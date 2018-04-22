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
    if($_POST['email']==""){
        $_SESSION['msgadd']=NNMAIL;
    }
        if($_POST['nombre'] !="" && $_POST['apellidos'] !="" && $_POST['email'] !=""){
                include('_include/conexion.php');
                include('_include/funciones.php');
            
            // Comprobamos que tipo de usuario esta creando a otro usuario
                $USER = $_SESSION['user']; 
                $comprob = consulta($conexion,"SELECT * FROM usuarios WHERE id_user = '".$USER."'");
                $info = mysqli_fetch_array($comprob); 
            
            $email=$_POST['email'];
            $resultado = consulta($conexion,"SELECT * from usuarios where email ='{$email}' and baja like 0");
            $totalFilas= mysqli_num_rows($resultado);
            if($totalFilas > 0){
                $_SESSION['msgadd']=NODISP;
                if($info['tipo']==0){
                    header('Location: cpaneladmin.php?rm=1&rt=1a=3');
                }elseif($info['tipo']==1){
                    header('Location: cpanelprofe.php?rm=1&rt=1a=3');
                        }
                exit(); 
            }else if($totalFilas == 0){ 
                $emailhash=md5($email);
                $baja = consulta($conexion,"SELECT * from usuarios where email ='{$email}' and baja like 1");
                $deBaja= mysqli_num_rows($baja);
                    if($deBaja > 0){
                        $update=consulta($conexion,"UPDATE usuarios SET password='{$emailhash}', baja='0' where email like '{$email}'");
                        $_SESSION['msgadd']=USRALT;
                        if($info['tipo']==0){
                            header('Location: cpaneladmin.php?rm=1&rt=1a=3');
                            exit();
                        }elseif($info['tipo']==1){
                            header('Location: cpanelprofe.php?rm=1&rt=1a=3');
                            exit();
                        }
                        }else{
                $nombre=$_POST['nombre'];
                $apellidos=$_POST['apellidos'];
                $sexo=$_POST['sexo'];
                $email=$_POST['email'];
                $tipo=$_POST['tipo']; 
                $emailhash=md5($email);
                    if($info['tipo']==0){
                        $resultado = consulta($conexion,"INSERT INTO usuarios (nombre, apellidos, sexo, email, password, tipo)  VALUES ( 
                                    '{$nombre}', 
                                    '{$apellidos}',
                                    '{$sexo}',
                                    '{$email}', 
                                    '{$emailhash}',
                                    '{$tipo}'
                                    )
                                    ");
                    
                    }elseif($info['tipo']==1){
                        $resultado = consulta($conexion,"INSERT INTO usuarios (nombre, apellidos, sexo, email, password, tipo)  VALUES ( 
                                    '{$nombre}', 
                                    '{$apellidos}',
                                    '{$sexo}',
                                    '{$email}', 
                                    '{$emailhash}',
                                    '2'
                                    )
                                    ");
                    }
                    $home="_users/$email";
                    if (!file_exists($home)) {
                        mkdir($home, 0777, true);
                    }
                    
                    if($info['tipo']==0){
                        header('Location: cpaneladmin.php?rm=1&rt=1a=3');
                    }elseif($info['tipo']==1){
                        header('Location: cpanelprofe.php?rm=1&rt=1a=3');
                    }
                    
                    $_SESSION['msgadd']=ADDCUR;
                    mysqli_close($conexion);
                    
                    exit();
                }
            }
        }
?>


