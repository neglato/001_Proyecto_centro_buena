<!DOCTYPE html>
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
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
if(isset($_POST['id_proy'])){
        if($_POST['id_proy'] == -1){
                header('Location: cpaneladmin.php?rm=3&rt=2&a=3');
            }
}
/*$_SESSION['user']=1;*/
/*session_destroy();*/
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
              <div class="icon-bar">
              <a href="#" id="enla1" onclick="desplegar(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegar(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegar(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" id="subenla2" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenla3" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3a=3" id="subenla4" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenla6" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <?php
       include('_include/cpanelindex.php');
    }
        elseif(isset($_GET['rm']) && $_GET['rm']==1 && isset($_GET['rt']) && $_GET['rt']==1) {
            unset($_SESSION['uid']);
        ?>
           <nav id="nav1">
              <div class="icon-bar">
              <a href="#" class="active" id="enla1" onclick="desplegar(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegar(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegar(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" class="active" id="subenla1" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" id="subenla2" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenla3" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenla6" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <section id="adduser">
        <fieldset>
            <legend><?=AÑADIR_USUARIO?></legend>
            <form action="addnewuser.php" method="post" enctype="multipart/form-data">
            <p><?=NOMBRE?></p><input type="text"  name="nombre" required>
           <p><?=APELLIDOS?></p><input type="text"  name="apellidos" required>
           <p><?=SEXO?></p><select name=sexo required>
                            <option value="0" ><?=HOM?></option>
                            <option value="1" ><?=MUJ?></option>
                        </select>
           <p>Email : </p><input type="email" name="email" required onblur="comprobarEmail(this.value)">
           <p><?=PRIVI?></p><select name=tipo>
                            <option value="0" ><?=ADMIN?></option>
                            <option value="1" ><?=PROFE?></option>
                            <option value="2" ><?=ALUM?></option>
                        </select>
            <button type="submit" id="boton"><div id="edit"><?=MODPER?></div><i class="fas fa-save edicion"></i></button>
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
              <div class="icon-bar">
              <a href="#" class="active" id="enla1" onclick="desplegar(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegar(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegar(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" class="active" id="subenla2" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenla3" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenla6" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
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
                    $info=mysqli_fetch_array($RESULT2);
                    $_SESSION['uid']=$idu;
                }elseif ($_POST['id_user'] !="-1"){
                    $RESULT2 = consulta($conexion,"SELECT * FROM usuarios WHERE id_user ='" . $_POST['id_user'] . "'"); 
                    $info=mysqli_fetch_array($RESULT2);
                    $_SESSION['uid']=$_POST['id_user'];
                }
            ?>
        <fieldset>
            <legend><?=MODIFICAR_USUARIO?></legend>
            <form action="modifyuser.php" method="post" enctype="multipart/form-data">
            <p><?=NOMBRE?></p><input type="text"  name="nombre" required value="<?=$info['nombre']?>">
           <p><?=APELLIDOS?></p><input type="text"  name="apellidos" required value="<?=$info['apellidos']?>">
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
           <p>Email : </p><input type="email" name="email" required value="<?=$info['email']?>">
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
                            if(isset($_SESSION['msgmod'])){
                                echo $_SESSION['msgmod'];
                                unset($_SESSION['msgmod']);
                            } ?></p>
            </form>
        </fieldset>
    </section>
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
/*Fin modifiar usuario
Comienza eliminar usuario*/
        }elseif(isset($_GET['rm']) and $_GET['rm']==1 and isset($_GET['rt']) and $_GET['rt']==3){?>
            <nav id="nav1">
              <div class="icon-bar">
              <a href="#" class="active" id="enla1" onclick="desplegar(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" onclick="desplegar(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegar(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" class="active" id="subenla3" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenla6" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
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
              <div class="icon-bar">
              <a href="#"  id="enla1" onclick="desplegar(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" class="active" id="enla2" onclick="desplegar(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegar(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenla3" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" class="active" id="subenla4" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenla6" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <section id="addcourse">
        <fieldset>
            <legend><?=AÑADIR_CURSO?></legend>
            <form action="addnewcourse.php" method="post" enctype="multipart/form-data">
            <p><?=CUR?></p><input type="text"  name="nombre" required placeholder="<?=EJ?> 2016-2017">
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
        comienza editar curso*/
    }else if(isset($_GET['rm']) and $_GET['rm']==2 and isset($_GET['rt']) and $_GET['rt']==2) { ?>
        <nav id="nav1">
              <div class="icon-bar">
              <a href="#"  id="enla1" onclick="desplegar(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enla2" class="active" onclick="desplegar(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegar(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2"class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=3&a=3"  id="subenla3" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a>
              <a href="?rm=1&rt=3&a=3" id="subenla3" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav3">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" class="active" id="subenla5" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenla6" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
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
                    $info=mysqli_fetch_array($RESULT2);
                    $_SESSION['cid']=$cid;
                }elseif ($_POST['id_curso'] !="-1"){
                    $RESULT2 = consulta($conexion,"SELECT * FROM cursos WHERE id_curso ='" . $_POST['id_curso'] . "'"); 
                    $info=mysqli_fetch_array($RESULT2);
                    $_SESSION['cid']=$_POST['id_curso'];
                }
            ?>
        <fieldset>
            <legend><?=MODIFICAR_CURSO?></legend>
            <form action="modifycourse.php" method="post" enctype="multipart/form-data">
            <p><?=CUR?></p><input type="text"  name="nombre" required value="<?=$info['curso']?>">
            <button type="submit" id="boton"><div id="edit"><?=MODPER?></div><i class="fas fa-save edicion"></i></button>
            <p id="error"><?php
                            if(isset($_SESSION['msgmodcour'])){
                                echo $_SESSION['msgmodcour'];
                                unset($_SESSION['msgmodcour']);
                            } ?></p>
            </form>
        </fieldset>
    </section>
            <?php 
            }else{ ?>
               <section id="coursemod">
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
    </section>
            <?php }
                
/*Fin modifiar curso
Comienza eliminar curso*/
        }elseif(isset($_GET['rm']) and $_GET['rm']==2 and isset($_GET['rt']) and $_GET['rt']==3){?>
            <nav id="nav1">
              <div class="icon-bar">
              <a href="#"  id="enla1" onclick="desplegar(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" class="active" id="enla2" onclick="desplegar(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" onclick="desplegar(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3"  id="subenla3" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" class="active" id="subenla6" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4" class="oculto">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" id="subenla7" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
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
              <div class="icon-bar">
              <a href="#"  id="enla1" onclick="desplegar(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#"  id="enla2" onclick="desplegar(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" class="active" onclick="desplegar(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3"  id="subenla3" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3"  id="subenla6" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3" class="active" id="subenla7" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3" id="subenla8" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
    <section id="addproy">
        <fieldset>
            <legend><?=AÑADIR_PROYECTO?></legend>
            <form action="addnewproyect.php" method="post" enctype="multipart/form-data">
            <p><?=NOMES?>:</p><input type="text"  name="nombre" required>
            <p><?=NAMES?>:</p><input type="text"  name="name" required>
                <p id="selectcurso"><?=CUR?> </p>
                    <select name="id_curso" id="icur">
                    <option value="-1"><?=SELCUR?></option>
                                            <?php
                    
                    $RESULT = consulta($conexion,"SELECT * FROM cursos  order by curso desc"); 
                    
                    while ($fila = mysqli_fetch_array($RESULT)) {
                       echo "<option value=" . $fila['id_curso'] . ">" . $fila['curso'] ."</option>";
                        
                    }  
                ?>
                </select>
                    <p id="selectuser"><?=COOR?>: </p>
                    <select name="id_coor" id="icoor">
                        <option value="-1"><?=COOR?></option>
                    
                        <?php
                            $RESULT2 = consulta($conexion,"SELECT * FROM usuarios where tipo like 1 and baja like 0"); 
                            while ($fila2 = mysqli_fetch_array($RESULT2)) {
                                echo "<option value=" . $fila2['id_user'] . ">" . $fila2['nombre'] . " " .  $fila2['apellidos'] . "</option>";
                            }
                        ?>
                    </select>
            <button type="submit" id="boton"><div id="edit">añadir curso</div><i class="fas fa-save edicion"></i></button>
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
              <div class="icon-bar">
              <a href="#"  id="enla1" onclick="desplegar(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#"  id="enla2" onclick="desplegar(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" class="active" onclick="desplegar(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3"  id="subenla3" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3"  id="subenla6" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3"  id="subenla7" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3"  class="active" id="subenla8" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" id="subenla9" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
            </div>
        </nav>
        <section id="coursemod">
         <?php 
            if(isset($_GET['pid'])){
                $pid=$_GET['pid'];
            }
            if(isset($_POST['id_proy']) || isset($pid)){
                if(isset($pid)){
                    $RESULT2 = consulta($conexion,"SELECT * FROM proyectos WHERE id_proyecto ='" . $pid . "'"); 
                    $info=mysqli_fetch_array($RESULT2);
                    $_SESSION['pid']=$pid;
                    unset($pid);
                }elseif ($_POST['id_proy'] != -1){
                    $RESULT2 = consulta($conexion,"SELECT * FROM proyectos WHERE id_proyecto ='" . $_POST['id_proy'] . "'"); 
                    $info=mysqli_fetch_array($RESULT2);
                    $_SESSION['pid']=$_POST['id_proy'];
                }
            ?>
           <fieldset>
            <legend><?=MODIFICAR_PROYECTO?></legend>
            <form action="modifyproyect.php" method="post" enctype="multipart/form-data">
            <p><?=NOMES?>:</p><input type="text"  name="nombre" required value="<?=$info['nombre_pro']?>">
            <p><?=NAMES?>:</p><input type="text"  name="name" required value="<?=$info['name_pro']?>">
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
                    <p id="selectuser"><?=COOR?>: </p>
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
    </section>
            <?php 
            }else{ ?>
               <section id="coursemod">
                <fieldset>
                <legend><?=MODIFICAR_PROYECTO?></legend>
                    <form action="" method="post" enctype="multipart/form-data">
                    <p id="selectcourse"><?=SELPROY?>: </p>
                    <select name="id_proy" id="iusu">
                    <option value="-1"><?=PROY?></option>
                <?php
                    $PROYECT = consulta($conexion,"SELECT * FROM proyectos");
                    $proy = mysqli_fetch_array($PROYECT);
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
                       echo "<option value=" . $proy['id_proyecto'] . ">" . $proye ." </option>";
                        
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
    </section>
            <?php
                 }
                /*fin de modificar proyecto
                comienzo de quitar publicacion proyecto*/
            }elseif(isset($_GET['rm']) and $_GET['rm']==3 and isset($_GET['rt']) and $_GET['rt']==3){?>
            <nav id="nav1">
              <div class="icon-bar">
              <a href="#"  id="enla1" onclick="desplegar(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#"  id="enla2" onclick="desplegar(this,'nav3')"><span><?= CURSOS ?></span><i class="fas fa-calendar-alt ico"></i></a> 
              <a href="#" id="enla3" class="active" onclick="desplegar(this,'nav4')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
          </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenla1" onclick="desplegar2(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3"  id="subenla2" onclick="desplegar2(this)"><i class="fas fa-user-md ico"></i></a> 
              <a href="?rm=1&rt=3&a=3"  id="subenla3" onclick="desplegar2(this)"><i class="fas fa-user-times ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenla4" onclick="desplegar2(this)"><i class="fas fa-calendar-plus ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenla5" onclick="desplegar2(this)"><i class="fas fa-calendar-check ico"></i></a> 
              <a href="?rm=2&rt=3&a=3"  id="subenla6" onclick="desplegar2(this)"><i class="fas fa-calendar-times ico"></i></a>  
            </div>
        </nav>
        <nav id="nav4">
          <div class="icon-bar">
              <a href="?rm=3&rt=1&a=3"  id="subenla7" onclick="desplegar2(this)"><i class="fas fa-file-alt ico"></i></a> 
              <a href="?rm=3&rt=2&a=3"   id="subenla8" onclick="desplegar2(this)"><i class="fas fa-file-code ico"></i></a> 
              <a href="?rm=3&rt=3&a=3" class="active" id="subenla9" onclick="desplegar2(this)"><i class="fas fa-file-excel ico"></i></a> 
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
                       echo "<option value=" . $proy['id_proyecto'] . ">" . $proye ." </option>";
                        

                        
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
    fin del cpanel admin*/
    }
    include('_include/footer.php');
    ?>
    <script src="_js/funciones.js"></script>
    <script src="_js/funcionescpanel.js"></script>
</body>
</html>