<!--    Script para añadir un usuaro a un proyecto-->
    
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

        if(isset($_POST['usu2proy'])){
            if($_POST['id_proyecto']==-1 || !isset($_POST['id_user2'])){
                header('Location: cpanelprofe.php?rm=1&rt=2&a=3');
                $_SESSION['msgprofe']=USUYPROY;
                exit();
            }else{
                include('_include/conexion.php');
                include('_include/funciones.php');
                $proy=$_POST['id_proyecto'];
                $use=$_POST['id_user2'];
                foreach($use as $i){
                        $consul = consulta($conexion,"INSERT INTO usuproy (id_proyecto, id_user)  VALUES 
                                                        ('" . $proy . "','" . $i . "')");
                }
                        header('Location: cpanelprofe.php?rm=1&rt=2&a=3');
                        $_SESSION['msgprofe']=USU2PROYOK;
                        mysqli_close($conexion);
                        exit(); 
            }
        }
        
    ?>
   