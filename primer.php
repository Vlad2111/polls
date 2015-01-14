<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
include 'class_db.php';
 try{ 
    $a= new DB();
    $db=$a->connect_db();
    echo $query=DB::query_db($db, '*', 'alluser', array('id_user', '2'));

    echo "<hr>";
    echo DB::fetch_result($query);
      }
                            catch (Exception $e){
                                $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
                                echo $error;
                            AddLog::Logging($error);
                            }
?>

                    	</body>
</html>