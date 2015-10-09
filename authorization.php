<?php
session_start();
 try{ 
include_once 'view/AuthorizationView.php';
include_once 'lib/smarty_lib/Smarty.class.php';  
$authorization_view = new AuthorizationView();
$title="Авторизация";
$smarty= new Smarty();
    $smarty->assign('title', $title);
    $smarty->assign('error', $authorization_view->error);
    $smarty->display('templates/authorization.tpl');
 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
