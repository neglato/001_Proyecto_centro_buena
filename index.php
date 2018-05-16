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
/*$_SESSION['user']=1;*/
/*session_destroy();*/
$activo=0;
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=INICIO?><?=TIT1?></title>
    <link rel="stylesheet" href="_css/estilosheader.css">
    <link rel="stylesheet" href="_css/index.css">
    <link rel="stylesheet" href="_css/footer.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    

    
</head>

<body>
<?php
    include('_include/header.php');
?>
   <section>
   <article id="galery">
    <figcaption>Galería de Imagenes</figcaption>
    <div class="w3-content w3-section">
      <?php 
    //realizamos la consulta y la almacenamos en $img_ies.
       $img_ies=consulta($conexion,"SELECT * FROM imagenes_ies order by id_img");
         //se inicia mientras haya registros que recorrer en el array.*/
       while($row=mysqli_fetch_array($img_ies)){
       ?>
      <img class="mySlides" src="<?= IES_IMG.$row['nombre_img']?>" style="width:100%">
       <?php 
       
       } ?>
    </div>
       </article>
          <article id="recent">
           <h1><?=ADDRE?></h1>
           <?php 
                $new_pro=consulta($conexion,"SELECT * FROM proyectos where mostrar like 1 order by fecha_pub desc");
                $totalFilas= mysqli_num_rows($new_pro);
            ?>
               <ul>
               <?php
                $i=0;
                while($i<$totalFilas && $i<3){
                    $row=mysqli_fetch_array($new_pro); 
                    $proyecto=$row['nombre_pro'];
                    $proyect=$row['name_pro'];
                    $idp=$row['id_proyecto'];
            ?>
            <li>
            <a href="proyecto.php?a=1&idp=<?=$idp?>"><?php
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
            </article>
   </section>
   <script src="_js/funcionesheader.js"></script>
   <?php 
    include('_include/footer.php');
    ?>
    
        <!--    Incluimos las cookies-->
    
<?php
    include('_include/cookies.php');
?>
    
</body>
</html>
