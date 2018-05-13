<?php
    include('_include/funciones.php');
    include('_include/conexion.php');
    session_start();
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
if(isset($_SESSION['subirfotos'])){
    echo "hay fotos :D";
}
if(!isset($_FILES['files'])){
    header("Location: index.php");
    exit();
}else{
    $total=count($_FILES["files"]["name"]);
    if($total > 0){
        if(end($_FILES["files"]["name"])==""){
        $_SESSION['msgsubfot']=SELFOTO;
        header("Location: cpanelalum.php?a=3&rm=2&rt=2&idp=$idp");
        exit();
            
        }else{
        /*si no lo es, recorremos el array y hacemos un delete en la base de datos y borramos la foto del servidor*/
        /*sacamos el curso del proyecto y su nombre, para poder eliminar la foto de su directrio*/
            $proyecto = consulta($conexion, "Select * from proyectos where id_proyecto like $idp");
            $row= mysqli_fetch_array($proyecto);
            $curso=$row['id_curso'];
            $nombre_pro=$row['nombre_pro'];
            $cursoN= consulta ($conexion, "select * from cursos where id_curso like $curso");
            $fila= mysqli_fetch_array($cursoN);
            $nomCurso= $fila['curso'];
            /*si ya existe no hacemos nada*/
        $max = sizeof($_FILES["files"]["name"]);
        $i;
    
        for($i = 0; $i < $max;$i++){
            $foto=$_FILES["files"]["name"][$i];
            $img="_cursos/".$nomCurso."/".$nombre_pro."/".$foto."";
            if(file_exists($img) == true){
                }else{
            $insert= consulta($conexion,"INSERT INTO imgproy (id_proyecto, imagen)  VALUES ('$idp','$foto')");
            /*subimos la imagen*/
            $tmp=$_FILES["files"]["tmp_name"][$i];
            $uploadfile_temporal=$foto; 
            $uploadfile_nombre=$img;
            move_uploaded_file($tmp, $img);
            }
        }
            

        $_SESSION['msgsubfot']=UPFOTO;
        header("Location: cpanelalum.php?a=3&rm=2&rt=2&idp=$idp");
                mysqli_close($conexion);
                exit();
    }
        }
        

    }

/*if (isset($_POST["myfiles"]))
{
   $reporte = null;
   var_export($_POST['myfiles']);
     for($x=0; $x<count($_POST["myfiles"]); $x++)
    {
    $file = $_POST["myfiles"];
    $nombre = $file["name"][$x];
    $tipo = $file["type"][$x];
    $ruta_provisional = $file["tmp_name"][$x];
    $size = $file["size"][$x];
    /*$dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];*/
    /*$carpeta = "imagenes/";
    
print_r($nombre);


     }
}*/