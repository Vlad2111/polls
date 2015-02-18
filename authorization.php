<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
 try{ 
include_once 'DAO/AuthorizationDAO.php';
include_once 'model/MAuthorization.php';
include_once 'template_smarty/smarty_lib/Smarty.class.php';
if (isset($_REQUEST['login']) && isset($_REQUEST['pass'])){
    $values_auth= new MAuthorization();
    $values_auth->setLogin($_REQUEST['login']);
    $values_auth->setPassword($_REQUEST['pass']);
    $dao_auth=new AuthorizationDAO();
    $user_login=$dao_auth->getAuthUser($values_auth);
    $error="Такой пользователь не найден";
    if($user_login){
        $error="";
    }
}
$title="Авторизация";
$action="authorization.php";
$smarty= new Smarty();
    $smarty->assign('title', $title);
    $smarty->assign('action', $action);
    $smarty->assign('user_login', $user_login);
    $smarty->assign('error', $error);
    $smarty->display('template_smarty/templates/authorization.tpl');
 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
                    	</body>
</html>