<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
 try{ 
include_once 'DAO/AdministrationDAO.php';
include_once 'DAO/UserDAO.php';
include_once 'model/MUser.php';
$user= new MUser();
$user->setIdUser(1);
$admin=new AdministrationDAO();
var_dump($admin->getListQuiz());
var_dump($admin->deleteUser($user));
$users=new UserDAO();
$users->deleteUser($user);
 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
                    	</body>
</html>