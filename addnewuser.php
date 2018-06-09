<?php
session_start();
include('_include/variables.php');
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
    if($_POST['email']==""){
        $_SESSION['msgadd']=NNMAIL;
    }
        if($_POST['nombre'] !="" && $_POST['apellidos'] !="" && $_POST['email'] !=""){
                include('_include/conexion.php');
                include('_include/funciones.php');
            
            // Comprobamos que tipo de usuario esta creando a otro usuario
                $USER = $_SESSION['user']; 
                $comprob = consulta($conexion,"SELECT * FROM usuarios WHERE id_user = '".$USER."'");
                $info = mysqli_fetch_array($comprob); 
            
            $email=htmlentities($_POST['email']);
            $resultado = consulta($conexion,"SELECT * from usuarios where email ='{$email}' and baja like 0");
            $totalFilas= mysqli_num_rows($resultado);
            if($totalFilas > 0){
                $_SESSION['msgadd']=NODISP;
                if($info['tipo']==0){
                    header('Location: cpaneladmin.php?rm=1&rt=1a=3');
                }elseif($info['tipo']==1){
                    header('Location: cpanelprofe.php?rm=1&rt=1a=3');
                        }
                exit(); 
            }else if($totalFilas == 0){
                $contraseña=$chorizo1.$email.$chorizo2;
                $emailhash=md5($contraseña);
                $baja = consulta($conexion,"SELECT * from usuarios where email ='{$email}' and baja like 1");
                $datos=mysqli_fetch_array($baja);
                $deBaja= mysqli_num_rows($baja);
                    if($deBaja > 0){
                        $update=consulta($conexion,"UPDATE usuarios SET password='{$emailhash}', baja='0' where email like '{$email}'");
                        $nomUSer=$datos['nombre'];
                        $_SESSION['msgadd']=USRALT;
                        //Enviamos un correo para avisar de la activacion de la cuenta
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
                        $mail->Username ="$cuenta"; //Email para enviar
                        $mail->Password = "$passEmail"; //Su password
                        //Agregar destinatario
                        $mail->setFrom("$cuenta", 'Admin');
                        $mail->AddAddress("$email");//A quien mandar email
                        $mail->SMTPKeepAlive = true;  
                        $mail->Mailer = "smtp"; 


                        //Content
                        $mail->isHTML(true); // Set email format to HTML


                        $mail->Subject = 'Cuenta dada de alta';
                        $mail->Body    = "<h1>¡Hola $nomUSer!</h1>
                                        <p>Le informamos de que su cuenta ha sido dada de alta nuevamente en la APP de Planes y proyectos del IES Delgado Hernández.</p>
                                        <p>Puede Acceder a la App desde el siguiente enlace:</p>
                                        <p>$enlaceEmail</p>";

                        if(!$mail->send()) {
                                echo 'Error al enviar email';
                                echo 'Mailer error: ' . $mail->ErrorInfo;
                            } else {
                                echo 'Mail enviado correctamente';
                            }
                        //Fin correo
                        if($info['tipo']==0){
                            header('Location: cpaneladmin.php?rm=1&rt=1a=3');
                            exit();
                        }elseif($info['tipo']==1){
                            header('Location: cpanelprofe.php?rm=1&rt=1a=3');
                            exit();
                        }
                        }else{
                $nombre=htmlentities($_POST['nombre']);
                $apellidos=htmlentities($_POST['apellidos']);
                $sexo=htmlentities($_POST['sexo']);
                        if($sexo != 0 && $sexo !=1){
                            $sexo=0;
                        }
                $email=htmlentities($_POST['email']);
                $tipo=htmlentities($_POST['tipo']);
                        if($tipo != 0 && $tipo != 1 && $tipo != 2){
                            $tipo= 2;
                        }
                $contraseña=$chorizo1.$email.$chorizo2;
                $emailhash=md5($contraseña);
                    if($info['tipo']==0){
                        $resultado = consulta($conexion,"INSERT INTO usuarios (nombre, apellidos, sexo, email, password, tipo)  VALUES ( 
                                    '{$nombre}', 
                                    '{$apellidos}',
                                    '{$sexo}',
                                    '{$email}', 
                                    '{$emailhash}',
                                    '{$tipo}'
                                    )
                                    ");
                    
                    }elseif($info['tipo']==1){
                        $resultado = consulta($conexion,"INSERT INTO usuarios (nombre, apellidos, sexo, email, password, tipo)  VALUES ( 
                                    '{$nombre}', 
                                    '{$apellidos}',
                                    '{$sexo}',
                                    '{$email}', 
                                    '{$emailhash}',
                                    '2'
                                    )
                                    ");
                    }
                        //Enviamos un correo para informar que ha sido registrado 
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
                        $mail->Username ="$cuenta"; //Email para enviar
                        $mail->Password = "$passEmail"; //Su password
                        //Agregar destinatario
                        $mail->setFrom("$cuenta", 'Admin');
                        $mail->AddAddress("$email");//A quien mandar email
                        $mail->SMTPKeepAlive = true;  
                        $mail->Mailer = "smtp"; 


                        //Content
                        $mail->isHTML(true); // Set email format to HTML


                        $mail->Subject = 'Ha sido registrado';
                        $mail->Body    = "<h1>¡Hola $nombre!</h1>
                                        <p>Usted ha sido registrado en la APP de Planes y Proyectos de IES Delgado Hernandez, su contraseña inicial es el propio email usado en el registro, que deberá ser cambiada en el primer inicio de sesión por motivos de seguridad</p>
                                         <p>Puede Acceder a la App desde el siguiente enlace:</p>
                                        <p>$enlaceEmail</p>";

                        if(!$mail->send()) {
                            echo 'Error al enviar email';
                            echo 'Mailer error: ' . $mail->ErrorInfo;
                        } else {
                            echo 'Mail enviado correctamente';
                        }
                        //FIn del correo
                    $home="_users/$email";
                    if (!file_exists($home)) {
                        mkdir($home, 0777, true);
                    }
                    
                    if($info['tipo']==0){
                        header('Location: cpaneladmin.php?rm=1&rt=1a=3');
                    }elseif($info['tipo']==1){
                        header('Location: cpanelprofe.php?rm=1&rt=1a=3');
                    }
                    
                    $_SESSION['msgadd']=ADDCUR;
                    mysqli_close($conexion);
                    exit();
                }
            }
        }
?>


