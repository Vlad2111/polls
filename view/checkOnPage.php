<?php
include_once 'lib/smarty_lib/Smarty.class.php';
if(!isset( $_SESSION['id_user']) && empty( $_SESSION['id_user']) && $_SESSION['id_user']=="" ){
header('HTTP/1.1 200 OK');
header('Location: authorization.php');
exit();        
}
$value_role=$_SESSION['role_user'];
$role=array();
foreach ($value_role as $value){
    if($value==1){
        $role[0]=1;
    }
    elseif($value==2){
        $role[1]=2;
    }
    elseif($value==3){
        $role[2]=3;
    }
}
$smarty= new Smarty();
$smarty->assign('you', $_SESSION['fio_user']);
$smarty->assign('data_role',$role);

