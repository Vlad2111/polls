<?php

class MQuiz {
    // table test
    private $id_quiz;
    private $topic; //тема теста
    private $time_limit=null; // временное ограничение, по-умолчанию null
    private $comment_test=null; // комментарий к тесту
    private $see_the_result='Y'; //просматривание результатов
    private $see_details='Y'; //просматривание детального отчёта
    private $id_status_quiz; //статус теста
    private $author_test; //инстанс MUser
    private $vasibility_test;
    private $date_create;
    
    public function getIdQuiz(){
        return $this->id_quiz;
    }
    public function setIdQuiz($id_quiz){
        $this->id_quiz= $id_quiz;
    }
    public function getTopic(){
        return $this->topic;
    }
    public function setTopic($topic){
        $this->topic=$topic;
    }
    public function getTimeLimit(){
        return $this->time_limit;
    }
    public function setTimeLimit($time_limit){
        $this->time_limit=$time_limit;
    }
    public function getCommentQuiz(){
        return $this->comment_test;
    }
    public function setCommentQuiz($comment_test){
        $this->comment_test=$comment_test;
    }
    public function getSeeTheResult(){
        return $this->see_the_result;
    }
    public function setSeeTheResult($see_the_result){
        $this->see_the_result=$see_the_result;
    }
    public function getSeeDetails(){
        return $this->see_details;
    }
    public function setSeeDetails($see_details){
        $this->see_details=$see_details;
    }
    public function getIdStatusQuiz(){
        return $this->id_status_quiz;
    }
    public function setIdStatusQuiz($id_status_quiz){
        $this->id_status_quiz=$id_status_quiz;
    }
    public function getAuthorTest(){
        return $this->author_test;
    }
    public function setAuthorTest(MUser $author_test){
        $this->author_test=$author_test;
    }
    public function getVasibilityTest(){
        return $this->vasibility_test;
    }
    public function setVasibilityTest($vasibility_test){
        $this->vasibility_test=$vasibility_test;
    }
    public function getDateCreate(){
        return $this->date_create;
    }
    public function setDateCreate($date_create){
        $this->date_create=$date_create;
    }
}
