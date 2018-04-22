<!DOCTYPE html>
<?php
include('_include/conexion.php');
function consulta2($conex, $select){
        $resultado= mysqli_query($conex, $select);
        return $resultado;
    }
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

if(isset($_GET['idp'])){
    $idp=$_GET['idp'];
    if(isset($_SESSION['tipo'])){
        if($_SESSION['tipo']== 1){
    $select=consulta2($conexion,"SELECT * FROM proyectos where id_proyecto like $idp");
    $totalFilas= mysqli_num_rows($select);
    $row=mysqli_fetch_array($select);
    $nombre_pro=$row['nombre_pro'];
    $name_pro=$row['name_pro'];
        }else{
    $select=consulta2($conexion,"SELECT * FROM proyectos where id_proyecto like $idp");
    $totalFilas= mysqli_num_rows($select);
    $row=mysqli_fetch_array($select);
    $nombre_pro=$row['nombre_pro'];
    $name_pro=$row['name_pro'];  
        }
if($totalFilas == 0){
    header('Location: cursos.php?a=1');
    exit();
}
    }else{
    $select=consulta2($conexion,"SELECT * FROM proyectos where id_proyecto like $idp and mostrar like 1");
    $totalFilas= mysqli_num_rows($select);
    $row=mysqli_fetch_array($select);
    $nombre_pro=$row['nombre_pro'];
    $name_pro=$row['name_pro'];
        if($totalFilas == 0){
            header('Location: cursos.php?a=1');
            exit();
}
    }
}else{
    header('Location: index.php');
    exit();
}
/*$_SESSION['user']=1;*/
/*session_destroy();*/
$_GET['a']=1;
$activo=1;
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    <?php
    if(isset($_SESSION['lang'])){
        if($_SESSION['lang']==1){
            echo $name_pro;
        }else{
            echo $nombre_pro;
            }
        }else{
        echo $nombre_pro;
    }   
    ?>
    <?=TIT1?>
    </title>
    <link rel="stylesheet" href="_css/estilosheader.css">
    <link rel="stylesheet" href="_css/proyecto.css">
    <link rel="stylesheet" href="_css/footer.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<body>
  <?php
    include('_include/header.php');
    ?>
  <section>
     <article id="submenu">
         <p><?=POY?>
         <?php
        if(isset($_SESSION['lang'])){
            if($_SESSION['lang']==1){
                echo $name_pro; 
            }else{
                echo $nombre_pro;
            }
        }else{
        echo $nombre_pro;
        }
         ?>
         </p>
     </article>
      <?php
      /*$proyecto=consulta($conexion,"SELECT * FROM proyectos where id_proyecto like $idp and mostrar like 1");
      $totalFilas= mysqli_num_rows($proyecto);
      $row=mysqli_fetch_array($proyecto);*/
      if($totalFilas==0){
          header('Location:index.php');
          exit();
      }else{
          $contenido=$row['contenido'];
          $content=$row['content'];
          $id_curso=$row['id_curso'];
          $curso=consulta($conexion,"SELECT curso FROM cursos where id_curso like $id_curso");
          $totalFilasCurso= mysqli_num_rows($curso);
          $rowCur=mysqli_fetch_array($curso);
          ?>
          <article id=articulo>
          <?php
          if($totalFilasCurso==0){
              header('Location: index.php');
          }else{
              $curso=$rowCur['curso'];
              if(isset($_SESSION['lang'])){
                  if($_SESSION['lang']==1){
                      if (!file_exists('_cursos/'.$curso.'/'.$nombre_pro.'/'.$content.'')){?>
                         <p>Not content available</p>
                      <?php }else{
                            include('_cursos/'.$curso.'/'.$nombre_pro.'/'.$content.'');
                            }
            }else{
                if (!file_exists('_cursos/'.$curso.'/'.$nombre_pro.'/'.$contenido.'')){ ?>
                <p>No hay contenido disponible</p>
                <?php }else{
                        include('_cursos/'.$curso.'/'.$nombre_pro.'/'.$contenido.'');  
                        }
                  }
    }else{
        if (!file_exists('_cursos/'.$curso.'/'.$nombre_pro.'/'.$contenido.'')){ ?>
            <p>No hay contenido disponible</p>
        <?php }else{
                include('_cursos/'.$curso.'/'.$nombre_pro.'/'.$contenido.'');  
                }
        }
    }
          }
      ?>
      </article>
      <article id="gallery">
         <?php
          $img=consulta($conexion, "SELECT * FROM imgproy WHERE id_proyecto like $idp");
          $totalFotos= mysqli_num_rows($img);
          if($totalFotos==0){
            if(isset($_SESSION['lang'])){
                if($_SESSION['lang']==1){ ?>
                   <p>Not images available</p> 
            <?php }else{ ?>
                   <p>No hay imagenes disponibles</p>
                <?php }
            }else{ ?>
            <p>No hay imagenes disponibles</p>
            <?php }
          }else{
          ?>
        <div class="container">
           <?php 
                $i=1;
                while($i<=$totalFotos){
                    $fila=mysqli_fetch_array($img);
                    $imagen=$fila['imagen'];
                
            ?>
            <div class="mySlides fade">
              <div class="numbertext"><?=$i?> / <?=$totalFotos?></div>
              <img  class="img2" src="_cursos/<?=$curso?>/<?=$nombre_pro?>/<?=$imagen?>" style="width:100%">
                </div>
            <?php 
                    $i++;
            } ?>
    
              <a class="prev" onclick="plusSlides(-1)">❮</a>
              <a class="next" onclick="plusSlides(1)">❯</a>

              <div class="caption-container">
                 <p id="caption"></p>
              </div>

 <div class="row">
        <?php
    $img=consulta($conexion, "SELECT * FROM imgproy WHERE id_proyecto like $idp");
        $i=1;
        while($i<=$totalFotos){
            $fila=mysqli_fetch_array($img);
            $imagen=$fila['imagen'];
                
    ?>
    <div class="column">
      <img class="demo cursor" src="_cursos/<?=$curso?>/<?=$nombre_pro?>/<?=$imagen?>" style="width:100%" onclick="currentSlide(<?= $i ?>)">
    </div>
      <?php 
        $i++;   
           } 
        ?>
  </div>
        </div>
        <?php } ?>
      </article>
      <article id="participado">
          <fieldset id="propar">
              <legend><?=DOCBY?></legend>
              <?php 
              $idp=$_GET['idp'];
              $coordinador=consulta($conexion,"Select id_user, concat(nombre,' ',apellidos) as coordinador
                                        from usuarios 
                                        where tipo like 1 and id_user in (select id_user
                                                        from usuproy
                                                        where id_proyecto=$idp)");
               while ($row=mysqli_fetch_array($coordinador)){
              ?>
              <a href="profilever.php?idu=<?=$row['id_user']?>&a=2"><p><?=$row['coordinador']?></p><p id="p2"><?=COORD?></p></a>
              <?php } 
              $idp=$_GET['idp'];
              $participantes=consulta($conexion,"Select id_user, concat(nombre,' ',apellidos) as editor
                                        from usuarios 
                                        where tipo like 2 and id_user in (select id_user
                                                        from usuproy
                                                        where id_proyecto=$idp)");
               while ($row=mysqli_fetch_array($participantes)){
              ?>
              <a href="profilever.php?idu=<?=$row['id_user']?>&a=2"><p><?=$row['editor']?></p><p id="p2"><?=EDITOR?></p></a>
              <?php } ?>
          </fieldset>
      </article>
  </section>
  <script src="_js/funcionesproyectos.js"></script>
   <?php 
    include('_include/footer.php');
    ?>
    
        <!--    Incluimos las cookies-->
    
<?php
    include('_include/cookies.php');
?>
    
</body>
</html>