<!DOCTYPE html>
<?php
ob_start();
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
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
if($_SESSION['tipo']!=0){
    header('Location: cpanel.php');
}
if(isset($_POST['id_proy'])){
        if($_POST['id_proy'] == -1){
                header('Location: cpaneladmin.php?rm=3&rt=2&a=3');
            }
}
$activo=3;
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=PANEL?><?=TIT1?></title>
    <link rel="stylesheet" href="_css/estilosheader.css">
    <link rel="stylesheet" href="_css/estilosCpanel.css">
    <link rel="stylesheet" href="_css/footer.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
<!--    Incluimos las cookies-->
    
<?php
    include('_include/cookies.php');
?>
    
</head>

<body onload="move()">
<?php
    if(isset($_POST['id_user']) && $_POST['id_user'] == -1){
        header('Location: cpaneladmin.php?rm=1&rt=2&a=3');
    }
    include('_include/header.php');
?>
  
  
  <!--Inicio Contenido CPanel-->
<?php
    include('_include/conexion.php');
    
    if(!isset($_GET['rm'])){?>
                 <nav id="nav1">
              <div class="icon-bar2">
              <a href="#" id="enla1" onclick="desplegarAdmin(this,'nav2')"><span class="titulo"><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegarAdmin(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegarAdmin(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a>
              <a href="#" id="enla4" onclick="desplegarAdmin(this,'nav5')"><span><?= OTHERS ?></span><i class="fas fa-cogs ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" id="subenla2" title="<?=MODIFICAR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenla3" title="<?=BAJA_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" title="<?=AÑADIR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" title="<?=MODIFICAR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenla6" title="<?=BAJA_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" title="<?=AÑADIR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" title="<?=MODIFICAR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" title="<?=BAJA_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <nav id="nav5" class="oculto">
          <div class="icon-bar3">
              <a href="?rm=4&rt=1&a=3" id="subenla10" title="<?=INDPHO?>" onclick="desplegar2(this)"><i class="fas fa-camera ico"></i></a> 
              <a href="?rm=4&rt=2&a=3" id="subenla11" title="<?=ADMINCOM?>" onclick="desplegar2(this)"><i class="fas fa-comments ico"></i></a>  
            </div>
        </nav>
        <?php
       include('_include/cpanelindex.php');
    }
        elseif(isset($_GET['rm']) && $_GET['rm']==1 && isset($_GET['rt']) && $_GET['rt']==1) {
            unset($_SESSION['uid']);
        ?>
        <nav id="nav1">
              <div class="icon-bar2">
              <a href="#" id="enla1" class="active" onclick="desplegarAdmin(this,'nav2')"><span><?= USUARIOS ?> </span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegarAdmin(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegarAdmin(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a>
              <a href="#" id="enla4" onclick="desplegarAdmin(this,'nav5')"><span><?= OTHERS ?></span><i class="fas fa-cogs ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" class="active" id="subenla1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" id="subenla2" title="<?=MODIFICAR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenla3" title="<?=BAJA_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" title="<?=AÑADIR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" title="<?=MODIFICAR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenla6" title="<?=BAJA_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" title="<?=AÑADIR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" title="<?=MODIFICAR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" title="<?=BAJA_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <nav id="nav5" class="oculto">
          <div class="icon-bar3">
              <a href="?rm=4&rt=1&a=3" id="subenla10" title="<?=INDPHO?>" onclick="desplegar2(this)"><i class="fas fa-camera ico"></i></a> 
              <a href="?rm=4&rt=2&a=3" id="subenla11" title="<?=ADMINCOM?>" onclick="desplegar2(this)"><i class="fas fa-comments ico"></i></a>  
            </div>
        </nav>
        <section id="adduser">
        <fieldset>
            <legend><?=AÑADIR_USUARIO?></legend>
            <form action="addnewuser.php" method="post" enctype="multipart/form-data">
            <p><?=NOMBRE?></p><input type="text"  name="nombre" required maxlength="255">
           <p><?=APELLIDOS?></p><input type="text"  name="apellidos" required maxlength="255">
           <p><?=SEXO?></p><select name=sexo required>
                            <option value="0" ><?=HOM?></option>
                            <option value="1" ><?=MUJ?></option>
                        </select>
           <p>Email : </p><input type="email" name="email" required onblur="comprobarEmail(this.value)" maxlength="255">
           <p><?=PRIVI?></p><select name=tipo>
                            <option value="0" ><?=ADMIN?></option>
                            <option value="1" ><?=PROFE?></option>
                            <option value="2" ><?=ALUM?></option>
                        </select>
            <button type="submit" id="boton"><div id="edit"><?=MODPER?></div><i class="far fa-save edicion"></i></button>
            <p id="error"><?php
                            if(isset($_SESSION['msgadd'])){
                                echo $_SESSION['msgadd'];
                                unset($_SESSION['msgadd']);
                            } ?></p>
            </form>
        </fieldset>
    </section>
    <?php
 /*Fin añadir usuario                                                                                             
 comienza editar usuario*/
    }else if(isset($_GET['rm']) and $_GET['rm']==1 and isset($_GET['rt']) and $_GET['rt']==2) { ?>
        <nav id="nav1">
              <div class="icon-bar2">
              <a href="#" id="enla1" class="active" onclick="desplegarAdmin(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegarAdmin(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegarAdmin(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a>
              <a href="#" id="enla4" onclick="desplegarAdmin(this,'nav5')"><span><?= OTHERS ?></span><i class="fas fa-cogs ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" class="active" id="subenla2" title="<?=MODIFICAR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenla3" title="<?=BAJA_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" title="<?=AÑADIR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" title="<?=MODIFICAR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenla6" title="<?=BAJA_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" title="<?=AÑADIR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" title="<?=MODIFICAR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" title="<?=BAJA_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <nav id="nav5" class="oculto">
          <div class="icon-bar3">
              <a href="?rm=4&rt=1&a=3" id="subenla10" title="<?=INDPHO?>" onclick="desplegar2(this)"><i class="fas fa-camera ico"></i></a> 
              <a href="?rm=4&rt=2&a=3" id="subenla11" title="<?=ADMINCOM?>" onclick="desplegar2(this)"><i class="fas fa-comments ico"></i></a>  
            </div>
        </nav>
        <section id="usermod">
         <?php 
            if(isset($_GET['uid'])){
                $idu=$_GET['uid'];
            }
            if(isset($_POST['id_user']) || isset($idu)){
                if(isset($idu)){
                    $RESULT2 = consulta($conexion,"SELECT * FROM usuarios WHERE id_user ='" . $idu . "'");
                    $siNo=mysqli_num_rows($RESULT2);
                    if($siNo == 0){
                    $_SESSION['msgmod2']= SELUSR;
                     header('Location: cpaneladmin.php?rm=1&rt=2&a=3');
                    exit(); 
                    }
                    $info=mysqli_fetch_array($RESULT2);
                    $_SESSION['uid']=$idu;    
                }
                if(isset($_POST['id_user'])){
                    if($_POST['id_user']== -1){
                        $_SESSION['msgmod2']= SELUSR;
                     header('Location: cpaneladmin.php?rm=1&rt=2&a=3');
                    exit();   
                    }elseif ($_POST['id_user'] !=-1){
                    $RESULT2 = consulta($conexion,"SELECT * FROM usuarios WHERE id_user ='" . $_POST['id_user'] . "'");
                    $siNo=mysqli_num_rows($RESULT2);
                        if($siNo == 0){
                    $_SESSION['msgmod2']= SELUSR;
                     header('Location: cpaneladmin.php?rm=1&rt=2&a=3');
                    exit(); 
                    }
                    $info=mysqli_fetch_array($RESULT2);
                    $_SESSION['uid']=$_POST['id_user'];
                }
                }
            ?>
        <fieldset>
            <legend><?=MODIFICAR_USUARIO?></legend>
            <form action="modifyuser.php" method="post" enctype="multipart/form-data">
            <p><?=NOMBRE?></p><input type="text"  name="nombre" required value="<?=$info['nombre']?>" maxlength="255">
           <p><?=APELLIDOS?></p><input type="text"  name="apellidos" required value="<?=$info['apellidos']?>" maxlength="255">
           <p><?=SEXO?></p><select name=sexo required>
                            <option value="0"  <?php
                                                    if($info['sexo']== 0){
                                                        echo "selected";
                                                    }
                                                    ?>><?=HOM?></option>
                            <option value="1"  <?php
                                                    if($info['sexo']== 1){
                                                        echo "selected";
                                                    }
                                                    ?>><?=MUJ?></option>
                        </select>
           <p>Email : </p><input type="email" name="email" required value="<?=$info['email']?>" maxlength="255">
           <p><?=PRIVI?></p><select name=tipo>
                            <option value="0" <?php
                                                    if($info['tipo']== 0){
                                                        echo "selected";
                                                    }
                                                    ?>><?=ADMIN?></option>
                            <option value="1"  <?php
                                                    if($info['tipo']== 1){
                                                        echo "selected";
                                                    }
                                                    ?>><?=PROFE?></option>
                            <option value="2"  <?php
                                                    if($info['tipo']== 2){
                                                        echo "selected";
                                                    }
                                                    ?>><?=ALUM?></option>
                        </select>
            <button type="submit" id="boton"><div id="edit"><?=MODPER?></div><i class="fas fa-save edicion"></i></button>
            <p id="error"><?php
                            if(isset($_SESSION['msgmod2'])){
                                echo $_SESSION['msgmod2'];
                                unset($_SESSION['msgmod2']);
                            } ?></p>
            </form>
        </fieldset>
            <?php 
            }else{ ?>
                <fieldset>
                <legend><?=MODIFICAR_USUARIO?></legend>
                    <form action="" method="post" enctype="multipart/form-data">
                    <p id="selectuser"><?=SELUSER?>: </p>
                    <select name="id_user" id="iusu">
                    <option value="-1"><?=USRR?></option>
                                            <?php
                    
                    $RESULT = consulta($conexion,"SELECT * FROM usuarios where baja like 0"); 
                    
                    while ($fila = mysqli_fetch_array($RESULT)) {
                       echo "<option value=" . $fila['id_user'] . ">" . $fila['nombre'] . " " .  $fila['apellidos'] . "</option>";
                        
                    }
                         
                         
                ?>
                </select>
                        <button type="submit" id="selectbu"><i class="fas fa-edit edicion"></i></button>
                        <p id="error"><?php
                            if(isset($_SESSION['msgmod2'])){
                                echo $_SESSION['msgmod2'];
                                unset($_SESSION['msgmod2']);
                            } ?></p>
                </form>
            </fieldset>
        
            <?php }
                    ?>
                    </section>
                    <?php
/*Fin editar usuario
Comienza eliminar usuario*/
        }elseif(isset($_GET['rm']) and $_GET['rm']==1 and isset($_GET['rt']) and $_GET['rt']==3){?>
        <nav id="nav1">
              <div class="icon-bar2">
              <a href="#" id="enla1" class="active" onclick="desplegarAdmin(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegarAdmin(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegarAdmin(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a>
              <a href="#" id="enla4" onclick="desplegarAdmin(this,'nav5')"><span><?= OTHERS ?></span><i class="fas fa-cogs ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" title="<?=MODIFICAR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" class="active" id="subenla3" title="<?=BAJA_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" title="<?=AÑADIR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" title="<?=MODIFICAR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenla6" title="<?=BAJA_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" title="<?=AÑADIR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" title="<?=MODIFICAR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" title="<?=BAJA_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <nav id="nav5" class="oculto">
          <div class="icon-bar3">
              <a href="?rm=4&rt=1&a=3" id="subenla10" title="<?=INDPHO?>" onclick="desplegar2(this)"><i class="fas fa-camera ico"></i></a> 
              <a href="?rm=4&rt=2&a=3" id="subenla11" title="<?=ADMINCOM?>" onclick="desplegar2(this)"><i class="fas fa-comments ico"></i></a>  
            </div>
        </nav>
        <section id="userdel">
            <fieldset>
                <legend><?=USERDEL?></legend>
                    <form action="userdelete.php" method="post" enctype="multipart/form-data">
                    <p id="selectuser"><?=SELUSER?>: </p>
                    <select name="id_user" id="iusu">
                    <option value="-1"><?=USRR?></option>
                                            <?php
                    
                    $RESULT = consulta($conexion,"SELECT * FROM usuarios where baja like 0"); 
                    
                    while ($fila = mysqli_fetch_array($RESULT)) {
                       echo "<option value=" . $fila['id_user'] . ">" . $fila['nombre'] . " " .  $fila['apellidos'] . "</option>";
                        
                    }  
                ?>
                </select>
                        <button type="submit" id="selectbu"><i class="fas fa-times edicion2"></i></button>
                        <p id="error"><?php
                            if(isset($_SESSION['msgdel'])){
                                echo $_SESSION['msgdel'];
                                unset($_SESSION['msgdel']);
                            } ?></p>
                </form>
            </fieldset>
    </section>
        <?php /*Fin de eliminar usuario
                Fin de la pestaña usuarios
                Comienzo de la pestaña cursos
                Comienzo de añadir curso*/
                }elseif(isset($_GET['rm']) and $_GET['rm']==2 and isset($_GET['rt']) and $_GET['rt']==1){?>
        <nav id="nav1">
              <div class="icon-bar2">
              <a href="#" id="enla1" onclick="desplegarAdmin(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" class="active" onclick="desplegarAdmin(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegarAdmin(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a>
              <a href="#" id="enla4" onclick="desplegarAdmin(this,'nav5')"><span><?= OTHERS ?></span><i class="fas fa-cogs ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" title="<?=MODIFICAR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenla3" title="<?=BAJA_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" class="active" title="<?=AÑADIR_CURSO?>" id="subenla4" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" title="<?=MODIFICAR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenla6" title="<?=BAJA_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" title="<?=AÑADIR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" title="<?=MODIFICAR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" title="<?=BAJA_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <nav id="nav5" class="oculto">
          <div class="icon-bar3">
              <a href="?rm=4&rt=1&a=3" id="subenla10" title="<?=INDPHO?>" onclick="desplegar2(this)"><i class="fas fa-camera ico"></i></a> 
              <a href="?rm=4&rt=2&a=3" id="subenla11" title="<?=ADMINCOM?>" onclick="desplegar2(this)"><i class="fas fa-comments ico"></i></a>  
            </div>
        </nav>
        <section id="addcourse">
        <fieldset>
            <legend><?=AÑADIR_CURSO?></legend>
            <form action="addnewcourse.php" method="post" enctype="multipart/form-data">
            <p><?=CUR?></p><input type="text"  name="nombre" required placeholder="<?=EJ?> 2016-2017" maxlength="255">
            <button type="submit" id="boton"><div id="edit">añadir curso</div><i class="fas fa-save edicion"></i></button>
            <p id="error"><?php
                            if(isset($_SESSION['msgaddcourse'])){
                                echo $_SESSION['msgaddcourse'];
                                unset($_SESSION['msgaddcourse']);
                            } ?></p>
            </form>
        </fieldset>
    </section>
    <?php /*Fin crear curso
        comienza moficiar curso*/
    }else if(isset($_GET['rm']) and $_GET['rm']==2 and isset($_GET['rt']) and $_GET['rt']==2) { ?>
        <nav id="nav1">
              <div class="icon-bar2">
              <a href="#" id="enla1" onclick="desplegarAdmin(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" class="active" onclick="desplegarAdmin(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegarAdmin(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a>
              <a href="#" id="enla4" onclick="desplegarAdmin(this,'nav5')"><span><?= OTHERS ?></span><i class="fas fa-cogs ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2"class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" title="<?=MODIFICAR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a>
              <a href="?rm=1&rt=3&a=3" id="subenla3" title="<?=BAJA_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav3">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" title="<?=AÑADIR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" class="active" title="<?=MODIFICAR_CURSO?>" id="subenla5" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenla6" title="<?=BAJA_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" title="<?=AÑADIR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" title="<?=MODIFICAR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" title="<?=BAJA_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <nav id="nav5" class="oculto">
          <div class="icon-bar3">
              <a href="?rm=4&rt=1&a=3" id="subenla10" title="<?=INDPHO?>" onclick="desplegar2(this)"><i class="fas fa-camera ico"></i></a> 
              <a href="?rm=4&rt=2&a=3" id="subenla11" title="<?=ADMINCOM?>" onclick="desplegar2(this)"><i class="fas fa-comments ico"></i></a>  
            </div>
        </nav>
        <section id="coursemod">
         <?php 
            if(isset($_GET['cid'])){
                $cid=$_GET['cid'];
            }
            if(isset($_POST['id_curso']) || isset($cid)){
                if(isset($cid)){
                    $RESULT2 = consulta($conexion,"SELECT * FROM cursos WHERE id_curso ='" . $cid . "'"); 
                    $siNo=mysqli_num_rows($RESULT2);
                    if($siNo == 0){
                    $_SESSION['msgmodcour']= SELCURSO;
                    header("Location: cpaneladmin.php?rm=2&rt=2&a=3&cid=$cid");
                    exit();   
                    }
                    $info=mysqli_fetch_array($RESULT2);
                    $_SESSION['cid']=$cid;
                }
                if(isset($_POST['id_curso'])){
                    if ($_POST['id_curso'] !=-1){
                        $idCurso=htmlentities($_POST['id_curso']);
                    $RESULT2 = consulta($conexion,"SELECT * FROM cursos WHERE id_curso ='" . $idCurso . "'"); 
                    $siNo=mysqli_num_rows($RESULT2);
                    if($siNo == 0){
                    $_SESSION['msgmodcour']= SELCURSO;
                    header("Location: cpaneladmin.php?rm=2&rt=2&a=3");
                    exit();   
                    }
                    $siNo=mysqli_num_rows($RESULT2);
                    if($siNo == 0){
                    $_SESSION['msgmodcour']= SELCURSO;
                     //header('Location: cpaneladmin.php?rm=2&rt=2&a=3');
                    exit();   
                    }
                    $info=mysqli_fetch_array($RESULT2);
                    $_SESSION['cid']=$_POST['id_curso'];
                }else{
                    $_SESSION['msgmodcour']= SELCURSO;
                     header('Location: cpaneladmin.php?rm=2&rt=2&a=3');
                    exit();    
                }
            }
            ?>
        <fieldset>
            <legend><?=MODIFICAR_CURSO?></legend>
            <form action="modifycourse.php" method="post" enctype="multipart/form-data">
            <p><?=CUR?></p><input type="text"  name="nombre" required value="<?=$info['curso']?>" maxlength="255">
            <button type="submit" id="boton"><div id="edit"><?=MODPER?></div><i class="fas fa-save edicion"></i></button>
            <p id="error"><?php
                            if(isset($_SESSION['msgmodcour'])){
                                echo $_SESSION['msgmodcour'];
                                unset($_SESSION['msgmodcour']);
                            } ?></p>
            </form>
        </fieldset>
            <?php 
            }else{ ?>
                <fieldset>
                <legend><?=MODIFICAR_CURSO?></legend>
                    <form action="" method="post" enctype="multipart/form-data">
                    <p id="selectcourse"><?=SELCUR?>: </p>
                    <select name="id_curso" id="iusu">
                    <option value="-1"><?=CURS?></option>
                                            <?php
                    
                    $RESULT = consulta($conexion,"SELECT * FROM cursos order by curso desc"); 
                    
                    while ($fila = mysqli_fetch_array($RESULT)) {
                       echo "<option value=" . $fila['id_curso'] . ">" . $fila['curso'] ." </option>";
                        
                    }
                         
                         
                ?>
                </select>
                        <button type="submit" id="selectbu"><div id="edit"><?=MODPER?></div><i class="fas fa-edit edicion"></i></button>
                        <p id="error"><?php
                            if(isset($_SESSION['msgmodcour'])){
                                echo $_SESSION['msgmodcour'];
                                unset($_SESSION['msgmodcour']);
                            } ?></p>
                </form>
            </fieldset>
            <?php }?>
                </section>
                <?php
                
/*Fin modificar curso
Comienza eliminar curso*/
        }elseif(isset($_GET['rm']) and $_GET['rm']==2 and isset($_GET['rt']) and $_GET['rt']==3){?>
        <nav id="nav1">
              <div class="icon-bar2">
              <a href="#" id="enla1" onclick="desplegarAdmin(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" class="active" onclick="desplegarAdmin(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegarAdmin(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a>
              <a href="#" id="enla4" onclick="desplegarAdmin(this,'nav5')"><span><?= OTHERS ?></span><i class="fas fa-cogs ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" title="<?=MODIFICAR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3"  id="subenla3" title="<?=BAJA_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" title="<?=AÑADIR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" title="<?=MODIFICAR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" class="active" title="<?=BAJA_CURSO?>" id="subenla6" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" title="<?=AÑADIR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" title="<?=MODIFICAR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
          <a href="?rm=3&rt=3&a=3" id="subenla9" title="<?=BAJA_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <nav id="nav5" class="oculto">
          <div class="icon-bar3">
              <a href="?rm=4&rt=1&a=3" id="subenla10" title="<?=INDPHO?>" onclick="desplegar2(this)"><i class="fas fa-camera ico"></i></a> 
              <a href="?rm=4&rt=2&a=3" id="subenla11" title="<?=ADMINCOM?>" onclick="desplegar2(this)"><i class="fas fa-comments ico"></i></a>  
            </div>
        </nav>
        <section id="userdel">
            <fieldset>
                <legend><?=CURDEL?></legend>
                    <form action="coursedelete.php" method="post" enctype="multipart/form-data">
                    <p id="selectuser"><?=SELCUR?>: </p>
                    <select name="id_curso" id="iusu">
                    <option value="-1"><?=CURS?></option>
                                            <?php
                    
                    $RESULT = consulta($conexion,"SELECT * FROM cursos  order by curso desc"); 
                    
                    while ($fila = mysqli_fetch_array($RESULT)) {
                       echo "<option value=" . $fila['id_curso'] . ">" . $fila['curso'] ."</option>";
                        
                    }  
                ?>
                </select>
                        <button type="submit" id="selectbu"><i class="fas fa-times edicion2"></i></button>
                        <p id="error"><?php
                            if(isset($_SESSION['msgdelcour'])){
                                echo $_SESSION['msgdelcour'];
                                unset($_SESSION['msgdelcour']);
                            } ?></p>
                </form>
            </fieldset>
    </section>
        <?php 
    /*Fin de eliminar curso
      Fin de la pestaña cursos
      Comienza la pestaña proyectos
      Crear nuevo proyecto*/
        }elseif(isset($_GET['rm']) and $_GET['rm']==3 and isset($_GET['rt']) and $_GET['rt']==1){?>
        <nav id="nav1">
              <div class="icon-bar2">
              <a href="#" id="enla1" onclick="desplegarAdmin(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegarAdmin(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" class="active" onclick="desplegarAdmin(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a>
              <a href="#" id="enla4" onclick="desplegarAdmin(this,'nav5')"><span><?= OTHERS ?> </span><i class="fas fa-cogs ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" title="<?=MODIFICAR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3"  id="subenla3" title="<?=BAJA_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" title="<?=AÑADIR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" title="<?=MODIFICAR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3"  id="subenla6" title="<?=BAJA_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" class="active" title="<?=AÑADIR_PROYECTO?>" id="subenla7" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" title="<?=MODIFICAR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" title="<?=BAJA_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <nav id="nav5" class="oculto">
          <div class="icon-bar3">
              <a href="?rm=4&rt=1&a=3" id="subenla10" title="<?=INDPHO?>" onclick="desplegar2(this)"><i class="fas fa-camera ico"></i></a> 
              <a href="?rm=4&rt=2&a=3" id="subenla11" title="<?=ADMINCOM?>" onclick="desplegar2(this)"><i class="fas fa-comments ico"></i></a>  
            </div>
        </nav>
    <section id="addproy">
        <fieldset>
            <legend><?=AÑADIR_PROYECTO?></legend>
            <form action="addnewproyect.php" method="post" enctype="multipart/form-data">
            <p><?=NOMES?>:</p><input type="text"  name="nombre" required maxlength="255">
            <p><?=NAMES?>:</p><input type="text"  name="name" required maxlength="255">
                <p><?=CUR?> </p>
                    <select name="id_curso" id="icur">
                    <option value="-1"><?=SELCUR?></option>
                                            <?php
                    
                    $RESULT = consulta($conexion,"SELECT * FROM cursos  order by curso desc"); 
                    
                    while ($fila = mysqli_fetch_array($RESULT)) {
                       echo "<option value=" . $fila['id_curso'] . ">" . $fila['curso'] ."</option>";
                        
                    }  
                ?>
                </select>
                    <p><?=COOR?>: </p>
                    <select name="id_coor" id="icoor">
                        <option value="-1"><?=COOR?></option>
                    
                        <?php
                            $RESULT2 = consulta($conexion,"SELECT * FROM usuarios where tipo like 1 and baja like 0"); 
                            while ($fila2 = mysqli_fetch_array($RESULT2)) {
                                echo "<option value=" . $fila2['id_user'] . ">" . $fila2['nombre'] . " " .  $fila2['apellidos'] . "</option>";
                            }
                        ?>
                    </select>
            <button type="submit" id="boton"><div id="edit"></div><i class="fas fa-save edicion"></i></button>
            <p id="error"><?php
                            if(isset($_SESSION['msgaddproy'])){
                                echo $_SESSION['msgaddproy'];
                                unset($_SESSION['msgaddproy']);
                            } ?></p>
            </form>
        </fieldset>
    </section>
        <?php
        /*Fin añadir proyecto
        Comienzo modificar proyecto*/
            }elseif(isset($_GET['rm']) and $_GET['rm']==3 and isset($_GET['rt']) and $_GET['rt']==2){?>
        <nav id="nav1">
              <div class="icon-bar2">
              <a href="#" id="enla1" onclick="desplegarAdmin(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegarAdmin(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" class="active" onclick="desplegarAdmin(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a>
              <a href="#" id="enla4" onclick="desplegarAdmin(this,'nav5')"><span><?= OTHERS ?></span><i class="fas fa-cogs ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" title="<?=MODIFICAR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3"  id="subenla3" title="<?=BAJA_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" title="<?=AÑADIR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" title="<?=MODIFICAR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3"  id="subenla6" title="<?=BAJA_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3"  id="subenla7" title="<?=AÑADIR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3"  class="active" id="subenla8" title="<?=MODIFICAR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" title="<?=BAJA_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <nav id="nav5" class="oculto">
          <div class="icon-bar3">
              <a href="?rm=4&rt=1&a=3" id="subenla10" title="<?=INDPHO?>" onclick="desplegar2(this)"><i class="fas fa-camera ico"></i></a> 
              <a href="?rm=4&rt=2&a=3" id="subenla11" title="<?=ADMINCOM?>" onclick="desplegar2(this)"><i class="fas fa-comments ico"></i></a>  
            </div>
        </nav>
        <section id="coursemod">
         <?php 
            if(isset($_GET['pid'])){
                $pid=$_GET['pid'];
            }
            if(isset($_POST['id_proy']) || isset($pid)){
                if(isset($pid)){
                    $RESULT2 = consulta($conexion,"SELECT * FROM proyectos WHERE id_proyecto ='" . $pid . "' and mostrar like 0");
                    //Comprobamos que exista el proyecto seleccionado y k esta de baja*/
                    $siNo=mysqli_num_rows($RESULT2);
                    if($siNo == 0){
                        $_SESSION['msgmodproy2']= DEBCHO;
                        header('Location: cpaneladmin.php?rm=3&rt=2&a=3');
                        exit(); 
                    }
                    $info=mysqli_fetch_array($RESULT2);
                    $_SESSION['pid']=$pid;
                    unset($pid);
                }
                if(isset($_POST['id_proy'])){
                if ($_POST['id_proy'] != -1){
                    $RESULT2 = consulta($conexion,"SELECT * FROM proyectos WHERE id_proyecto ='" . $_POST['id_proy'] . "' and mostrar like 0"); 
                       $siNo=mysqli_num_rows($RESULT2);
                    if($siNo == 0){
                        $_SESSION['msgmodproy2']= DEBCHO;
                        header('Location: cpaneladmin.php?rm=3&rt=2&a=3');
                        exit(); 
                    }
                    $info=mysqli_fetch_array($RESULT2);
                    $_SESSION['pid']=$_POST['id_proy'];
                }else{
                    $_SESSION['msgmodproy2']= DEBCHO;
                     header('Location: cpaneladmin.php?rm=3&rt=2&a=3');
                    exit(); 
                }
            }
            ?>
           <fieldset>
            <legend><?=MODIFICAR_PROYECTO?></legend>
            <form action="modifyproyect.php" method="post" enctype="multipart/form-data">
            <p><?=NOMES?>:</p><input type="text"  name="nombre" required value="<?=$info['nombre_pro']?>" maxlength="255">
            <p><?=NAMES?>:</p><input type="text"  name="name" required value="<?=$info['name_pro']?>" maxlength="255">
            <p id="selectcurso"><?=CUR?> </p>
                    <select name="id_curso" id="icur">
                    <option value="-1"><?=SELCUR?></option>
                                            <?php
                    
                    $RESULT = consulta($conexion,"SELECT * FROM cursos  order by curso desc");
                    $id_curso=$info['id_curso'];
                    while ($fila = mysqli_fetch_array($RESULT)) { ?>
                       echo "<option value="<?=$fila['id_curso']?>"<?php
                                                                        if($fila['id_curso']== $id_curso){
                                                                            echo "selected";
                                                                        }
                                                                        ?> ><?=$fila['curso']?></option><?php
                        
                    }  
                ?>
                </select>
                    <p ><?=COOR?>: </p>
                    <select name="id_coor" id="icoor">
                        <option value="-1"><?=COOR?></option>
                    
                        <?php
                            $RESULT2 = consulta($conexion,"SELECT * FROM usuarios 
                                                            where tipo like 1 and baja like 0");
                            $id_proyecto=$info['id_proyecto'];
                            $RESULTCOOR=consulta($conexion, "SELECT * FROM usuarios 
                                                            WHERE tipo like 1 and baja like 0 and id_user in(SELECT id_user
                                                                                                                FROM usuproy
                                                                                                                where id_proyecto like $id_proyecto)");
                            $selcoor = mysqli_fetch_array($RESULTCOOR);
                            $coord=$selcoor['id_user'];
                            while ($fila2 = mysqli_fetch_array($RESULT2)) {?>
                                <option value="<?=$fila2['id_user']?>"<?php if($coord==$fila2['id_user']){
                                                                                echo "selected";        
                                                                            }
                                                                        ?>><?=$fila2['nombre']?> <?=$fila2['apellidos']?></option><?php
                            }
                        ?>
                    </select>
            <button type="submit" id="boton"><div id="edit">Modificar Proyecto</div><i class="fas fa-save edicion"></i></button>
            <p id="error"><?php
                            if(isset($_SESSION['msgmodproy'])){
                                echo $_SESSION['msgmodproy'];
                                unset($_SESSION['msgmodproy']);
                            } ?></p>
            </form>
        </fieldset>
            <?php 
            }else{ ?>
                <fieldset>
                <legend><?=MODIFICAR_PROYECTO?></legend>
                    <form action="" method="post" enctype="multipart/form-data">
                    <p id="selectcourse"><?=SELPROY?>: </p>
                    <select name="id_proy" id="iusu">
                    <option value="-1"><?=PROY?></option>
                <?php
                    $PROYECT = consulta($conexion,"SELECT * FROM proyectos where mostrar like 0");
                    while ($proy = mysqli_fetch_array($PROYECT)) {
                    if(isset($_SESSION['lang'])){
                        if($_SESSION['lang']==1){
                            $proye=$proy['name_pro']; 
                        }else{
                            $proye=$proy['nombre_pro'];
                            }
                        }else{
                        $proye=$proy['nombre_pro'];
                        }
                        $proyec=$proy['id_proyecto'];
                         $curso =consulta($conexion, "SELECT * FROM cursos where id_curso in (Select id_curso from proyectos where id_proyecto like $proyec)");
                        $cur = mysqli_fetch_array($curso);
                        $nomCur=$cur['curso'];
                       echo "<option value=" . $proy['id_proyecto'] . ">" . $proye ." /".$nomCur."</option>";
                        
                    }
                         
                         
                ?>
                </select>
                        <button type="submit" id="selectbu"><div id="edit"><?=MODPER?></div><i class="fas fa-edit edicion"></i></button>
                        <p id="error"><?php
                            if(isset($_SESSION['msgmodproy2'])){
                                echo $_SESSION['msgmodproy2'];
                                unset($_SESSION['msgmodproy2']);
                            } ?></p>
                </form>
            </fieldset>
    
            <?php
                 }?>
                 </section>
                 <?php
                /*fin de modificar proyecto
                comienzo de quitar publicacion proyecto*/
            }elseif(isset($_GET['rm']) and $_GET['rm']==3 and isset($_GET['rt']) and $_GET['rt']==3){?>
        <nav id="nav1">
              <div class="icon-bar2">
              <a href="#" id="enla1" onclick="desplegarAdmin(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegarAdmin(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" class="active" onclick="desplegarAdmin(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a>
              <a href="#" id="enla4" onclick="desplegarAdmin(this,'nav5')"><span><?= OTHERS ?></span><i class="fas fa-cogs ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" title="<?=MODIFICAR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3"  id="subenla3" title="<?=BAJA_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" title="<?=AÑADIR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" title="<?=MODIFICAR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3"  id="subenla6" title="<?=BAJA_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3"  id="subenla7" title="<?=AÑADIR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3"   id="subenla8" title="<?=MODIFICAR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" class="active" id="subenla9" title="<?=BAJA_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <nav id="nav5" class="oculto">
          <div class="icon-bar3">
              <a href="?rm=4&rt=1&a=3" id="subenla10" title="<?=INDPHO?>" onclick="desplegar2(this)"><i class="fas fa-camera ico"></i></a> 
              <a href="?rm=4&rt=2&a=3" id="subenla11" title="<?=ADMINCOM?>" onclick="desplegar2(this)"><i class="fas fa-comments ico"></i></a>  
            </div>
        </nav>
            <section id="proydel">
            <fieldset>
                <legend><?=PROYDEL?></legend>
                    <form action="proyectdelete.php" method="post" enctype="multipart/form-data">
                    <p id="selectuser"><?=SELPROY?>: </p>
                    <select name="id_proy" id="iusu">
                    <option value="-1"><?=PROY?></option>
                                            <?php
                    
                    $RESULT = consulta($conexion,"SELECT * FROM proyectos where mostrar like 1"); 
                    
                    while ($proy = mysqli_fetch_array($RESULT)) {
                    if(isset($_SESSION['lang'])){
                        if($_SESSION['lang']==1){
                            $proye=$proy['name_pro']; 
                        }else{
                            $proye=$proy['nombre_pro'];
                            }
                        }else{
                        $proye=$proy['nombre_pro'];
                        }
                        $proyec=$proy['id_proyecto'];
                        $curso =consulta($conexion, "SELECT * FROM cursos where id_curso in (Select id_curso from proyectos where id_proyecto like $proyec)");
                        $cur = mysqli_fetch_array($curso);
                        $nomCur=$cur['curso'];
                       echo "<option value=" . $proy['id_proyecto'] . ">" . $proye ." /".$nomCur."</option>";
                        

                        
                    }  
                ?>
                </select>
                        <button type="submit" id="selectbu"><i class="fas fa-times edicion2"></i></button>
                        <p id="error"><?php
                            if(isset($_SESSION['msgproydel'])){
                                echo $_SESSION['msgproydel'];
                                unset($_SESSION['msgproydel']);
                            } ?></p>
                </form>
            </fieldset>
    </section>
    <?php
    /*FIn de quitar publicacion
    Fin pestaña proyectos
    comienza pestaña otros
    Comienza fotos del index*/
    }elseif(isset($_GET['rm']) and $_GET['rm']==4 and isset($_GET['rt']) and $_GET['rt']==1){?>
        <nav id="nav1">
              <div class="icon-bar2">
              <a href="#" id="enla1" onclick="desplegarAdmin(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegarAdmin(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegarAdmin(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a>
              <a href="#" id="enla4" class="active" onclick="desplegarAdmin(this,'nav5')"><span><?= OTHERS ?></span><i class="fas fa-cogs ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" title="<?=MODIFICAR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3"  id="subenla3" title="<?=BAJA_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" title="<?=AÑADIR_CURSO?>" id="subenla4" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" title="<?=MODIFICAR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3"  id="subenla6" title="<?=BAJA_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3"  id="subenla7" title="<?=AÑADIR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3"   id="subenla8" title="<?=MODIFICAR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" title="<?=BAJA_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <nav id="nav5">
          <div class="icon-bar3">
              <a href="?rm=4&rt=1&a=3" class="active" id="subenla10" title="<?=INDPHO?>" onclick="desplegar2(this)"><i class="fas fa-camera ico"></i></a> 
              <a href="?rm=4&rt=2&a=3" id="subenla11" title="<?=ADMINCOM?>" onclick="desplegar2(this)"><i class="fas fa-comments ico"></i></a>  
            </div>
        </nav>   
                <section id="fotosindex">
            <fieldset id="fotosact"> 
                <legend><?=FOTACT?></legend>
                <?php 
        /*recuperamos las fotos del index*/
                $fotosIndex=consulta($conexion,"SELECT * FROM imagenes_ies order by id_img");
                $totalImg=mysqli_num_rows($fotosIndex);
                if($totalImg == 0){?>
                    <p style="color:limegreen;font-size:1.3em;text-align:center;"><?=NOFOTS?></p>
                <?php }else{?>
                <table>
                    <tr>
                    <th><?=IMAGEN?></th>
                    <th><?=NAMEFOT?></th>
                    </tr>
                    <?php
                    while($img= mysqli_fetch_array($fotosIndex)){
                    $imagen=$img['nombre_img'];
                    ?>
                       <tr>
                        <td>
                            <img class="imagen" src="<?=IES_IMG?><?=$imagen?>" alt="">
                        </td>
                           <td><p><?=$imagen?></p></td>
                    </tr>
                    <?php }
                    ?>
                </table>
                <?php }
                ?>
            </fieldset>
            <fieldset id="fotosub">
                <legend><?=SUBFOTOS?></legend>
<style type="text/css">
  .demo-droppable {
    background: cadetblue!important;
    color: white;
    padding: 100px 0;
    text-align: center;
    border: 2px solid rgb(5, 137, 25);
      margin: 10px auto;
      width: 95%;
  }
  .demo-droppable.dragover {
    background: #00CC71;
  }
</style>
<?php
        ?>
<form method="post" id="formulario" enctype="multipart/form-data" action="subirfotosindex.php">
<div class="demo-droppable">
  <h3><?=DROPTEXT?></h3>
</div>
<div class="output"></div>
<script type="text/javascript">
  (function(window) {
    function triggerCallback(e, callback) {
      if(!callback || typeof callback !== 'function') {
        return;
      }
      var files;
      if(e.dataTransfer) {
        files = e.dataTransfer.files;
      } else if(e.target) {
        files = e.target.files;
      }
      callback.call(null, files);
    }
    function makeDroppable(ele, callback) {
      var input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.setAttribute('multiple', true);
      input.setAttribute('name','files[]');
      input.setAttribute('id','files');
      input.setAttribute('accept','image/*');
      input.style.display = 'none';
      input.addEventListener('change', function(e) {
        triggerCallback(e, callback);
      });
      ele.appendChild(input);
      
      ele.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        ele.classList.add('dragover');
      });

      ele.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        ele.classList.remove('dragover');
      });

      ele.addEventListener('drop', function(e) {
        input.value = null;
        e.preventDefault();
        e.stopPropagation();
        ele.classList.remove('dragover');
        triggerCallback(e, callback);
      });
      
      ele.addEventListener('click', function() {
        input.value = null;
        input.click();
      });
    }
    window.makeDroppable = makeDroppable;
  })(this);
  (function(window) {
    makeDroppable(window.document.querySelector('.demo-droppable'), function(files) {
      console.log(files);
        document.getElementById('files').files=files;
      var output = document.querySelector('.output');
      output.innerHTML = '';
      for(var i=0; i<files.length; i++) {
        if(files[i].type.indexOf('image/') === 0) {
          output.innerHTML += '<img class="imgtemp" src="' + URL.createObjectURL(files[i]) + '"/>';
        }
        output.innerHTML += '<p class="textfoto">'+files[i].name+'</p>';
      }
        
    });
  })(this);
</script>
               <button type="submit"><i class="fas fa-upload edicion"></i></button>
                        <p id="error"><?php
                            if(isset($_SESSION['msgsubfot'])){
                                echo $_SESSION['msgsubfot'];
                                unset($_SESSION['msgsubfot']);
                            } ?></p>
                </form>
            </fieldset>
                        <?php /*fin de subir fotos
            comienza borrar fotos*/
                    ?>
            <fieldset id="fotodel">
                <legend><?=DELFOTOS?></legend>
                <?php  
                    $imgAct= consulta($conexion,"SELECT * from imagenes_ies order by id_img");
                $totalImg= mysqli_num_rows($imgAct);
                if($totalImg == 0){?>
                    <p style="color:limegreen;font-size:1.3em;text-align:center;"><?=NOFOTS?></p>
                <?php }else{
                    ?>
                    <div id="textImg">
                    <p class="textImg"><?=FOTACT?>:</p><p class="textImg"><?=PHOTODEL?>:</p>
                    </div>
                <form method="post" enctype="multipart/form-data" action="eliminarfotosindex.php">
                <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
                  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                  <link href="_css/jquery.lwMultiSelect.css" rel="stylesheet" type="text/css" />
                  <script type="text/javascript" src="_js/jquery.lwMultiSelect.js"></script>
                  <style>
                  .container { margin:10px auto; 
                      width: 100%;}
                  </style>
        
                   <p><select id="defaults" multiple="multiple" name="fotos[]" id="delfotos">
                   <?php
                   while($img= mysqli_fetch_array($imgAct)){
                       $idImg=$img['id_img'];
                    $imagen=$img['nombre_img']; ?>
                       <option value="<?=$idImg?>"><p><?=$imagen?></p></option>
                   <?php }
                    ?>
                   </select>
                   <?php 
                       $_SESSION['fotosdel']=1;
                       ?>
                      </p>
                    <script>
                    jQuery('#defaults').lwMultiSelect();
                    </script>
                    <script type="text/javascript">

                      var _gaq = _gaq || [];
                      _gaq.push(['_setAccount', 'UA-36251023-1']);
                      _gaq.push(['_setDomainName', 'jqueryscript.net']);
                      _gaq.push(['_trackPageview']);

                      (function() {
                        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                      })();

                    </script>
                               <button type="submit" id=btnborrar><i class="fas fa-times cancel edicion2"></i></button>
                                                  <p id="error"><?php
                                                if(isset($_SESSION['msgalfot'])){
                                                    echo $_SESSION['msgalfot'];
                                                    unset($_SESSION['msgalfot']);
                                                } ?></p>
                                    </form>
                                    <?php } ?>
                                </fieldset>
                            </section>
        <?php   
            /*fin de fotos del index
            Comienza comentarios*/
    }elseif(isset($_GET['rm']) and $_GET['rm']==4 and isset($_GET['rt']) and $_GET['rt']==2){?>
        <nav id="nav1">
              <div class="icon-bar2">
              <a href="#" id="enla1" onclick="desplegarAdmin(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegarAdmin(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegarAdmin(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a>
              <a href="#" id="enla4" class="active" onclick="desplegarAdmin(this,'nav5')"><span><?= OTHERS ?></span><i class="fas fa-cogs ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" title="<?=MODIFICAR_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3"  id="subenla3" title="<?=BAJA_USUARIO?>" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" title="<?=AÑADIR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" title="<?=MODIFICAR_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3"  id="subenla6" title="<?=BAJA_CURSO?>" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3"  id="subenla7" title="<?=AÑADIR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3"   id="subenla8" title="<?=MODIFICAR_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" title="<?=BAJA_PROYECTO?>" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <nav id="nav5">
          <div class="icon-bar3">
              <a href="?rm=4&rt=1&a=3" id="subenla10" title="<?=INDPHO?>" onclick="desplegar2(this)"><i class="fas fa-camera ico"></i></a> 
              <a href="?rm=4&rt=2&a=3" class="active" title="<?=ADMINCOM?>" id="subenla11" onclick="desplegar2(this)"><i class="fas fa-comments ico"></i></a>  
            </div>
        </nav>
            <section id="commentarioscpanel">
         <?php 
            if(isset($_POST['id_proyAd']) || isset($_GET['idp'])){
            if(isset($_GET['idp'])){
                $idp=$_GET['idp'];
                }else if(isset($_POST['id_proyAd'])){
                if($_POST['id_proyAd']== -1){
                    $_SESSION['msgcom']=DEBCHO;
                    header('Location: ?rm=4&rt=2&a=3');
                    exit();
                }
                $idp=htmlentities($_POST['id_proyAd']);
            }
                /*sacamos todos los comentarios del proyecto selccionado*/
                $comments=consulta($conexion,"SELECT * FROM comentarios where id_proyecto like $idp");
                /*sacamos su nombre y name*/
                $proy=consulta($conexion,"SELECT * FROM proyectos where id_proyecto like $idp");
                $proyecto=mysqli_fetch_array($proy);
                $nombrePro=$proyecto['nombre_pro'];
                $namePro=$proyecto['name_pro'];
                $totalcomentarios=mysqli_num_rows($comments);
                if($totalcomentarios == 0){?>
                   <article id="comentarios">
                   <fieldset>
                   <legend>    <?php if(isset($_SESSION['lang'])){
                                    if($_SESSION['lang']==1){
                                        echo $namePro; 
                                    }else{
                                        echo $nombrePro;
                                        }
                                }else{
                                    echo $nombrePro;
                                    }?>
                   </legend>
                        <p id="errorNo">
                           <?php
                                $_SESSION['msgprofe']=NO_COMENTARIO;
                                    echo $_SESSION['msgprofe'];
                                    unset($_SESSION['msgprofe']);
                             ?>
                </p>
                       </fieldset>
                </article>
                <?php }else{?>
                <article id="comentarios">
                <fieldset>
                <p id="error">
                           <?php
                                if(isset($_SESSION['msgdeletecom'])){
                                    echo $_SESSION['msgdeletecom'];
                                    unset($_SESSION['msgdeletecom']);
                                }
                             ?>
                </p>
                <legend>    
                <?php if(isset($_SESSION['lang'])){
                            if($_SESSION['lang']==1){
                                echo $namePro; 
                            }else{
                                echo $nombrePro;
                                }
                        }else{
                            echo $nombrePro;
                            }?>
               </legend>
                <?php 
                /*pintamos un fieldset por cada cmentarios con un formulario y un button para eliminar*/
                while($comentario=mysqli_fetch_array($comments)){
                            $id_com=$comentario['id_comentario'];
                            $user=$comentario['usuario'];
                            $texto=$comentario['comentario'];
                    ?>
                            <fieldset class="coments">
                                <form method="post" enctype="multipart/form-data" action="eliminarcomentarios.php">
                                   <div class="textocom">
                                       <h2><?=$user?> <?=SAY?>:</h2>
                                        <p><?=$texto?></p>
                                   </div>
                                   <div class="buttoncom">
                                    <input type="hidden" value="<?=$id_com?>" name="comentario">
                                    <input type="hidden" value="<?=$idp?>" name="proyecto">
                                          <button type="submit" class="combutton"><i class="fas fa-times edicion3"></i></button>
                                    </div>
                                </form>
                            </fieldset>
                
                <?php }
             ?>
                    </fieldset>
                </article>
          <?php 
                }
            }else{ ?>
                <fieldset>
                <legend><?=ELIMINAR_COMENTARIO?></legend>
                    <form action="" method="post" enctype="multipart/form-data">
                    <p id="selectuser"><?=SELPROY?>: </p>
                    <select name="id_proyAd" id="idproyAd">
                    <option value="-1"><?=PROY?></option>
                                            <?php
                    
                    $RESULT = consulta($conexion,"SELECT * FROM proyectos where mostrar like 1"); 
                    
                    while ($fila = mysqli_fetch_array($RESULT)) { ?>
                       <option value="<?=$fila['id_proyecto']?>"><?php if(isset($_SESSION['lang'])){
                                                                            if($_SESSION['lang']==1){
                                                                                echo $fila['name_pro']; 
                                                                                    }else{
                                                                                    echo $fila['nombre_pro'];
                                                                                    }
                                                                                }else{
                                                                                echo $fila['nombre_pro'];
                                                                                }?></option>
                       <?php
                    }    
                ?>
                </select>
                        <button type="submit" id="selectbu"><i class="fas fa-edit edicion"></i></button>
                        <p id="error"><?php
                            if(isset($_SESSION['msgcom'])){
                                echo $_SESSION['msgcom'];
                                unset($_SESSION['msgcom']);
                            } ?></p>
                </form>
            </fieldset>
           <?php
        }?>
        </section>
        <?php
    /*Fin comentarios
    Fin del cpanel admin*/
    }else{
            header('Location: cpanel.php');
            exit();
        }
    include('_include/footer.php');
    ob_end_flush();
    ?>
    
    <script src="_js/funciones.js"></script>
    <script src="_js/funcionescpanel.js"></script>
</body>
</html>