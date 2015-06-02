<?php
include_once 'lib/smarty_lib/Smarty.class.php';
//if(!isset( $_SESSION['id_user']) && empty( $_SESSION['id_user']) && $_SESSION['id_user']=="" ){
//header('HTTP/1.1 200 OK');
//header('Location: authorization.php');
//exit();        
//}
if(!$_SESSION['role_user']){
header('HTTP/1.1 200 OK');
header('Location: authorization.php');
exit();        
}
$smarty= new Smarty();
$smarty->assign('you', $_SESSION['fio_user']);
$smarty->assign('data_role',$_SESSION['role_user']);

