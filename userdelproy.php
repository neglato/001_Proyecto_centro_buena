<!--    Script para eliminar un usuaro de un proyecto-->
    
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

    if (!isset($_SESSION['user'])){
        header('Location: index.php');
        exit();
    }

        if(isset($_POST['userdelproy'])){
            if($_POST['id_proyecto']==-1 || !isset($_POST['id_user2'])){
                header('Location: cpanelprofe.php?rm=1&rt=3&a=3');
                $_SESSION['msgprofe']=USUYPROY;
                exit();
            }else{
                include('_include/conexion.php');
                include('_include/funciones.php');
                $proy=$_POST['id_proyecto'];
                $use=$_POST['id_user2'];
                foreach($use as $i){
                        $consul2 = consulta($conexion,"DELETE FROM usuproy WHERE id_proyecto='{$proy}' AND id_user='{$i}'");
                    //correo
                    $email=consulta($conexion,"SELECT * FROM usuarios where id_user like $i");
                    $usFila=mysqli_fetch_array($email);
                    $nomUser=$usFila['nombre'];
                    $emailUser=$usFila['email'];
                    $proyecto=consulta($conexion,"SELECT * FROM proyectos where id_proyecto like $proy");
                    $prFila=mysqli_fetch_array($proyecto);
                    $nomPro=$prFila['nombre_pro'];
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
                    $mail->AddAddress("$emailUser");//A quien mandar email
                    $mail->SMTPKeepAlive = true;  
                    $mail->Mailer = "smtp"; 


                        //Content
                    $mail->isHTML(true); // Set email format to HTML


                    $mail->Subject = 'Ha sido relevado';
                    $mail->Body    = "Hola $nomUser, ha sido relevado de su puesto como editor del proyecto $nomPro.";

                    if(!$mail->send()) {
                      echo 'Error al enviar email';
                      echo 'Mailer error: ' . $mail->ErrorInfo;
                    } else {
                      echo 'Mail enviado correctamente';
                    }
                    //fin correo
                }
                        header('Location: cpanelprofe.php?rm=1&rt=3&a=3');
                        $_SESSION['msgprofe']=USUDELPROYOK;
                        mysqli_close($conexion);
                        exit(); 
            }
        }          
        ob_end_flush();
    ?>
   
  
 
