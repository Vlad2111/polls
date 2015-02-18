<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
 try{ 
include_once 'DAO/AuthorizationDAO.php';
include_once 'model/ValuesAuthorization.php';
include_once 'template_smarty/smarty_lib/Smarty.class.php';
$title="Авторизация";
$action="user.php";
$smarty= new Smarty();
$smarty->assign('title', $title);
$smarty->assign('action', $action);
$smarty->display('template_smarty/templates/authorization.tpl');

$username= $_REQUEST['login'];
$user_password=$_REQUEST['pass'];
$values_auth= new ValuesAuthorization();
$values_auth->setLogin($username);
$values_auth->setPassword($user_password);
$dao_auth=new AuthorizationDAO();
$user_login=$dao_auth->getAuthUser($values_auth);
$smarty= new Smarty();
$display='Страница';
$smarty->assign('title', $title);
$smarty->assign('user_login', $user_login);
$smarty->display('template_smarty/templates/user.tpl');
 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
                    	</body>
</html>