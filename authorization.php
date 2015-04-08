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
    $button_click=filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($login) && isset($password)){
    $values_auth= new MAuthorization();

    
    $values_auth->setLogin($login);
    $values_auth->setPassword($password);
    $dao_auth=new AuthorizationDAO();
    $user_login=$dao_auth->getAuthUser($values_auth);
    if ($user_login){
        $obj_user=$dao_auth->getObjUser($values_auth);
        $_SESSION['id_user']=$dao_auth->getObjUser($values_auth)->getIdUser();
        $_SESSION['fio_user']=$obj_user->getFirstName()."".$obj_user->getLastName(); 
        $_SESSION['role_user']=$obj_user->getIdRole();
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
