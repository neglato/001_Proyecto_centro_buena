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
    if (!isset($_SESSION['user'])){
        header('Location: index.php');
        exit();
    }
    if(!isset($_POST['id_curso']) || !isset($_POST['id_coor']) || !isset($_POST['nombre']) || !isset($_POST['name'])){
            $_SESSION['msgaddproy']=ALLFIELDS;
        echo $_POST['id_curso']."/".$_POST['id_coor']."/".$_POST['nombre']."/".$_POST['name'];
            header('Location: cpaneladmin.php?rm=3&rt=1a=3');
            exit();
    }
    if($_POST['id_curso']=="" || $_POST['id_coor']=="" || $_POST['nombre'] =="" || $_POST['name']==""){
        $_SESSION['msgaddproy']=FOOBL;
        header('Location: cpaneladmin.php?rm=3&rt=1a=3');
        exit();
    }
        if($_POST['id_curso'] !=-1 && $_POST['id_coor'] !=-1 && $_POST['nombre'] !="" && $_POST['name'] !=""){
                include('_include/conexion.php');
                include('_include/funciones.php');
            /*Comprobamos que no exista ya en la base de datos*/
            $nombre=$_POST['nombre'];
            $name=$_POST['name'];
            $curso=$_POST['id_curso'];
            $coor=$_POST['id_coor'];
            $resultado1 = consulta($conexion,"SELECT * from proyectos where nombre_pro='{$nombre}' and id_curso like $curso");
            $totalFilas1= mysqli_num_rows($resultado1);
            $resultado2 = consulta($conexion,"SELECT * from proyectos where name_pro='{$name}' and id_curso like $curso");
            $totalFilas2= mysqli_num_rows($resultado2);
            if($totalFilas1 > 0 || $totalFilas2 > 0 ){             
                $_SESSION['msgaddproy']=EXISPROY;
                header('Location: cpaneladmin.php?rm=3&rt=1a=3');
                mysqli_close($conexion);
                exit(); 
            }else{
                /*creamos el curso y su carpeta home*/
            $insert = consulta($conexion,"INSERT INTO proyectos (id_curso, nombre_pro, name_pro)  VALUES ('{$curso}','{$nombre}','{$name}')");
            $newpro =consulta($conexion,"SELECT * from proyectos where nombre_pro='{$nombre}' and id_curso='{$curso}'");
            $newpro = mysqli_fetch_array($newpro);
            $id_pro=$newpro['id_proyecto'];
            $nomCurso=consulta($conexion,"SELECT * from cursos where id_curso='{$curso}'");
            $nomCurso=mysqli_fetch_array($nomCurso);
            $nomCurso=$nomCurso['curso'];
            $insert2 = consulta($conexion,"INSERT INTO usuproy (id_proyecto, id_user)  VALUES ('{$id_pro}','{$coor}')");
            $home="_cursos/$nomCurso/$nombre";
            mkdir($home, 0777, true);
                //Enviamos un correo al coordinador para que sepa que se le ha asignado un proyecto
                //primero sacamos el email del cordinador y su nombre
                $emCoor= consulta($conexion, "SELECT * FROM usuarios WHERE id_user like $coor");
                $filaCoor=mysqli_fetch_array($emCoor);
                $nomCoor= $filaCoor['nombre'];
                $emailCoor= $filaCoor['email'];
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
                $mail->AddAddress("$emailCoor");//A quien mandar email
                $mail->SMTPKeepAlive = true;  
                $mail->Mailer = "smtp"; 


                    //Content
                $mail->isHTML(true); // Set email format to HTML


                $mail->Subject = 'Le ha sido asignado un proyecto';
                $mail->Body    = "Hola $nomCoor, ha sido seleccionado como coordinador de proyecto $nombre en la app de planes y proyectos del IES Delgado Hernández";

                if(!$mail->send()) {
                  echo 'Error al enviar email';
                  echo 'Mailer error: ' . $mail->ErrorInfo;
                } else {
                  echo 'Mail enviado correctamente';
                }
                //Fin de enviar correo
                $_SESSION['msgaddproy']=ADDPROY;
                mysqli_close($conexion);
                header('Location: cpaneladmin.php?rm=3&rt=1a=3');
                exit();
                }
        }


?>
