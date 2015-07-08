<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'log4php/Logger.php';
include_once 'model/MAnswer.php';
Logger::configure(CheckOS::getConfigLogger());
class AnswerDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    private $testing;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
        $this->testing= new TestingDAO();
    }

    public function setAnswer(MAnswer $manswer){
            $query="insert into answers(id_testing, answer) values
                ($1, $2);"; 
        $array_params=array();
        $array_params[]=$manswer->getIdTesting();
        $array_params[]=$manswer->getAnswer();
        $result=$this->db->execute($query,$array_params);
    }
    public function getIdAnswer($id_testing) {
        $query="select max(id_answer) as id_answer from answers where id_testing=$1;";
        $array_params=array();
        $array_params[]=$id_testing;
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        return $obj->id_answer;
    }
    public function setAnswersAndAnswerUser($id_answer, $id_answer_user){
            $query="insert into answers_answer_user(id_answer, id_answer_user) values
                ($1, $2);"; 
        $array_params=array();
        $array_params[]=$id_answer;
        $array_params[]=$id_answer_user;
        $result=$this->db->execute($query,$array_params);
    }
}
