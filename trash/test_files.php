<html>
	<head><title>Тестирование</title><meta charset="utf-8"></head>
		<body>
<?php
chdir("C:WebServers/home/localhost/www/NetBeans/PhpPrimer1/");
include_once 'lib/DB.php';
try{ 
    $db=  DB::getInstance();
    echo "<pre>";    
    echo "Проверяем config: <br>";
    var_dump($db->getConfig());
    echo "<hr>";
    echo "Проверяем execute pg_query: <br>";
    $query="create table table_for_test(
	id int not null,
	value_test character(20) null
    );
    insert into table_for_test values
	(1, 'one'),
	(2, 'two');";
    var_dump($db->execute($query));
    echo "<hr>";
    
    echo "Проверяем getFetchObject: <br>";
        $array_params=array();
        $query="select * from table_for_test where id=$1;";
        $array_params[]=2;
        $execute=$db->execute($query, $array_params);
        var_dump($db->getFetchObject($execute));    
    echo "<hr>";
//    
    echo "Проверяем getArrayData: <br>";
        $array_params=array();
        $query="select * from table_for_test where id=$1;";
        $array_params[]=2;
        $execute=$db->execute($query, $array_params);
        var_dump($db->getArrayData($execute));    
    echo "<hr>";
    
    echo "Удаляем таблицу: <br>";
    $query="drop table  table_for_test;";
    var_dump($db->execute($query));
    echo "<hr>";
    echo "</pre>";
 } catch (Exception $ex) {

 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}

 
?>
                    	</body>
</html>