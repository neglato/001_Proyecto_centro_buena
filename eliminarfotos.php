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
/*primero comprobamos que exista $_POST['fotos']*/
if(!isset($_POST['fotos'])){
   header('Location: index.php');
    exit();
}
if(count($_POST['fotos']) > 0){
    /*si en final del array es la opcion por defecto, devolvemos a la pagina anterior y mostramos el mensage*/
    if(end($_POST['fotos'])=="na"){
        $_SESSION['msgalfot']="debes elegir alguna foto";
        $_POST['fotos']=="";
        header("Location: cpanelalum.php?a=3&rm=2&rt=2&idp=$idp");    
    }else{
        /*sacamos el curso del proyecto y su nombre, para poder eliminar la foto de su directrio*/
            $proyecto = consulta($conexion, "Select * from proyectos where id_proyecto like $idp");
            $row= mysqli_fetch_array($proyecto);
            $curso=$row['id_curso'];
            $nombre_pro=$row['nombre_pro'];
            $cursoN= consulta ($conexion, "select * from cursos where id_curso like $curso");
            $fila=$img= mysqli_fetch_array($cursoN);
            $nomCurso= $fila['curso'];
        /*si no lo es, recorremos el array y hacemos un delete en la base de datos y borramos la foto del servidor*/
        $max = sizeof($_POST['fotos']);
        $i;
        for($i = 1; $i < $max;$i++){
            $foto=$_POST['fotos'][$i];
            /*recuperamos el nombre de la imagen*/
            $imgN= consulta($conexion,"select * from imgproy where id_img like $foto");
            $imgV=mysqli_fetch_array($imgN);
            $nomImg=$imgV['imagen'];
        $delete= consulta($conexion,"delete from imgproy 
                            where id_img like $foto");
            /*borramos la imagen*/
            $img="_cursos/".$nomCurso."/".$nombre_pro."/".$nomImg."";
            unlink($img);
            

        }
        $_SESSION['msgalfot']="foto eliminada correctamente";
        header("Location: cpanelalum.php?a=3&rm=2&rt=2&idp=$idp"); 
    }
}




