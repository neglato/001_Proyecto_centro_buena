<?php
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
if(!isset($_SESSION['user'])){
    header('Location: index.php');
    exit();
}
if(!isset($_POST['nombre']) || !isset($_POST['name']) || !isset($_POST['id_curso']) || !isset($_POST['id_coor'])){
    $_SESSION['msgmodproy']=ALLFIELDS;
    header('Location: cpaneladmin.php?rm=3&rt=2&a=3&pid='.$pid.'');
    exit;
}
        if($_POST['nombre'] !="" && $_POST['name'] !="" && $_POST['id_curso'] !=-1 && $_POST['id_coor'] !=-1){
            include('_include/conexion.php');
            include('_include/funciones.php');
                    $pid=$_SESSION['pid'];
                    unset($_SESSION['pid']);
                    $nombre=$_POST['nombre'];
                    $name=$_POST['name'];
                    $idCurso=$_POST['id_curso'];
                    $coor=$_POST['id_coor'];
            /*comprobamos si existe algun proyecto con el nombre introducido en el curso elegido*/
                $porNombre = consulta($conexion,"SELECT * FROM proyectos WHERE nombre_pro ='" . $nombre . "' and id_curso like $idCurso"); 
                $infoNombre=mysqli_fetch_array($porNombre);
                $totalNombre=mysqli_num_rows($porNombre);
            /*comprobamos si existe algun proyecto con el name introducido en el curso elegido*/
                $porName = consulta($conexion,"SELECT * FROM proyectos WHERE name_pro ='" . $name . "' and id_curso like $idCurso"); 
                $infoName=mysqli_fetch_array($porName);
                $totalName=mysqli_num_rows($porName);
            /*Buscamos el proyecto con el id que elegimos para editarlo*/
                $RESULT2 = consulta($conexion,"SELECT * FROM proyectos WHERE id_proyecto ='" . $pid . "'"); 
                $info2=mysqli_fetch_array($RESULT2);
                $total2=mysqli_num_rows($RESULT2);
            /*Primero rescatamos el curso actual y su nombre actual, para poder cambiar la ruta de su carpeta*/
                $porCur = consulta($conexion,"SELECT * FROM proyectos WHERE id_proyecto like $pid"); 
                $infoCur=mysqli_fetch_array($porCur);
                $cursoAc=$infoCur['id_curso'];
                $nomAct=$infoCur['nombre_pro'];
                $cursoAct= consulta($conexion,"SELECT * FROM cursos WHERE id_curso like $cursoAc");
                $infoCurso=mysqli_fetch_array($cursoAct);
                $cursoActual=$infoCurso['curso'];
            /*si existe alguno con el nombre o el name en el curso elegido*/
                if($totalNombre > 0 || $totalName > 0){
                /*comprobamos si el proyecto que nos sale en la consulta es el propio proyecto que estamos editando*/
                if($infoNombre['id_proyecto'] == $pid || $infoName['id_proyecto'] == $pid){
                    /*si lo es hacemos el update de los datos*/
                    $UPDATE = consulta($conexion,"UPDATE proyectos SET 
                                                    id_curso ='" . $idCurso . "',
                                                    nombre_pro ='" . $nombre . "',
                                                    name_pro = '" . $name . "' 
                                                    WHERE id_proyecto ='" . $pid . "'
                                                    ");
                    $UPDATE2= consulta($conexion, "update usuproy SET
                                                    id_user ='". $coor ."'
                                                    where id_proyecto like $pid and id_user in (SELECT id_user from usuarios
                                                                                              where tipo like 1)
                                                    ");
                    /*Comprobamos que el nombre introducido sea distinto que el nombre actual*/
                    if($infoCur['nombre_pro'] != $nombre){
                        /*renombramos la carpeta del proyecto*/
                        $homeact="_cursos/".$cursoActual."/".$nomAct."";
                        $homenew="_cursos/".$cursoActual."/".$nombre."";
                        rename($homeact,$homenew);
                    }
                    $_SESSION['msgmodproy2']=MODPROYCURR;
                    header('Location: cpaneladmin.php?rm=3&rt=2&a=3');
                    unset($_SESSION['pid']);
                    exit;
                    }else{
                    /*si no es el propio proyecto*/
                     $_SESSION['msgmodproy']=NONOM;
                      header('Location: cpaneladmin.php?rm=3&rt=2&a=3&pid='.$pid.'');
                    exit();
                }
            }else if($totalNombre == 0 && $totalName == 0){
                    /*si no existe hacemos el update*/
                    /*Buscamos el nombre del curso introducido*/
                    $newCurso= consulta($conexion,"SELECT * FROM cursos Where id_curso like $idCurso");
                    $infoNewCurso=mysqli_fetch_array($newCurso);
                    $cursoNew= $infoNewCurso['curso'];
                    $infoCurso=mysqli_fetch_array($cursoAct);
                    /*hacemos el update*/
                    $UPDATE = consulta($conexion,"UPDATE proyectos SET 
                                                    id_curso ='" . $idCurso . "',
                                                    nombre_pro ='" . $nombre . "',
                                                    name_pro = '" . $name . "' 
                                                    WHERE id_proyecto ='" . $pid . "'
                                                    ");
                    $UPDATE2= consulta($conexion, "update usuproy SET
                                                    id_user ='". $coor ."'
                                                    where id_proyecto like $pid and id_user in(SELECT id_user from usuarios
                                                                                              where tipo like 1)
                                                    ");
                    
                        /*renombramos la carpeta del proyecto*/
                        $nomAct=$infoCur['nombre_pro'];
                        $homeact="_cursos/".$cursoActual."/".$nomAct."";
                        $homenew="_cursos/".$cursoNew."/".$nombre."";
                        rename($homeact,$homenew);
                    }
                        $_SESSION['msgmodproy2']=MODPROYCURR;
                        header('Location: cpaneladmin.php?rm=3&rt=2&a=3');
                        exit();
        }else{
            header('Location: cpaneladmin.php?rm=3&rt=2&a=3');
            exit();  
        }