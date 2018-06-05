<?php
    include('_include/funciones.php');
    include('_include/conexion.php');
/*   codigo de inactividad  */

//Comprobamos si existe la sesión 'tiempo'.
if(isset($_SESSION['tiempo']) ) {

    //Tiempo en segundos para dar vida a la sesión.
    $inactivo = 5000000;//20min en este caso.

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];

        //Comparación para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
        if($vida_session > $inactivo)
        {
            
            //Removemos sesión.
            session_unset();
            //Destruimos sesión.
            session_destroy();              
            //Redirigimos pagina.
            
            header("Location: index.php");
            session_start();
            $_SESSION['msglo']=LOCOR;
            exit();
        } else {  // si no ha caducado la sesion, actualizamos
            $_SESSION['tiempo'] = time();
        }


} else {
    //Activamos sesion tiempo.
    $_SESSION['tiempo'] = time();
}
         
     /*fin codigo de inactividad*/ 
     
    if(!isset($_GET['a'])){
        $_SESSION['activo']= 0;
    }else{
        switch($_GET['a']){
            case 0:
            case 1:
            case 2:
            case 3:
            case 4:$_SESSION['activo']= $_GET['a'];
                break;
            default: $_SESSION['activo']= 0;
                break;
        }
    }
/*nos da la parte siguiente a la del host en la url*/
$urlact=$_SERVER['REQUEST_URI'];
/*creamos un array diviendo la url mediante / */
$urlact=explode("/",$urlact);
/*Vemos cuantos elementos componen el array y le asignamos a num el valor del ultimo de sus compenentes*/
$num=sizeof($urlact)-1;
/*guardamos en $urlact el valor de la ultima posicion del array*/
$urlact=$urlact[$num];
/* y le asignamos su valor a $_SESSION['urlact']*/
$_SESSION['urlact']=$urlact;
if(isset($_SESSION['password']) && isset($_SESSION['email']) && $_SESSION['password']== md5($_SESSION['email'])){
    header('Location: cambiapass.php');
}
        if(!isset($_SESSION['fail'])){?>
            <link rel="stylesheet" href="_css/oculogin.css">
    <?php
        }else{?>
        <link rel="stylesheet" href="_css/moslogin.css">
        <?php
        }
        if(isset($_SESSION['email'])){
        if(!isset($_GET['ed']) and file_exists('_users/'.$_SESSION['email'].'/img2.jpg')== true){
            unlink('_users/'.$_SESSION['email'].'/img2.jpg');
            }
        }
?>
      <header>
       <figure>
           <figcaption>Logo</figcaption>
           <img src="_img/logoDH.jpg">
       </figure>
       <spam id="slogan">
       <p><?=PYP?></p>
       <p id="p2">IES Delgado Hernández</p>
       </spam>
        <div id="sep"></div>
        <div id="line">
       <div id="myg">
       <p>
        <?php
            switch($_SESSION['activo']){
                case 0: echo '<span class="migas">' . INICIO . '</span>';
                    break;
                case 1:
                    if(isset($_GET['idp']) && !isset($_GET['rm'])){
                        echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <a href="cursos.php?a=1" class="migas">' .CURSOS. '</a>  <span class="migas">' . POY . '</span>';
                    }else{
                    echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <span class="migas">' . CURSOS . '</span>'; 
                    }
                    break;
            
                case 2: 
                    echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <span class="migas">' . PERFIL . '</span>';
                    break;
                case 3: 
                    $cpanel=explode("?",$urlact);
                    $cpanel=$cpanel[0];
                    /*si es el cpanel admin*/
                    if($cpanel== "cpaneladmin.php"){
                        if(!isset($_GET['rm'])){
                            echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <span class="migas">' . PANEL . '</span>';
                        }
                        else if($_GET['rm']== 1){
                            echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <a href="cpanel.php?a=3" class="migas">' . PANEL . '</a> <span class="migas">' . USUARIOS . '</span>';
                        }else if($_GET['rm']== 2){
                            echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <a href="cpanel.php?a=3" class="migas">' . PANEL . '</a> <span class="migas">' . CURSOS . '</span>';
                        }else if($_GET['rm']== 3){
                            echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <a href="cpanel.php?a=3" class="migas">' . PANEL . '</a> <span class="migas">' . PROYECT . '</span>';
                        }else if($_GET['rm']== 4){
                            echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <a href="cpanel.php?a=3" class="migas">' . PANEL . '</a> <span class="migas">' . OTHERCONF . '</span>';
                        }
                    }else if($cpanel== "cpanelprofe.php"){
                        if(!isset($_GET['rm'])){
                            echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <span class="migas">' . PANEL . '</span>';
                        }else if($_GET['rm']== 1){
                            echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <a href="cpanel.php?a=3" class="migas">' . PANEL . '</a> <span class="migas">' . USUARIOS . '</span>';
                        }else if($_GET['rm']== 2){
                            echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <a href="cpanel.php?a=3" class="migas">' . PANEL . '</a> <span class="migas">' . PROYECT . '</span>';
                        }
                    }else if($cpanel== "cpanelalum.php"){
                        if(!isset($_GET['rm'])){
                            echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <span class="migas">' . PANEL . '</span>';
                        }else if($_GET['rm']== 1){
                            echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <a href="cpanel.php?a=3" class="migas">' . PANEL . '</a> <span class="migas">' . PUBPROYS . '</span>';
                        }else if($_GET['rm']== 2 && !isset($_GET['rt'])){
                            echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <a href="cpanel.php?a=3" class="migas">' . PANEL . '</a> <span class="migas">' . NOPUBPROYS . '</span>';
                        }else if($_GET['rm']== 2 && isset($_GET['rt'])){
                            echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <a href="cpanel.php?a=3" class="migas">' . PANEL . '</a> <span class="migas">' . EDITPROY . '</span>';
                        }
                    }
                       /*echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <span class="migas">' . PANEL . '</span>';*/
                        break;
                case 4:
                    echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a> <span class="migas">' . NOPERFIL . '</span>';
                    break;
                default: echo '<a href="index.php?a=0" class="migas">' . INICIO . '</a>';
                    break;
            }    
    
        ?>     
                      
       </p>
       </div>
        <!--       Inicio Barra de busqueda global con DATALIST-->
        <div id="busq">
            <form action="_include/barraBusqueda.php" method="post">
                <input type="text" list="busqueda" placeholder="<?=BUSQ?>" name="search" onkeyup="BarraBuscar(this.value)" value="<?php 
                            if(isset($_SESSION['msje'])){
                                echo $_SESSION['msje'];
                                unset($_SESSION['msje']);
                            }
                            ?>">
                <datalist id="busqueda">
                    
                </datalist>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        
<!--       Fin Barra de busqueda global con DATALIST-->

          </div>
        <div id="sep2"></div>
        <div id="lys">
        <spam id="saludo">
        <?php if(isset($_SESSION['user'])){?>
         <p><?php
             switch($_SESSION['sexo']){
            case 0:
                echo BIENVH;
                break;
            case 1:
                echo BIENVM;
            break; 
                }
             ?> <?=$_SESSION['nombre']?></p>
         <?php }
                elseif(isset($_SESSION['msglo'])){?>
                        <p id="logout"><?=$_SESSION['msglo']?></p>
                    <?php unset($_SESSION['msglo']);
                       }
            ?>
         </spam>
         <div id="lang">
             <ul>
                 <li><a href="indexEs.php"><img src="_img/Sp.ico"></a></li>
                 <li><a href="indexUk.php"><img src="_img/Uk.ico"></a></li>
             </ul>
        </div>
       </div>
       <nav id="movil">
           <ul>
               <li <?php esActivo(0,$_SESSION[ 'activo'])?>><a href="index.php?a=0"><i class="fas fa-home <?php esActivo2(0,$_SESSION[ 'activo'])?>"></i></a></li>
               <li <?php esActivo(1,$_SESSION[ 'activo'])?>><a href="cursos.php?a=1"><i class="fas fa-book <?php esActivo2(1,$_SESSION[ 'activo'])?>"></i></a></li>
               <?php if(isset($_SESSION['user'])){ ?>
               <li <?php esActivo(2,$_SESSION[ 'activo'])?>><a href="profile.php?a=2"><i class="fas fa-user <?php esActivo2(2,$_SESSION[ 'activo'])?>"></i></a></li>
               <li <?php esActivo(3,$_SESSION[ 'activo'])?>><a href="cpanel.php"><i class="fas fa-cog <?php esActivo2(3,$_SESSION[ 'activo'])?>"></i></a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
               <?php }else{?>
               <li><a onclick="mostLog(document.getElementById('opaco'))"><i class="fas fa-sign-in-alt"></i></a></li>
               <?php } ?>
           </ul>
       </nav>
        <nav id="pc">
           
            <ul>
                <li <?php esActivo(0,$_SESSION[ 'activo'])?>><a href="index.php?a=0" ><p <?php esActivo3(0,$_SESSION['activo'])?>><?=INICIO?> <i class="fas fa-home"></i></p></a></li>
                <li <?php esActivo(1,$_SESSION[ 'activo'])?>><a href="cursos.php?a=1" ><p <?php esActivo3(1,$_SESSION['activo'])?>><?=CURSOS?> <i class="fas fa-book"></i></p></a></li>
                <?php if(isset($_SESSION['user'])){ ?>
                <li <?php esActivo(2,$_SESSION[ 'activo'])?>><a href="profile.php?a=2"><p <?php esActivo3(2,$_SESSION['activo'])?>><?=PERFIL?> <i class="fas fa-user"></i></p></a></li>
                <li <?php esActivo(3,$_SESSION[ 'activo'])?>><a href="cpanel.php"><p <?php esActivo3(3,$_SESSION['activo'])?>><?=PANEL?> <i class="fas fa-cog"></i></p></a></li>
                 <li><a href="logout.php"><p><?=CERRAR_S?> <i class="fas fa-sign-out-alt"></i></p></a></li>
                <?php }else{?>
                <li><a onclick="mostLog(document.getElementById('opaco'))"><p><?=INICIO_S?> <i class="fas fa-sign-in-alt"></i></p></a></li>
                <?php } ?>
            </ul>
        </nav>
       
   </header>
 <div id="opaco"><!--  este div occupara toda la pagina en el indice z, lo que impedira que pueda darse clic algo que no este en el cadro de login, ademas le dare un color negro de fondo con opacidad 0.4, para que se vea el la pagina pero un poco opaca-->
   <div id="login">
      <fieldset>
       <form action="login.php" method="post">
            <figure>
               <figcaption>Logo</figcaption>
               <img src="_img/logoDH.jpg">
            </figure>
            <div id="idh">
            <p>IES DELGADO HERNANDEZ</p>
            <p><?=INLOG?></p>
           </div>
            <div id="inputs">
                  <label><?= LOGEMAIL;?>:</label>
                  <input type="email" placeholder="<?= PHLEMAIL;?>" name="email" id="email" required >
                  <label><?=LOGPASS?>:</label>
                  <input type="password" placeholder="<?=PHLPASS?>" name="passw" id="passw" required>
            </div>
            <div id="buttons">
                  <button type="submit" id="submit"><?=LOGBUTTON?></button>
                  <button type="button" onclick="oculLog(document.getElementById('opaco'))"><?=LOGCAN?></button>
            </div>
           <p><?=LOGFOR?> <a href="<?=$olvidaPass?>"><?=LOGPASS?></a>?</p>
            <p id="msg"><?php 
                            if(isset($_SESSION['msg'])){
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                                unset($_SESSION['fail']);
                            }
                            ?></p>
       </form>
       </fieldset>
   </div>
</div>
