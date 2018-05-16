<!DOCTYPE html>
<?php
include('_include/variables.php');
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
$activo=1;
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=CURSOS?><?=TIT1?></title>
    <link rel="stylesheet" href="_css/estilosheader.css">
    <link rel="stylesheet" href="_css/cursos.css">
    <link rel="stylesheet" href="_css/footer.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    
<!--    Incluimos las cookies-->
    
<?php
    include('_include/cookies.php');
?>
    
</head>

<body>
<?php
    include('_include/header.php');
?>
<section>
<?php 
    if(isset($_GET['idc'])){
        $idc=$_GET['idc'];
        $proyectos=consulta($conexion,"SELECT * FROM proyectos where id_curso like $idc and mostrar like 1 order by fecha_pub desc");
        $totalProyectos=mysqli_num_rows($proyectos);
        $curso=consulta($conexion,"SELECT curso FROM cursos where id_curso like $idc");
        $row=mysqli_fetch_array($curso);
        $totalCur=mysqli_num_rows($curso);
        if($totalCur == 0){
            header('Location: cursos.php?a=1');
            mysqli_close($conexion);
            exit();
        }else{
            $curso_n=$row['curso'];
        }
        ?>
        <article id="proyectos">
           <h1><?=PC.$curso_n.PC2?> :</h1>
            <ul>
        <?php
        $i=0;
    if($totalProyectos == 0){?>
         <li id="noproyects"><a><?=NOPROYECTS?></a></li>
         <?php }else{
        while($i<$totalProyectos){
           $row=mysqli_fetch_array($proyectos);
            $idp=$row['id_proyecto'];
            $nombre_pro=$row['nombre_pro'];
            $name_pro=$row['name_pro'];
            ?>
            <li>
               <a href="proyecto.php?idp=<?=$idp?>&a=1">
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
                </a>
            </li>
            <?php
            $i++;
        }
    }
        
                mysqli_close($conexion);
                ?>
            </ul>
    </article>
            <?php
    }else{
     $curso=consulta($conexion,"SELECT * FROM cursos");
     $totalFilas= mysqli_num_rows($curso);
     $i=0;
    $mitad1=floor($totalFilas/2);
    $mitad2=$mitad1;
    if($totalFilas%2!=0){
         $mitad1=$mitad1+1;
     }
    $cursoA=consulta($conexion,"SELECT * FROM cursos order by curso desc limit 0, $mitad1");
        ?>
        <div id="cursoA">
        <?php
     while($i<$mitad1){
           $row=mysqli_fetch_array($cursoA);
            $idc=$row['id_curso'];
            $cur=$row['curso'];
       ?>
<!--       Primera columna de escritrio(zquierda)-->
        <article id="curso">
            <ul>
                <li>
                    <a href="cursos.php?idc=<?=$idc?>&a=1"><?=$cur?></a><i class="fas fa-caret-down arriba icono" onclick="mostrarPro(proyectos<?=$i?>a,this)"></i>
                    <ul id="proyectos<?=$i?>a" class="oculto">
                    <?php
                        $proyectos=consulta($conexion,"SELECT * FROM proyectos where id_curso like $idc and mostrar like 1 order by fecha_pub desc");
                        $totalProyectos=mysqli_num_rows($proyectos);
                        $p=0;
         if($totalProyectos == 0){?>
         <li id="noproyects"><a><?=NOPROYECTS?></a></li>
         <?php }else{
                        while($p<$totalProyectos){
                           $row=mysqli_fetch_array($proyectos);
                            $idp=$row['id_proyecto'];
                            $nombre_pro=$row['nombre_pro'];
                            $name_pro=$row['name_pro'];
                    ?>
                    
                            <li>
                               <a href="proyecto.php?idp=<?=$idp?>&a=1">
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
                                </a>
                            </li>
                            <?php
                            $p++;
                        }
         }
                        ?>
                    </ul>
                </li>
            </ul>
    </article>
    <?php 
       $i++;
         }
        ?>
        </div>
        <?php
    $cursoB=consulta($conexion,"SELECT * FROM cursos order by curso desc limit $mitad1, $mitad2");
        $i=0;
        ?>
        <div id="cursoB">
        <?php
     while($i<$mitad2){
           $row=mysqli_fetch_array($cursoB);
            $idc=$row['id_curso'];
            $cur=$row['curso'];
       ?>
<!--       segunda columna de escritrio(derecha)-->
        <article id="curso">
            <ul>
                <li>
                    <a href="cursos.php?idc=<?=$idc?>&a=1"><?=$cur?></a><i class="fas fa-caret-down arriba icono" onclick="mostrarPro(proyectos<?=$i?>b,this)"></i>
                    <ul id="proyectos<?=$i?>b" class="oculto">
                    <?php
                        $proyectos=consulta($conexion,"SELECT * FROM proyectos where id_curso like $idc and mostrar like 1 order by fecha_pub desc");
                        $totalProyectos=mysqli_num_rows($proyectos);
                        $p=0;
                  if($totalProyectos == 0){?>
                     <li id="noproyects"><a><?=NOPROYECTS?></a></li>
                 <?php }else{
                        while($p<$totalProyectos){
                           $row=mysqli_fetch_array($proyectos);
                            $idp=$row['id_proyecto'];
                            $nombre_pro=$row['nombre_pro'];
                            $name_pro=$row['name_pro'];
                    ?>
                    
                            <li>
                               <a href="proyecto.php?idp=<?=$idp?>&a=1">
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
                                </a>
                            </li>
                            <?php
                            $p++;
                        }
                  }
                        ?>
                    </ul>
                </li>
            </ul>
    </article>
    <?php 
       $i++;
     }
    }
    ?>
    </div>
</section>
<?php
    include('_include/footer.php');
?>
    <script src="_js/funciones.js"></script>
    <script src="_js/funcionescurso.js"></script>
</body>
</html>