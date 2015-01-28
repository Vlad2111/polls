<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
 try{ 
    include 'DB.php';
    include 'Authorization.php';
    include 'Administration.php';  
    include 'Test.php';
    
// (nextval('id'), 'Пробный тест', null, null, 'Y', 'Y', null);
    $array=array('Массив', '360', 'для теста', 'Y', 'Y', 'только создан');
$test= new Test();
$test->createTest($array);
}
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>

                    	</body>
</html>