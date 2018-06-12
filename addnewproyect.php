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
    if(!isset($_POST['id_curso']) || !isset($_POST['id_coor']) || !isset($_POST['nombre']) || !isset($_POST['name'])){
            $_SESSION['msgaddproy']=ALLFIELDS;
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
            $name=htmlentities($_POST['name']);
            $curso=htmlentities($_POST['id_curso']);
            /*Comprobamos que exista el curso*/
            $cursos=consulta($conexion,"SELECT * FROM cursos WHERE id_curso like $curso");
            $siNo1=mysqli_num_rows($cursos);
            if($siNo1 == 0){
                $_SESSION['msgaddproy']=INVCURSO;
                header('Location: cpaneladmin.php?rm=3&rt=1a=3');
                exit();
            }
            $coor=htmlentities($_POST['id_coor']);
            /*comprobamos que exista el coordinador*/
            $coordinador=consulta($conexion,"SELECT * FROM usuarios WHERE id_user like $coor AND tipo like 1 AND baja like 0");
            $siNo2=mysqli_num_rows($coordinador);
            if($siNo2 == 0){
                $_SESSION['msgaddproy']=INVCOORD;
                header('Location: cpaneladmin.php?rm=3&rt=1a=3');
                exit();
            }
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
            $insert = consulta($conexion,"INSERT INTO proyectos (id_curso, fecha_pub, nombre_pro, name_pro)  VALUES ('{$curso}','1940-01-01','{$nombre}','{$name}')");
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
                $mail->Username ="$cuenta"; //Email para enviar
                $mail->Password = "$passEmail"; //Su password
                //Agregar destinatario
                $mail->setFrom("$cuenta", 'Admin');
                $mail->AddAddress("$emailCoor");//A quien mandar email
                $mail->SMTPKeepAlive = true;  
                $mail->Mailer = "smtp"; 


                    //Content
                $mail->isHTML(true); // Set email format to HTML


                $mail->Subject = 'Le ha sido asignado un proyecto';
                $mail->Body    = "<h1>¡Hola $nomCoor!</h1>
                                    <p>Ha sido seleccionado como coordinador de proyecto $nombre en la app de planes y proyectos del IES Delgado Hernández</p>
                                    <p>Puede Acceder a la App desde el siguiente enlace:</p>
                                        <p>$enlaceEmail</p>";

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
