<?php 
ob_start();
    session_start();
 include('_include/variables.php');
    include('_include/funciones.php');
    include('_include/conexion.php');
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
if(!isset($_FILES["files"])){
    header("Location: index.php");
    exit();
}else{
    $total=count($_FILES["files"]["name"]);
    if($total > 0){
        if(end($_FILES["files"]["name"])==""){
        $_SESSION['msgsubfot']=SELFOTO;
        header("Location: cpanelalum.php?a=3&rm=2&rt=2&idp=$idp");
        exit();
        }else{
        /*si no lo es, recorremos el array y hacemos un delete en la base de datos y borramos la foto del servidor*/
        /*sacamos el curso del proyecto y su nombre, para poder eliminar la foto de su directrio*/
            $proyecto = consulta($conexion, "Select * from proyectos where id_proyecto like $idp");
            $row= mysqli_fetch_array($proyecto);
            $curso=$row['id_curso'];
            $nombre_pro=$row['nombre_pro'];
            $cursoN= consulta ($conexion, "select * from cursos where id_curso like $curso");
            $fila= mysqli_fetch_array($cursoN);
            $nomCurso= $fila['curso'];
            print_r ($_FILES["files"]);
            /*si ya existe no hacemos nada*/
        $max = sizeof($_FILES["files"]["name"]);
        $i;
    
        for($i = 0; $i < $max;$i++){
            $foto=$_FILES["files"]["name"][$i];
            $img="_cursos/".$nomCurso."/".$nombre_pro."/".$foto."";
            if(file_exists($img) == true){
                }else{
            $insert= consulta($conexion,"INSERT INTO imgproy (id_proyecto, imagen)  VALUES ('$idp','$foto')");
            /*subimos la imagen*/
            $tmp=$_FILES["files"]["tmp_name"][$i];
            $uploadfile_temporal=$foto; 
            $uploadfile_nombre=$img;
            move_uploaded_file($tmp, $img);
            }
        }
        unset($_SESSION['msgalfot']);
        //mandar el correo:
        //Load composer's autoloader
        require_once('_include/PHPMailerAutoload.php'); 
        //Creamos las varianles que vamosa necesitar, los datos del coordinador
        $participa=consulta($conexion, "select email, nombre from usuarios where id_user in (select id_user from usuproy where id_proyecto like $idp) and tipo = 1");
        $proyecto= consulta($conexion, "SELECT * FROM proyectos where id_proyecto like $idp");
        $proy=mysqli_fetch_array($proyecto);
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
        $nomCoor=$par['nombre'];
            $nombpro=$proy['nombre_pro'];
        $mail->isHTML(true); // Set email format to HTML
        //sacamos de la base de datos el resto de datos necesarios
        $mail->Subject = "Añadido nuevas imagenes";
        $mail->Body    = "<h1>¡Hola $nomCoor!</h1>
                        <p>El proyecto $nombpro, en que participa en la App de Planes y Proyectos del IES Delgado Henández ha recibido nuevas imagenes</p>";

        if(!$mail->send()) {
              echo 'Error al enviar email';
              echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
              echo 'Mail enviado correctamente';
        }
        //fin mandar correo
        $_SESSION['msgsubfot']=UPFOTO;
        header("Location: cpanelalum.php?a=3&rm=2&rt=2&idp=$idp");
                mysqli_close($conexion);
                exit();
    }
        }
        

    }
ob_end_flush();

