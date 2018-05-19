<?php 
ob_start();
    session_start();
 include('_include/variables.php');
    include('_include/funciones.php');
    include('_include/conexion.php');
if(!isset($_SESSION['user'])){
    header('Location: index.php');
    
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
if(!isset($_FILES["files"])){
    header("Location: index.php");
    exit();
}else{
    $total=count($_FILES["files"]["name"]);
    if($total > 0){
        if(end($_FILES["files"]["name"])==""){
        $_SESSION['msgsubfot']=SELFOTO;
        header("Location: cpaneladmin.php?a=3&rm=4&rt=1");
        exit();
        }else{
        /*si no lo es, recorremos el array y hacemos un delete en la base de datos y borramos la foto del servidor*/
        /*sacamos el los registros de la tabla imagenes_ies*/
            $imgIndex = consulta($conexion, "Select * from imagenes_ies order by id_img");
            $row= mysqli_fetch_array($imgIndex);
        $max = sizeof($_FILES["files"]["name"]);
        $i;
    
        for($i = 0; $i < $max;$i++){
            $foto=$_FILES["files"]["name"][$i];
            $img="_img/imagenes_ies/".$foto."";
            if(file_exists($img) == true){
                }else{
            $insert= consulta($conexion,"INSERT INTO imagenes_ies (nombre_img)  VALUES ('$foto')");
            /*subimos la imagen*/
            $tmp=$_FILES["files"]["tmp_name"][$i];
            $uploadfile_temporal=$foto; 
            $uploadfile_nombre=$img;
            move_uploaded_file($tmp, $img);
            }
        }
        unset($_SESSION['msgalfot']);
        $_SESSION['msgsubfot']=UPFOTO;
        header("Location: cpaneladmin.php?a=3&rm=4&rt=1");
                mysqli_close($conexion);
                exit();
    }
        }
        

    }
ob_end_flush();