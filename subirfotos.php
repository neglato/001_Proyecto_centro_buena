<?php 
    include('_include/funciones.php');
    include('_include/conexion.php');
    session_start();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
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
            $fila=$img= mysqli_fetch_array($cursoN);
            $nomCurso= $fila['curso'];
            /*si ya existe no hacemos nada*/
            if(file_exists($img) == true){
                }else{
        $max = sizeof($_FILES["files"]["name"]);
        $i;
        for($i = 0; $i < $max;$i++){
            $foto=$_FILES["files"]["name"][$i];
            $insert= consulta($conexion,"INSERT INTO imgproy (id_proyecto, imagen)  VALUES ('$idp','$foto')");
            /*subimos la imagen*/
            $tmp=$_FILES["files"]["tmp_name"][$i];
            $img="_cursos/".$nomCurso."/".$nombre_pro."/".$foto."";
            $uploadfile_temporal=$foto; 
            $uploadfile_nombre=$img;
            move_uploaded_file($tmp, $img);
            }
            
            

        $_SESSION['msgsubfot']=UPFOTO;
        header("Location: cpanelalum.php?a=3&rm=2&rt=2&idp=$idp"); 
    }
        }
        

    }
}



