<?php 
    include('_include/variables.php');
    include('_include/funciones.php');
    include('_include/conexion.php');
    session_start();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
    mysqli_close($conexion);
    exit();
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
$idp=$_SESSION['idp'];
/*primero comprobamos que exista $_POST['fotos']*/
if(!isset($_POST['fotos']) && !isset($_SESSION['fotosdel'])){
   header('Location: index.php');
    mysqli_close($conexion);
    exit();
}
if(isset($_POST['fotos'])){
    unset($_SESSION['fotosdel']);
}
if(isset($_SESSION['fotosdel'])){
    /*ssi existe lo mandamos a la propia pagina para que seleccione al menos una imagen*/
        $_SESSION['msgalfot']=SELFOTO;
        header("Location: cpaneladmin.php?a=3&rm=4&rt=1");
        mysqli_close($conexion);
        exit();
}
if(count($_POST['fotos']) > 0){
        $max = sizeof($_POST['fotos']);
        $i;
        for($i = 0; $i < $max;$i++){
            $foto=$_POST['fotos'][$i];
            /*recuperamos el nombre de la imagen*/
            $imgN= consulta($conexion,"select * from imagenes_ies where id_img like $foto");
            $imgV=mysqli_fetch_array($imgN);
            $nomImg=$imgV['nombre_img'];
        $delete= consulta($conexion,"delete from imagenes_ies 
                            where id_img like $foto");
            /*borramos la imagen*/
            $img="_img/imagenes_ies/".$nomImg."";
            unlink($img);
            

        }
    $_SESSION['msgalfot']=DELFOTO;
        header("Location: cpaneladmin.php?a=3&rm=4&rt=1");
        mysqli_close($conexion);
        exit();
    }
