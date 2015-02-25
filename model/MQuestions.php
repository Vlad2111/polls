<?php
class MQuestions {
    private $id_question;
    private $texts;
    private $id_questions_type;
    private $id_answer_the_questions;
    private $comment_question;
    private $question_number;
    private $id_test;
    private $answer_the_question;
    
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
    public function getIdQuestionsType(){
        return $this->$id_questions_type;
    }
    public function setIdQuestionsType($id_questions_type){
        $this->id_questions_type=$id_questions_type;
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
    public function getQuestionNumber(){
        return $this->question_number;
    }
    public function setQuestionNumber($question_number){
        $this->question_number=$question_number;
    }
    public function getIdTest(){
        return $this->id_test;
    }
    public function setIdTest($id_test){
        $this->id_test=$id_test;
    }
    public function getAnswerTheQuestion(){
        return $this->answer_the_question;
    }
    public function setAnswerTheQuestion($answer_the_question){
        $this->answer_the_question=$answer_the_question;
    }
}
?>
