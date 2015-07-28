<?php
include_once 'DAO/AuthorQuizDAO.php';
include_once 'model/MAuthorQuiz.php';
include_once 'model/MQuiz.php';
include_once 'DAO/QuizDAO.php';
include_once 'model/MUser.php';
include_once 'DAO/UserDAO.php';
include_once 'DAO/AnswerOptionsDAO.php';
include_once 'model/MAnswerOptions.php';
class CreateQuizView{
    public $id_author; //ид составителя опроса
    public $id_quiz; // Ид опроса: создавемого или редактируемого
    public $id_question; // Ид вопроса
    public $link_click; // какая кнопка нажата
    public $view_quiz; // Какое действие отображается
    public $title; // Заголовок страницы
    private $mauthor; 
    private $author;
    private $answer_option;
    public function __construct() {
        if(isset($_GET['id_quiz']) && !empty($_GET['id_quiz'])){
                $_SESSION['id_quiz'] = $_GET['id_quiz'];     
        }
        $this->id_author = $_SESSION['id_user'];
        $this->id_quiz = $_SESSION['id_quiz'];
        $this->id_question = $_SESSION['id_question'];
        $this->mauthor = new MAuthorQuiz();
        $this->mauthor->setIdUser($this->id_author);
        $this->author = new AuthorQuizDAO();
        $this->answer_option = new AnswerOptionsDAO();
        $this->link_click = filter_input(INPUT_GET, 'link_click', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->button_click = filter_input(INPUT_POST, 'button_click', FILTER_SANITIZE_SPECIAL_CHARS);        
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
                $_SESSION['id_question'] = $_GET['id_question'];
            }
            elseif($_GET['action'] == 'delete' && !empty ($_GET['id_question'])){  
                $_SESSION['id_question'] = $_GET['id_question'];
            }
            elseif($_GET['action'] == 'add_inteviewee'){                
                $this->view_quiz = 'add_inteviewee';
            }
        }
        if(isset($this->button_click) && !empty($this->button_click)){
            if ($this->button_click == 'create_quiz'){  
                $var = $this->createQuiz();
                if($var!=0){
                    header("Location: create_quiz.php?link_click=".$this->link_click."&action=menu_questions");      
				    exit;
				}
				else {
				    echo "Wrong time!";
				}
            }        
            elseif ($this->button_click == 'add_question'){
                $this->addQuestion();            
            }
            elseif ($this->button_click == 'add_right_answer_option_one'){ 
                $this->resetRightAnswer();
                $this->addRightAnswerQuestion();
            }
            elseif ($this->button_click == 'add_answer_option_one'){  
                $this->addAnswerQuestion();
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
        $mquiz->setSeeTheResult($_POST['see_the_result']);
        $mquiz->setSeeDetails($_POST['see_details']);
        $mquiz->setIdStatusQuiz($_POST['status_test']);
        $_SESSION['id_quiz'] = $quiz->createQuiz($mquiz, $muser);
        $this->id_quiz = $_SESSION['id_quiz'];
        $this->addAnswerQuestion();
    }
    public function addQuestion(){ 
        unset($_SESSION['id_question']);
        $mquestion= new MQuestion();
        $question= new QuestionDAO();
        $mquestion->setTextQuestion($_POST['text_question']);
        $mquestion->setCommentQuestion($_POST['comment_question']);
        $mquestion->setIdQuestionsType($_POST['question_type']);
        $mquestion->setIdTest($this->id_quiz);     
        $_SESSION['id_question'] = $question->createQuestion($mquestion);
        if ($_POST['question_type'] == 1){
        var_dump($_POST['answer']);
            //$this->addAnswerQuestion($this->id_question, $_POST['add_answer_type_yorn'], 'Y');
            //header("Location: create_quiz.php?link_click=".$this->link_click."&action=menu_questions");
			//exit;
        }
        elseif ($_POST['question_type'] == 2){
            header("Location: create_quiz.php?link_click=".$this->link_click."&action=menu_questions");
			exit;
        }
        elseif ($_POST['question_type'] == 3){
            header("Location: create_quiz.php?link_click=".$this->link_click."&action=menu_questions");
			exit;
        }
        elseif ($_POST['question_type'] == 4){
            header("Location: create_quiz.php?link_click=".$this->link_click."&action=menu_questions");
			exit;
        }
    }
    public function getDataQuestions(){
        $result = $this->author->getDataQuestions($this->id_quiz);
        if(count($result) > 0){            
            return $result;
        }
        return false;
    }
    public function getOneDataQuestion(){
        return $this->author->getListObjQuestion($this->id_question);
    }
    public function getAnswerOptionsData(){
        return $this->answer_option->getDataAnswerOtions($this->id_question);        
    }
    public function getOneDataQuiz(){
        return $this->author->getListObjQuiz($this->id_quiz);
    }
    public function addAnswerQuestion(){
        if(!empty($this->id_question) && !empty($_POST['answer_the_question'])){
            $manswer_option=new MAnswerOptions();
            $manswer_option->setIdQuestion($this->id_question);
            $manswer_option->setAnswerTheQuestions($_POST['answer_the_question']);
            $manswer_option->setRightAnswer('N'); //Возможно переписать
            $this->answer_option->createAnswerOptions($manswer_option);
        }
        header("Location: create_quiz.php?link_click=".$this->link_click."&action=answer_option_one");
		exit;
    }
    public function addRightAnswerQuestion(){
        if (isset($_POST['value_answer_option']) && !empty($_POST['value_answer_option'])){
            $this->answer_option->addRightAnswerOptions($_POST['value_answer_option']);
        }
        header("Location: create_quiz.php?link_click=".$this->link_click."&action=menu_questions");
		exit;
    }
    public function resetRightAnswer(){
        $this->answer_option->resetRightAnswerOptions($this->id_question);
    }
    
}?>
