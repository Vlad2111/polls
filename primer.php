<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
 try{ 
include 'class_db.php';
include 'class_auth.php';
echo "<pre>";
$array=DB::getInstance();
var_dump($array); echo "</pre>";


$query= DB::getQuery_db('last_name, first_name', 'alluser', 'id_user = $1', array(1));
$query=DB::getQuery_db('id_user', 'alluser', "login=$1 and password=$2", array('Иван', 1));
echo DB::getFetch_result($query);
echo "<hr>";
$q= new Auth('Иван', 1);
echo $q->getAuthUser();

    
      }
                            catch (Exception $e){
                                $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
                                echo $error;
                            AddLog::Logging($error);
                            }
?>

                    	</body>
</html>