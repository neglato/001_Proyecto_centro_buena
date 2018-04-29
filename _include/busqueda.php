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


if(isset($_POST['search'])){
    if($_POST['search']==""){
        header('Location: index.php');
        exit();
    }elseif($_POST['search']!=""){
        include('conexion.php');
        include('funciones.php');
        $busq = $_POST['search'];
        $busqueda = consulta($conexion, "SELECT * 
                                        FROM usuarios 
                                        WHERE baja like 0
                                        AND (nombre like '%$busq%'
                                        OR apellidos like '%$busq%')
                                        "); 
        while($fila= mysqli_fetch_array($busqueda)){                                
                   echo "<option>{$fila['nombre']} {$fila['apellidos']}</option>
                   ";                     
        }
                                        
        $busqueda2 = consulta($conexion, "SELECT * 
                                          FROM proyectos 
                                          WHERE (nombre_pro like '%$busq%'
                                          OR name_pro like '%$busq%')
                                          AND mostrar like 1");                                 
        while($fila2= mysqli_fetch_array($busqueda2)){                                
                   if($_SESSION['lang']==1){
                       echo "<option>{$fila2['name_pro']}</option>";
                   }elseif($_SESSION['lang']==0){
                       echo "<option>{$fila2['nombre_pro']}</option>";
                   }
        }            
        
        $busqueda3 = consulta($conexion, "SELECT * 
                                          FROM cursos                                 
                                          WHERE curso like '%$busq%'");
        while($fila3= mysqli_fetch_array($busqueda3)){                                
                   echo "<option>{$fila3['curso']}</option>
                   ";                                   

        }
    }
}