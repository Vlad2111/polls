<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'Log4php/Logger.php';
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
        $query="INSERT INTO questions(text_question, id_questions_type, comment_question, id_test)
        VALUES ($1, $2, $3, $4);"; 
        $array_params=array();
        $array_params[]=$questions->getTextQuestion();
        $array_params[]=$questions->getIdQuestionsType();
        $array_params[]=$questions->getCommentQuestion();
        $array_params[]=$questions->getIdTest();

        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: questions('.pg_last_error().')'); 
            throw new Exception('Ошибка добавления строки в таблицу: questions('.pg_last_error().')'); 
        }  
    }
    //Обновляет данные в таблице questions
    public function updateQuestion(MQuestion $questions){
        $query="UPDATE questions SET text_question=$1, id_questions_type=$2,"
                . " comment_question=$3, question_number=$4,"
                . " id_test=$5 where id_question=$6;";
        $array_params=array();
        $array_params[]=$questions->getTextQuestion();
        $array_params[]=$questions->getIdQuestionsType();
        $array_params[]=$questions->getCommentQuestion();
        $array_params[]=$questions->getQuestionNumber();       
        $array_params[]=$questions->getIdTest();
        $array_params[]=$questions->getIdQuestion();
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка обновления строки в таблице: questions('.pg_last_error().')'); 
            throw new Exception('Ошибка обновления строки в таблице: questions('.pg_last_error().')'); 
        }   
    }
    //Удаляет вопрос
    public function deleteQuestion(MQuestion $questions){
        $query="DELETE FROM questions WHERE id_question=$1;";
        $array_params=array();
        $array_params[]=$questions->getIdQuestion();
        $result=$this->db->execute($query,$array_params);
        $this->deleteAnswerQuestion($questions);
        $this->deleteOptionAnswer($questions);
        if($result){
            return $result;            
        } 
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: questions('.pg_last_error().')'); 
            throw new Exception('Ошибка удаления строки в таблице: questions('.pg_last_error().')'); 
        }  
    }
    //Возращает список вариантов ответа для вопроса
    public function getArrayIdOptions($id_question){
        $query="select id_answer_option from question_answer_options where id_question=$1;";
        $array_params=array();
        $array_params[]=$id_question;
        $result=$this->db->execute($query,$array_params);
        return $this->db->getArrayData($result);   
    }
    public function getListAnswerOptions($id_question){
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
       
}
?>
