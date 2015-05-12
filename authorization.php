<?php
session_start();
 try{ 
include_once 'DAO/AuthorizationDAO.php';
include_once 'model/MAuthorization.php';
include_once 'lib/smarty_lib/Smarty.class.php';
    $error="";
    $user_login="";
        //фильтруем входные данные
    $login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS); 
    $password=filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($login) && isset($password)){
    $mauth= new MAuthorization();
    $mauth->setLogin($login);
    $mauth->setPassword($password);
    $mauth->setPasswordLDAP($password);
    $dao_auth=new AuthorizationDAO();
    if ($dao_auth->getAuthUser($mauth)){
        $obj_user=$dao_auth->getObjUser($mauth);
        $_SESSION['id_user']=$dao_auth->getIdUser($mauth);
        $_SESSION['fio_user']=$obj_user->getFirstName()." ".$obj_user->getLastName(); 
        $_SESSION['role_user']=$dao_auth->getRole($mauth);
        header('HTTP/1.1 200 OK');
        header('Location: main.php');
        exit();
    }
    $error="Такой пользователь не найден";
    
    if ($link_click==='exit'){
        $_SESSION=array();
        session_destroy();
        }
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
