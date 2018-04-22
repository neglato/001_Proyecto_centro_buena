<!DOCTYPE html>
<?php
ob_start();
?>
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
$activo=3;
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=PANEL?><?=PROFE?></title>
    <link rel="stylesheet" href="_css/estilosheader.css">
    <link rel="stylesheet" href="_css/estilosCpanel.css">
    <link rel="stylesheet" href="_css/footer.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
<!--    Incluimos las cookies-->
    
<?php
    include('_include/cookies.php');
?>
    
</head>


<body onload="move()">
<?php
    include('_include/header.php');
    include('_include/conexion.php');
    
    if(!isset($_GET['rm'])){?>
        <nav id="nav1">
            <div class="icon-bar">
              <a href="#" id="enlace1" onclick="desplegarProfe(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enlace2" onclick="desplegarProfe(this,'nav3')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenlace1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" id="subenlace2" title="<?=USU2PROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i><i class="fas fa-file ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenlace3" title="<?=USUDELPROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-times ico"></i><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenlace4" title="<?=PROYOK?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-check-circle ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenlace5" title="<?=PROYSTOP?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-stop-circle ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenlace6" title="<?=PROYEDIT?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="fas fa-edit ico"></i></a>
            </div>
        </nav>
        
<!--Inicio añadir usuario-->
       
        <?php
            include('_include/cpanelindex.php');
            }elseif(isset($_GET['rm']) && $_GET['rm']==1 && isset($_GET['rt']) && $_GET['rt']==1) {
            unset($_SESSION['uid']);
        ?>
           <nav id="nav1">
            <div class="icon-bar">
              <a href="#" id="enlace1" class="active" onclick="desplegarProfe(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enlace2" onclick="desplegarProfe(this,'nav3')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav2">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenlace1" class="active" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" id="subenlace2" title="<?=USU2PROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i><i class="fas fa-file ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenlace3" title="<?=USUDELPROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenlace4" title="<?=PROYOK?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-check-circle ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenlace5" title="<?=PROYSTOP?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-stop-circle ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenlace6" title="<?=PROYEDIT?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="fas fa-edit ico"></i></a>
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
            <button type="submit" id="boton"><div id="edit"><?=MODPER?></div><i class="fas fa-save edicion"></i></button>
            <p id="error">
                <?php
                    if(isset($_SESSION['msgadd'])){
                        echo $_SESSION['msgadd'];
                        unset($_SESSION['msgadd']);
                } ?>
            </p>
            </form>
        </fieldset>
    </section>
    
    <?php
/*Fin añadir usuario                                                                                             
 comienza añadir usuario a proyecto*/
        }else if(isset($_GET['rm']) and $_GET['rm']==1 and isset($_GET['rt']) and $_GET['rt']==2) { ?>
        <nav id="nav1">
            <div class="icon-bar">
              <a href="#" id="enlace1" class="active" onclick="desplegarProfe(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enlace2" onclick="desplegarProfe(this,'nav3')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav2">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenlace1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" id="subenlace2" class="active" title="<?=USU2PROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i><i class="fas fa-file ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenlace3" title="<?=USUDELPROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-times ico"></i><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenlace4" title="<?=PROYOK?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-check-circle ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenlace5" title="<?=PROYSTOP?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-stop-circle ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenlace6" title="<?=PROYEDIT?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="fas fa-edit ico"></i></a> 
            </div>
        </nav>

    <section id="user2proy">
        <fieldset>
            <legend><?=USU2PROY?></legend>
                <form action="user2proy.php" method="post" enctype="multipart/form-data">
                    <p id="selectproy"><?=PROYECT?>: </p>
                    <select name="id_proyecto" id="iproy" onchange="obtenNoParticipantes(this.value);">
                        <option value="-1"><?=SELPROY?></option>
                    
                        <?php
                            $user=$_SESSION['user'];
                            $RESULT = consulta($conexion,"SELECT * 
                                                            FROM proyectos 
                                                            WHERE id_proyecto in (SELECT id_proyecto 
                                                                                    FROM usuproy
                                                                                    WHERE id_user = $user)
                                                            AND mostrar like 0");  
                            while ($fila = mysqli_fetch_array($RESULT)) {
                                if($_SESSION['lang']==0){
                                    echo "<option value=" . $fila['id_proyecto'] . ">" . $fila['nombre_pro'] . "</option>";
                                }elseif($_SESSION['lang']==1){
                                    echo "<option value=" . $fila['id_proyecto'] . ">" . $fila['name_pro'] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    

                    <p id="selectuser"><?=USUDISP?></p>
                    <select name="id_user[]" id="iusuario" multiple size="3">
                       
                    </select>
                    
                    <div id="parcial">
                        <input type="button" id="suma" class="pasar izq" value="<?=ADD?>">
                        <input type="button" id="sumaAll" class="pasartodos izq" value="<?=ADDALL?>">
                        
                    </div>
                    <div id="total">
                        <input type="button" id="resta" class="quitar der" value="<?=DESH?>">
                        <input type="button" id="restaAll" class="quitartodos der" value="<?=DESHALL?>">
                    </div>
                 
                    <p id="selectuser"><?=USUPAAÑADIR?></p>
                    <select name="id_user2[]" id="iusuario2" multiple size="3">
                        
                    </select>
                   
                    <button type="submit" name="usu2proy" id="btnprofe" class="submit"><i class="fas fa-save edicion"></i></button>
                        <p id="error">
                           <?php
                                if(isset($_SESSION['msgprofe'])){
                                    echo $_SESSION['msgprofe'];
                                    unset($_SESSION['msgprofe']);
                            } ?>
                        </p>
                </form>
        </fieldset>
    </section>

<?php
/*Fin añadir usuario a proyecto                                                                                            
 comienza eliminar usuario del proyecto*/
    }else if(isset($_GET['rm']) and $_GET['rm']==1 and isset($_GET['rt']) and $_GET['rt']==3) { ?>
        <nav id="nav1">
            <div class="icon-bar">
              <a href="#" id="enlace1" class="active" onclick="desplegarProfe(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enlace2" onclick="desplegarProfe(this,'nav3')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav2">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenlace1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" id="subenlace2" title="<?=USU2PROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i><i class="fas fa-file ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenlace3" class="active" title="<?=USUDELPROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-times ico"></i><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3" class="oculto">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenlace4" title="<?=PROYOK?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-check-circle ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenlace5" title="<?=PROYSTOP?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-stop-circle ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenlace6" title="<?=PROYEDIT?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="fas fa-edit ico"></i></a> 
            </div>
        </nav>

    <section id="userdelproy">
        <fieldset>
            <legend><?=USUDELPROY?></legend>
                <form action="userdelproy.php" method="post" enctype="multipart/form-data">
                    <p id="selectproy"><?=PROYECT?>: </p>
                    <select name="id_proyecto" id="iproy" onchange="obtenParticipantes(this.value);">
                        <option value="-1"><?=SELPROY?></option>
                    
                        <?php
                            $user=$_SESSION['user'];
                            $RESULT = consulta($conexion,"SELECT * 
                                                            FROM proyectos 
                                                            WHERE id_proyecto in (SELECT id_proyecto 
                                                                                    FROM usuproy
                                                                                    WHERE id_user = $user)
                                                            AND mostrar like 0");  
                            while ($fila = mysqli_fetch_array($RESULT)) {
                                if($_SESSION['lang']==0){
                                    echo "<option value=" . $fila['id_proyecto'] . ">" . $fila['nombre_pro'] . "</option>";
                                }elseif($_SESSION['lang']==1){
                                    echo "<option value=" . $fila['id_proyecto'] . ">" . $fila['name_pro'] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    
                    <p id="selectuser"><?=PART?></p>
                    <select name="id_user[]" id="iusuario" multiple size="3">
                    
                    </select>
                    
                    <div id="parcial">
                        <input type="button" id="suma" class="pasar izq" value="<?=DEL?>">
                        <input type="button" id="sumaAll" class="pasartodos izq" value="<?=DELALL?>">
                        
                    </div>
                    <div id="total">
                        <input type="button" id="resta" class="quitar der" value="<?=DESH?>">
                        <input type="button" id="restaAll" class="quitartodos der" value="<?=DESHALL?>">
                    </div>
                 
                    <p id="selectuser"><?=PARTDROP?></p>
                    <select name="id_user2[]" id="iusuario2" multiple size="3">
                        
                    </select>                    
                    
                    <button type="submit" name="userdelproy" id="btnprofe" class="submit"><i class="fas fa-times edicion2"></i></button>
                        <p id="error">
                           <?php
                                if(isset($_SESSION['msgprofe'])){
                                    echo $_SESSION['msgprofe'];
                                    unset($_SESSION['msgprofe']);
                            } ?>
                        </p>
                </form>
        </fieldset>
    </section>

    <?php
        /*Fin eliminar usuario del proyecto                                                                                           
        comienza visualizar proyectos publicados*/
        }else if(isset($_GET['rm']) and $_GET['rm']==2 and isset($_GET['rt']) and $_GET['rt']==1) { ?>
    
    <nav id="nav1">
            <div class="icon-bar">
              <a href="#" id="enlace1" onclick="desplegarProfe(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enlace2" class="active" onclick="desplegarProfe(this,'nav3')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenlace1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" id="subenlace2" title="<?=USU2PROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i><i class="fas fa-file ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenlace3" title="<?=USUDELPROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-times ico"></i><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenlace4" class="active" title="<?=PROYOK?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-check-circle ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenlace5" title="<?=PROYSTOP?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-stop-circle ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenlace6" title="<?=PROYEDIT?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="fas fa-edit ico"></i></a> 
            </div>
        </nav>

       <section id="proypublic">
<!--           Aqui saldran los proyectos publicados-->
      
        <?php
            $user=$_SESSION['user'];
            $RESULT = consulta($conexion,"SELECT * 
                                          FROM proyectos 
                                          WHERE id_proyecto in (SELECT id_proyecto 
                                                                FROM usuproy
                                                                WHERE id_user = $user)
                                          AND mostrar = 1"); 
            $totalFilas= mysqli_num_rows($RESULT);?>
            
            <fieldset id="proypub">
               <legend><?=PROYOK?></legend>
               
               <?php if($totalFilas==0){ ?>
                <p id="error">
                           <?php
                                $_SESSION['msgprofe']=PROYP;
                                    echo $_SESSION['msgprofe'];
                                    unset($_SESSION['msgprofe']);
                             ?>
                </p>
            <?php
                }
            ?>

            <ul>
               <?php
                $i=0;
                while($i<$totalFilas){
                    $row=mysqli_fetch_array($RESULT); 
                    $proyecto=$row['nombre_pro'];
                    $proyect=$row['name_pro'];
                    $idp=$row['id_proyecto'];
            ?>
            <li>
            <a href="proyecto.php?a=1&idp=<?=$idp?>" id="proyprof"><?php
                            if(isset($_SESSION['lang'])){
                                if($_SESSION['lang']==1){
                                    echo $proyect; 
                                }else{
                                   echo $proyecto;
                                }
                            }else{
                                echo $proyecto;
                            }  
                        ?></a>
            </li>
            <?php 
            $i++;
            } ?>
            </ul>
           </fieldset>
      
       </section>
    
        <?php
        /*Fin visualizar proyectos publicados                                                                                         
        comienza visualizar proyectos NO publicados*/
        }else if(isset($_GET['rm']) and $_GET['rm']==2 and isset($_GET['rt']) and $_GET['rt']==2) { ?>
    
        <nav id="nav1">
            <div class="icon-bar">
              <a href="#" id="enlace1" onclick="desplegarProfe(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enlace2" class="active" onclick="desplegarProfe(this,'nav3')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenlace1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" id="subenlace2" title="<?=USU2PROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i><i class="fas fa-file ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenlace3" title="<?=USUDELPROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-times ico"></i><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenlace4" title="<?=PROYOK?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-check-circle ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenlace5" class="active" title="<?=PROYSTOP?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-stop-circle ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenlace6" title="<?=PROYEDIT?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="fas fa-edit ico"></i></a> 
            </div>
        </nav>

        <section id="proyNOpublic">
<!--           Aqui saldran los proyectos NO publicados-->
           <fieldset id="proyNOpub">
               <legend><?=PROYSTOP?></legend>
           <?php
            $user=$_SESSION['user'];
            $RESULT = consulta($conexion,"SELECT * 
                                          FROM proyectos 
                                          WHERE id_proyecto in (SELECT id_proyecto 
                                                                FROM usuproy
                                                                WHERE id_user = $user)
                                          AND mostrar = 0"); 
                                                                                                   
            $totalFilas= mysqli_num_rows($RESULT);
            
            if($totalFilas==0){ ?>
                <p id="error">
                           <?php
                                $_SESSION['msgprofe']=PROYNOPUB;
                                    echo $_SESSION['msgprofe'];
                                    unset($_SESSION['msgprofe']);
                             ?>
                </p>
           <?php
                }else{
           ?>
            
            <ul>
               <?php
                $i=0;
                while($i<$totalFilas){
                    $row=mysqli_fetch_array($RESULT); 
                    $proyecto=$row['nombre_pro'];
                    $proyect=$row['name_pro'];
                    $idp=$row['id_proyecto'];
            ?>
            <li>
            <a href="proyecto.php?a=1&idp=<?=$idp?>" id="proyprof"><?php
                            if(isset($_SESSION['lang'])){
                                if($_SESSION['lang']==1){
                                    echo $proyect; 
                                }else{
                                   echo $proyecto;
                                }
                            }else{
                                echo $proyecto;
                            }  
                        ?></a>
            </li>
            <?php 
            $i++;
            } ?>
            </ul>
           </fieldset>
       
       <?php
            }
       ?>
        </section>
    
        <?php
        /*Fin visualizar proyectos publicados                                                                                         
        comienza visualizar proyectos NO publicados*/
        }else if(isset($_GET['rm']) and $_GET['rm']==2 and isset($_GET['rt']) and $_GET['rt']==3) { ?>
    
        <nav id="nav1">
            <div class="icon-bar">
              <a href="#" id="enlace1" onclick="desplegarProfe(this,'nav2')"><span><?= USUARIOS ?></span><i class="fas fa-user ico"></i></a> 
              <a href="#" id="enlace2" class="active" onclick="desplegarProfe(this,'nav3')"><span><?= PROYECT ?></span><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav2" class="oculto">
            <div class="icon-bar">
              <a href="?rm=1&rt=1&a=3" id="subenlace1" title="<?=AÑADIR_USUARIO?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i></a> 
              <a href="?rm=1&rt=2&a=3" id="subenlace2" title="<?=USU2PROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-plus ico"></i><i class="fas fa-file ico"></i></a> 
              <a href="?rm=1&rt=3&a=3" id="subenlace3" title="<?=USUDELPROY?>" onclick="desplegar2Profe(this)"><i class="fas fa-user-times ico"></i><i class="fas fa-file ico"></i></a> 
            </div>
        </nav>
        <nav id="nav3">
          <div class="icon-bar">
              <a href="?rm=2&rt=1&a=3" id="subenlace4" title="<?=PROYOK?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-check-circle ico"></i></a> 
              <a href="?rm=2&rt=2&a=3" id="subenlace5" title="<?=PROYSTOP?>" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="far fa-stop-circle ico"></i></a> 
              <a href="?rm=2&rt=3&a=3" id="subenlace6" title="<?=PROYEDIT?>" class="active" onclick="desplegar2Profe(this)"><i class="fas fa-file ico"></i><i class="fas fa-edit ico"></i></a> 
            </div>
        </nav>
        
        <section id="proyedit">
<!--           Aqui saldran los proyectos para editar-->
       
       <?php

//Aqui sale el select para seleccionar un proyecto
        if(!isset($_POST['tipo'])){
            $user=$_SESSION['user'];
            $RESULT = consulta($conexion,"SELECT * 
                                          FROM proyectos 
                                          WHERE id_proyecto in (SELECT id_proyecto 
                                                                FROM usuproy
                                                                WHERE id_user = $user)
                                          "); 
            $totalFilas= mysqli_num_rows($RESULT);?>
            <fieldset id="proyedi">
               <legend><?=PROYEDIT?></legend>
               <form action="" method="post" enctype="multipart/form-data" name="rename">
                   <p id="selectproy"><?=PROYECT?>: </p>
                    <select name="tipo" id="iproyec">
                       <option value="-1"><?=SELPROY?></option>
                        <?php
                            while ($fila = mysqli_fetch_array($RESULT)) {
                                if($_SESSION['lang']==0){
                                    echo "<option value=" . $fila['id_proyecto'] . ">" . $fila['nombre_pro'] . "</option>";
                                }elseif($_SESSION['lang']==1){
                                    echo "<option value=" . $fila['id_proyecto'] . ">" . $fila['name_pro'] . "</option>";
                                }
                            }
                        ?>
                    </select>
                       
                        <button type="submit" id="btnprofe1"><i class="fas fa-edit edicion"></i></button>
                        <button type="submit" id="btnprofe2" onclick="this.form.action='uploadproy.php'"><i class="fas fa-upload edicion"></i></button> 
                        
                        <p id="error">
                           <?php
                                if(isset($_SESSION['msgprofe'])){
                                    echo $_SESSION['msgprofe'];
                                    unset($_SESSION['msgprofe']);
                            } ?>
                        </p>
                </form>
           </fieldset>
        </section>
<?php        
            
    //A partir de aqui sale el formulario para renombrar el nombre español e ingles
        }else{   
                if($_POST['tipo'] == -1){
                    header('Location: cpanelprofe.php?rm=2&rt=3&a=3');
                    $_SESSION['msgprofe']=SELPROY;
                    exit();
                }elseif($_POST['tipo'] != -1){
                    $idproy=$_POST['tipo'];
                    $_SESSION['tipo']=$idproy;
            ?>
              <fieldset id="proyedi">
               <legend><?=CAMNOM?></legend>
                    <form action="" method="post" enctype="multipart/form-data" name="rename2">
                       <?php
                        $RESULTADO = consulta($conexion, "select * from proyectos where id_proyecto=$idproy");
                        $plan = mysqli_fetch_array($RESULTADO);
                       ?>
                        <p>Proyecto (ES)</p><input type="text"  name="newnombre" value="<?= $plan['nombre_pro']?>" required>
                        <p>Project (UK)</p><input type="text"  name="newnombreuk" value="<?= $plan['name_pro']?>" required>
                        <button type="submit"><i class="fas fa-save edicion"></i></button>
                        <p id="error">
                           <?php
                                if(isset($_SESSION['msgprofe'])){
                                    echo $_SESSION['msgprofe'];
                                    unset($_SESSION['msgprofe']);
                            } ?>
                        </p>
                    </form>
             </fieldset>
         <?php
              }
                }
    ?>
    
<!--    Si se envia el formulario de cambio de nombres, para validar dicho cambio-->
    
    <?php
    if(isset($_POST['newnombre']) && $_POST['newnombre'] == "" && isset($_POST['newnombreuk']) && $_POST['newnombreuk'] == ""){
        header('Location: cpanelprofe.php?rm=2&rt=3&a=3');
        $_SESSION['msgprofe']=DEBEINTNOM;
        exit();
    }elseif(isset($_POST['newnombre']) && $_POST['newnombre'] != "" && isset($_POST['newnombreuk']) && $_POST['newnombreuk'] != ""){
        //Guardamos el nuevo nombre en los 2 idiomas
        $nomb=$_POST['newnombre'];
        $nombuk=$_POST['newnombreuk'];
        //Recuperamos el id del proyecto y el nombre viejo para modificar la carpeta y el codigo del curso
        $idproy=$_SESSION['tipo'];
        $CONS = consulta($conexion,"SELECT * FROM proyectos WHERE id_proyecto='" . $idproy . "'"); 
        $dato=mysqli_fetch_array($CONS);
        $oldnomb=$dato['nombre_pro'];
        $idcurso=$dato['id_curso'];
        //recuperamos el nombre del curso para renombrar la carpeta
        $CONSULT = consulta($conexion,"SELECT * FROM proyectos p, cursos c WHERE p.id_curso=c.id_curso AND p.id_proyecto='" . $idproy . "'"); 
        $año=mysqli_fetch_array($CONSULT);
        $curso=$año['curso'];
        //Comprobamos si existe otro proyecto distinto con el mismo nombre en español o en ingles en el mismo curso
        $RESU = consulta($conexion,"SELECT * 
                                    FROM proyectos 
                                    WHERE id_curso='" . $idcurso . "' 
                                    AND id_proyecto != '" . $idproy . "' 
                                    AND (nombre_pro ='" . $nomb . "' 
                                    OR name_pro ='" . $nombuk . "')"); 
                $inform=mysqli_fetch_array($RESU);
                $totalfil=mysqli_num_rows($RESU);
        if($totalfil!=0){
            header('Location: cpanelprofe.php?rm=2&rt=3&a=3');
            $_SESSION['msgprofe']=NOMBREPE;
            exit();
        }else{
      
        $UPDATE = consulta($conexion,"UPDATE proyectos SET
                                      fecha_pub = CURRENT_DATE(),
                                      nombre_pro ='" . $nomb . "',
                                      name_pro ='" . $nombuk . "'
                                      WHERE id_proyecto ='" . $idproy . "'");
            
            //renombramos la carpeta del proyecto
            $homeact="_cursos/".$curso."/".$oldnomb."";
            $homenew="_cursos/".$curso."/".$nomb."";
            rename($homeact,$homenew);
            
            
        header('Location: cpanelprofe.php?rm=2&rt=3&a=3');
        $_SESSION['msgprofe']=MODYES;
        unset($_SESSION['tipo']);
        exit();
    }}
    ?>
    
<?php
    }
    ?>


    <?php
        include('_include/footer.php');
    ?>
    <script src="_js/funciones.js"></script>
    <script src="_js/funcionescpanel.js"></script>
</body>
</html>
<?php
ob_end_flush();
?>