<!DOCTYPE html>
<?php
session_start(); 
if(!isset($_SESSION['user'])){
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
/*$_SESSION['user']=1;*/
/*session_destroy();*/
$activo=3;
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=INICIO?><?=TIT1?></title>
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
        $id=$_SESSION['user'];
        if($newpass != $confpass){
            $_SESSION['msgpass']=CONFPASSFAL;
            header('Location: cambiapass.php');
            exit();
        }else{
            if($newpass == $_SESSION['email']){
                $_SESSION['msgpass']=PASSISMAIL;
                header('Location: cambiapass.php');
                exit();
            }else{
                $newpass=md5($newpass);
                $update=consulta($conexion,"UPDATE usuarios SET password='{$newpass}' where id_user like '{$id}'");
                $_SESSION['password']=$newpass;
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
    <section>
       <article id="text">
           <p><?=TPASS?></p>
       </article>
        <article>
                <fieldset id="pass">
                <legend><?=LOGPASS?></legend>
                <form action="?pm=1" method="post" enctype="multipart/form-data">
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
?>
    
</body>
</html>