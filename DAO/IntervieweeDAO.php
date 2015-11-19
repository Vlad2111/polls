<?php
include_once 'lib/CheckOS.php';
include_once 'lib/DB.php';
include_once 'model/MInterviewee.php';
include_once 'AdministrationDAO.php';
include_once 'QuizDAO.php';
include_once 'DAO/AuthorQuizDAO.php';
include_once 'log4php/Logger.php';
include_once 'DAO/TestingDAO.php';
include_once 'DAO/AnswerDAO.php';
include_once 'DAO/QuestionDAO.php';
include_once 'DAO/AnswerOptionsDAO.php';
include_once 'model/MAnswer.php';
Logger::configure(CheckOS::getConfigLogger());
class IntervieweeDAO {
    protected $db;
    protected $log;
    protected $nameclass=__CLASS__;
    private $testing;
    public function __construct(){
        $this->db=DB::getInstance();
        $this->log= Logger::getLogger($this->nameclass);
        $this->testing= new TestingDAO();
    }
    // Начать тест: обновить статус теста,
    public function statusStartQuiz(MInterviewee $interviewee, $interval){
        $return=$this->testing->createTesting($interviewee, 2);
        $this->testing->setDatetimeStartTest($interviewee, date("Y-m-d H:i:s"));
        $time = $this->testing->getDatetimeStartTest($interviewee);
        $timer = new DateTime($time);
        $a = split ( ':' , $interval, -1 );
        if(isset($a[0])){
            $timer->modify('+'.$a[0].' hour +'.$a[1].' minute +'.$a[2].' second');
        }
        if(isset($interval)) {
            $this->testing->setDatetimeEndTest($interviewee, $timer->format("Y-m-d H:i:s"));
        }
        $this->setMarker($interviewee->getIdTesting(), $this->getNextQuestion($interviewee->getTest()->getIdQuiz(), 0));
        return $return;
    }
    //Закончить тест
    public function statusEndQuiz(MInterviewee $interviewee){
        $this->testing->setDatetimeEndTest($interviewee, date("Y-m-d H:i:s"));
        $this->testing->editMarkTest($interviewee, 4);
        $result = $this->getCountofRightAnswers($interviewee);
        $this->testing->setAnswers($interviewee, $result);
        $this->testing->setInterval($interviewee->getIdTesting());
    }
    public function getCountofRightAnswers(MInterviewee $interviewee){
        $manswer = new AnswerDAO();
        $answeroption = new AnswerOptionsDAO();
        $quiz = new QuizDAO();
        $que = new QuestionDAO();
        $answers = $manswer->getAnswersForTesting($interviewee->getIdTesting());
        $result=array();
        $result['wrong']=0;
        $result['right']=0;
        $result['skip']=0;
        $result['unvalidated']=0;
        $array_id_question=$quiz->getArrayIdQuestion($interviewee->getTest()->getIdQuiz());
        for($i=0; $i<count($array_id_question); $i++){
            if(isset($answers[$array_id_question[$i]])){
                for($j=0; $j<count($answers[$array_id_question[$i]]); $j++){
                    $flag = true;
                    if(isset($answers[$array_id_question[$i]][$j])){
                        if($que->getIdQuestionType($array_id_question[$i]) != 4 && $que->getIdQuestionType($array_id_question[$i]) != 5){
                            $obj=$answeroption->getRightAnswerOptions($answers[$array_id_question[$i]][$j]);
                            if($obj != ''){
                                if($obj == 'Y'){
                                    $flag = true;
                                }
                                else {
                                    $flag = false;
                                }
                                if($j==count($answers[$array_id_question[$i]])-1) {
                                    $countOfRight = $answeroption->getCountOfRightAnswers($array_id_question[$i]);
                                    if($flag && $countOfRight == count($answers[$array_id_question[$i]])) {
                                        $result['right']++;
                                    }
                                    else {
                                        $result['wrong']++;
                                    }
                                }
                            }
                            else {
                                $result['unvalidated']++;
                            }
                        }
                        else {
                            $result['unvalidated']++;
                        }
                    }
                    else {
                        $result['skip']++;
                    }
                }
            }
        }
        return $result;
    }
    public function getRightAnswers(MInterviewee $interviewee){
        $manswer = new AnswerDAO();
        $answeroption = new AnswerOptionsDAO();
        $quiz = new QuizDAO();
        $que = new QuestionDAO();
        $answers = $manswer->getAnswersForTesting($interviewee->getIdTesting());
        $result=array();
        $array_id_question=$quiz->getArrayIdQuestion($interviewee->getTest()->getIdQuiz());
        for($i=0; $i<count($array_id_question); $i++){
            if(isset($answers[$array_id_question[$i]])) {
                for($j=0; $j<count($answers[$array_id_question[$i]]); $j++){
                    $flag = true;
                    if(isset($answers[$array_id_question[$i]][$j])){
                        if($que->getIdQuestionType($array_id_question[$i]) != 4 && $que->getIdQuestionType($array_id_question[$i]) != 5){
                            $obj=$answeroption->getRightAnswerOptions($answers[$array_id_question[$i]][$j]);
                            if($obj != ''){
                                if($obj == 'Y') {
                                    $flag = true;
                                } else {
                                    $flag = false;
                                }
                                if($j==count($answers[$array_id_question[$i]])-1) {
                                   $countOfRight = $answeroption->getCountOfRightAnswers($array_id_question[$i]);
                                    if($flag && $countOfRight == count($answers[$array_id_question[$i]])) {
                                        $result[$array_id_question[$i]]['value'] = 'success';
                                    } else {
                                        $result[$array_id_question[$i]]['value'] = 'danger';
                                    }
                                }
                            }
                        }
                    } else {
                        $result[$array_id_question[$i]]['value'] = 'warning';
                    }
                }
            }
            
        }
        return $result;
    }
    public function getListOfAnswers(MInterviewee $interviewee){
        $manswer = new AnswerDAO();
        $answeroption = new AnswerOptionsDAO();
        $quiz = new QuizDAO();
        $que = new QuestionDAO();
        $answers = $manswer->getAnswersForTesting($interviewee->getIdTesting());
        return $answers;
    }
    
//    // Прервать тест
//    public function interruptTheQuiz(MInterviewee $interviewee){        
//        $this->testing->editMarkTest($interviewee, 2);
//    }
    //Продолжить тест
    public function statusContinueTheQuiz(MInterviewee $interviewee){
        return $this->getMarker($interviewee);
    }
	
	public function statusNextQuestion(MInterviewee $interviewee, $answers){
	    $answer = new AnswerDAO();
	    $manswer = new MAnswer();
        $que = new QuestionDAO();
		$skipFlag = true;
		for ( $i=0; $i < count($answers); $i++){
		    $manswer->setIdTesting($interviewee->getIdTesting());
		    $manswer->setAnswer($answers[$i]);
		    $answer->setAnswer($manswer);
		    $answer->setAnswersAndAnswerUser($answer->getIdAnswer($interviewee->getIdTesting()), $this->getMarkerId($interviewee));
			$skipFlag=false;
        }
		if($skipFlag) {
			$this->setSkipAnswer($interviewee->getIdTesting(), $this->getMarker($interviewee), 'Y');
		}
		else {
			$this->setSkipAnswer($interviewee->getIdTesting(), $this->getMarker($interviewee), 'N');
		}
		$marker = $this->getMarker($interviewee);
        $this->removeMarker($interviewee->getIdTesting(), $marker);
        $question_number = $que->getQuestionNumber($marker);
		if($this->getNextQuestion($interviewee->getTest()->getIdQuiz(), $question_number) != null) {
            $this->setMarker($interviewee->getIdTesting(), $this->getNextQuestion($interviewee->getTest()->getIdQuiz(), $question_number));
            return true;
        }
        else {
		    return null;
		}
    }
	
	public function getCountOfAnswered($id_testing){
        $query="select count(id_question) as id_question from answer_users where  marker_quiz is null and id_testing=$1";
        $array_params=array();
        $array_params[]=$id_testing;
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        return $obj->id_question;
        
    }
  
	 public function setSkipAnswer($id_testing, $id_question, $skip){
        $query="UPDATE answer_users SET skip_answer=$3 where id_testing=$1 and id_question=$2;";
        
		$array_params=array();
        $array_params[]=$id_testing;
        $array_params[]=$id_question;
		$array_params[]=$skip;
        $result=$this->db->execute($query,$array_params);
        
    }
  
    //Вставить "маяк"(помечается вопрос на котором остановился пользователь)
    public function setMarker($id_testing, $id_question){
        if($this->checkMarker($id_testing, $id_question)){
            $query="UPDATE answer_users SET marker_quiz='latest' where id_testing=$1 and id_question=$2;";
        }
        else {
            $query="insert into answer_users(id_testing, id_question, marker_quiz) values
                ($1, $2, 'latest');"; 
        }
        $array_params=array();
        $array_params[]=$id_testing;
        $array_params[]=$id_question;
        $result=$this->db->execute($query,$array_params);
        
    }
    private function checkMarker($id_testing, $id_question){
        $query="select * from answer_users where id_testing=$1 and id_question=$2;";
        $array_params=array();
        $array_params[]=$id_testing;
        $array_params[]=$id_question;
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        if ($obj){
            return $obj->id_testing;
        }
        else{
            return false;
        }
    }
    //Вернуть вопрос в котором установлен маяк
    public function getMarker(MInterviewee $interviewee){
        $query="select id_question from answer_users where marker_quiz='latest' and id_testing=$1;";
        $array_params=array();
        $array_params[]=$interviewee->getIdTesting();
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        if(isset($obj->id_question)){
            return $obj->id_question;
        }
    }
    public function getMarkerId(MInterviewee $interviewee){
        $query="select id_answer_users from answer_users where marker_quiz='latest' and id_testing=$1;";
        $array_params=array();
        $array_params[]=$interviewee->getIdTesting();
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        return $obj->id_answer_users;
    }
    //Удалить "маяк"
    public function removeMarker($id_testing, $id_question){
        $query="UPDATE answer_users SET marker_quiz=null where id_testing=$1 and id_question=$2;";
        $array_params=array();
        $array_params[]=$id_testing;
        $array_params[]=$id_question;
        $this->db->execute($query,$array_params);              
    }
    //Проверить ограничение по времени, возращает true если нет ограничений
    private function checkTimeLimit(MInterviewee $interviewee){
        $query="select time_limit from test where id_test=$1;";
        $array_params=array();
        $array_params[]=$interviewee->getTest()->getIdQuiz();
        $resurs_check_time_limit=$this->db->execute($query,$array_params);
        $result_check_time_limit= $this->db->getFetchObject($resurs_check_time_limit);
        if ($result_check_time_limit->time_limit=='null' || $result_check_time_limit->time_limit==''){
            return $result_check_time_limit->time_limit;
        }
        else {
            return $result_check_time_limit->time_limit;
        }
    }  
    //Проверить статус теста, возращает true если доступ открыт
    private function checkMarkTest(MInterviewee $interviewee){
        $query="select id_user from testing where id_testing=$1 and mark_test='available' or mark_test='unfinished';";
        $array_params=array();
        $array_params[]=$interviewee->getIdTesting();
        $resurs_check_time_limit=$this->db->execute($query,$array_params);
        $result_check_time_limit= $this->db->getArrayData($resurs_check_time_limit);
        if (count($result_check_time_limit)>0){
            return true;
        }
        else {
            return false;
        }
    }  
    public function checkTime(MInterviewee $interviewee){
        $query="select datetime_start_test from testing where id_testing=$1;";
        $array_params=array();
        $array_params[]=$interviewee->getIdTesting();
        $result=$this->db->execute($query,$array_params);
        $obj=$this->db->getFetchObject($result);
        $datetime= $obj->datetime_start_test;
        if($datetime+$this->checkTimeLimit($interviewee)<=date("Y-m-d H:i:s")){
            return true;
        }
        else {
            return false;
        }
    }
    //Возвращает ид самого первого вопроса
    public function getFirstQuestion($id_quiz){
       $query="select min(id_question) as first_question from questions where id_test=$1;";
       $array_params=array();
       $array_params[]=$id_quiz;
       $result=$this->db->execute($query,$array_params);
       $obj=$this->db->getFetchObject($result);
       if($obj->first_question!=null){
           return $obj->first_question;
       }
       else{
           return false;
       }
   }
   public function getNextQuestion($id_quiz, $question_number){
       $query="select id_question from questions where id_test=$1 and question_number > $2 order by question_number limit 1";
       $array_params=array();
       $array_params[]=$id_quiz;
       $array_params[]=$question_number;
       $result=$this->db->execute($query,$array_params);
       $obj=$this->db->getFetchObject($result);
       if(isset($obj->id_question)){
           return $obj->id_question;
       }
       else{
           return false;
       }
   }
    ////////////////////////////////////////////////////////////////////////////
    //Возвратить инфо. о всех опроса для данного пользователя
    public function getDataTesting($id_user){
        $return=array();
        $array_testing=$this->getArrayIdTesting($id_user);
        for($i=0; $i<count($array_testing); $i++){
            if(isset($array_testing[$i])){
                $return[$i]=$this->getDataOneTesting($array_testing[$i]);        
                
            }
        }        
        return $return;
    }
    public function getDataQuizTesting($id_user){
        $author_quiz=new AuthorQuizDAO();
        $return=array();
        $array_quiz=$this->getListQuiz($id_user);
        for($i=0; $i<count($array_quiz); $i++){
            $return[$i]['quiz']=$author_quiz->getListObjQuiz($array_quiz[$i]);
            if ( $this->getIdTesting($id_user, $array_quiz[$i])){
                $return[$i]['testing']=$this->getDataOneTesting($this->getIdTesting($id_user, $array_quiz[$i]));        
            }
            else{
                $return[$i]['testing']=false;
            }
        }        
        return $return;
    }
    //возвратить информацию опроса
    public function getDataOneTesting($id_testing){
        $id_quiz=$this->getObjTesting($id_testing)->id_testing;
        $admin= new AdministrationDAO();
        $minterviewee=new MInterviewee();
        $quiz=new QuizDAO();
        $minterviewee->setIdTesting($id_quiz);
        $minterviewee->setUser($admin->getObjDataUser($_SESSION['id_user']));
        $minterviewee->setTest($admin->getObjDataQuiz($this->getObjTesting($id_quiz)->id_test));
        //$minterviewee->setQuestion($quiz->getObjTestQuestion($id_quiz));
        $minterviewee->setMarkTest($this->getObjTesting($id_quiz)->id_mark_test);
        $minterviewee->setDatetimeStartTest($this->getObjTesting($id_quiz)->datetime_start_test);
        $minterviewee->getDatetimeEndTest($this->getObjTesting($id_quiz)->datetime_end_test);
        return $minterviewee;
    }
    public function getDataOneTest($id_testing){
        if(isset($this->getObjTest($id_testing, $_SESSION['id_user'])->id_testing)){
            $id_quiz=$this->getObjTest($id_testing, $_SESSION['id_user'])->id_testing;
            }
        $admin= new AdministrationDAO();
        $minterviewee=new MInterviewee();
        $quiz=new QuizDAO();
        if(isset($id_quiz)){
            $minterviewee->setIdTesting($id_quiz);
        }
        $minterviewee->setUser($admin->getObjDataUser($_SESSION['id_user']));
        $minterviewee->setTest($admin->getObjDataQuiz($id_testing));
        if(isset($id_quiz)){
            $minterviewee->setQuestion($quiz->getObjTestQuestion($id_quiz));
            $minterviewee->setMarkTest($this->getObjTesting($id_quiz)->id_mark_test);
            $minterviewee->setDatetimeStartTest($this->getObjTesting($id_quiz)->datetime_start_test);
            $minterviewee->getDatetimeEndTest($this->getObjTesting($id_quiz)->datetime_end_test);
        }
        return $minterviewee;
    }
    //возвратить ид всех опросов
    private function getArrayIdTesting($id_user){
        $query="select id_testing from testing where id_user=$1;";
        $array_params=array();
        $array_params[]=$id_user;
        $result=$this->db->execute($query, $array_params);
        return $this->db->getArrayData($result);
    }
    private function getObjTesting($id_testing){
        $query="select * from testing where id_testing=$1;";
        $array_params=array();
        $array_params[]=$id_testing;
        $result=$this->db->execute($query, $array_params);
        return $this->db->getFetchObject($result);
    }
    private function getObjTest($id_testing, $id_user){
        $query="select * from testing where id_test=$1 and id_user=$2;";
        $array_params=array();
        $array_params[]=$id_testing;
        $array_params[]=$id_user;
        $result=$this->db->execute($query, $array_params);
        return $this->db->getFetchObject($result);
    }
    //Отображаем список доступных тестов для данного пользователя
    public function getListQuiz($id_user){
        $query="select id_test from interviewees where id_user=$1;";
        $array_params=array();
        $array_params[]=$id_user;
        $result=$this->db->execute($query,$array_params);
        if($result){
             return $this->db->getArrayData($result);            
        } 
        else{
            $this->log->ERROR('Ошибка запроса к таблице: testing('.pg_last_error().')'); 
//            throw new Exception('Ошибка запроса к таблице: testing('.pg_last_error().')'); 
        }   
    }
    public function getIdTesting($id_user,$id_quiz){
        $query="select id_testing from testing where id_user=$1 and id_test=$2;";
        $array_params=array();
        $array_params[]=$id_user;
        $array_params[]=$id_quiz;
        $result=$this->db->execute($query, $array_params);
        $obj= $this->db->getFetchObject($result);
        if ($obj){
            return $obj->id_testing;
        }
        else {
            return false;
        }
    } 
    public function addUserIntoTest($test, $user){
        $query="INSERT INTO interviewees(id_test, id_user)
                VALUES ($1, $2);"; 
        $array_params=array();
        $array_params[]=$test;
        $array_params[]=$user;
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка добавления строки в таблицу: interviewees( '.pg_last_error().')'); 
//            throw new Exception('Ошибка добавления строки в таблицу: alluser( '.pg_last_error().')');  
        }   
    }
    public function deleteUser($id_test, $id_user){
        $query="DELETE FROM interviewees WHERE id_user=$1 AND id_test=$2;";
        $array_params=array();
        $array_params[]=$id_user;
        $array_params[]=$id_test;
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: interviewees( '.pg_last_error().')');  
//            throw new Exception('Ошибка удаления строки в таблице: alluser( '.pg_last_error().')'); 
        }  
    }
    public function deleteForQuiz($id_test){
        $query="DELETE FROM interviewees WHERE id_test=$1;";
        $array_params=array();
        $array_params[]=$id_test;
        $result=$this->db->execute($query,$array_params);
        if($result){
            return $result;            
        }
        else{
            $this->log->ERROR('Ошибка удаления строки в таблице: interviewees( '.pg_last_error().')');  
//            throw new Exception('Ошибка удаления строки в таблице: alluser( '.pg_last_error().')'); 
        }  
    }
    public function checkUserInTest($test, $user){
        $query="select * from interviewees where id_test=$1 and id_user=$2"; 
        $array_params=array();
        $array_params[]=$test;
        $array_params[]=$user;
        $result=$this->db->execute($query,$array_params);
        $obj= $this->db->getFetchObject($result);
        if(isset($obj->id_test)){
            return $obj->id_test;
        }  
    }
}
    



