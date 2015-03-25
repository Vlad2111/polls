
<?php
session_start();
 try{ 
include_once 'DAO/QuizDAO.php';
include_once 'DAO/AuthorizationDAO.php';
include_once 'model/MAuthorization.php';
include_once 'DAO/QuizDAO.php';     
include_once 'view/AdministrationView.php';
include_once 'model/MUser.php';
include_once 'model/MQuiz.php';
include_once 'lib/smarty_lib/Smarty.class.php';
include_once 'view/Check.php';
$administration=new AdministrationDAO();
$administration_view= new AdministrationView();


        
//Объявляем переменные    
$title="Меню администратора";
$you=$_SESSION['fio_user'];
$exit="Выход";
$name_page='administration';
$role_user=$_SESSION['role_user'];
$create_user_fio='';
$view_admin='';
//Проверяем доступ к странице
    Check::checkRoleUser($role_user, $name_page);
$link_click=filter_input(INPUT_GET, 'link_click', FILTER_SANITIZE_SPECIAL_CHARS);
$button_click=filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name=@$_REQUEST['last_name'];
    $first_name=@$_REQUEST['first_name'];
    $patronymic=@$_REQUEST['patronymic'];
    $role=@$_REQUEST['role'];
    $email=@$_REQUEST['email'];
    $login=@$_REQUEST['login'];
    $password=@$_REQUEST['password'];
    
    $quiz_control=@$_REQUEST['quiz_control'];


if ($button_click==='new_user'){    
    $view_admin='create_user';
}
elseif ($link_click==='show_users'){    
    $view_admin='table_users';
}
elseif ($link_click==='show_quiz'){    
    $view_admin='table_quiz';
}
elseif ($button_click==='delete_quiz'){
    $mquiz=new MQuiz();
    $mquiz->setIdQuiz($_REQUEST['id_delete_quiz']);
        $quiz= new QuizDAO();
        $quiz->deleteQuiz($mquiz);
    $view_admin='table_quiz'; 
    
    /*
     *  if (isset($quiz_control) && !empty($quiz_control)){
            $id_quiz=$quiz_control;
            $array_one_quiz=$administration->getDataOneQuiz($quiz_control);        
            $view_admin='edit_quiz';
            }    
     */
}
elseif (isset($last_name) && !empty($last_name) &&
isset($first_name) && !empty($first_name) &&   
isset($patronymic) && !empty($patronymic) &&
isset($role) && !empty($role)){    
    $user=new MUser();
    $user->setFirstName($first_name);
    $user->setLastName($last_name);
    $user->setPatronymic($patronymic);
    $user->setIdRole($role);
    $user->setEmail($email);
    $user->setLogin($login);
    $user->setPassword($password);
    $administration_view->addUser($user);
    $create_user_fio=$last_name." ".$first_name." ".$patronymic;
    $view_admin='create_user_info';
}
//elseif (@$_REQUEST['delete_one_quiz']=='ok'){
//    $mquiz=new MQuiz();
//    $mquiz->setIdQuiz($_REQUEST['delete_quiz_id']);
//    $administration_view->deleteQuiz($mquiz);
//    $view_admin='table_quiz';
//}
elseif ($link_click==='exit'){
        $_SESSION=array();
        session_destroy();
        header('HTTP/1.1 200 OK');
        header('Location: authorization.php');
        exit();
}

$smarty= new Smarty();

    $smarty->assign('title', $title);
    $smarty->assign('view_admin', $view_admin);
    $smarty->assign('you', $you);
    $smarty->assign('exit', $exit);
    $smarty->assign('create_user_fio', $create_user_fio);
    $smarty->assign('users_data', $administration->getDataUsers());
    $smarty->assign('quiz_data', $administration->getDataQuiz());
    $smarty->assign('name_page', $name_page);
    $smarty->assign('role_user',$role_user);
    
    $smarty->display('templates/administration.tpl');
//    var_dump($administration->getDataUsers());

 }
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
