
<?php
session_start();
 try{ 
include_once 'DAO/QuizDAO.php';     
include_once 'view/AdministrationView.php';
include_once 'model/MUser.php';
include_once 'model/MQuiz.php';
include_once 'lib/smarty_lib/Smarty.class.php';
//$you=$_SESSION['id_user'];
//$fio_you=

$administration=new AdministrationView();
$create_user_fio='';
$view_admin='';

if (@$_REQUEST['new_user']=='ok'){    
    $view_admin='create_user';
}
if (@$_REQUEST['tab']=='users'){    
    $view_admin='table_users';
}
if (@$_REQUEST['tab']=='quiz' || @$_REQUEST['return_tables_quiz']=='ok'){    
    $view_admin='table_quiz';
}
if (isset($_REQUEST['quiz_control']) && !empty($_REQUEST['quiz_control'])){
    $id_quiz=$_REQUEST['quiz_control'];
    $array_one_quiz=$administration->getDataOneQuiz($_REQUEST['quiz_control']);        
    $view_admin='edit_quiz';
}
if (isset($_REQUEST['last_name']) && !empty($_REQUEST['last_name']) &&
    isset($_REQUEST['first_name']) && !empty($_REQUEST['first_name']) &&   
    isset($_REQUEST['patronymic']) && !empty($_REQUEST['patronymic']) &&
    isset($_REQUEST['role']) && !empty($_REQUEST['role'])){    
        $user=new MUser();
        $user->setFirstName($_REQUEST['first_name']);
        $user->setLastName($_REQUEST['last_name']);
        $user->setPatronymic($_REQUEST['patronymic']);
        $user->setIdRole($_REQUEST['role']);
        $user->setEmail($_REQUEST['email']);
        $user->setLogin($_REQUEST['login']);
        $user->setPassword($_REQUEST['password']);
        $administration->addUser($user);
        $create_user_fio=$_REQUEST['last_name']." ".$_REQUEST['first_name']." ".$_REQUEST['patronymic'];
        $view_admin='create_user_info';
}
if (@$_REQUEST['delete_one_quiz']=='ok'){
    $mquiz=new MQuiz();
    $mquiz->setIdQuiz($_REQUEST['delete_quiz_id']);
    $administration->deleteQuiz($mquiz);
    $view_admin='table_quiz';
}
if (@$_REQUEST['exit']=='ok'){
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
    $smarty->assign('id_quiz', $id_quiz);
    $smarty->assign('title', $title);
    $smarty->assign('view_admin', $view_admin);
    $smarty->assign('you', $you);
    $smarty->assign('exit', $exit);
    $smarty->assign('create_user_fio', $create_user_fio);
    $smarty->assign('users_data', $administration->getDataUsers());
    $smarty->assign('quiz_data', $administration->getDataQuiz());  
    $smarty->assign('array_one_quiz', $array_one_quiz);
    $smarty->display('templates/administration.tpl');
//    var_dump($administration->getDataUsers());

 }
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
