<?php
class MAnswerOptions {
    private $id_answer_option;
    private $answer_the_questions;
    private $right_answer;
    private $id_question;
    
    public function getIdAnswerOption(){
        return $this->id_answer_option;
    }
    public function setIdAnswerOption($id_answer_option){
        $this->id_answer_option=$id_answer_option;
    }
    public function getAnswerTheQuestions(){
        return $this->answer_the_questions;
    }
    public function setAnswerTheQuestions($answer_the_questions){
        $this->answer_the_questions=$answer_the_questions;
    }
    public function getRightAnswer(){
        return $this->right_answer;
    }
    public function setRightAnswer($right_answer){
        $this->right_answer=$right_answer;
    }
    public function getIdQuestion(){
        return $this->id_question;
    }
    public function setIdQuestion($id_question){
        $this->id_question=$id_question;
    }
}
