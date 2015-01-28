<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
 try{ 
    include 'class_db.php';
    include 'class_auth.php';
    include 'class_admin.php';
        $array_name=array('last_name', 'first_name','patronymic', 'type','email','login','password');
        $admin= new Admin();
        $admin->deleteRole(24);
        
}
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>

                    	</body>
</html>