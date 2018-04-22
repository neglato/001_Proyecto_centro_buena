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
    if($_POST['nombre']==""){
        $_SESSION['msgaddcourse']=BLANCKCOUR;
        header('Location: cpaneladmin.php?rm=2&rt=1a=1');
        exit();
    }
        if($_POST['nombre'] !=""){
                include('_include/conexion.php');
                include('_include/funciones.php');
            
            // Comprobamos que el formato sea correcto
            $curso=$_POST['nombre'];
            /*convertimos el año en un array, diviendo el string mediante -*/
            $curso=explode("-",$curso);
            /*guardamos las 2 partes del array*/
            $cursoa=$curso[0];
            $cursob=$curso[1];
            /*comprobamos que ambas tengas 4 digitos*/
            if(strlen($cursoa)!=4 || strlen($cursob)!=4){
                $_SESSION['msgaddcourse']=INVACOUR;
                header('Location: cpaneladmin.php?rm=2&rt=1a=1');
                exit();
            }
            /*Comprobamos que sean conscutivos*/
            if($cursob!=($cursoa+1)){
                $_SESSION['msgaddcourse']=CONSECYEAR;
                header('Location: cpaneladmin.php?rm=2&rt=1a=1');
                exit(); 
            }
            /*Comprobamos que no exista ya en la base de datos*/
            $nombre=$_POST['nombre'];
            $resultado = consulta($conexion,"SELECT * from cursos where curso ='{$nombre}'");
            $totalFilas= mysqli_num_rows($resultado);
            if($totalFilas > 0){             
                $_SESSION['msgaddcourse']=EXISCOUR;
                header('Location: cpaneladmin.php?rm=2&rt=1a=1');
                exit(); 
            }else{
                /*creamos el curso y su carpeta home*/
            $update = consulta($conexion,"INSERT INTO cursos (curso)  VALUES ('{$nombre}')");
            $home="_cursos/$nombre";
            mkdir($home, 0777, true);
                $_SESSION['msgaddcourse']=ADDCUOR;
                mysqli_close($conexion);
                header('Location: cpaneladmin.php?rm=2&rt=1a=1');
                exit();
                }
        }


?>
