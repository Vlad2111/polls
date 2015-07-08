<?php
class MAnswer {
    private $id_answer;
    private $answer='null';
    private $id_testing;
    
    public function getIdAnswer(){
        return $this->id_answer;
    }
    public function setIdAnswer($id_answer){
        $this->id_answer=$id_answer;
    }
    public function getAnswer(){
        return $this->answer;
    }
    public function setAnswer($answer){
        $this->answer=$answer;
    }
    public function getIdTesting(){
        return $this->id_testing;
    }
    public function setIdTesting($id_testing){
        $this->id_testing=$id_testing;
    }
}
?>
