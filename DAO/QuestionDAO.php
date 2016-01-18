<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'log4php/Logger.php';
include_once 'model/MAnswerOptions.php';
Logger::configure(CheckOS::getConfigLogger());
class QuestionDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
    }
       //Создаёт описание теста в таблице questions
    public function createQuestion(MQuestion $questions){
        try {
            $query="INSERT INTO questions(text_question, id_questions_type, comment_question, question_number, id_test, validation, " 
                    . "weight, show_chart) VALUES ($1, $2, $3, $4, $5, $6, $7, $8);"; 
            $array_params=array();
            $array_params[]=$questions->getTextQuestion();
            $array_params[]=$questions->getIdQuestionsType();
            $array_params[]=$questions->getCommentQuestion();
            $array_params[]=$questions->getQuestionNumber();
            $array_params[]=$questions->getIdTest();
            $array_params[]=$questions->getValidation();
            $array_params[]=$questions->getWeight();
            $array_params[]=$questions->getShowChart();
            $this->db->executeAsync($query,$array_params);
            $result=$this->setIdQuestion($questions); 
            if($result){            
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка добавления строки в таблицу: questions '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    //Обновляет данные в таблице questions
    public function updateQuestion(MQuestion $questions) {
        try {
            $query="UPDATE questions SET text_question=$1, id_questions_type=$2,"
                    . " comment_question=$3, question_number=$4,"
                    . " id_test=$5, validation=$6, weight=$7, show_chart=$8 where id_question=$9;";
            $array_params=array();
            $array_params[]=$questions->getTextQuestion();
            $array_params[]=$questions->getIdQuestionsType();
            $array_params[]=$questions->getCommentQuestion();
            $array_params[]=$questions->getQuestionNumber();       
            $array_params[]=$questions->getIdTest();
            $array_params[]=$questions->getValidation();
            $array_params[]=$questions->getWeight();
            $array_params[]=$questions->getShowChart();
            $array_params[]=$questions->getIdQuestion();
            $result=$this->db->executeAsync($query,$array_params);
            $result=$this->setIdQuestion($questions); 
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления строки в таблице: questions '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    //Удаляет вопрос
    public function deleteQuestion(MQuestion $questions) {
        try {
            $query="DELETE FROM questions WHERE id_question=$1;";
            $array_params=array();
            $array_params[]=$questions->getIdQuestion();
            $result=$this->db->executeAsync($query,$array_params);
            if($result){
                return $result;            
            }
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка удаления строки в таблице: questions '.$e->getMessage().$e->getTraceAsString());
        }  
    }
    //Возращает список вариантов ответа для вопроса
    public function getArrayIdOptions($id_question) {
        try {
            $query="select id_answer_option from answer_options where id_question=$1;";
            $array_params=array();
            $array_params[]=$id_question;
            $result=$this->db->executeAsync($query,$array_params);
            return $this->db->getArrayData($result); 
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения списка вариантов ответа на вопрос '.$e->getMessage().$e->getTraceAsString());
        }    
    }
    public function getListAnsweOptions($id_question) {
        try {
            $array_data=array();
            $id_answer_option=$this->getArrayIdOptions($id_question);        
            $query="select answer_the_questions from answer_options where id_answer_option=$1;";
            for ($i=0; $i<count($id_answer_option); $i++){
                $array_params=array();
                $array_params[]=$id_answer_option[$i];
                $result=$this->db->executeAsync($query,$array_params);
                $array_data[]=$this->db->getArrayData($result);
            }
            return $array_data;    
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения списка ответа на вопрос '.$e->getMessage().$e->getTraceAsString());
        }
    }
	
	public function getListAnswerOptions($id_quiz){
        $result=array();
        $array_id_option=$this->getArrayIdOptions($id_quiz);
        for($i=0; $i<count($array_id_option); $i++){
            if(isset($array_id_option[$i])){
                $result[$i]=$this->getObjOptions($array_id_option[$i]);
            }
        }
        return $result;
    }
		
    //Возращает информацию об вопросе типи MQuestion     
    public function getObjOptions($id_answer_option) {
        try {
            $query="select * from answer_options where id_answer_option=$1;";
            $array_params=array();
            $array_params[]=$id_answer_option;
            $result=$this->db->executeAsync($query,$array_params);
            $obj_status= $this->db->getFetchObject($result);
            $manswer=new MAnswerOptions();
            $manswer->setIdAnswerOption($obj_status->id_answer_option);
            $manswer->setAnswerTheQuestions($obj_status->answer_the_questions);
            $manswer->setRightAnswer($obj_status->right_answer);
            $manswer->setIdQuestion($obj_status->id_question);
            return $manswer;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения информацию об вопросе '.$e->getMessage().$e->getTraceAsString());
        }
    }
       
    public function setIdQuestion(MQuestion $questions){
        /*$query="select id_question from questions where "
                . "text_question=$1 and id_questions_type=$2 and id_test=$3;";
        $array_params=array();
        $array_params[]=$questions->getTextQuestion();
        $array_params[]=$questions->getIdQuestionsType();
        $array_params[]=$questions->getIdTest();
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        $questions->setIdQuestion($obj->id_question);
        return $obj->id_question;*/
        try {
            $query="select max(id_question) from questions where "
                    . "text_question=$1 and id_questions_type=$2 and id_test=$3;";
            $array_params=array();
            $array_params[]=$questions->getTextQuestion();
            $array_params[]=$questions->getIdQuestionsType();
            $array_params[]=$questions->getIdTest();
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            $questions->setIdQuestion($obj->max);
            return $obj->max;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения id вопросa '.$e->getMessage().$e->getTraceAsString());
        }
    } 
    public function getIdQuestionType($id_question) {
        try {
            $query="select id_questions_type from questions where id_question=$1;";
            $array_params=array();
            $array_params[]=$id_question;
            $result=$this->db->executeAsync($query,$array_params);
            $obj=$this->db->getFetchObject($result);
            return $obj->id_questions_type;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения id_question_type вопросa '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getQuestionType() {
        try {
            $query="select description_questions_type from type_the_questions";
            $array_params=array();
            $result=$this->db->executeAsync($query);
            $obj=$this->db->getArrayData($result);
            return $obj;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения description_questions_type вопросa '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function upQuestion($id_question, $first, $second) {
        try {
            $query="UPDATE questions SET question_number=(CAST($2 AS float)+CAST($3 AS float))/2  where id_question=$1";
            $array_params=array();
            $array_params[]=$id_question;
            $array_params[]=$first;
            $array_params[]=$second;
            $result=$this->db->executeAsync($query, $array_params);
            return $result;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка обновления порядка вопроса '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getNextQuestionNumber($id_quiz) {
        try {
            $query="Select ceil(max(question_number)) from questions where id_test=$1";
            $array_params=array();
            $array_params[]=$id_quiz;
            $result=$this->db->executeAsync($query, $array_params);
            $obj=$this->db->getFetchObject($result);
            return $obj->ceil;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения следующего вопроса '.$e->getMessage().$e->getTraceAsString());
        }
    }
    public function getQuestionNumber($id_question) {
        try {
            $query="Select question_number from questions where id_question=$1";
            $array_params=array();
            $array_params[]=$id_question;
            $result=$this->db->executeAsync($query, $array_params);
            $obj=$this->db->getFetchObject($result);
            return $obj->question_number;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения номера порядка вопроса '.$e->getMessage().$e->getTraceAsString());
        }
    }
    
    public function getRate($text) {
        try {
            $query="Select rate from mark_type_rating where text=$1";
            $array_params=array();
            $array_params[]=$text;
            $result=$this->db->executeAsync($query, $array_params);
            $obj=$this->db->getFetchObject($result);
            return $obj->rate;
        }          
        catch(Exception $e) { 
            $this->log->ERROR('Ошибка получения rate '.$e->getMessage().$e->getTraceAsString());
        }
    }
}
?>
