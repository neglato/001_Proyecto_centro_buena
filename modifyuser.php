<?php
     session_start();
    include('_include/variables.php');
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
if(!isset($_POST['nombre']) || !isset($_POST['apellidos']) ||!isset($_POST['email']) || !isset($_POST['tipo']) || !isset($_POST['sexo'])){
    $_SESSION['msgmod']=ALLFIELDS;
    header('Location: cpaneladmin.php?rm=1&rt=2&a=3');
    exit();
}
        if($_POST['nombre'] !="" && $_POST['apellidos'] !="" && $_POST['email'] !="" && $_POST['tipo'] !="" && $_POST['sexo'] !=""){
            include('_include/conexion.php');
            include('_include/funciones.php');
                    $idu=$_SESSION['uid'];
                    unset($_SESSION['uid']);
                    $nombre=htmlentities($_POST['nombre']);
                    $apellidos=htmlentities($_POST['apellidos']);
                    $sexo=htmlentities($_POST['sexo']);
		    if($sexo != 0 && $sexo !=1){
                            $sexo=0;
                        }
                    $email=htmlentities($_POST['email']);
                    $tipo=htmlentities($_POST['tipo']);
                        if($tipo != 0 && $tipo != 1 && $tipo != 2){
                            $tipo= 2;
                        }
                    
            /*comprobamos si existe algun usuario con el email introducido*/
                $RESULT1 = consulta($conexion,"SELECT * FROM usuarios WHERE email ='" . $email . "' and baja like 0"); 
                $info1=mysqli_fetch_array($RESULT1);
                $total1=mysqli_num_rows($RESULT1);
            /*Buscamos el usuario con el id que elegimos para editarlo*/
                $RESULT2 = consulta($conexion,"SELECT * FROM usuarios WHERE id_user ='" . $idu . "' and baja like 0"); 
                $info2=mysqli_fetch_array($RESULT2);
            $total2=mysqli_num_rows($RESULT2);
            /*si no existe*/
                if($total1 == 0){
                /*guardamos el home antiguo y el nuevo*/
                    $oldemail=$info2['email'];
                    $oldhome="_users/".$oldemail."";
                    $newhome="_users/".$email."";
                /*hacemos el update*/
                $UPDATE = consulta($conexion,"UPDATE usuarios SET 
                                        nombre ='" . $nombre . "',
                                        apellidos ='" . $apellidos . "',
                                        sexo = '" . $sexo . "',
                                        email ='" . $email . "',
                                        tipo ='" . $tipo . "' 
                                        WHERE id_user ='" . $idu . "'
                                        ");
               rename('_users/'.$info2['email'],'_users/'.$email);
                $_SESSION['msgmod2']=MODYES;
                header('Location: cpaneladmin.php?rm=1&rt=2&a=3');  
                exit();
                    /*si existe*/
                }else{
                    /*comprobamos si el emial introducido es el mismo que el actual de ese usuario*/
                    if($email == $info2['email']){
                        /*si lo es, hacemos el update*/
                    $UPDATE = consulta($conexion,"UPDATE usuarios SET 
                                                    nombre ='" . $nombre . "',
                                                    apellidos ='" . $apellidos . "',
                                                    sexo = '" . $sexo . "',
                                                    email ='" . $email . "',
                                                    tipo ='" . $tipo . "' 
                                                    WHERE id_user ='" . $idu . "'
                                                    ");
                $_SESSION['msgmod2']=MODYES;
                header('Location: cpaneladmin.php?rm=1&rt=2&a=3');  
                exit();
                    }else{
                        /*Si no es el mismo, quiere decir que lo tiene otro usuario, por lo que mandaremos el error*/
                      $_SESSION['msgmod']=NODISP;
                      header('Location: cpaneladmin.php?rm=1&rt=2&a=3&uid='.$idu.'');
                        exit();
                    }
                }
        }
