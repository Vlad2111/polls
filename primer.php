<html>
	<head><title>Пример</title><meta charset="utf-8"></head>
		<body>
<?php
include_once 'view/AdministrationView.php';
include_once 'model/MInterviewee.php';
include_once 'DAO/IntervieweeDAO.php';
 try{ 
     $data_inter=new MInterviewee();
     $data_inter->setIdUser(4);
     $inter= new IntervieweeDAO();
     echo "<pre>";
//     var_dump($inter->getListQuiz($data_inter));
//     var_dump($inter->getStatusQuiz(17));
//     var_dump($inter->getArrayTest(17));
//     var_dump($inter->getArrayTesting(4));
//     
     var_dump($inter->getDataQuiz($data_inter));
     echo "</pre>";
 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}

 
?>
                    	</body>
</html>