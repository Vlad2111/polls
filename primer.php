<html>
	<head><title>Пример</title><meta charset="utf-8"></head>
		<body>
<?php

include_once 'lib/CheckOS.php';
include_once 'DAO/AdministrationDAO.php';

 try{ 
$administration=new AdministrationDAO();
     echo "<pre>";
//     var_dump($inter->getListQuiz($data_inter));
//     var_dump($inter->getStatusQuiz(17));
//     var_dump($inter->getArrayTest(17));
//     var_dump($inter->getArrayTesting(4));
//     
     var_dump($administration->getDataUsers());

     echo "</pre>";
 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}

 
?>
                    	</body>
</html>