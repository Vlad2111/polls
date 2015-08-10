<?php
include_once 'DAO/UserDAO.php';
$adm = new AdministrationDAO();
$user_dao=new UserDAO();
$elements = $user_dao->searchUser($_POST['keyword']);
$response = array(); 
//while($row = $res->fetch()){
//for($i=0;$i<count($elements);$i++){
  //  $response[] = array(
    //    'login' => $elements[$i]->getLogin(),//$row['title_ru'],
//        'plink' => itemPath('fgdf') //itemPath($row['item_id']) // тут у меня функция формирует ссылку
        /* добавлять можно всё, что угодно. Хоть маму с папой впихнуть ;) */
    //);
//}
//echo json_encode($response);
foreach ($elements as $rs) {
	// put in bold the written text
	$country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs->getLogin());
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs->getLogin()).'\')">'.$country_name.'</li>';
}
exit;

