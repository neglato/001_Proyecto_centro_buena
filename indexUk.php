<?php
session_start();
$_SESSION['lang']=1;
if ($_SESSION['urlact'] == ""){
    header('Location: index.php');
}else{
    header('Location: '.$_SESSION['urlact'].'');
}

