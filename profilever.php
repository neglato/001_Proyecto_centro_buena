<!DOCTYPE html>
<?php
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
if(!isset($_GET['idu'])){
    header('Location: index.php');
}
if(isset($_SESSION['user'])){
    if($_SESSION['user'] == $_GET['idu']){
        header('Location: profile.php?a=2');
        exit();
    }
}
$activo=2;
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=PERFIL?><?=TIT1?></title>
    <link rel="stylesheet" href="_css/estilosheader.css">
    <link rel="stylesheet" href="_css/profile.css">
    <link rel="stylesheet" href="_css/footer.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--    Incluimos las cookies-->
    
<?php
    include('_include/cookies.php');
?>
    
</head>

<body>
<?php
    include('_include/header.php');
    if(isset($_GET['idu'])){
    $usuario=$_GET['idu'];
    $usuario=consulta($conexion,"SELECT * FROM usuarios where id_user like $usuario and baja like 0");
    $row=mysqli_fetch_array($usuario);
        $nombre=$row['nombre'];
        $apellidos=$row['apellidos'];
        $email=$row['email'];
        $tipo=$row['tipo'];
        $foto=$row['foto'];
        $sexo=$row['sexo'];
        $email=$row['email'];
    }
    ?>
<section>
    <fieldset id="perfil">
        <figure>
            <figcaption>Foto de perfil</figcaption>
            <img src="_users/<?php
                        $rutaimg="_users/".$email."/img.jpg";
                      if(is_file($rutaimg)==true){
                          echo $email."/".$foto;
                      }else{
                          if($sexo == 0){
                          echo "avatarmasculino.jpg";
                          }else{
                              echo "avatarfemenino.jpg";
                          }
                      }
                      ?>" alt="">
        </figure>
        <article>
          <fieldset id="dp">
           <legend><?=DATPER?></legend>
            <p><?=NOMBRE?><?=$nombre?></p>
           <p><?=APELLIDOS?><?=$apellidos?></p>
           <p><?=SEXO?><?php
                            switch($sexo){
                                        case 0:
                                            echo HOM;
                                            break;
                                        case 1:
                                            echo MUJ;
                                        break; 
                            }
                        ?>
            </p>
           <p>Email : <?=$email?></p>
            <p><?=TIPO?> 
               <?php
                switch($tipo){
                    case 0:
                        echo ADMIN;
                        break;
                    case 1:
                        echo PROFE;
                        break;
                    case 2:
                        echo ALUM;
                        break;
                        
                }
        unset($_SESSION['msg']);
            ?>
            </p>
            </fieldset>
            <?php
                $usuario=$_GET['idu'];
                $proyecto=consulta($conexion,"select *
                                                from proyectos
                                                where mostrar like 1 and id_proyecto in (select id_proyecto
                                                from usuproy
                                                where id_user=$usuario)");
            $total=mysqli_num_rows($proyecto);
            if($total > 0){?>
            <fieldset id="propar">
               <legend><?=PARTI?></legend>
                <?php

        while ($row=mysqli_fetch_array($proyecto)){
              $pid=$row['id_proyecto'];
              $name=$row['name_pro'];
              $nombre=$row['nombre_pro'];
                ?>
                <p><a href="proyecto.php?idp=<?=$pid?>"><?php 
                                                            if(isset($_SESSION['lang'])){
                                                                if($_SESSION['lang']==1){
                                                                    echo $name; 
                                                                }else{
                                                                    echo $nombre;
                                                                }
                                                            }else{
                                                            echo $nombre;
                                                            }
                                                            ?></a></p>
               <?php } ?>
            </fieldset>
            <?php } 
            mysqli_close($conexion);?>
        </article>
    </fieldset>
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