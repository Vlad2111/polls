<html>
	<head><title>Таблица</title><meta charset="utf-8"></head>
		<body>
<?php
 try{ 
include_once 'template_smarty/smarty_lib/Smarty.class.php';
$title="Меню";
$href1="view.php";
$value1="Добавить вопрос";

$smarty= new Smarty();
    $smarty->assign('title', $title);
    $smarty->assign('href1', $href1);
    $smarty->assign('value1', $value1);
    $smarty->display('template_smarty/templates/menu.tpl');
 }

catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
                    	</body>
</html>