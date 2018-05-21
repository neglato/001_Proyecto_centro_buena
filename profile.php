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
if(!isset($_SESSION['user'])){
    header('Location: index.php');
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
    if(isset($_SESSION['user'])){
    $usuario=$_SESSION['user'];
    $usuario=consulta($conexion,"SELECT * FROM usuarios where id_user like $usuario and baja like 0");
    $row=mysqli_fetch_array($usuario);
        $nombre=$row['nombre'];
        $apellidos=$row['apellidos'];
        $email=$row['email'];
        $password=$row['password'];
        $tipo=$row['tipo'];
        $foto=$row['foto'];
        $sexo=$row['sexo'];
        $email=$_SESSION['email'];
    }
    ?>
    <div id="separar2"></div>
<section>
   <?php 
    if (!isset($_GET['ed'])){
    ?>
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
            <a href="profile.php?ed=1&a=2"><button><div id="edit"><?=MODPER?></div><i class="fas fa-edit editar"></i></button></a>
            </fieldset>
            <?php
                $usuario=$_SESSION['user'];
                $proyecto=consulta($conexion,"select *
                                                from proyectos
                                                where id_proyecto in (select id_proyecto
                                                from usuproy
                                                where id_user=$usuario) and mostrar like 1");
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
            <?php } ?>
        </article>
    </fieldset>
    <?php
        mysqli_close($conexion);
    }else{
        /*Edicion de perfil*/
        ?>
        <article>
        <fieldset id="perfil">
        <figure>
            <figcaption><?=FOTPER?></figcaption>
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
        <fieldset id="fotoperfilpc">
           <legend><?=FOTPER?></legend>
           <div id="pc">
                    <form action="subir.php" method="post" enctype="multipart/form-data">
                        <button id="buttonfot"><i class="fas fa-folder-open editar"></i></button> 
                        <input type="file" name="fichero">
                        <button type="submit" name="submit" id="buttonsbr"><i class="fas fa-upload editar"></i></button>
                        <button id="buttoncan" onclick="borrarFoto('<?=$rutaimg?>')" type="button"><i class="fas fa-trash-alt cancel"></i></button>
                        <button id="buttonre" onclick="deshacer('<?=$rutaimg?>')" type="button"><i class="fas fa-reply cancel"></i></button>
                    </form> 
                     
                     <p id="error"><?php
                                        if(isset($_SESSION['msgfoto'])){
                                            echo $_SESSION['msgfoto'];
                                            unset($_SESSION['msgfoto']);
                                        }
                                    ?></p> 
               </div>
            </fieldset>
        <article class=editandoperfil>
           <fieldset id="fotoperfil">
           <legend><?=FOTPER?></legend>
           <div id="movil">
                    <form action="subir.php" method="post" enctype="multipart/form-data">
                        <button id="buttonfot"><i class="fas fa-folder-open editar"></i></button> 
                        <input type="file" name="fichero">
                        <button type="submit" name="submit" id="buttonsbr"><i class="fas fa-upload editar"></i></button>
                        <button id="buttoncan" onclick="borrarFoto('<?=$rutaimg?>')" type="button"><i class="fas fa-trash-alt cancel"></i></button>
                        <button id="buttonre" onclick="deshacer('<?=$rutaimg?>')" type="button"><i class="fas fa-reply cancel"></i></button>
                    </form> 
                     
                     <p id="error"><?php
                                        if(isset($_SESSION['msgfoto'])){
                                            echo $_SESSION['msgfoto'];
                                            unset($_SESSION['msgfoto']);
                                        }
                                    ?></p> 
               </div>
            </fieldset>
            <fieldset id="datosperfil">
            <legend><?=DATPER?></legend>
            <form action="modificar.php" method="post" enctype="multipart/form-data">
            <p><?=NOMBRE?></p><input type="text" value="<?=$nombre?>" name="nombre">
           <p><?=APELLIDOS?></p><input type="text" value="<?=$apellidos?>" name="apellidos">
           <p><?=SEXO?></p><select name=genero>
                            <option value="0" <?php
                                                    if($sexo==0){
                                                        echo "selected";
                                                    }
                                                    ?>><?=HOM?></option>
                            <option value="1" <?php
                                                    if($sexo==1){
                                                        echo "selected";
                                                    }
                                                    ?>><?=MUJ?></option>
                        </select>
           <p>Email : </p><input type="text" value="<?=$email?>" name="correo">
            <div id="buttonsyc">
            <button onclick="cancelarCambios()" type="button"><div id="edit"><?=LOGCAN?></div><i class="fas fa-times cancel"></i></button>
            <button type="submit"><div id="edit"><?=SAV?></div><i class="far fa-save editar"></i></button>
            </div>
                </form>
            </fieldset>
            <fieldset id="pass">
                <legend><?=LOGPASS?></legend>
                <form action="password.php" method="post" enctype="multipart/form-data">
                <p><?=OLDPASS?></p><input type="password" name="oldpass">
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
        <div id="separar"></div>
    </fieldset>
    </article>
    <?php
                                        mysqli_close($conexion);
        }
    ?>
</section>

    
<?php
    include('_include/footer.php');
?>
    <script src="_js/funciones.js"></script>
    <script src="_js/funcionesprofile.js"></script>
</body>
</html>