<!DOCTYPE html>
<?php
session_start(); 
include('_include/variables.php');
include('_include/funciones.php');
include('_include/conexion.php');

if(isset($_SESSION['lang'])){
if($_SESSION['lang']==1){
    include('_include/UK-uk.php'); 
    }else{
        include('_include/ES-es.php');
        }
    }else{
      include('_include/ES-es.php');
}
/*nos da la parte siguiente a la del host en la url*/
$urlact=$_SERVER['REQUEST_URI'];
/*creamos un array diviendo la url mediante / */
$urlact=explode("/",$urlact);
/*Vemos cuantos elementos componen el array y le asignamos a num el valor del ultimo de sus compenentes*/
$num=sizeof($urlact)-1;
/*guardamos en $urlact el valor de la ultima posicion del array*/
$urlact=$urlact[$num];
/* y le asignamos su valor a $_SESSION['urlact']*/
$_SESSION['urlact']=$urlact;
$activo=3;

if(isset($_POST['email'])){
    if($_POST['email']== ""){
        unset ($_POST['email']);
        $_SESSION['msgemail']=NNMAIL;
        header('Location: olvidopass.php');
        exit();
    }
    /*comprobamos el email y mandamos el mensaje para reestablecer la contraseña*/
    $email=htmlentities($_POST['email']);
    $usuario= consulta($conexion, "SELECT * FROM usuarios where email like '$email'");
    $totalUsu=mysqli_num_rows($usuario);
    $user=mysqli_fetch_array($usuario);
    $idUsuario=$user['id_user'];
    if($totalUsu == 0){
         $_SESSION['msgemail']=FAILMAIL;
        header('Location: olvidopass.php');
        mysqli_close($conexion);
        exit();
    }else{
/*generamos un codigo aleatorio alfanumerico para enviarlo por email*/
function generarCodigo($id,$conexion)
{
    //creamos la variable codigo
    $codigo = "";
    $longitud=30;
    $tipo=0;
    //caracteres a ser utilizados
    $caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    //el maximo de caracteres a usar
    $max=strlen($caracteres)-1;
    //creamos un for para generar el codigo aleatorio utilizando parametros min y max
    for($i=0;$i < $longitud;$i++)
    {
        $codigo.=$caracteres[rand(0,$max)];
    }
    //convertimos el coadigo generado a md5
    $codigoMd5=md5($codigo);
    //realizamos el insert en la tabla olvidopass
    $insert=consulta ($conexion, "UPDATE usuarios 
                                    SET codigo_recuperacion = \"$codigoMd5\"
                                    WHERE id_user like $id");
    //regresamos codigo como valor
    return $codigo;
    //pintamos el codigo
    echo $codigo;
}
        $usu=mysqli_fetch_array($usuario);
        $nombre=$user['nombre'];
        $idu=$user['id_user'];
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


$mail->Subject = 'Cambio de contraseña solicitado';
$mail->Body    = "<h1>¡Hola $nombre!</h1>
                    <p>Ha solicitado un cambio de contraseña, para poder reestrablecerla debe acceder al siguiente enlace, de no haberla solicitado, ignore este email:<br>
                    <a href=\"$enlacePass".$idu."\">Reestablecer contraseña</a></p>
                    <p>Introduzca el siguiente código: ".generarCodigo($idUsuario,$conexion)."</p>";

if(!$mail->send()) {
  echo 'Error al enviar email';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Mail enviado correctamente';
}
        //Fin correo
        header('Location: index.php');
        mysqli_close($conexion);
        exit();
    }
}else{
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=TITOLPS?><?=TIT1?></title>
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
                </header>
    <section>
       <article id="text">
           <p><?=TOLVPASS?></p>
       </article>
        <article>
                <fieldset id="pass">
                <legend><?=LOGEMAIL?></legend>
                <form action="?op=1" method="post" enctype="multipart/form-data">
                <p><?=PHLEMAIL?>: </p><input name="email" type="email" maxlength="255">
                <p class="errorpass"><?php
                        if(isset($_SESSION['msgemail'])){
                            echo $_SESSION['msgemail'];
                            unset($_SESSION['msgemail']);
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
?>
    
</body>
</html>