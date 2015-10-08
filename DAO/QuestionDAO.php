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
        $query="INSERT INTO questions(text_question, id_questions_type, comment_question, question_number, id_test, validation)
        VALUES ($1, $2, $3, $4, $5, $6);"; 
        $array_params=array();
        $array_params[]=$questions->getTextQuestion();
        $array_params[]=$questions->getIdQuestionsType();
        $array_params[]=$questions->getCommentQuestion();
        $array_params[]=$questions->getQuestionNumber();
        $array_params[]=$questions->getIdTest();
        $array_params[]=$questions->getValidation();
        $this->db->execute($query,$array_params);
        $result=$this->setIdQuestion($questions); 
        if($result){            
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: questions('.pg_last_error().')'); 
//            throw new Exception('Ошибка добавления строки в таблицу: questions('.pg_last_error().')'); 
        }  
    }
    //Обновляет данные в таблице questions
    public function updateQuestion(MQuestion $questions){
        $query="UPDATE questions SET text_question=$1, id_questions_type=$2,"
                . " comment_question=$3, question_number=$4,"
                . " id_test=$5, validation=$6 where id_question=$7;";
        $array_params=array();
        $array_params[]=$questions->getTextQuestion();
        $array_params[]=$questions->getIdQuestionsType();
        $array_params[]=$questions->getCommentQuestion();
        $array_params[]=$questions->getQuestionNumber();       
        $array_params[]=$questions->getIdTest();
        $array_params[]=$questions->getValidation();
        $array_params[]=$questions->getIdQuestion();
        $result=$this->db->execute($query,$array_params);
        $result=$this->setIdQuestion($questions); 
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: questions('.pg_last_error().')'); 
//            throw new Exception('Ошибка обновления строки в таблице: questions('.pg_last_error().')'); 
        }   
    }
    //Удаляет вопрос
    public function deleteQuestion(MQuestion $questions){
        $query="DELETE FROM questions WHERE id_question=$1;";
        $array_params=array();
        $array_params[]=$questions->getIdQuestion();
        $result=$this->db->execute($query,$array_params);
//        $this->deleteAnswerQuestion($questions);
//        $this->deleteOptionAnswer($questions);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: questions('.pg_last_error().')'); 
//            throw new Exception('Ошибка удаления строки в таблице: questions('.pg_last_error().')'); 
        }  
    }
    //Возращает список вариантов ответа для вопроса
    public function getArrayIdOptions($id_question){
        $query="select id_answer_option from answer_options where id_question=$1;";
        $array_params=array();
        $array_params[]=$id_question;
        $result=$this->db->execute($query,$array_params);
        return $this->db->getArrayData($result);   
    }
    public function getListAnsweOptions($id_question){
        $array_data=array();
        $id_answer_option=$this->getArrayIdOptions($id_question);        
        $query="select answer_the_questions from answer_options where id_answer_option=$1;";
        for ($i=0; $i<count($id_answer_option); $i++){
            $array_params=array();
            $array_params[]=$id_answer_option[$i];
            $result=$this->db->execute($query,$array_params);
            $array_data[]=$this->db->getArrayData($result);
        }
        return $array_data;    
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
   public function getObjOptions($id_answer_option){
       $query="select * from answer_options where id_answer_option=$1;";
       $array_params=array();
        $array_params[]=$id_answer_option;
        $result=$this->db->execute($query,$array_params);
        $obj_status= $this->db->getFetchObject($result);
        $manswer=new MAnswerOptions();
        $manswer->setIdAnswerOption($obj_status->id_answer_option);
        $manswer->setAnswerTheQuestions($obj_status->answer_the_questions);
        $manswer->setRightAnswer($obj_status->right_answer);
        $manswer->setIdQuestion($obj_status->id_question);
        return $manswer;
   }
       
    public function setIdQuestion(MQuestion $questions){
        $query="select id_question from questions where "
                . "text_question=$1 and id_questions_type=$2 and id_test=$3;";
        $array_params=array();
        $array_params[]=$questions->getTextQuestion();
        $array_params[]=$questions->getIdQuestionsType();
        $array_params[]=$questions->getIdTest();
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        $questions->setIdQuestion($obj->id_question);
        return $obj->id_question;
    } 
    public function getIdQuestionType($id_question) {
        $query="select id_questions_type from questions where id_question=$1;";
        $array_params=array();
        $array_params[]=$id_question;
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        return $obj->id_questions_type;
    }
    public function getQuestionType() {
        $query="select description_questions_type from type_the_questions";
        $array_params=array();
        $result=$this->db->execute($query);
        $obj=$this->db->getArrayData($result);
        return $obj;
    }
    public function upQuestion($id_question, $first, $second) {
        $query="UPDATE questions SET question_number=(CAST($2 AS float)+CAST($3 AS float))/2  where id_question=$1";
        $array_params=array();
        $array_params[]=$id_question;
        $array_params[]=$first;
        $array_params[]=$second;
        $result=$this->db->execute($query, $array_params);
        return $result;
    }
    public function getNextQuestionNumber($id_quiz) {
        $query="Select ceil(max(question_number)) from questions where id_test=$1";
        $array_params=array();
        $array_params[]=$id_quiz;
        $result=$this->db->execute($query, $array_params);
        $obj=$this->db->getFetchObject($result);
        return $obj->ceil;
    }
    public function getQuestionNumber($id_question) {
        $query="Select question_number from questions where id_question=$1";
        $array_params=array();
        $array_params[]=$id_question;
        $result=$this->db->execute($query, $array_params);
        $obj=$this->db->getFetchObject($result);
        return $obj->question_number;
    }
    
    public function getRate($text) {
        $query="Select rate from mark_type_rating where text=$1";
        $array_params=array();
        $array_params[]=$text;
        $result=$this->db->execute($query, $array_params);
        $obj=$this->db->getFetchObject($result);
        return $obj->rate;
    }
}
?>
