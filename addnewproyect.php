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
    if (!isset($_SESSION['user'])){
        header('Location: index.php');
        exit();
    }
    if(!isset($_POST['id_curso']) || !isset($_POST['id_coor']) || !isset($_POST['nombre']) || !isset($_POST['name'])){
            $_SESSION['msgaddproy']=ALLFIELDS;
            header('Location: cpaneladmin.php?rm=3&rt=1a=3');
            exit();
    }
    if($_POST['id_curso']=="" || $_POST['id_coor']==""|| $_POST['']=="" || $_POST['nombre'] =="" || $_POST['name']==""){
        $_SESSION['msgaddproy']=FOOBL;
        header('Location: cpaneladmin.php?rm=3&rt=1a=3');
        exit();
    }
        if($_POST['id_curso'] !=-1 && $_POST['id_coor'] !=-1 && $_POST['nombre'] !="" && $_POST['name'] !=""){
                include('_include/conexion.php');
                include('_include/funciones.php');
            /*Comprobamos que no exista ya en la base de datos*/
            $nombre=$_POST['nombre'];
            $name=$_POST['name'];
            $curso=$_POST['id_curso'];
            $coor=$_POST['id_coor'];
            $resultado1 = consulta($conexion,"SELECT * from proyectos where nombre_pro='{$nombre}' and id_curso like $curso");
            $totalFilas1= mysqli_num_rows($resultado1);
            $resultado2 = consulta($conexion,"SELECT * from proyectos where name_pro='{$name}' and id_curso like $curso");
            $totalFilas2= mysqli_num_rows($resultado2);
            if($totalFilas1 > 0 || $totalFilas2 > 0 ){             
                $_SESSION['msgaddproy']=EXISPROY;
                header('Location: cpaneladmin.php?rm=3&rt=1a=3');
                mysqli_close($conexion);
                exit(); 
            }else{
                /*creamos el curso y su carpeta home*/
            $insert = consulta($conexion,"INSERT INTO proyectos (id_curso, nombre_pro, name_pro)  VALUES ('{$curso}','{$nombre}','{$name}')");
            $newpro =consulta($conexion,"SELECT * from proyectos where nombre_pro='{$nombre}' and id_curso='{$curso}'");
            $newpro = mysqli_fetch_array($newpro);
            $id_pro=$newpro['id_proyecto'];
            $nomCurso=consulta($conexion,"SELECT * from cursos where id_curso='{$curso}'");
            $nomCurso=mysqli_fetch_array($nomCurso);
            $nomCurso=$nomCurso['curso'];
            $insert2 = consulta($conexion,"INSERT INTO usuproy (id_proyecto, id_user)  VALUES ('{$id_pro}','{$curso}')");
            $home="_cursos/$nomCurso/$nombre";
            mkdir($home, 0777, true);
                $_SESSION['msgaddproy']=ADDPROY;
                mysqli_close($conexion);
                header('Location: cpaneladmin.php?rm=3&rt=1a=3');
                exit();
                }
        }


?>
