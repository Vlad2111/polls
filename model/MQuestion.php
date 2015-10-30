<?php
class MQuestion {
    private $id_question;
    private $text_question;
    private $id_questions_type;
    private $answer_option=array();//array 
    private $comment_question;
    private $question_number;
    private $id_test;
    private $validation;
    private $weight;
    private $showChart;
    
    
    public function getIdQuestion(){
        return $this->id_question;
    }
    public function setIdQuestion($id_question){
        $this->id_question=$id_question;
    }
    public function getTextQuestion(){
        return $this->text_question;
    }
    public function setTextQuestion($text_question){
        $this->text_question=$text_question;
    }
    public function getIdQuestionsType(){
        return $this->id_questions_type;
    }
    public function setIdQuestionsType($id_questions_type){
        $this->id_questions_type=$id_questions_type;
    }

    public function getAnswerOption(){
        return $this->answer_option;
    }
    public function setAnswerOption($list_answer_option){
        $this->answer_option=$list_answer_option;
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
    public function getValidation(){
        return $this->validation;
    }
    public function setValidation($validation){
        $this->validation=$validation;
    }
    public function getWeight(){
        return $this->weight;
    }
    public function setWeight($weight){
        $this->weight=$weight;
    }
    public function getShowChart(){
        return $this->showChart;
    }
    public function setShowChart($showChart){
        $this->showChart=$showChart;
    }
}
?>
