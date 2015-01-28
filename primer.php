<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
 try{ 
    include_once 'DB.php';
    include_once 'Authorization.php';
    include_once 'Administration.php';  
    include_once 'Quiz.php';    
    $array=array(
                    'topic'=>'Tests',
                    'comment'=>'this is test',
                    'see_the_result'=>'Y',
                    'see_details'=>'Y'
    );
$test= new Quiz();
$test->deleteQuiz(5);
}
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>

                    	</body>
</html>