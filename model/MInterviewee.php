<?php
class MInterviewee {
    private $id_testing;
    private $user;
    private $test;
    private $question;
    private $mark_test;
    private $datetime_start_test;
    private $datetime_end_test;

    public function getUser(){
        return $this->user;
    }
    public function setUser(MUser $user){
        $this->user=$user;
    }
    public function getTest(){
        return $this->test;
    }
    public function setTest(MQuiz $test){
        $this->test=$test;
    }
    public function getIdTesting(){
        return $this->id_testing;
    }
    public function setIdTesting($id_testing){
        $this->id_testing=$id_testing;
    }
    public function getQuestion(){
        return $this->question;
    }
    public function setQuestion(array $question){
        $this->question=$question;
    }
    public function getMarkTest(){
        return $this->mark_test;
    }
    public function setMarkTest($mark_test){
        $this->mark_test=$mark_test;
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
}
?>
