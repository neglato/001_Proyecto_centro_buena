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
if(!isset($_POST['idioma']) || !isset($_POST['editor1'])){
    header("Location: index.php");
    exit();
}
if($_POST['idioma']== -1){
    $_SESSION['msgtexto']="Debes elegir un idioma";
    header("Location: cpanelalum.php?a=3&rm=2&rt=1&idp=$idp");
    exit();
}
if($_POST['editor1']==""){
    $_SESSION['msgtexto']="Debes redactar un texto";
    header("Location: cpanelalum.php?a=3&rm=2&rt=1&idp=$idp");
    exit(); 
}
/*recuperamos el proyecto y su curso, para poder acceder a la carpeta donde guardar el texto*/
$proyecto= consulta($conexion, "Select * from proyectos where id_proyecto like $idp");
$proy=mysqli_fetch_array($proyecto);
/*guardamos el nombre_pro y el id_curso*/
$nomProy=$proy['nombre_pro'];
$idCur=$proy['id_curso'];
$curso= consulta($conexion, "select * from cursos where id_curso like $idCur");
/*guardamos el nombre del curso*/
$cur= mysqli_fetch_array($curso);
$nomCur=$cur['curso'];
/*montamos su directorio*/
$directorio="_cursos/".$nomCur."/".$nomProy;
if($_POST['idioma']== "1es.php" || $_POST['idioma']== "1en.php"){
    $archivo=$directorio."/".$_POST['idioma'];
    if(file_exists($archivo)){
        /*si existe lo eliminamos y volvemos a crear*/
        $open = fopen($archivo,"w+"); 
        $text = $_POST['editor1']; 
        fwrite($open, $text); 
        fclose($open);
        $_SESSION['msgtexto']=UPDATETEXT;
        header("Location: cpanelalum.php?a=3&rm=2&rt=1&idp=$idp");
        mysqli_close($conexion);
        exit(); 
    }else{
        /*creamos el fichero*/
        $open = fopen($archivo, "w+");
        $text = $_POST['editor1']; 
        fwrite($open, $text); 
        fclose($open);
        $_SESSION['msgtexto']=CREATETEXT;
        header("Location: cpanelalum.php?a=3&rm=2&rt=1&idp=$idp");
        mysqli_close($conexion);
        exit(); 
    }
    
}