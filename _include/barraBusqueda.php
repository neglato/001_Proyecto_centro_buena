<?php
     session_start();

if(isset($_SESSION['lang'])){
if($_SESSION['lang']==1){
    include('UK-uk.php'); 
    }else{
        include('ES-es.php');
        }
    }else{
      include('ES-es.php');
} 

if(isset($_POST['search'])){
    if($_POST['search']=="" || $_POST['search']==ESCRIALGO){
        $archivoActual = $_SERVER['PHP_SELF'];
        header('Location:' . getenv('HTTP_REFERER'));
        $_SESSION['msje']=ESCRIALGO;
        exit();
    }elseif($_POST['search']!=""){
        include('conexion.php');
        include('funciones.php');
        $buscar = $_POST['search'];
        $busqueda = consulta($conexion, "SELECT CONCAT(nombre,' ',apellidos) as fullnombre, id_user, email 
                                        FROM usuarios 
                                        WHERE baja like 0
                                        AND CONCAT(nombre,' ',apellidos) like '%$buscar%'
                                        "); 
        while($fila=mysqli_fetch_array($busqueda)){
            $nombre=$fila['fullnombre'];
            $iduser="idu=".$fila['id_user']."";
            $email=$fila['email'];
            if($buscar==$nombre){
                header('Location: ../profilever.php?'.$iduser.'&a=2');
                exit();
            }
        }
        
        $busqueda2 = consulta($conexion, "SELECT * 
                                          FROM proyectos 
                                          WHERE (nombre_pro like '%$buscar%'
                                          OR name_pro like '%$buscar%')
                                          AND mostrar like 1");                                 
        while($fila2= mysqli_fetch_array($busqueda2)){                                
            $idproy="idp=".$fila2['id_proyecto']."";
            $nombES=$fila2['nombre_pro'];
            $nombUK=$fila2['name_pro'];
            if($buscar==$nombES || $buscar==$nombUK){
                header('Location: ../proyecto.php?'.$idproy.'&a=1');
                exit();
            }
        }                                
        
        $busqueda3 = consulta($conexion, "SELECT * 
                                          FROM cursos                                 
                                          WHERE curso like '%$buscar%'");
        while($fila3= mysqli_fetch_array($busqueda3)){                                
            $idcurso="idc=".$fila3['id_curso']."";
            $curso=$fila3['curso'];
            if($buscar==$curso){
                header('Location: ../cursos.php?'.$idcurso.'&a=1');
                exit();
            }
        }
        
    }
}