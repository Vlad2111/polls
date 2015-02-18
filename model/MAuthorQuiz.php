<?php
class MAuthorQuiz {
    private $id_user;
    private $id_test;
    private $id_role;
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
    public function getIdRole(){
        return $this->id_role;
    }
    public function setIdRole($id_role){
        $this->id_role=$id_role;
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
