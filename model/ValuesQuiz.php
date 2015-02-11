<?php

class ValuesQuiz {
    // table test
    private $id_quiz;
    private $topic; //тема теста
    private $time_limit=null; // временное ограничение, по-умолчанию null
    private $comment_test=null; // комментарий к тесту
    private $see_the_result='Y'; //просматривание результатов
    private $see_details='Y'; //просматривание детального отчёта
    private $status; //статус теста
    // table questions
    private $id_question;
    private $texts;
    private $type;
    private $answer;
    private $comment_question;
    
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
        $this->see_the_result;
    }
    public function getSeeDetails(){
        return $this->see_details;
    }
    public function setSeeDetails($see_details){
        $this->see_details=$see_details;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
        $this->status=$status;
    }
    public function getIdQuestion(){
        return $this->id_question;
    }
    public function setIdQuestion($id_question){
        $this->id_question=$id_question;
    }
    public function getTexts(){
        return $this->texts;
    }
    public function setTexts($texts){
        $this->texts=$texts;
    }
    public function getType(){
        return $this->type;
    }
    public function setType($type){
        $this->type=$type;
    }
    public function getAnswer(){
        return $this->answer;
    }
    public function setAnswer($answer){
        $this->answer=$answer;
    }
    public function getCommentQuestion(){
        return $this->comment_question;
    }
    public function setCommentQuestion($comment_question){
        $this->comment_question=$comment_question;
    }
}
