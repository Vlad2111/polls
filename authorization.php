<?php
session_start();
 try{ 
include_once 'DAO/AuthorizationDAO.php';
include_once 'model/MAuthorization.php';
include_once 'lib/smarty_lib/Smarty.class.php';
    $error="";
    $user_login="";
if (isset($_REQUEST['login']) && isset($_REQUEST['pass'])){
    $values_auth= new MAuthorization();
    //фильтруем входные данные
    $login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS); 
    $password=filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
    $values_auth->setLogin($login);
    $values_auth->setPassword($password);
    $dao_auth=new AuthorizationDAO();
    if ($_REQUEST['button_click']=='DB'){
        $param='database';
    $user_login=$dao_auth->getAuthUser($values_auth, $param);
    
    }
    if ($_REQUEST['button_click']=='LDAP'){
        $param="LDAP";
    $user_login=$dao_auth->getAuthUser($values_auth, $param);
    }
    if ($user_login){
        $obj_user=$dao_auth->getObjUser($values_auth, $param);
        $_SESSION['id_user']=$dao_auth->getObjUser($values_auth, $param)->getIdUser();
        $_SESSION['fio_user']=$obj_user->getFirstName()."".$obj_user->getLastName(); 
        $_SESSION['role_user']=$obj_user->getIdRole();
        header('HTTP/1.1 200 OK');
        header('Location: quiz.php');
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
