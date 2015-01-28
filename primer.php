<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
 try{ 
    include 'DB.php';
    include 'Authorization.php';
    include 'Administration.php';  
}
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>

                    	</body>
</html>