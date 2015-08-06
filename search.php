<?php
include_once 'DAO/UserDAO.php';
$user_dao=new UserDAO();
$elements = $user_dao->searchUser($_GET['term']);

$response = array(); 
//while($row = $res->fetch()){
for($i=0;$i<5;$i++){
    $response[] = array(
        'title_ru' => 'dfsd',//$row['title_ru'],
//        'plink' => itemPath('fgdf') //itemPath($row['item_id']) // тут у меня функция формирует ссылку
        /* добавлять можно всё, что угодно. Хоть маму с папой впихнуть ;) */
    );
}
echo json_encode($response);
exit;
