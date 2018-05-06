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

if(isset($_POST['tipo']) && $_POST['tipo'] == -1){
    header('Location: cpanelprofe.php?rm=2&rt=3&a=3');
    $_SESSION['msgprofe']=SELPROY;
    exit();
}elseif(isset($_POST['tipo']) && $_POST['tipo'] != -1){
    include('_include/conexion.php');
    include('_include/funciones.php');
    $idproy=$_POST['tipo'];
    //Hago la consulta para recuperar el nombre del curso y del proyecto
    $CONSULT = consulta($conexion,"SELECT * 
                                    FROM proyectos p, cursos c 
                                    WHERE p.id_curso=c.id_curso 
                                    AND p.id_proyecto='" . $idproy . "'"); 
    
    $info=mysqli_fetch_array($CONSULT);
    $año=$info['curso'];
    $nombpro=$info['nombre_pro'];
    $fecha=$info['fecha_pub'];
    //monto la ruta de los ficheros esp y eng y las guardo en variables
    $rutaes="_cursos/".$año."/".$nombpro."/1es.php";
    $rutaen="_cursos/".$año."/".$nombpro."/1en.php";
    //si existen ambos ficheros...
    if(file_exists($rutaes) && file_exists($rutaen)){
        /*comprobamos su fecha de pub*/
        if($fecha == "0000-00-00"){
        $UPDATE = consulta($conexion,"UPDATE proyectos SET 
                                        fecha_pub = CURRENT_DATE(),
                                        mostrar = 1 
                                        WHERE id_proyecto ='" . $idproy . "'"); 
        header('Location: cpanelprofe.php?rm=2&rt=3&a=3');
        $_SESSION['msgprofe']=PROYSIPUB;
        unset($_SESSION['tipo']);
        mysqli_close($conexion);
        exit();
        }else{
        $UPDATE = consulta($conexion,"UPDATE proyectos SET 
                                        mostrar = 1 
                                        WHERE id_proyecto ='" . $idproy . "'"); 
        header('Location: cpanelprofe.php?rm=2&rt=3&a=3');
        $_SESSION['msgprofe']=PROYSIPUB;
        unset($_SESSION['tipo']);
        mysqli_close($conexion);
        exit();  
        }
        //si no existen los ficheros...
    }else{
        
        header('Location: cpanelprofe.php?rm=2&rt=3&a=3');
        $_SESSION['msgprofe']=NOFILE;
        unset($_SESSION['tipo']);
        mysqli_close($conexion);
        exit();
    }
}
