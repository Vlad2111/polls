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
    public $data_testing;
	public $data_tes;
    public $array_question;
	public $admini;
	public $inter;
	public $id_testing;
    public function __construct($id_testing){
        $this->id_testing = $id_testing;
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
        $this->testing=new QuizDAO();
		$this->admini = new AdministrationDAO();
        $this->data_test=$this->admini->getObjDataQuiz($id_testing);
        $array_question=$this->testing->getObjTestQuestion($id_testing);
//        shuffle($array_question); //Случайный порядок вопросов
        $this->array_question=$array_question;
		 $this->testing=new IntervieweeDAO();
		$this->data_testing=$this->testing->getDataOneTest($id_testing);//////////////////testing
        $this->button_click = filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);  
    }
    public function startQuiz(){
        $this->testing->statusStartQuiz($this->data_testing);
    }
    public function endQuiz(){
        $this->data_testing=$this->testing->getDataOneTest($this->id_testing);
        $this->testing->statusEndQuiz($this->data_testing);
    }
	public function answerQuestion($answers){
		$boolean = $this->testing->statusNextQuestion($this->data_testing, $answers);
		return $boolean;
	}
	public function skipAllQuestions(){
	    $boolean = "true";
	    while (isset($boolean)) {
		    $boolean = $this->testing->statusNextQuestion($this->data_testing, null);
	    }
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

