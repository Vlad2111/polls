<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
include_once 'model/ValuesQuiz.php';
include_once 'model/QuizDAO.php';
 try{ 
     $quiz= new ValuesQuiz;
$dao=new QuizDAO();
    $quiz->topic='New topic';
    $quiz->see_the_result='Y';
    $quiz->see_details='Y';
    $quiz->status='ok';
    echo $dao->createQuiz($quiz) ;
 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
                    	</body>
</html>