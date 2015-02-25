<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
include_once 'view/AdministrationView.php';
 try{ 
$admin=new AdministrationView();
$admin->getDataUsers();
echo "<pre>";
var_dump($admin->getDataUsers());
var_dump($admin->getDataQuiz());
echo "</pre>";

 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
                    	</body>
</html>