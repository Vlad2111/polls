<?php
session_start();
 try{ 
include_once 'DAO/AuthorizationDAO.php';
include_once 'model/MAuthorization.php';
include_once 'lib/smarty_lib/Smarty.class.php';
    $error="";
if (isset($_REQUEST['login']) && isset($_REQUEST['pass'])){
    $values_auth= new MAuthorization();
    $values_auth->setLogin($_REQUEST['login']);
    $values_auth->setPassword($_REQUEST['pass']);
    $dao_auth=new AuthorizationDAO();
    $user_login=$dao_auth->getAuthUser($values_auth);
    if ($user_login){
        $obj_user=$dao_auth->getFIO($values_auth);
        $_SESSION['id_user']=$dao_auth->getIdUser($values_auth);
        $_SESSION['fio_user']=$obj_user->first_name."".$obj_user->last_name." ".$obj_user->patronymic; 
        $_SESSION['role_user']=$dao_auth->getRole($values_auth);
        header('HTTP/1.1 200 OK');
        header('Location: quiz.php');
        exit();

    }
    $error="Такой пользователь не найден";
}
$title="Авторизация";
$action="authorization.php";
$smarty= new Smarty();
    $smarty->assign('title', $title);
    $smarty->assign('action', $action);
    $smarty->assign('user_login', $user_login);
    $smarty->assign('error', $error);
    $smarty->display('templates/authorization.tpl');
 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
