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
              <a href="cpanelalum.php?a=3&rm=1" id="enlace1" ><span><?= YAPUB ?></span><i class="fas fa-file ico"></i><i class="far fa-check-circle ico"></i></a> 
                <a href="cpanelalum.php?a=3&rm=2" id="enlace2" ><span><?= NOPUB ?></span><i class="fas fa-file ico"></i><i class="far fa-stop-circle ico"></i></a> 
            </div>
        </nav>
        
        <?php
       include('_include/cpanelindex.php');
    /*Fin del cpanel index
    COmienzo de proyectos publicados*/
    }else if (isset($_GET['rm']) && $_GET['rm']==1){ ?>
           <nav id="nav1">
            <div class="icon-bar">
              <a href="cpanelalum.php?a=3&rm=1" id="enlace1" class="active"><span><?= YAPUB ?></span><i class="fas fa-file ico"></i><i class="far fa-check-circle ico"></i></a> 
                <a href="cpanelalum.php?a=3&rm=2" id="enlace2"><span><?= NOPUB ?></span><i class="fas fa-file ico"></i><i class="far fa-stop-circle ico"></i></a> 
            </div>
            </nav>
        <section id="proypublic">
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
            <ul>
               <?php
                $i=0;
                while($i<$totalFilas){
                    $row=mysqli_fetch_array($RESULT); 
                    $proyecto=$row['nombre_pro'];
                    $proyect=$row['name_pro'];
                    $idp=$row['id_proyecto'];
                    $_SESSION['idp']=$idp;
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
    COmienzo de la pestaña de no publicados
    Mostramos los no publicados*/
    }else if (!isset($_GET['rt']) && isset($_GET['rm']) && $_GET['rm']==2){ ?>
           <nav id="nav1">
            <div class="icon-bar">
              <a href="cpanelalum.php?a=3&rm=1" id="enlace1"><span><?= YAPUB ?></span><i class="fas fa-file ico"></i><i class="far fa-check-circle ico"></i></a> 
                <a href="cpanelalum.php?a=3&rm=2" id="enlace2" class="active"><span><?= NOPUB ?></span><i class="fas fa-file ico"></i><i class="far fa-stop-circle ico"></i></a> 
            </div>
        </nav>
        <section id="proypublic">
        <?php
            $user=$_SESSION['user'];
            $RESULT = consulta($conexion,"SELECT * 
                                          FROM proyectos 
                                          WHERE id_proyecto in (SELECT id_proyecto 
                                                                FROM usuproy
                                                                WHERE id_user = $user)
                                          AND mostrar = 0"); 
            $totalFilas= mysqli_num_rows($RESULT);?>
            <fieldset id="proypub">
               <legend><?=PROYSTOP?></legend>
            <ul>
               <?php
                $i=0;
                while($i<$totalFilas){
                    $row=mysqli_fetch_array($RESULT); 
                    $proyecto=$row['nombre_pro'];
                    $proyect=$row['name_pro'];
                    $idp=$row['id_proyecto'];
                    $_SESSION['idp']=$idp;
            ?>
            <li>
            <a href="cpanelalum.php?a=1&rm=2&rt=1&idp=<?=$idp?>" id="proyprof"><?php
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
        /*pestaña de redactar*/
    }else if (isset($_GET['rm']) && $_GET['rm']==2 && isset($_GET['rt']) && $_GET['rt']==1){ 
    $idp=$_GET['idp'];
    $_SESSION['ajax']=$idp;
    ?>
               <nav id="nav1">
            <div class="icon-bar">
              <a href="cpanelalum.php?a=3&rm=1" id="enlace1"><span><?= YAPUB ?></span><i class="fas fa-file ico"></i><i class="far fa-check-circle ico"></i></a> 
              <a href="cpanelalum.php?a=3&rm=2" id="enlace2" class="active"><span><?= NOPUB ?></span><i class="fas fa-file ico"></i><i class="far fa-stop-circle ico"></i></a> 
            </div>
        </nav>
        <nav id="navAlum">
          <div class="icon-bar">
              <a href="cpanelalum.php?a=3&rm=2&rt=1&idp=<?=$idp?>" id="subenlace1" class="active"><span><?= TEXT ?></span><i class="fas fa-file-alt ico"></i></a> 
              <a href="cpanelalum.php?a=3&rm=2&rt=2&idp=<?=$idp?>" id="subenlace2"><span><?= PHOTO ?></span><i class="fas fa-images ico"></i></a> 
            </div>
        </nav>
        <section id="adduser">
           <!-- wysihtml5 parser rules -->
            <script src="/ruta-a-wysihtml5/parser_rules/advanced.js"></script>
            <!-- Library -->
            <script src="/ruta-a-wysihtml5/dist/wysihtml5-0.3.0.min.js"></script>
                <?php 
                    /*recuperamos el nombre del proyecto*/
                     $ProyAct = consulta($conexion, "select * from proyectos where id_proyecto like $idp");                                     $rowProy=mysqli_fetch_array($ProyAct);
                     $nombre_pro=$rowProy['nombre_pro'];                                                                       
                     $name_pro=$rowProy['name_pro'];
                     $contenido=$rowProy['contenido'];
                     $content=$rowProy['content'];
                        $_SESSION['idp']=$idp;
                    /*Ahora recuperamos el curso*/
                    $CurAct = consulta($conexion,"Select * from cursos where id_curso in (select id_curso from proyectos
                                                                                            where id_proyecto like $idp)");
                    $row=mysqli_fetch_array($CurAct);
                    $curso=$row['curso'];
                ?>
            <fieldset>
                <legend><?=REDART?></legend>
                <form method="post" enctype="multipart/form-data" action="subirtexto.php">
                   <select name="idioma" id="idioma" onchange="textCont(this, editor1)">
                       <option value="-1"><?=SELLENG?></option>
                       <option value="1es.php"><?=ESP?></option>
                       <option value="1en.php"><?=ENG?></option>
                   </select>
                    <script src="ckeditor_4.9.2_bd5767ce8fc7/ckeditor/ckeditor.js"></script>
                    <div id="textoenr">
                        <textarea name="editor1" id="editor1"></textarea>
                    </div>
            <script>
                CKEDITOR.replace( 'editor1' );
            </script>
               <button type="submit"><i class="fas fa-upload edicion"></i></button>
                                       <p id="error"><?php
                            if(isset($_SESSION['msgtexto'])){
                                echo $_SESSION['msgtexto'];
                                unset($_SESSION['msgtexto']);
                            } ?></p>
                </form>
            </fieldset>
        </section>
    <?php
        /*termina redactar proyecto
        comienza subir imagenes*/
    }else if(isset($_GET['rm']) && $_GET['rm']==2 && isset($_GET['rt']) && $_GET['rt']==2){ 
    $idp=$_GET['idp'];
    ?>
            <nav id="nav1">
            <div class="icon-bar">
              <a href="cpanelalum.php?a=3&rm=1" id="enlace1"><span><?= YAPUB ?></span><i class="fas fa-file ico"></i><i class="far fa-check-circle ico"></i></a> 
              <a href="cpanelalum.php?a=3&rm=2" id="enlace2" class="active"><span><?= NOPUB ?></span><i class="fas fa-file ico"></i><i class="far fa-stop-circle ico"></i></a> 
            </div>
        </nav>
        <nav id="navAlum">
          <div class="icon-bar">
              <a href="cpanelalum.php?a=3&rm=2&rt=1&idp=<?=$idp?>" id="subenlace1" ><span><?= TEXT ?></span><i class="fas fa-file-alt ico"></i></a> 
              <a href="cpanelalum.php?a=3&rm=2&rt=2&idp=<?=$idp?>" id="subenlace2" class="active"><span><?= PHOTO ?></span><i class="fas fa-images ico"></i></a>  
            </div>
        </nav>
        <section id="adduser">
            <fieldset id="fotosact"> 
                <legend><?=FOTACT?></legend>
                <?php 
        /*recuperamos el nombre del proyecto*/
                     $ProyAct = consulta($conexion, "select * from proyectos where id_proyecto like $idp");                                   $rowProy=mysqli_fetch_array($ProyAct);
                     $nombre_pro=$rowProy['nombre_pro'];
                        $_SESSION['idp']=$idp;
        /*recuperamos las imagenes*/
                $imgAct= consulta($conexion,"SELECT * from imgproy where id_proyecto like $idp");
                $totalImg= mysqli_num_rows($imgAct);
        /*Ahora recuperamos el curso*/
                    $CurAct = consulta($conexion,"Select * from cursos where id_curso in (select id_curso from proyectos
                                                                                            where id_proyecto like $idp)");
                    $row=mysqli_fetch_array($CurAct);
                    $curso=$row['curso'];
                if($totalImg == 0){?>
                    <p style="color:limegreen;font-size:1.3em;text-align:center;"><?=NOFOTS?></p>
                <?php }else{?>
                <table>
                    <tr>
                    <th><?=IMAGEN?></th>
                    <th><?=NAMEFOT?></th>
                    </tr>
                    <?php
                    while($img= mysqli_fetch_array($imgAct)){
                    $imagen=$img['imagen'];
                    ?>
                       <tr>
                        <td>
                            <img src="_cursos/<?=$curso?>/<?=$nombre_pro?>/<?=$imagen?>" alt="" width="150">
                        </td>
                        <td><?=$imagen?></td>
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
    background: #08c;
    color: limegreen;
    padding: 100px 0;
    text-align: center;
    border: 2px solid limegreen;
      margin: 10px auto;
      width: 95%;
  }
  .demo-droppable.dragover {
    background: #00CC71;
  }
</style>
<?php
        ?>
<form method="post" id="formulario" enctype="multipart/form-data" action="subirfotos.php">
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
                    $imgAct= consulta($conexion,"SELECT * from imgproy where id_proyecto like $idp");
                $totalImg= mysqli_num_rows($imgAct);
                if($totalImg == 0){?>
                    <p style="color:limegreen;font-size:1.3em;text-align:center;"><?=NOFOTS?></p>
                <?php }else{
                    ?>
                    <div id="textImg">
                    <p class="textImg"><?=FOTACT?>:</p><p class="textImg"><?=PHOTODEL?>:</p>
                    </div>
                <form method="post" enctype="multipart/form-data" action="eliminarfotos.php">
                <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
                  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                  <link href="_css/jquery.lwMultiSelect.css" rel="stylesheet" type="text/css" />
                  <script type="text/javascript" src="_js/jquery.lwMultiSelect.js"></script>
                  <style>
                  .container { margin:10px auto; 
                      width: 100%;}
                  </style>
        
                   <p><select id="defaults" multiple="multiple" name="fotos[]">
                    <option value="na" selected></option>
                   <?php
                   while($img= mysqli_fetch_array($imgAct)){
                       $idImg=$img['id_img'];
                    $imagen=$img['imagen']; ?>
                   <option value="<?=$idImg?>"><?=$imagen?></option>
                   <?php }
                    ?>
                   </select>
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
           <?php }
        ?>
           <button type="submit" id=btnborrar><i class="fas fa-times cancel edicion2"></i></button>
                              <p id="error"><?php
                            if(isset($_SESSION['msgalfot'])){
                                echo $_SESSION['msgalfot'];
                                unset($_SESSION['msgalfot']);
                            } ?></p>
                </form>
            </fieldset>
        </section>
    <?php
        mysqli_close($conexion);
        /*FIn de borrar imagenes
        fin de la pestaña no publicados
        fin cpanel alumno*/
    }
    include('_include/footer.php');
    ?>
    <script src="_js/funciones.js"></script>
    <script src="_js/funcionescpanel.js"></script>
</body>
</html>