<?php
include_once 'DAO/IntervieweeDAO.php';
include_once 'DAO/QuizDAO.php';
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
    Logger::configure('setting/config.xml');
class QuizView {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    private $testing;
    private $data_testing;
    private $array_question;
    public function __construct($id_testing){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
        $this->testing=new IntervieweeDAO();
        $this->data_testing=$this->testing->getDataOneTesting($id_testing);
        $array_question=$this->data_testing->getQuestion();
//        shuffle($array_question); //Случайный порядок вопросов
        $this->array_question=$array_question;
    }
    public function startQuiz(){
        $this->testing->statusStartQuiz($this->data_testing);
    }
    public function endQuiz(){
        $this->testing->statusEndQuiz($this->data_testing);
    }
    public function takinPassing($id_question='null'){
        if($this->testing->checkTime($this->data_testing) ){
            if ($id_question=='null')
            {
                $i=0;
            $id_question=$this->array_question[$i]->getIdQuestion();   
            
            }
            else{
                $i= $this->getIQuestion($id_question);
                
            }
            $this->testing->setMarker($this->data_testing->getIdTesting(), $id_question);
            return $this->array_question[$i];
        }
        else {
            $this->endQuiz();
        }
    }
    public function nextQuestion($id_question, $id_answer_option='null', $answer_user='null'){
        $manswer_user=new MAnswerUser();
        $manswer_user->setAnswerUser($answer_user);
        $manswer_user->setIdAnswerOption($id_answer_option);
        $manswer_user->setIdQuestion($id_question);
        $manswer_user->setIdTesting($this->data_testing->getIdTesting());
        $this->testing->removeMarker($this->data_testing->getIdTesting(), $id_question);
        $this->testing->answerTheQuestion($manswer_user);
        $i_now= $this->getIQuestion($id_question);
        count($this->array_question);        
        if ($i<count($this->array_question)){
            return $this->array_question[$i+1];
        }
        else{
            $this->endQuiz();
        }
    }
    private function getIQuestion($id_question){
        foreach ($this->array_question as $key => $value) {
                    $value->getIdQuestion();
                    if ($value->getIdQuestion()==$id_question){
                        return $key;
                    }       
        }
    }
    public function getTesting(){
        return $this->data_testing;
    }
}
