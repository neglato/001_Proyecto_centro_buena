<?php
     session_start();

if(isset($_SESSION['lang'])){
if($_SESSION['lang']==1){
    include('_include/UK-uk.php'); 
    }else{
        include('_include/ES-es.php');
        }
    }else{
      include('_include/ES-es.php');
}  
if(!isset($_SESSION['user'])){
    header('Location: index.php');
    exit();
}

if(isset($_POST['tipo']) && $_POST['tipo'] == -1){
    header('Location: cpanelprofe.php?rm=2&rt=3&a=3');
    $_SESSION['msgprofe']=SELPROY;
    exit();
}elseif(isset($_POST['tipo']) && $_POST['tipo'] != -1){
    include('_include/conexion.php');
    include('_include/funciones.php');
    $idproy=$_POST['tipo'];
    //Hago la consulta para recuperar el nombre del curso y del proyecto
    $CONSULT = consulta($conexion,"SELECT * 
                                    FROM proyectos p, cursos c 
                                    WHERE p.id_curso=c.id_curso 
                                    AND p.id_proyecto='" . $idproy . "'"); 
    
    $info=mysqli_fetch_array($CONSULT);
    $año=$info['curso'];
    $nombpro=$info['nombre_pro'];
    $fecha=$info['fecha_pub'];
    //monto la ruta de los ficheros esp y eng y las guardo en variables
    $rutaes="_cursos/".$año."/".$nombpro."/1es.php";
    $rutaen="_cursos/".$año."/".$nombpro."/1en.php";
    //si existen ambos ficheros...
    if(file_exists($rutaes) && file_exists($rutaen)){
        /*comprobamos su fecha de pub*/
        if($fecha == "0000-00-00"){
        $UPDATE = consulta($conexion,"UPDATE proyectos SET 
                                        fecha_pub = CURRENT_DATE(),
                                        mostrar = 1 
                                        WHERE id_proyecto ='" . $idproy . "'"); 
        header('Location: cpanelprofe.php?rm=2&rt=3&a=3');
        $_SESSION['msgprofe']=PROYSIPUB;
        unset($_SESSION['tipo']);
        mysqli_close($conexion);
        exit();
        }else{
        $UPDATE = consulta($conexion,"UPDATE proyectos SET 
                                        mostrar = 1 
                                        WHERE id_proyecto ='" . $idproy . "'");
//mandar el correo:
//Load composer's autoloader
require_once('_include/PHPMailerAutoload.php'); 

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
$mail->Username ='idhappmaster@gmail.com'; //Email para enviar
$mail->Password = 'adminIdh1572'; //Su password
//Agregar destinatario
$mail->setFrom('idhappmaster@gmail.com', 'Admin');
//Creamos las varianles que vamosa necesitar, que sera la direccion de correo de todos los participantes en el proyecto menos el coordinador
$participa=consulta($conexion, "select email from usuarios where id_user in (select id_user from usuproy where id_proyecto like $idproy) and tipo = 2");
//guardamos todos los emails en $mail->AddAddress
while($par=mysqli_fetch_array($participa)){
    $dest=$par['email'];
    $mail->AddAddress("$dest");
}
/*$mail->AddAddress('');//A quien mandar email*/
$mail->SMTPKeepAlive = true;  
$mail->Mailer = "smtp"; 


    //Content
$mail->isHTML(true); // Set email format to HTML
//sacamos de la base de datos el resto de datos necesarios


$mail->Subject = "Proyecto publicado";
$mail->Body    = "El proyecto $nombpro, en que participa en la App de Planes y Proyectos del IES Delgado Henández ha sido publicado";

if(!$mail->send()) {
  echo 'Error al enviar email';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Mail enviado correctamente';
}
        

            //fin mandar correo
        $_SESSION['msgprofe']=PROYSIPUB;
        unset($_SESSION['tipo']);
            header('Location: cpanelprofe.php?rm=2&rt=3&a=3');
        mysqli_close($conexion);
        exit();  
        }
        //si no existen los ficheros...
    }else{
        header('Location: cpanelprofe.php?rm=2&rt=3&a=3');
        $_SESSION['msgprofe']=NOFILE;
        unset($_SESSION['tipo']);
        mysqli_close($conexion);
        exit();
    }
}
