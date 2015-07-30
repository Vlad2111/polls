<?php
include_once 'DAO/UserDAO.php';
$user_dao=new UserDAO();
$elements = $user_dao->searchUser($_GET['term']);
$s = "[".implode(",", $elements)."]";
echo $s;
