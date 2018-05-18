<?php 
    include('_include/variables.php');
    include('_include/funciones.php');
    include('_include/conexion.php');
    session_start();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
    mysqli_close($conexion);
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
/*primero comprobamos que exista $_POST['fotos']*/
if(!isset($_POST['fotos']) && !isset($_SESSION['fotosdel'])){
   header('Location: index.php');
    mysqli_close($conexion);
    exit();
}
if(isset($_POST['fotos'])){
    unset($_SESSION['fotosdel']);
}
if(isset($_SESSION['fotosdel'])){
    /*ssi existe lo mandamos a la propia pagina para que seleccione al menos una imagen*/
        $_SESSION['msgalfot']=SELFOTO;
        header("Location: cpanelalum.php?a=3&rm=2&rt=2&idp=$idp");
        mysqli_close($conexion);
        exit();
}
if(count($_POST['fotos']) > 0){
        /*sacamos el curso del proyecto y su nombre, para poder eliminar la foto de su directrio*/
            $proyecto = consulta($conexion, "Select * from proyectos where id_proyecto like $idp");
            $row= mysqli_fetch_array($proyecto);
            $curso=$row['id_curso'];
            $nombre_pro=$row['nombre_pro'];
            $cursoN= consulta ($conexion, "select * from cursos where id_curso like $curso");
            $fila=$img= mysqli_fetch_array($cursoN);
            $nomCurso= $fila['curso'];
        /*si no lo es, recorremos el array y hacemos un delete en la base de datos y borramos la foto del servidor*/
        $max = sizeof($_POST['fotos']);
        $i;
        for($i = 0; $i < $max;$i++){
            $foto=$_POST['fotos'][$i];
            /*recuperamos el nombre de la imagen*/
            $imgN= consulta($conexion,"select * from imgproy where id_img like $foto");
            $imgV=mysqli_fetch_array($imgN);
            $nomImg=$imgV['imagen'];
        $delete= consulta($conexion,"delete from imgproy 
                            where id_img like $foto");
            /*borramos la imagen*/
            $img="_cursos/".$nomCurso."/".$nombre_pro."/".$nomImg."";
            unlink($img);
            

        }
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
    $nombpro=$proy['nombre_pro'];
        $mail->AddAddress("$dest");
        $mail->SMTPKeepAlive = true;  
        $mail->Mailer = "smtp";
        //Content
        $mail->isHTML(true); // Set email format to HTML
        //sacamos de la base de datos el resto de datos necesarios
        $nomInt=$par['nombre'];
        $mail->Subject = "Fotos eliminadas";
        $mail->Body    = "<h1>¡Hola $nomInt!</h1>
                            <p>Algunas fotos del proyecto $nombpro, en que participa en la App de Planes y Proyectos del IES Delgado Henández, han sido eliminadas</p>";

        if(!$mail->send()) {
              echo 'Error al enviar email';
              echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
              echo 'Mail enviado correctamente';
        }
        //fin mandar correo
    $_SESSION['msgalfot']=DELFOTO;
        header("Location: cpanelalum.php?a=3&rm=2&rt=2&idp=$idp");
        mysqli_close($conexion);
        exit();
    }




