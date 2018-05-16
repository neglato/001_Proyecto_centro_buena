<!--    Script para añadir un usuaro a un proyecto-->
    
    <?php
ob_start();
include('_include/variables.php');
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

        if(isset($_POST['usu2proy'])){
            if($_POST['id_proyecto']==-1 || !isset($_POST['id_user2'])){
                header('Location: cpanelprofe.php?rm=1&rt=2&a=3');
                $_SESSION['msgprofe']=USUYPROY;
                exit();
            }else{
                include('_include/conexion.php');
                include('_include/funciones.php');
                $proy=$_POST['id_proyecto'];
                $use=$_POST['id_user2'];
                foreach($use as $i){
                        $consul = consulta($conexion,"INSERT INTO usuproy (id_proyecto, id_user)  VALUES 
                                                        ('" . $proy . "','" . $i . "')");
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
                    $mail->Username ="$cuenta"; //Email para enviar
                    $mail->Password = "$passEmail"; //Su password
                    //Agregar destinatario
                    $mail->setFrom("$cuenta", 'Admin');
                    $mail->AddAddress("$emailUser");//A quien mandar email
                    $mail->SMTPKeepAlive = true;  
                    $mail->Mailer = "smtp"; 


                        //Content
                    $mail->isHTML(true); // Set email format to HTML


                    $mail->Subject = 'Ha sido asignado como editor';
                    $mail->Body    = "<h1>¡Hola $nomUser!</h1> 
                                    <p>Ha sido asignado como editor del proyecto $nomPro, en la APP de Planes y Proyectos del IES DELGADO HERNANDEZ.</p>";

                    if(!$mail->send()) {
                      echo 'Error al enviar email';
                      echo 'Mailer error: ' . $mail->ErrorInfo;
                    } else {
                      echo 'Mail enviado correctamente';
                    }
                }
                        header('Location: cpanelprofe.php?rm=1&rt=2&a=3');
                        $_SESSION['msgprofe']=USU2PROYOK;
                        mysqli_close($conexion);
                        exit(); 
            }
        }
        
   ob_end_flush();