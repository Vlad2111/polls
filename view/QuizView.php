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
	public $countOfAnswered;
	public $countOfQuestions;
	public $countOfAnswers;
	public $interval;
	public $dateinterval;
    public function __construct($id_testing){
        $this->id_testing = $id_testing;
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
        $this->quizDAO=new QuizDAO();
		$this->admini = new AdministrationDAO();
		$testingDAO = new TestingDAO();
		$answerOptionsDAO=new AnswerOptionsDAO();
		$answerDAO = new AnswerDAO();
        $this->data_test=$this->admini->getObjDataQuiz($id_testing);
//        shuffle($array_question); //Случайный порядок вопросов
        $this->array_question=$this->quizDAO->getObjTestQuestion($id_testing);
		$this->countOfQuestions=count($this->quizDAO->getArrayIdQuestion($id_testing));
		$this->testing=new IntervieweeDAO();
		$this->data_testing=$this->testing->getDataOneTest($id_testing);//////////////////testing
		if(isset($this->data_testing)){
			$this->countOfAnswered=$this->testing->getCountOfAnswered($this->data_testing->getIdTesting());
            $this->countOfAnswers = $testingDAO->getAnswers($this->data_testing->getIdTesting()); 
            $this->interval = $testingDAO->getInterval($this->data_testing->getIdTesting());
            $this->listOfAnswers = $this->testing->getListOfAnswers($this->data_testing);
            $this->colors = $this->testing->getRightAnswers($this->data_testing);
            $this->dateinterval = $testingDAO->getDatetimeEndTest($this->data_testing);
		}
		else {
			$this->countOfAnswered=0;
		}
		$this->answers = array();
		$this->countOfAnswersAboutAllUsers = array();
		foreach($this->array_question as $aq) {
		    $answer = $answerDAO->getAnswersForQuestion($aq->getIdQuestion());
		    if(isset($answer[0])){
		        foreach($answer as $answerId){
		            $answerIds = $answerDAO->getIdAnswer_user($answerId);
		            if(isset($answerIds[0])){
		                foreach($answerIds as $id) {
		                    $answer = $answerDAO->getAnswer($id);
		                    if($this->quizDAO->getObjQuestions($aq->getIdQuestion())->getIdQuestionsType() == 4) {
                                $this->answers[$aq->getIdQuestion()][] = $answer;
                            } else {
                                $this->answers[$aq->getIdQuestion()][] = $answerOptionsDAO->getListObjAnswerOption($answer)->answer_the_questions;
                            }
		                }
		            }
		        }
	        }
		    if(isset($this->answers[$aq->getIdQuestion()])){
		        $this->countOfAnswersAboutAllUsers[$aq->getIdQuestion()] = array_count_values($this->answers[$aq->getIdQuestion()]);
		    }
		}
        $this->button_click = filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    public function startQuiz(){
        $this->testing->statusStartQuiz($this->data_testing, $this->data_test->getTimeLimit());
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
    public function getMarkOfRatingType(){
        $quizDAO = new QuizDAO();
        return $quizDAO->getMarkOfRatingType();
    }
}
