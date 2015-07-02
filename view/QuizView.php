<?php
include_once 'DAO/IntervieweeDAO.php';
include_once 'DAO/QuizDAO.php';
include_once 'lib/DB.php';
include_once 'log4php/Logger.php';
    Logger::configure('setting/config.xml');
class QuizView {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    private $testing;
    private $question;
    public $data_testing;
    public $array_question;
    public $minterwee;
    private $dataM;
    public function __construct($id_testing){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
        //$this->testing=new IntervieweeDAO();
        //$this->data_testing=$this->testing->getDataOneTesting($id_testing);
	$this->testing=new AdministrationDAO();
	$this->question = new QuizDAO();
	$this->data_testing=$this->testing->getObjDataQuiz($id_testing);
	$array_question = $this->question->getObjTestQuestion($id_testing);
       // $array_question=$this->getArrayQuestions();
	//$array_question=$this->data_testing->getQuestion();
//        shuffle($array_question); //Случайный порядок вопросов
        $this->array_question=$array_question;
	$this->testing=new IntervieweeDAO();
	$this->minterwee = new IntervieweeDAO();
	$this->dataM = $this->minterwee->setMInterviewee($id_testing);
    }
    public function startQuiz(){
        $this->testing->statusStartQuiz($this->dataM);
    }
    public function endQuiz(){
        $this->testing->statusEndQuiz($this->dataM);
    }
    public function getArrayQuestions(){
        $data_questions=array();
        $temp_array_question=$this->array_question;
        for($i=0; $i<count($this->array_question); $i++){
            $data_questions[$i]['number']=$i+1;
            $data_questions[$i]['data_questions']=$temp_array_question[$i];            
        }
        return $data_questions;
    }
}
