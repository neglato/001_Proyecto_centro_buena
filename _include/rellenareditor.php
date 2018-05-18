<?php
session_start();
include('variables.php');
    require_once('conexion.php');
    include('funciones.php');
if(isset($_SESSION['lang'])){
    if($_SESSION['lang']==1){
        include('UK-uk.php'); 
        }else{
            include('ES-es.php');
            }
        }else{
        include('ES-es.php');
    }
    if(isset($_POST['i'])){
        /*recuperamos el nombre del proyecto*/
        $idp=$_SESSION['ajax'];
        $ProyAct = consulta($conexion, "select * from proyectos where id_proyecto like $idp");                                     $rowProy=mysqli_fetch_array($ProyAct);
        $nombre_pro=$rowProy['nombre_pro'];                                                                       
        $name_pro=$rowProy['name_pro'];
        $contenido=$rowProy['contenido'];
        $content=$rowProy['content'];
        
        /*Ahora recuperamos el curso*/
        $CurAct = consulta($conexion,"Select * from cursos where id_curso in (select id_curso from proyectos
                                                                                where id_proyecto like $idp)");
        $row=mysqli_fetch_array($CurAct);
        $curso=$row['curso'];
            switch ($_POST['i']) {
                case -1:
                    echo "";
                    break;
                case "1es.php":
                    /*mostamos el directorio del texto en español*/
                    if (file_exists('../_cursos/'.$curso.'/'.$nombre_pro.'/'.$contenido.'')){
                            include('../_cursos/'.$curso.'/'.$nombre_pro.'/'.$contenido.'');
                        }else{?>
                       <p style="color:limegreen;font-size:1.3em;text-align:center;"><?=NOCONT?></p>
                        <?php }
                        break;
                case "1en.php":
                        if (file_exists('../_cursos/'.$curso.'/'.$nombre_pro.'/'.$content.'')){
                            include('../_cursos/'.$curso.'/'.$nombre_pro.'/'.$content.'');
                        }else{?>
                          <p style="color:limegreen;font-size:1.3em;text-align:center;"><?=NOCONT?></p>
                        <?php }
                    break;
            }

    }