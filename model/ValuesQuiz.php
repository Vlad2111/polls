<?php

class ValuesQuiz {
    public $id_quiz="nextval('id_test')";
    public $topic; //тема теста
    public $time_limit='null'; // временное ограничение, по-умолчанию null
    public $comment_test='null'; // комментарий к тесту
    public $see_the_result='Y'; //просматривание результатов
    public $see_details='Y'; //просматривание детального отчёта
    public $status; //статус теста
    public $id_question="NEXTVAL('id_question')";
    public $texts;
    public $type;
    public $answer;
    public $comment_question;    
}
