<?php
session_start();
 try{ 
include_once 'view/checkOnPage.php';
include_once 'view/AdministrationView.php';
$id_edit_user="";
$other_data_user="";
$view_admin='table_users';
$admin_view=new AdministrationView();

$button_click=filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);
$link_click=filter_input(INPUT_GET, 'link_click', FILTER_SANITIZE_SPECIAL_CHARS);
$id_user=filter_input(INPUT_GET, 'id_user', FILTER_SANITIZE_SPECIAL_CHARS);
$type_user=filter_input(INPUT_GET, 'type_user', FILTER_SANITIZE_SPECIAL_CHARS);
$delete_user=filter_input(INPUT_POST, 'delete_user', FILTER_SANITIZE_SPECIAL_CHARS);
$update_user=filter_input(INPUT_POST, 'update_user', FILTER_SANITIZE_SPECIAL_CHARS);
$deactivate_user=filter_input(INPUT_POST, 'deactivate_user', FILTER_SANITIZE_SPECIAL_CHARS);
$activate_user=filter_input(INPUT_POST, 'activate_user', FILTER_SANITIZE_SPECIAL_CHARS);
$deactivate_quiz=filter_input(INPUT_POST, 'deactivate_quiz', FILTER_SANITIZE_SPECIAL_CHARS);
$activate_quiz=filter_input(INPUT_POST, 'activate_quiz', FILTER_SANITIZE_SPECIAL_CHARS);

if ($button_click=="create_internal_user"){
    $last_name=filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $first_name=filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    $password=filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $role_user[]= intval(filter_input(INPUT_POST, 'role_admin', FILTER_SANITIZE_SPECIAL_CHARS));
    $role_user[]= intval(filter_input(INPUT_POST, 'role_author', FILTER_SANITIZE_SPECIAL_CHARS));
    $role_user[]= intval(filter_input(INPUT_POST, 'role_interviewees', FILTER_SANITIZE_SPECIAL_CHARS));
    $admin_view->createInternalUser($last_name, $first_name, $email, $login, $password, $role_user);
    unset($button_click);
}
if (isset($delete_user) && !empty($delete_user)){
        $admin_view->deleteUser($delete_user);
    }
if (isset($update_user) && !empty($update_user)){
    $id_user=filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name=filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $first_name=filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    $create_new_password=filter_input(INPUT_POST, 'reset_password', FILTER_SANITIZE_SPECIAL_CHARS);
    $new_password=filter_input(INPUT_POST, 'set_new_password', FILTER_SANITIZE_SPECIAL_CHARS);
    $role_user[]= intval(filter_input(INPUT_POST, 'role_admin', FILTER_SANITIZE_SPECIAL_CHARS));
    $role_user[]= intval(filter_input(INPUT_POST, 'role_author', FILTER_SANITIZE_SPECIAL_CHARS));
    $role_user[]= intval(filter_input(INPUT_POST, 'role_interviewees', FILTER_SANITIZE_SPECIAL_CHARS));
    $admin_view->updateUser($id_user, $last_name, $first_name, $email, $login, $role_user, $create_new_password, $new_password);
}

if(isset($deactivate_user)  && !empty($deactivate_user)){
    $id_status_user=$deactivate_user;
    $status=0;
    $admin_view->setStatusUser($id_status_user, $status);
}
if(isset($activate_user)  && !empty($activate_user)){
    $id_status_user=$activate_user;
    $status=1;
    $admin_view->setStatusUser($id_status_user, $status);
}
if(isset($deactivate_quiz)  && !empty($deactivate_quiz)){
    $id_status_quiz=$deactivate_quiz;
    $status=0;
    $admin_view->setStatusQuiz($id_status_quiz, $status);
}
if(isset($activate_quiz)  && !empty($activate_quiz)){
    $id_status_quiz=$activate_quiz;
    $status=1;
    $admin_view->setStatusQuiz($id_status_quiz, $status);
}


//Обработка параметров переданных через GET
if(isset($link_click) && !empty($link_click)){
    if ($link_click=='show_quiz'){    
        $view_admin='table_quizs';
    }
    elseif ($link_click=='new_user' && $type_user=="internal_user"){   
                $view_admin='new_internal_user';         
    }
    elseif ($link_click=='edit_user'){    
        $view_admin='edit_user';
        $id_edit_user=$id_user;
        $other_data_user= $admin_view->getDataEditUser($id_edit_user);    
    }   
}


$title="Меню администратора"; 
$smarty->assign('title', $title);
$smarty->assign('view_admin', $view_admin);
$smarty->assign('users_data', $admin_view->getUsersData());
$smarty->assign('quizs_data', $admin_view->getQuizsData());
$smarty->assign('id_edit_user', $id_edit_user);
$smarty->assign("other_data_user", $other_data_user);
$smarty->display('templates/administration.tpl');

 }
catch (Exception $e){
    $error= $e->getMessage().'. Строка '.$e->getLine().': '. ' ('. $e->getFile().')';
    echo $error;                            
}
?>
