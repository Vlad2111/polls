<?php
class MInterviewee {
    private $id_user;
    private $id_test;
    private $id_testing;
    private $id_question;
    private $question_number;
    
    public function getIdUser(){
        return $this->id_user;
    }
    public function setIdUser($id_user){
        $this->id_user=$id_user;
    }
    public function getIdTest(){
        return $this->id_test;
    }
    public function setIdTest($id_test){
        $this->id_test=$id_test;
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
    public function getQuestionNumber(){
        return $this->question_number;
    }
    public function setQuestionNumber($question_number){
        $this->question_number=$question_number;
    }
}
?>
