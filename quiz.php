
<?php
session_start();
 try{ 
include_once 'DAO/QuizDAO.php';     
include_once 'view/AdministrationView.php';
include_once 'model/MUser.php';
include_once 'model/MQuiz.php';
include_once 'lib/smarty_lib/Smarty.class.php';
$link_click=filter_input(INPUT_GET, 'link_click', FILTER_SANITIZE_SPECIAL_CHARS);

if ($link_click==='exit'){
        $_SESSION=array();
        session_destroy();
        header('HTTP/1.1 200 OK');
        header('Location: authorization.php');
        exit();
}

$smarty= new Smarty();
$title="Меню администратора";
$you=$_SESSION['fio_user'];
$exit="Выход";
$role="Составитель теста";
$name_page='quiz';
$role_user=$_SESSION['role_user'];
    $smarty->assign('title', $title);
    $smarty->assign('you', $you);
    $smarty->assign('exit', $exit);
    $smarty->assign('name_page', $name_page);    
    $smarty->assign('role_user',$role_user);
    
    $smarty->display('templates/quiz.tpl');

 }
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
