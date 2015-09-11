<?php
include_once 'DAO/UserDAO.php';
include_once 'LdapOperations.php';
$adm = new AdministrationDAO();
$user_dao=new UserDAO();
$ldapOperations=new LdapOperations();

if($_POST[ 'field']=="user"){
    $elements = $user_dao->searchUser($_POST['keyword']);
    $ldapOperations->connect();
    $ldap_users = $ldapOperations->getLDAPAccountNamesByPrefix($_POST['keyword']);
    //$result = array_merge($elements ,$ldap_users);
    $result = $ldap_users;
    foreach($elements as $elem) {
        array_push($result, array('name'=>$elem->getLogin(), 'sAMAccountName'=>$elem->getLogin(), 'sn'=>$elem->getLastName(), 'givenName'=>$elem->getFirstName(), 'mail'=>$elem->getEmail()));
    }

    foreach ($result as $rs) {
	    // put in bold the written text
	    $country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['sAMAccountName']);
	    // add new option
        echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['sAMAccountName']).'\')">'.$country_name.'</li>';
    }
}

if($_POST[ 'field']=="group"){
    $ldapOperations->connect();
    $ldap_users = $ldapOperations->getLDAPGroupNamesByPrefix($_POST['keyword']);
    //$result = array_merge($elements ,$ldap_users);
    $result = $ldap_users;
    //var_dump($result);

    foreach ($result as $rs) {
	    // put in bold the written text
	    $country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['sAMAccountName']);
	    if(strlen($country_name) > 40){
	        $country_name = substr($country_name, 0, 40);
	        $country_name = $country_name.'...';
	    }
	    // add new option
        echo '<li onclick="set_item_group(\''.str_replace("'", "\'", $rs['sAMAccountName']).'\')">'.$country_name.'</li>';
    }
}
exit;

