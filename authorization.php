<?php
include_once 'template_smarty/smarty_lib/Smarty.class.php';
$title="Авторизация";
$action="user.php";
$smarty= new Smarty();
$smarty->assign('title', $title);
$smarty->assign('action', $action);
$smarty->display('template_smarty/templates/authorization.tpl');

?>
