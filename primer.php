<html>
	<head><title>Пример</title><meta charset="utf-8"></head>
		<body>
<?php
include_once 'view/AdministrationView.php';
include_once 'model/MUser.php';
include_once 'model/MQuiz.php';
include_once 'DAO/QuizDAO.php';
 try{ 
     $user_data= new MUser();
     $user_data->setIdUser(4);
     $user_data->setLastName('Иванка');
     $user_data->setFirstName('Иванов');
     $user_data->setPatronymic('Иванывич');
     $user_data->setEmail('ivanixh@ivi');
     $user_data->setLogin('Иванка');     
     $user_data->setPassword(1);
     $user_data->setIdRole(3);
     $admin= new AdministrationView();
     $admin->createUser($user_data);
 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}

 
?>
                    	</body>
</html>