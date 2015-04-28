<?php
class MAuthorQuiz {
    private $id_user;
    private $id_test;
    private $id_mark_test;
    private $datetime_start_test;
    private $datetime_end_test;
    private $id_question;
    private $question_number;
    private $group_ldap;
    
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
    public function getIdMarkTest(){
        return $this->id_mark_test;
    }
    public function setIdMarkTest($id_mark_test){
        $this->id_mark_test=$id_mark_test;
    }
    public function getDatetimeStartTest(){
        return $this->datetime_start_test;
    }
    public function setDatetimeStartTest($datetime_start_test){
        $this->datetime_start_test=$datetime_start_test;
    }
    public function getDatetimeEndTest(){
        return $this->datetime_end_test;
    }
    public function setDatetimeEndTest($datetime_end_test){
        $this->datetime_end_test=$datetime_end_test;
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
    public function getGroupLdap(){
        return $this->group_ldap;
    }
    public function setGroupLdap($group_ldap){
        $this->group_ldap=$group_ldap;
    }
    
}
?>
