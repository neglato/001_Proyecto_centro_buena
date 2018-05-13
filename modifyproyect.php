<?php
ob_start();
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
if(!isset($_POST['nombre']) || !isset($_POST['name']) || !isset($_POST['id_curso']) || !isset($_POST['id_coor'])){
    $_SESSION['msgmodproy']=ALLFIELDS;
    header('Location: cpaneladmin.php?rm=3&rt=2&a=3&pid='.$pid.'');
    exit;
}
        if($_POST['nombre'] !="" && $_POST['name'] !="" && $_POST['id_curso'] !=-1 && $_POST['id_coor'] !=-1){
            include('_include/conexion.php');
            include('_include/funciones.php');
                    $pid=$_SESSION['pid'];
                    unset($_SESSION['pid']);
                    $nombre=$_POST['nombre'];
                    $name=$_POST['name'];
                    $idCurso=$_POST['id_curso'];
                    $coor=$_POST['id_coor'];
            /*comprobamos si existe algun proyecto con el nombre introducido en el curso elegido*/
                $porNombre = consulta($conexion,"SELECT * FROM proyectos WHERE nombre_pro ='" . $nombre . "' and id_curso like $idCurso"); 
                $infoNombre=mysqli_fetch_array($porNombre);
                $totalNombre=mysqli_num_rows($porNombre);
            /*comprobamos si existe algun proyecto con el name introducido en el curso elegido*/
                $porName = consulta($conexion,"SELECT * FROM proyectos WHERE name_pro ='" . $name . "' and id_curso like $idCurso"); 
                $infoName=mysqli_fetch_array($porName);
                $totalName=mysqli_num_rows($porName);
            /*Buscamos el proyecto con el id que elegimos para editarlo*/
                $RESULT2 = consulta($conexion,"SELECT * FROM proyectos WHERE id_proyecto ='" . $pid . "'"); 
                $info2=mysqli_fetch_array($RESULT2);
                $total2=mysqli_num_rows($RESULT2);
            /*Primero rescatamos el curso actual y su nombre actual, para poder cambiar la ruta de su carpeta*/
                $porCur = consulta($conexion,"SELECT * FROM proyectos WHERE id_proyecto like $pid"); 
                $infoCur=mysqli_fetch_array($porCur);
                $cursoAc=$infoCur['id_curso'];
                $nomAct=$infoCur['nombre_pro'];
                $cursoAct= consulta($conexion,"SELECT * FROM cursos WHERE id_curso like $cursoAc");
                $infoCurso=mysqli_fetch_array($cursoAct);
                $cursoActual=$infoCurso['curso'];
            /*si existe alguno con el nombre o el name en el curso elegido*/
                if($totalNombre > 0 || $totalName > 0){
                /*comprobamos si el proyecto que nos sale en la consulta es el propio proyecto que estamos editando*/
                if($infoNombre['id_proyecto'] == $pid || $infoName['id_proyecto'] == $pid){
                    //Comprobamos si ha cambiado el coordinador para enviar los correos pertinentes
                    $CompCoor= consulta($conexion, "SELECT * FROM usuproy where id_proyecto like $pid and id_user in (SELECT id_user FROM usuarios where tipo =1) ");
                    $oldCo=mysqli_fetch_array($CompCoor);
                    $oldCoor= $oldCo['id_user'];
                    //si es el propio proyecto le hacemos el update de los datos*/
                    $UPDATE = consulta($conexion,"UPDATE proyectos SET 
                                                    id_curso ='" . $idCurso . "',
                                                    nombre_pro ='" . $nombre . "',
                                                    name_pro = '" . $name . "' 
                                                    WHERE id_proyecto ='" . $pid . "'
                                                    ");
                    $UPDATE2= consulta($conexion, "update usuproy SET
                                                    id_user ='". $coor ."'
                                                    where id_proyecto like $pid and id_user in (SELECT id_user from usuarios
                                                                                              where tipo like 1)
                                                    ");
                    //ahora comprobamos si ha cambiado de coordinador y mandamos el correo
                    if($coor != $oldCoor){
                        //rescatamos el email de ambos:
                        $antCo=consulta ($conexion, "SELECT * from usuarios where id_user like $oldCoor");
                        $filaAntCo=mysqli_fetch_array($antCo);
                        $oldCoorNom=$filaAntCo['nombre'];
                        $oldCoorEmail=$filaAntCo['email'];
                        $actCo=consulta ($conexion, "SELECT * from usuarios where id_user like $coor");
                        $filaNewCo=mysqli_fetch_array($actCo);
                        $newCoorNom=$filaNewCo['nombre'];
                        $newCoorEmail=$filaNewCo['email'];
                        //mandamos el correo al antigui coordinador
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
                $mail->AddAddress("$oldCoorEmail");//A quien mandar email
                $mail->SMTPKeepAlive = true;  
                $mail->Mailer = "smtp"; 


                    //Content
                $mail->isHTML(true); // Set email format to HTML


                $mail->Subject = 'Ha sido relevado';
                $mail->Body    = "Hola $oldCoorNom, ha sido relevado de su labor como coordinador de proyecto $nombre en la app de planes y proyectos del IES Delgado Hernández";

                if(!$mail->send()) {
                  echo 'Error al enviar email';
                  echo 'Mailer error: ' . $mail->ErrorInfo;
                } else {
                  echo 'Mail enviado correctamente';
                }
                    
                //ahora lo enviamos al nuevo coordinador
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
                $mail->AddAddress("$newCoorEmail");//A quien mandar email
                $mail->SMTPKeepAlive = true;  
                $mail->Mailer = "smtp"; 


                    //Content
                $mail->isHTML(true); // Set email format to HTML


                $mail->Subject = 'Le ha sido asignado un proyecto';
                $mail->Body    = "Hola $newCoorNom, ha sido elegido como coordinador de proyecto $nombre en la app de planes y proyectos del IES Delgado Hernández";

                if(!$mail->send()) {
                  echo 'Error al enviar email';
                  echo 'Mailer error: ' . $mail->ErrorInfo;
                } else {
                  echo 'Mail enviado correctamente';
                }
                //Fin de enviar correo
                    }
                    /*Comprobamos que el nombre introducido sea distinto que el nombre actual*/
                    if($infoCur['nombre_pro'] != $nombre){
                        /*renombramos la carpeta del proyecto*/
                        $homeact="_cursos/".$cursoActual."/".$nomAct."";
                        $homenew="_cursos/".$cursoActual."/".$nombre."";
                        rename($homeact,$homenew);
                    }
                    $_SESSION['msgmodproy2']=MODPROYCURR;
                    header('Location: cpaneladmin.php?rm=3&rt=2&a=3');
                    unset($_SESSION['pid']);
                    exit;
                    }else{
                    /*si no es el propio proyecto*/
                     $_SESSION['msgmodproy']=NONOM;
                      header('Location: cpaneladmin.php?rm=3&rt=2&a=3&pid='.$pid.'');
                    exit();
                }
            }else if($totalNombre == 0 && $totalName == 0){
                    /*si no existe hacemos el update*/
                    /*Buscamos el nombre del curso introducido*/
                    $newCurso= consulta($conexion,"SELECT * FROM cursos Where id_curso like $idCurso");
                    $infoNewCurso=mysqli_fetch_array($newCurso);
                    $cursoNew= $infoNewCurso['curso'];
                    $infoCurso=mysqli_fetch_array($cursoAct);
                //Comprobamos si ha cambiado el coordinador para enviar los correos pertinentes
                    $CompCoor= consulta($conexion, "SELECT * FROM usuproy where id_proyecto like $pid and id_user in (SELECT id_user FROM usuarios where tipo =1) ");
                    $oldCo=mysqli_fetch_array($CompCoor);
                    $oldCoor= $oldCo['id_user'];
                    /*hacemos el update*/
                    $UPDATE = consulta($conexion,"UPDATE proyectos SET 
                                                    id_curso ='" . $idCurso . "',
                                                    nombre_pro ='" . $nombre . "',
                                                    name_pro = '" . $name . "' 
                                                    WHERE id_proyecto ='" . $pid . "'
                                                    ");
                    $UPDATE2= consulta($conexion, "update usuproy SET
                                                    id_user ='". $coor ."'
                                                    where id_proyecto like $pid and id_user in(SELECT id_user from usuarios
                                                                                              where tipo like 1)
                                                    ");
                    
                        /*renombramos la carpeta del proyecto*/
                        $nomAct=$infoCur['nombre_pro'];
                        $homeact="_cursos/".$cursoActual."/".$nomAct."";
                        $homenew="_cursos/".$cursoNew."/".$nombre."";
                        rename($homeact,$homenew);
                                        //ahora comprobamos si ha cambiado de coordinador y mandamos el correo
                    if($coor != $oldCoor){
                        //rescatamos el email de ambos:
                        $antCo=consulta ($conexion, "SELECT * from usuarios where id_user like $oldCoor");
                        $filaAntCo=mysqli_fetch_array($antCo);
                        $oldCoorNom=$filaAntCo['nombre'];
                        $oldCoorEmail=$filaAntCo['email'];
                        $actCo=consulta ($conexion, "SELECT * from usuarios where id_user like $coor");
                        $filaNewCo=mysqli_fetch_array($actCo);
                        $newCoorNom=$filaNewCo['nombre'];
                        $newCoorEmail=$filaNewCo['email'];
                        //mandamos el correo al antigui coordinador
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
                $mail->AddAddress("$oldCoorEmail");//A quien mandar email
                $mail->SMTPKeepAlive = true;  
                $mail->Mailer = "smtp"; 


                    //Content
                $mail->isHTML(true); // Set email format to HTML


                $mail->Subject = 'Ha sido relevado';
                $mail->Body    = "Hola $oldCoorNom, ha sido relevado de su labor como coordinador de proyecto $nombre en la app de planes y proyectos del IES Delgado Hernández";

                if(!$mail->send()) {
                  echo 'Error al enviar email';
                  echo 'Mailer error: ' . $mail->ErrorInfo;
                } else {
                  echo 'Mail enviado correctamente';
                }
                    
                //ahora lo enviamos al nuevo coordinador
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
                $mail->AddAddress("$newCoorEmail");//A quien mandar email
                $mail->SMTPKeepAlive = true;  
                $mail->Mailer = "smtp"; 


                    //Content
                $mail->isHTML(true); // Set email format to HTML


                $mail->Subject = 'Le ha sido asignado un proyecto';
                $mail->Body    = "Hola $newCoorNom, ha sido elegido como coordinador de proyecto $nombre en la app de planes y proyectos del IES Delgado Hernández";

                if(!$mail->send()) {
                  echo 'Error al enviar email';
                  echo 'Mailer error: ' . $mail->ErrorInfo;
                } else {
                  echo 'Mail enviado correctamente';
                }
                //Fin de enviar correo
                    }
                    /*Comprobamos que el nombre introducido sea distinto que el nombre actual*/
                    if($infoCur['nombre_pro'] != $nombre){
                        /*renombramos la carpeta del proyecto*/
                        $homeact="_cursos/".$cursoActual."/".$nomAct."";
                        $homenew="_cursos/".$cursoActual."/".$nombre."";
                        rename($homeact,$homenew);
                    }
                    $_SESSION['msgmodproy2']=MODPROYCURR;
                    header('Location: cpaneladmin.php?rm=3&rt=2&a=3');
                    unset($_SESSION['pid']);
                    exit;
                    }else{
                    /*si no es el propio proyecto*/
                     $_SESSION['msgmodproy']=NONOM;
                      header('Location: cpaneladmin.php?rm=3&rt=2&a=3&pid='.$pid.'');
                    exit();
                }
                    
                        $_SESSION['msgmodproy2']=MODPROYCURR;
                        header('Location: cpaneladmin.php?rm=3&rt=2&a=3');
                        exit();
        }else{
            header('Location: cpaneladmin.php?rm=3&rt=2&a=3');
            exit();  
        }
ob_end_flush();