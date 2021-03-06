<?php
include_once 'DAO/AuthorQuizDAO.php';
include_once 'DAO/AdministrationDAO.php';
include_once 'model/MAuthorQuiz.php';
include_once 'model/MQuiz.php';
include_once 'DAO/QuizDAO.php';
include_once 'model/MUser.php';
include_once 'DAO/UserDAO.php';
include_once 'DAO/AnswerOptionsDAO.php';
include_once 'model/MAnswerOptions.php';
include_once 'LdapOperations.php';
include_once 'DAO/QuestionDAO.php';
include_once 'DAO/AnswerDAO.php';
include_once 'DAO/AnswerOptionsDAO.php';
class CreateQuizView{
    public $id_author; //ид составителя опроса
    public $id_quiz; // Ид опроса: создавемого или редактируемого
    public $id_question; // Ид вопроса
    public $link_click; // какая кнопка нажата
    public $view_quiz; // Какое действие отображается
    public $title; // Заголовок страницы
    public $user;
    public $inter;
    public $questionDAO;
    private $mauthor; 
    private $author;
    private $answer_option;
    public $ldapOperations;
    public function __construct() {
        if(isset($_SESSION['id_quiz'])) {
            unset($_SESSION['id_quiz']);
        }
        if(isset($_GET['id_quiz']) && !empty($_GET['id_quiz'])){
                $_SESSION['id_quiz'] = $_GET['id_quiz'];     
        }
        if(isset($_SESSION['id_user'])) {
            $this->id_author = $_SESSION['id_user'];
        }
        //$this->id_quiz = $_SESSION['id_quiz'];
        //$this->id_question = $_SESSION['id_question'];
        $this->user = new UserDAO();
        $this->mauthor = new MAuthorQuiz();
        $this->mauthor->setIdUser($this->id_author);
        $this->author = new AuthorQuizDAO();
        $this->inter = new IntervieweeDAO();
        $this->answer_option = new AnswerOptionsDAO();
        $this->ldapOperations=new LdapOperations();
        $this->questionDAO = new QuestionDAO();
        $this->quizDAO = new QuizDAO();
        $answerDAO = new AnswerDAO();
        $answerOptionsDAO = new AnswerOptionsDAO();
        $this->link_click = filter_input(INPUT_GET, 'link_click', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->button_click = filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);  
        $this->id_question = filter_input(INPUT_GET, 'id_question', FILTER_SANITIZE_SPECIAL_CHARS);     
        $_SESSION['id_question'] = $this->id_question;
        $this->countOfAnswersAboutAllUsers = array();
        if(isset($_SESSION['id_quiz'])) {
            $this->array_question=$this->quizDAO->getObjTestQuestion($_SESSION['id_quiz']);
		    foreach($this->array_question as $aq) {
		        $answer = $answerDAO->getAnswersForQuestion($aq->getIdQuestion());
		        if(isset($answer[0])) {
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
		}
        $this->initialize();
    }
    public function initialize(){
        if($this->link_click == 'new_quiz'){
             $this->view_quiz = "new_quiz";
             $this->title = 'Создание опроса';
        }
        elseif($this->link_click=='edit_quiz'){
            $this->view_quiz='edit_quiz';
            $this->title = 'Редактирование опроса';
        }
        elseif($this->link_click=='sendEmail'){
            $this->view_quiz='sendEmail';
            $this->title = 'Отправка е-майл';
        }
        elseif($this->link_click=='checkEmail'){
            $this->view_quiz='checkEmail';
        }
        if(isset($_GET['action']) && !empty($_GET['action'])){
           if($_GET['action'] == 'new_question'){
                $this->view_quiz="new_question";
            }
            elseif($_GET['action'] == 'menu_questions'){
                $this->view_quiz = 'menu_questions';
            }
            elseif($_GET['action'] == 'answer_option_one'){                
                $this->view_quiz = 'add_answer_option_one';
            }
            elseif($_GET['action'] == 'answer_option_more'){                
                $this->view_quiz = 'add_answer_option_more';
            }
            elseif($_GET['action'] == 'edit_question' && !empty ($_GET['id_question'])){  
                //$_SESSION['id_question'] = $_GET['id_question'];
                $this->view_quiz = 'edit_question';
            }
            elseif($_GET['action'] == 'delete' && !empty ($_GET['id_question'])){  
                //$_SESSION['id_question'] = $_GET['id_question'];
                $this->deleteQuestion();
                
            }
            elseif($_GET['action'] == 'deleteUser' && !empty ($_GET['id_user'])){  
                $this->inter->deleteUser($_SESSION['id_quiz'], $_GET['id_user']);
                header("Location: create_quiz.php?link_click=".$this->link_click."&action=add_inteviewee&id_quiz=".$_SESSION['id_quiz']);      
				exit;
            }
            elseif($_GET['action'] == 'add_inteviewee'){                
                $this->view_quiz = 'add_inteviewee';
            }
            elseif($_GET['action'] == 'edit_data_quiz'){                
                $this->view_quiz = 'edit_data_quiz';
            }
            elseif($_GET['action'] == 'showReport'){                
                $this->view_quiz = 'showReport';
            }
            elseif($_GET['action'] == 'upQuestion'){
                $this->questionDAO->upQuestion($_GET['id_question'],$_GET['first'],$_GET['second']);
                header("Location: create_quiz.php?link_click=edit_quiz&id_quiz=".$_SESSION['id_quiz']);      
				exit;
            }
        }
        if(isset($this->button_click) && !empty($this->button_click)){
            if ($this->button_click == 'create_quiz'){  
                $var = $this->createQuiz();
                //if($var!=0){
                    header("Location: create_quiz.php?link_click=edit_quiz&id_quiz=".$_SESSION['id_quiz']);      
				    exit;
				/*}
				else {
				    echo "Wrong time!";
				}*/
            }        
            elseif ($this->button_click == 'add_question'){
                $this->addQuestion();            
            }
            elseif ($this->button_click == 'edit_question'){
                $this->editQuestion();            
            }
            elseif ($this->button_click == 'add_right_answer_option_one'){ 
                $this->resetRightAnswer();
                $this->addRightAnswerQuestion();
            }
            elseif ($this->button_click == 'add_answer_option_one'){  
                $this->addAnswerQuestion();
            }
            elseif ($this->button_click == 'addUserIntoTest'){
                if($this->user->checkLoginUser($_POST['inputName'])){
                    $this->inter->addUserIntoTest($_SESSION['id_quiz'], $this->user->checkLoginUser($_POST['inputName']));
                }
                else {
                    $this->ldapOperations->connect();
                    $name = $this->ldapOperations->getLDAPAccountNamesByPrefix($_POST['inputName']);
                    $userDAO= new UserDAO();
                    $muser= new Muser();
                    $muser->setFirstName($name[0]['givenName']);
                    $muser->setLastName($name[0]['sn']);
                    $muser->setEmail($name[0]['mail']);
                    $muser->setLogin($name[0]['sAMAccountName']);
                    $muser->setLdapUser(1);
                    $userDAO->createUser($muser);
                    //$userDAO->addFirstRole($this->user->checkLoginUser($_POST['inputName']));
                    $this->inter->addUserIntoTest($_SESSION['id_quiz'], $this->user->checkLoginUser($_POST['inputName']));
                }
                //header("Location: create_quiz.php?link_click=".$this->link_click."&action=add_inteviewee&id_quiz=".$_SESSION['id_quiz']);      
				//exit;
            }
            elseif ($this->button_click == 'addGroupIntoTest'){
                $this->ldapOperations->connect();
                $group = $this->ldapOperations->getGroupMembers($_POST['inputGroup']);
                $subGroups = $this->ldapOperations->getSubGroups($_POST['inputGroup']);
                foreach($subGroups as $oneGroup){
                    $arr = $this->ldapOperations->getGroupMembers($oneGroup['sAMAccountName']);
                    foreach($arr as $oneUser){
                        array_push($group, $oneUser);
                    }
                }
                foreach($group as $user){
                    if(!$this->user->checkLoginUser($user['sAMAccountName'])){
                        $userDAO= new UserDAO();
                        $muser= new Muser();
                        $muser->setFirstName($user['givenName']);
                        $muser->setLastName($user['sn']);
                        $muser->setEmail($user['mail']);
                        $muser->setLogin($user['sAMAccountName']);
                        $muser->setLdapUser(1);
                        $userDAO->createUser($muser);
                        //$userDAO->addFirstRole($this->user->checkLoginUser($_POST['inputName']));
                    }
                    if(!$this->inter->checkUserInTest($_SESSION['id_quiz'], $this->user->checkLoginUser($user['sAMAccountName']))){
                        $this->inter->addUserIntoTest($_SESSION['id_quiz'], $this->user->checkLoginUser($user['sAMAccountName']));
                    }
                }
                header("Location: create_quiz.php?link_click=".$this->link_click."&action=add_inteviewee&id_quiz=".$_SESSION['id_quiz']);      
				exit;
            }
            elseif ($this->button_click == 'edit_data_quiz'){
                $this->editQuiz();
                header("Location: create_quiz.php?link_click=edit_quiz&id_quiz=".$_SESSION['id_quiz']);      
				exit;
            }  
            elseif ($this->button_click == 'sendListOfMail'){
                if(isset($_POST['rowcheckboxes'])){
                    $_SESSION['rowcheckboxes'] = $_POST['rowcheckboxes'];
                }
                header("Location: create_quiz.php?link_click=sendEmail&id_quiz=".$_SESSION['id_quiz']);      
				exit;
            }
            elseif($this->button_click == 'checkMailStatus'){
                $_SESSION['head'] = $_POST['head'];
                //$_SESSION['testOfMale'] = str_replace(PHP_EOL, "<br>", $_POST['testOfMale']);
                
               
                $order   = array("\r\n", "\n", "\r", PHP_EOL);
                $replace = '<br />';
                $_SESSION['testOfMale'] = str_replace($order, $replace, $_POST['testOfMale']);
                $_SESSION['testOfMale'] = addslashes($_SESSION['testOfMale']);
                
                header("Location: create_quiz.php?link_click=checkEmail&id_quiz=".$_SESSION['id_quiz']);      
				exit;
            }
            elseif($this->button_click == 'getExcel'){
                header("Location: ExcelReport.php?id_quiz=".$_SESSION['id_quiz']);  
                exit;
            }
            elseif($this->button_click == 'showReport'){
                header("Location: create_quiz.php?action=showReport&id_quiz=".$_SESSION['id_quiz']);      
				exit;
            }
        }
    }    
    public function createQuiz(){
        unset($_SESSION['id_quiz']);
        unset($_SESSION['id_question']);
        $quiz=new QuizDAO();
        $muser=new MUser();
        $mquiz= new MQuiz();
        
        $muser->setIdUser($this->id_author);
        $mquiz->setTopic($_POST['topic_quiz']);
        if($_POST['hour']=='0') {
            $_POST['hour']='00';
        }
        if($_POST['minutes']=='0') {
            $_POST['minutes']='00';
        }
        if(preg_match("/[0-9]*/",$_POST['hour']) && preg_match("/[0-9]*/",$_POST['minutes']) && $_POST['minutes']<60 && !$_POST['hour']=='' && !$_POST['minutes']==''){
           $mquiz->setTimeLimit($_POST['hour'].':'.$_POST['minutes'].':00');
           
        }
        elseif($_POST['hour']=='' && $_POST['minutes']==''){
            $mquiz->setTimeLimit(null);
        }
        elseif($_POST['hour']=='' && !$_POST['minutes']==''){
            $mquiz->setTimeLimit('00:'.$_POST['minutes'].':00');
        }
        elseif(!$_POST['hour']=='' && $_POST['minutes']==''){
            $mquiz->setTimeLimit($_POST['hour'].':00:00');
        }   
        else {      
            return 0;
        }
        $mquiz->setCommentQuiz($_POST['comment_test']);
        if(isset($_POST['see_the_result'])){
            $mquiz->setSeeTheResult('Y');
        }
        else {
            $mquiz->setSeeTheResult('N');
        }
        if(isset($_POST['see_details'])){    
            $mquiz->setSeeDetails('Y');
        }
        else {
            $mquiz->setSeeDetails('N');
        }
        $mquiz->setIdStatusQuiz($_POST['status_test']);
        $_SESSION['id_quiz'] = $quiz->createQuiz($mquiz, $muser);
        $this->id_quiz = $_SESSION['id_quiz'];
        $this->addAnswerQuestion();
    }
    public function editQuiz(){
        unset($_SESSION['id_question']);
        $quiz=new QuizDAO();
        $mquiz= new MQuiz();
        $mquiz->setIdQuiz($_SESSION['id_quiz']);
        $mquiz->setTopic($_POST['topic_quiz']);
        if(preg_match("/[0-9]*/",$_POST['hour']) && preg_match("/[0-9]*/",$_POST['minutes']) && $_POST['minutes']<60 && !$_POST['hour']=='' && !$_POST['minutes']==''){
           $mquiz->setTimeLimit($_POST['hour'].':'.$_POST['minutes'].':00');
           
        }
        elseif($_POST['hour']=='' && $_POST['minutes']==''){
            $mquiz->setTimeLimit(null);
        }
        elseif($_POST['hour']=='' && !$_POST['minutes']==''){
            $mquiz->setTimeLimit('00:'.$_POST['minutes'].':00');
        }
        elseif(!$_POST['hour']=='' && $_POST['minutes']==''){
            $mquiz->setTimeLimit($_POST['hour'].':00:00');
        }   
        else
        {      
            return 0;
        }
        $mquiz->setCommentQuiz($_POST['comment_test']);
        if(isset($_POST['see_the_result'])){
            $mquiz->setSeeTheResult('Y');
        }
        else {
            $mquiz->setSeeTheResult('N');
        }
        if(isset($_POST['see_details'])){    
            $mquiz->setSeeDetails('Y');
        }
        else {
            $mquiz->setSeeDetails('N');
        }
        $mquiz->setIdStatusQuiz($_POST['status_test']);
        $_SESSION['id_quiz'] = $quiz->updateQuiz($mquiz);
        $this->id_quiz = $_SESSION['id_quiz'];
    }
    public function addQuestion(){
        $mark_of_rating = $this->getMarkOfRatingType();
        unset($_SESSION['id_question']);
        $mquestion= new MQuestion();
        $question= new QuestionDAO();
        $mquestion->setTextQuestion($_POST['text_question']);
        $mquestion->setCommentQuestion($_POST['comment_question']);
        $mquestion->setIdQuestionsType($_POST['question_type']);
        if(isset($_POST['switch']) && $_POST['weight'] != ''){
            $mquestion->setWeight($_POST['weight']);
        }
        else {
            $mquestion->setWeight(1);
        }
        if(isset($_POST['show_chart'])){
            $mquestion->setShowChart('Y');
        }
        else {
            $mquestion->setShowChart('N');
        }
        $question_number = $question->getNextQuestionNumber($_SESSION['id_quiz']);
        if(isset($question_number)){
            $mquestion->setQuestionNumber($question->getNextQuestionNumber($_SESSION['id_quiz'])+1);
        }
        else {
            $mquestion->setQuestionNumber(1);
        }
        $mquestion->setIdTest($_SESSION['id_quiz']);  
        if($_POST['question_type'] != 4 && $_POST['question_type'] != 5){
            if(isset($_POST['switch'])){
                $mquestion->setValidation('Y');
            }
            else {
                $mquestion->setValidation('N');
            }
        }
        $_SESSION['id_question'] = $question->createQuestion($mquestion);
        if ($_POST['question_type'] == 1){
            $manswer_option=new MAnswerOptions();
            $manswer_option->setIdQuestion( $_SESSION['id_question']);
            $manswer_option->setAnswerTheQuestions('Да');
            if(isset($_POST['switch'])){
                if($_POST['answer'][0]=='Да'){
                    $manswer_option->setRightAnswer('Y');
                }
                else {
                    $manswer_option->setRightAnswer('N');
                }
            }
            $this->answer_option->createAnswerOptions($manswer_option);
            $manswer_option=new MAnswerOptions();
            $manswer_option->setIdQuestion( $_SESSION['id_question']);
            $manswer_option->setAnswerTheQuestions('Нет');
            if(isset($_POST['switch'])){
                if($_POST['answer'][0]=='Нет'){
                    $manswer_option->setRightAnswer('Y');
                }
                else {
                    $manswer_option->setRightAnswer('N');
                }
            }
            $this->answer_option->createAnswerOptions($manswer_option);
            header("Location: create_quiz.php?link_click=".$this->link_click."edit_quiz&id_quiz=".$_SESSION['id_quiz']);
			exit;
        }
        elseif ($_POST['question_type'] == 2){
            for($i=0;$i<count($_POST['texting']);$i++)
            {
                $manswer_option=new MAnswerOptions();
                $manswer_option->setIdQuestion($_SESSION['id_question']);
                $manswer_option->setAnswerTheQuestions($_POST['texting'][$i]);
                $flag = false;
                if(isset($_POST['rad'])) {
                    for($j=0;$j<count($_POST['rad']);$j++){
                        if($_POST['rad'][$j]==$i){
                            $flag=true;
                        }
                    }
                }
                if(isset($_POST['switch'])){
                    if($flag==true){
                        $manswer_option->setRightAnswer('Y');
                    } else {
                        $manswer_option->setRightAnswer('N');
                    }
                }
                $this->answer_option->createAnswerOptions($manswer_option);
            }
            header("Location: create_quiz.php?link_click=".$this->link_click."edit_quiz&id_quiz=".$_SESSION['id_quiz']);
			exit;
        }
        elseif ($_POST['question_type'] == 3){
            for($i=0;$i<count($_POST['textr']);$i++)
            {
                $manswer_option=new MAnswerOptions();
                $manswer_option->setIdQuestion($_SESSION['id_question']);
                $manswer_option->setAnswerTheQuestions($_POST['textr'][$i]);
                $flag = false;
                if(isset($_POST['checkbox'])){
                    for($j=0;$j<count($_POST['checkbox']);$j++){
                        if($_POST['checkbox'][$j]==$i){
                            $flag=true;
                        }
                    }
                }
                if(isset($_POST['switch'])){
                    if($flag==true){
                        $manswer_option->setRightAnswer('Y');
                    } else {
                        $manswer_option->setRightAnswer('N');
                    }
                }
                $this->answer_option->createAnswerOptions($manswer_option);
            }
            header("Location: create_quiz.php?link_click=".$this->link_click."edit_quiz&id_quiz=".$_SESSION['id_quiz']);
			exit;
        }
        elseif ($_POST['question_type'] == 4){
        
            header("Location: create_quiz.php?link_click=".$this->link_click."edit_quiz&id_quiz=".$_SESSION['id_quiz']);
			exit;
        }
        elseif ($_POST['question_type'] == 5){
            foreach($mark_of_rating[$_POST['rating']] as $mrt) {
                $manswer_option=new MAnswerOptions();
                $manswer_option->setIdQuestion($_SESSION['id_question']);
                $manswer_option->setAnswerTheQuestions($mrt->text);
                $this->answer_option->createAnswerOptions($manswer_option);
            }
            header("Location: create_quiz.php?link_click=".$this->link_click."edit_quiz&id_quiz=".$_SESSION['id_quiz']);
			exit;
        }
    }
    public function editQuestion(){ 
        $mark_of_rating = $this->getMarkOfRatingType();
        $mquestion= new MQuestion();
        $question= new QuestionDAO();
	$answerDAO = new AnswerDAO();
	$manswer=new MAnswer();
        $mquestion->setIdQuestion($_SESSION['id_question']);
        $mquestion->setTextQuestion($_POST['text_question']);
        $mquestion->setCommentQuestion($_POST['comment_question']);
        $mquestion->setIdQuestionsType($_POST['question_type']);
        $mquestion->setIdTest($_SESSION['id_quiz']); 
        if(isset($_POST['switch']) && $_POST['weight'] != ''){
            $mquestion->setWeight($_POST['weight']);
        }
        else {
            $mquestion->setWeight(1);
        }
        if(isset($_POST['show_chart'])){
            $mquestion->setShowChart('Y');
        }
        else {
            $mquestion->setShowChart('N');
        }
        if($_POST['question_type'] != 4 && $_POST['question_type'] != 5){
            if(isset($_POST['switch'])){
                $mquestion->setValidation('Y');
            }
            else {
                $mquestion->setValidation('N');
            }
        }
        $mquestion->setQuestionNumber($question->getQuestionNumber($_SESSION['id_question']));
        $_SESSION['id_question'] = $question->updateQuestion($mquestion);
        if($_POST['deleteDataAnswers']=='TRUE'){
		$manswer_option=new MAnswerOptions();
		$manswer_option->setIdQuestion($_SESSION['id_question']);
		$this->answer_option->deleteAnswerOptions($manswer_option);
	}
        if ($_POST['question_type'] == 1){
            $manswer_option=new MAnswerOptions();
            $manswer_option->setIdQuestion($_SESSION['id_question']);
            $manswer_option->setAnswerTheQuestions('Да');
            if(isset($_POST['switch'])){
                if($_POST['answer'][0]=='Да'){
                    $manswer_option->setRightAnswer('Y');
                }
                else {
                    $manswer_option->setRightAnswer('N');
                } 
            }
            if($_POST['deleteDataAnswers']=='TRUE'){
		$this->answer_option->createAnswerOptions($manswer_option);
	    }else{
		$idAnswer = $this->answer_option->getIdAnswerOptionsByIdQuestion($_SESSION['id_question']);
		$manswer_option->setIdAnswerOption($idAnswer);
		$this->answer_option->updateAnswerOptions($manswer_option);
	    }
            $manswer_option=new MAnswerOptions();
            $manswer_option->setIdQuestion($_SESSION['id_question']);
            $manswer_option->setAnswerTheQuestions('Нет');
            if(isset($_POST['switch'])){
                if($_POST['answer'][0]=='Нет'){
                    $manswer_option->setRightAnswer('Y');
                }
                else {
                    $manswer_option->setRightAnswer('N');
                }
            }
            if($_POST['deleteDataAnswers']=='TRUE'){
		$this->answer_option->createAnswerOptions($manswer_option);
	    }else{
		$idAnswer = $this->answer_option->getIdAnswerOptionsByIdQuestion($_SESSION['id_question']);
		$manswer_option->setIdAnswerOption($idAnswer);
		$this->answer_option->updateAnswerOptions($manswer_option);
	    }
            header("Location: create_quiz.php?link_click=".$this->link_click."edit_quiz&id_quiz=".$_SESSION['id_quiz']);
			exit;
        }
        elseif ($_POST['question_type'] == 2){
            for($i=0;$i<count($_POST['texting']);$i++)
            {
                $manswer_option=new MAnswerOptions();
                $manswer_option->setIdQuestion($_SESSION['id_question']);
                $manswer_option->setAnswerTheQuestions($_POST['texting'][$i]);
                $flag = false;
                if(isset($_POST['switch']) && isset($_POST['rad'])){
                    for($j=0;$j<count($_POST['rad']);$j++){
                        if($_POST['rad'][$j]==$i){
                            $flag=true;
                        }
                    }
                    if($flag==true){
                        $manswer_option->setRightAnswer('Y');
                    } else {
                        $manswer_option->setRightAnswer('N');
                    }
                }
	    if($_POST['deleteDataAnswers']=='TRUE'){
		$this->answer_option->createAnswerOptions($manswer_option);
	    }else{
		$idAnswer = $this->answer_option->getIdAnswerOptionsByIdQuestion($_SESSION['id_question']);
		$manswer_option->setIdAnswerOption($idAnswer);
		$this->answer_option->updateAnswerOptions($manswer_option);
	    }
            }
            header("Location: create_quiz.php?link_click=".$this->link_click."edit_quiz&id_quiz=".$_SESSION['id_quiz']);
			exit;
        }
        elseif ($_POST['question_type'] == 3){
            for($i=0;$i<count($_POST['textr']);$i++)
            {
                $manswer_option=new MAnswerOptions();
                $manswer_option->setIdQuestion($_SESSION['id_question']);
                $manswer_option->setAnswerTheQuestions($_POST['textr'][$i]);
                $flag = false;
                if(isset($_POST['switch']) && isset($_POST['checkbox'])){
                    for($j=0;$j<count($_POST['checkbox']);$j++){
                        if($_POST['checkbox'][$j]==$i){
                            $flag=true;
                        }
                    }
                    if($flag==true){
                        $manswer_option->setRightAnswer('Y');
                    } else {
                        $manswer_option->setRightAnswer('N');
                    }
                }
	    if($_POST['deleteDataAnswers']=='TRUE'){
		$this->answer_option->createAnswerOptions($manswer_option);
	    }else{
		$idAnswer = $this->answer_option->getIdAnswerOptionsByIdQuestion($_SESSION['id_question']);
		$manswer_option->setIdAnswerOption($idAnswer);
		$this->answer_option->updateAnswerOptions($manswer_option);
	    }
            }
            header("Location: create_quiz.php?link_click=".$this->link_click."edit_quiz&id_quiz=".$_SESSION['id_quiz']);
		    exit;
        }
        elseif ($_POST['question_type'] == 4){
        
            header("Location: create_quiz.php?link_click=".$this->link_click."edit_quiz&id_quiz=".$_SESSION['id_quiz']);
			exit;
        }
        elseif ($_POST['question_type'] == 5){
            foreach($mark_of_rating[$_POST['rating']] as $mrt) {
                $manswer_option=new MAnswerOptions();
                $manswer_option->setIdQuestion($_SESSION['id_question']);
                $manswer_option->setAnswerTheQuestions($mrt->text);
	    if($_POST['deleteDataAnswers']=='TRUE'){
		$this->answer_option->createAnswerOptions($manswer_option);
	    }else{
		$idAnswer = $this->answer_option->getIdAnswerOptionsByIdQuestion($_SESSION['id_question']);
		$manswer_option->setIdAnswerOption($idAnswer);
		$this->answer_option->updateAnswerOptions($manswer_option);
	    }
            }
            header("Location: create_quiz.php?link_click=".$this->link_click."edit_quiz&id_quiz=".$_SESSION['id_quiz']);
			exit;
        }
    }
    public function getDataQuestions(){
        if(isset($_SESSION['id_quiz'])){
            $result = $this->author->getDataQuestions($_SESSION['id_quiz']);
            if(count($result) > 0){            
                return $result;
            }
        }
        return false;
    }
    public function getOneDataQuestion(){
        if(isset($this->id_question)){
            return $this->author->getListObjQuestion($_SESSION['id_question']);
        }
    }
    public function getAnswerOptionsData(){
    /*var_dump($this->id_question);
    var_dump($this->answer_option->getDataAnswerOtions($this->id_question));*/
        if(isset($_SESSION['id_question'])){
            return $this->answer_option->getDataAnswerOtions($_SESSION['id_question']);    
        }    
    }
    public function getOneDataQuiz(){
        if(isset($_SESSION['id_quiz'])){
            return $this->author->getListObjQuiz($_SESSION['id_quiz']);
        }
    }
    public function addAnswerQuestion(){
        /*if(!empty($this->id_question) && !empty($_POST['answer_the_question'])){
            $manswer_option=new MAnswerOptions();
            $manswer_option->setIdQuestion($this->id_question);
            $manswer_option->setAnswerTheQuestions($_POST['answer_the_question']);
            $manswer_option->setRightAnswer('N'); //Возможно переписать
            $this->answer_option->createAnswerOptions($manswer_option);
        }
        header("Location: create_quiz.php?link_click=".$this->link_click."&action=answer_option_one");
		exit;*/
		
    }
    public function addRightAnswerQuestion(){
        if (isset($_POST['value_answer_option']) && !empty($_POST['value_answer_option'])){
            $this->answer_option->addRightAnswerOptions($_POST['value_answer_option']);
        }
        header("Location: create_quiz.php?link_click=".$this->link_click."edit_quiz&id_quiz=".$_SESSION['id_quiz']);
		exit;
    }
    public function resetRightAnswer(){
        $this->answer_option->resetRightAnswerOptions($_SESSION['id_question']);
    }
    public function deleteQuestion(){
        $question= new QuestionDAO();
        $manswer_option=new MAnswerOptions();
        $manswer_option->setIdQuestion($_SESSION['id_question']);
        $this->answer_option->deleteAnswerOptions($manswer_option);
        $mquestion= new MQuestion();
        $mquestion->setIdQuestion($_SESSION['id_question']);
        $question->deleteQuestion($mquestion);
        header("Location: create_quiz.php?link_click=".$this->link_click."edit_quiz&id_quiz=".$_SESSION['id_quiz']);
		exit;
    }
    public function getUsers(){
        if(isset($_SESSION['id_quiz'])){
            $administration = new AdministrationDAO();
            $arr = $administration->getTestingUsers($_SESSION['id_quiz']);
            return $arr;
        }
    }
    public function getMarkOfRatingType(){
        $quizDAO = new QuizDAO();
        return $quizDAO->getMarkOfRatingType();
    }
    public function getArrayQuestions(){
        $data_questions=array();
        if(isset($this->array_question)) {
            $temp_array_question=$this->array_question;
            for($i=0; $i<count($this->array_question); $i++){
                $data_questions[$i]['number']=$i+1;
                $data_questions[$i]['data_questions']=$temp_array_question[$i];            
            }
            return $data_questions;
        }
    }
}?>
