<?php
class MQuestions {
    private $id_question;
    private $texts;
    private $id_answer_type;
    private $id_answer_the_questions;
    private $comment_question;
    private $answer_the_questions;
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
    public function getIdAnswerType(){
        return $this->$id_answer_type;
    }
    public function setIdAnswerType($id_answer_type){
        $this->id_answer_type=$id_answer_type;
    }
    public function getIdAnswerTheQuestions(){
        return $this->id_answer_the_questions;
    }
    public function setIdAnswerTheQuestions($id_answer_the_questions){
        $this->id_answer_the_questions=$id_answer_the_questions;
    }
    public function getCommentQuestion(){
        return $this->comment_question;
    }
    public function setCommentQuestion($comment_question){
        $this->comment_question=$comment_question;
    }
    public function getAnswerTheQuestions(){
        return $this->answer_the_questions;
    }
    public function setAnswerTheQuestions($answer_the_questions){
        $this->answer_the_questions=$answer_the_questions;
    }
}
?>
