<?php
session_start();
 try{ 
include_once 'view/checkOnPage.php';
include_once 'view/AdministrationView.php';
$id_edit_user="";
$other_data_user="";
$admin_view=new AdministrationView();

$button_click=filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);
$link_click=filter_input(INPUT_GET, 'link_click', FILTER_SANITIZE_SPECIAL_CHARS);
$id_user=filter_input(INPUT_GET, 'id_user', FILTER_SANITIZE_SPECIAL_CHARS);
$type_user=filter_input(INPUT_GET, 'type_user', FILTER_SANITIZE_SPECIAL_CHARS);
$delete_user=filter_input(INPUT_POST, 'delete_user', FILTER_SANITIZE_SPECIAL_CHARS);
$update_user=filter_input(INPUT_POST, 'update_user', FILTER_SANITIZE_SPECIAL_CHARS);

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
    $last_name=filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $first_name=filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);  
    $role_user[]= intval(filter_input(INPUT_POST, 'role_admin', FILTER_SANITIZE_SPECIAL_CHARS));
    $role_user[]= intval(filter_input(INPUT_POST, 'role_author', FILTER_SANITIZE_SPECIAL_CHARS));
    $role_user[]= intval(filter_input(INPUT_POST, 'role_interviewees', FILTER_SANITIZE_SPECIAL_CHARS));
    $admin_view->updateUser($update_user, $last_name, $first_name, $email, $login, $role_user);
}
if ($link_click=='show_quiz'){    
    $view_admin='table_quizs';
}
elseif ($link_click=='new_user'){   
        if($type_user=="internal_user"){
            $view_admin='new_internal_user'; 
        }
        elseif($type_user=="ldap_user"){
            $view_admin='new_ldap_user'; 
        }
        else{
            $view_admin='new_user';            
        }
}
elseif ($link_click=='edit_user'){    
    $view_admin='edit_user';
    $id_edit_user=$id_user;
    $other_data_user= $admin_view->getDataEditUser($id_edit_user);
    
}
else {
    $view_admin='table_users';
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
