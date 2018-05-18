<?php 
    include('_include/variables.php');
    include('_include/funciones.php');
    include('_include/conexion.php');
    session_start();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
    
    exit();
}
    if(isset($_SESSION['lang'])){
        if($_SESSION['lang']==1){
            include('_include/UK-uk.php'); 
        }else{
            include('_include/ES-es.php');
            }
    }else{
        include('_include/ES-es.php');
        }
$idp=$_SESSION['idp'];
if(!isset($_POST['idioma']) || !isset($_POST['editor1'])){
    header("Location: index.php");
    exit();
}
if($_POST['idioma']== -1){
    $_SESSION['msgtexto']="Debes elegir un idioma";
    header("Location: cpanelalum.php?a=3&rm=2&rt=1&idp=$idp");
    exit();
}
if($_POST['editor1']==""){
    $_SESSION['msgtexto']="Debes redactar un texto";
    header("Location: cpanelalum.php?a=3&rm=2&rt=1&idp=$idp");
    exit(); 
}
/*recuperamos el proyecto y su curso, para poder acceder a la carpeta donde guardar el texto*/
$proyecto= consulta($conexion, "Select * from proyectos where id_proyecto like $idp");
$proy=mysqli_fetch_array($proyecto);
/*guardamos el nombre_pro y el id_curso*/
$nomProy=$proy['nombre_pro'];
$idCur=$proy['id_curso'];
$curso= consulta($conexion, "select * from cursos where id_curso like $idCur");
/*guardamos el nombre del curso*/
$cur= mysqli_fetch_array($curso);
$nomCur=$cur['curso'];
/*montamos su directorio*/
$directorio="_cursos/".$nomCur."/".$nomProy;
if($_POST['idioma']== "1es.php" || $_POST['idioma']== "1en.php"){
    $archivo=$directorio."/".$_POST['idioma'];
    if(file_exists($archivo)){
        /*si existe lo eliminamos y volvemos a crear*/
        $open = fopen($archivo,"w+"); 
        $text = $_POST['editor1']; 
        fwrite($open, $text); 
        fclose($open);
        $_SESSION['msgtexto']=UPDATETEXT; 
    }else{
        /*creamos el fichero*/
        $open = fopen($archivo, "w+");
        $text = $_POST['editor1']; 
        fwrite($open, $text); 
        fclose($open);
        $_SESSION['msgtexto']=CREATETEXT;
    }
            //mandar el correo:
        //Load composer's autoloader
        require_once('_include/PHPMailerAutoload.php'); 
        //Creamos las varianles que vamosa necesitar, los datos del coordinador
        $participa=consulta($conexion, "select email, nombre from usuarios where id_user in (select id_user from usuproy where id_proyecto like $idp) and tipo = 1");
        $par=mysqli_fetch_array($participa);
        $mail = new PHPMailer(true); 
        $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
        $mail->SMTPDebug = 2; 
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;// TCP port to connect to
        $mail->CharSet = 'UTF-8';
        $mail->Username ="$cuenta"; //Email para enviar
        $mail->Password = "$passEmail"; //Su password
        //Agregar destinatario
        $mail->setFrom("$cuenta", 'Admin');
        //guardamos todos los emails en $mail->AddAddress
        $dest=$par['email'];
        $mail->AddAddress("$dest");
        $mail->SMTPKeepAlive = true;  
        $mail->Mailer = "smtp";
        //Content
    $nomInt=$par['nombre'];
        $mail->isHTML(true); // Set email format to HTML
        //sacamos de la base de datos el resto de datos necesarios
        $mail->Subject = "Añadido nuevo articulo";
        $mail->Body    = "<h1>¡Hola $nomInt!</h1> 
                        <p>El proyecto $nombpro, que coordina en la App de Planes y Proyectos del IES Delgado Henández ha recibido una actualizacion en su artciulo</p>";

        if(!$mail->send()) {
              echo 'Error al enviar email';
              echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
              echo 'Mail enviado correctamente';
        }
        //fin mandar correo
        header("Location: cpanelalum.php?a=3&rm=2&rt=1&idp=$idp");
        mysqli_close($conexion);
        exit(); 
    
}

