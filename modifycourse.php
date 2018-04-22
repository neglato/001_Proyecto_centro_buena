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
}
if(!isset($_POST['nombre'])){
    $_SESSION['msgmodcour']=BLANKCOURSE;
    header('Location: cpaneladmin.php?rm=2&rt=2&a=3&cid='.$cid.'');
    exit;
}
        if($_POST['nombre'] !=""){
            /*comprobamos que no exista ya en la base da datos*/
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
                header('Location: cpaneladmin.php?rm=2&rt=2a=3&cid='.$cid.'');
                exit();
            }
            /*Comprobamos que sean conscutivos*/
            if($cursob != ($cursoa+1)){
                $_SESSION['msgaddcourse']=CONSECYEAR;
                header('Location: cpaneladmin.php?rm=2&rt=2a=3&cid='.$cid.'');
                exit(); 
            }
            /*comprobamos si existe algun curso*/
            $nomCurso=$_POST['nombre'];
            $cid=$_SESSION['cid'];
                $RESULT1 = consulta($conexion,"SELECT * FROM cursos WHERE curso ='" . $nomCurso . "'"); 
                $info1=mysqli_fetch_array($RESULT1);
                $total1=mysqli_num_rows($RESULT1);
            /*Buscamos el curso con el id que elegimos para editarlo*/
                $RESULT2 = consulta($conexion,"SELECT * FROM cursos WHERE id_curso ='" . $cid . "'"); 
                $info2=mysqli_fetch_array($RESULT2);
                $total2=mysqli_num_rows($RESULT2);
            /*si no existe*/
                if($total1 == 0){
                    /*si no existe, hacemos el update del curso y del diretorio home*/

                $UPDATE = consulta($conexion,"UPDATE cursos SET 
                                        curso ='" . $nomCurso . "'
                                        WHERE id_curso like $cid");
                    
               rename('_cursos/'.$info2['curso'],'_cursos/'.$nomCurso);
                $_SESSION['msgmodcour']=MODYES;
                    unset($_SESSION['cid']);
                header('Location: cpaneladmin.php?rm=2&rt=2&a=3'); 
                exit();
                    /*si existe*/
                }else{
                      $_SESSION['msgmodcour']=NODISPCOURSE;
                      header('Location: cpaneladmin.php?rm=2&rt=2&a=3&cid='.$cid.'');
                      exit();
                    }
                }
