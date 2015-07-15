<?php
class MAnswerUser {
    private $id_answer_users;
    private $id_testing;
    private $id_question;
    private $id_answer_option='null';
    private $answer_user='null';
    private $skip_answer;
    
    public function getIdAnswerUsers(){
        return $this->id_answer_users;
    }
    public function setIdAnswerUsers($id_answer_users){
        $this->id_answer_users=$id_answer_users;
    }
    public function getIdTesting(){
        return $this->id_testing;
    }
    public function setIdTesting($id_testing){
        $this->id_testing=$id_testing;
    }
    public function getIdQuestion(){
        return $this->id_question;
    }
    public function setIdQuestion($id_question){
        $this->id_question=$id_question;
    }
    
    public function getIdAnswerOption(){
        return $this->id_answer_option;
    }
    public function setIdAnswerOption($id_answer_option){
        $this->id_answer_option=$id_answer_option;
    }
    public function getAnswerUser(){
        return $this->answer_user;
    }
    public function setAnswerUser($answer_user){
        $this->answer_user=$answer_user;
    }
    public function getSkipAnswer(){
        return $this->skip_answer;
    }
    public function setSkipAnswer($skip_answer){
        $this->skip_answer=$skip_answer;
    }
}
