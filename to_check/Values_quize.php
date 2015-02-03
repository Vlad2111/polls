<?php
class Values_quize {  
    public $id_quize="nextval('id')";
    public $topic; //тема теста
    public $time_limit='null'; // временное ограничение, по-умолчанию null
    public $comment='null'; // комментарий к тесту
    public $see_the_result='Y'; //просматривание результатов
    public $see_details='Y'; //просматривание детального отчёта
    public $status; //статус теста
    
}
