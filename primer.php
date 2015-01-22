<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
 try{ 
include 'class_db.php';
include 'class_auth.php';
$db=DB::getInstance();
$query= $db->getQueryDb('last_name, first_name', 'alluser', 'id_user = $1', array(1));
echo $db->getFetchResult($query);
echo "<hr>";
$q= new Auth('Иван', 1);
echo $q->getAuthUser();


    
      }
                            catch (Exception $e){
                                $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
                                echo $error;                            
                            }
?>

                    	</body>
</html>