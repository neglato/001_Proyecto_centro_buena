<!DOCTYPE html>
<?php
session_start(); 
ob_start();
include('_include/variables.php');
if(!isset($_SESSION['user']) && !isset($_GET['proy'])){
    header('Location: index.php');
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
$activo=3;
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=TITPASS?><?=TIT1?></title>
    <link rel="stylesheet" href="_css/estilosheader.css">
    <link rel="stylesheet" href="_css/cambiapass.css">
    <link rel="stylesheet" href="_css/footer.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    

    
</head>

<body>
      <header>
       <figure>
           <figcaption>Logo</figcaption>
           <img src="_img/logoDH.jpg">
       </figure>
       <spam id="slogan">
       <p><?=PYP?></p>
       <p id="p2">IES Delgado Hernández</p>
       </spam>
        <div id="sep"></div>
        <div id="sep2"></div>
        <div id="lys">
        <spam id="saludo">
        <?php if(isset($_SESSION['user'])){?>
         <p><?php
             switch($_SESSION['sexo']){
            case 0:
                echo BIENVH;
                break;
            case 1:
                echo BIENVM;
            break; 
                }
             ?> <?=$_SESSION['nombre']?></p>
         <?php }
                elseif(isset($_SESSION['msglo'])){?>
                        <p id="logout"><?=$_SESSION['msglo']?></p>
                    <?php unset($_SESSION['msglo']);
                       }
            ?>
         </spam>
         <div id="lang">
             <ul>
                 <li><a href="indexEs.php"><img src="_img/Sp.ico"></a></li>
                 <li><a href="indexUk.php"><img src="_img/Uk.ico"></a></li>
             </ul>
        </div>
       </div>
<?php
if(isset($_POST['newpass']) && isset($_POST['confpass'])){
    
    include('_include/funciones.php');
    include('_include/conexion.php');
        $newpass=$_POST['newpass'];
        $confpass=$_POST['confpass'];
    if(isset($_GET['proy'])){
        $id=$_GET['proy'];
    }else{
        $id=$_SESSION['user'];
    }
        if($newpass != $confpass){
            if(isset($_GET['proy'])){
                $_SESSION['msgpass']=CONFPASSFAL;
                $proy=$_GET['proy'];
                header("Location: cambiapass.php?proy=$proy");
                exit();  
                }
            $_SESSION['msgpass']=CONFPASSFAL;
            header('Location: cambiapass.php');
            exit();
        }else{
            //buscamos el email del usuario.
            if(isset($_GET['proy'])){
            $id=$_GET['proy'];
            $emailUser=consulta($conexion,"SELECT * FROM usuarios where id_user like $id");
            $usu=mysqli_fetch_array($emailUser);
            $nomUser=$usu['nombre'];
            $email=$usu['email'];
            }else{
                $nomUser=$_SESSION['nombre'];
                $email=$_SESSION['email'];
            }
            if( $newpass == $email ){
                $_SESSION['msgpass']=PASSISMAIL;
                if(isset($_GET['proy'])){
                    $proy=$_GET['proy'];
                  header("Location: cambiapass.php?proy=$proy");
                exit();  
                }
                header('Location: cambiapass.php');
                exit();
            }else{
                $contraseña=$chorizo1.$newpass.$chorizo2;
                $newpass=md5($contraseña);
                $update=consulta($conexion,"UPDATE usuarios SET password='{$newpass}' where id_user like '{$id}'");
                if(!isset($_GET['proy'])){
                    $_SESSION['password']=$newpass;
                }
                        //enviamos el correo
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


$mail->Subject = 'Contraseña modificada';
$mail->Body    = "<h1>¡Hola $nomUser!</h1>
                    <p>Su contraseña ha sido modificada correctamente.</p>
                    <p>Puede Acceder a la App desde el siguiente enlace:</p>
                                        <p>$enlaceEmail</p>";

if(!$mail->send()) {
  echo 'Error al enviar email';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Mail enviado correctamente';
}
        //Fin correo
                if(isset($_GET['proy'])){
                    header('Location: index.php');
                    mysqli_close($conexion);
                    exit();
                }
                if ($_SESSION['urlact'] == ""){
                 header('Location: index.php');
                    mysqli_close($conexion);
                    exit();
                }else{
                   header('Location: '.$_SESSION['urlact'].'');
                    exit();
                    mysqli_close($conexion);
                }
            }
        }

}else{ 
          ?>
          </header>
    <section>
       <article id="text">
           <p><?php
    if(isset($_GET['proy'])){
        echo TCPASS;
    }else{
        echo TPASS;
    }?>
      </p>
       </article>
        <article>
                <fieldset id="pass">
                <legend><?=LOGPASS?></legend>
                <form action="<?php 
                                    if(isset($_GET['proy'])){
                                        $id=$_GET['proy'];
                                        echo "?proy=$id";
                                    }    
                                    ?>" method="post" enctype="multipart/form-data">
                <p><?=NEWPASS?></p><input type="password" name="newpass">
                <p><?=CONFPASS?></p><input type="password" name="confpass">
                <p class="errorpass"><?php
                        if(isset($_SESSION['msgpass'])){
                            echo $_SESSION['msgpass'];
                            unset($_SESSION['msgpass']);
                        }
                    ?></p>
                <button type="submit"><div id="edit"><?=SAV?></div><i class="far fa-save editar"></i></button>
                </form>
            </fieldset> 
    </article>
</section>
<script src="_js/funcionesheader.js"></script>
<?php 
    include('_include/footer.php');
/*Incluimos las cookies*/
    include('_include/cookies.php');
}
          ob_end_flush();
?>
    
</body>
</html>