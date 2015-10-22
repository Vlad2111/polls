<?php
include_once 'DAO/AuthorQuizDAO.php';
include_once 'model/MAuthorQuiz.php';
include_once 'DAO/QuizDAO.php';     
include_once 'view/AdministrationView.php';
include_once 'model/MUser.php';
include_once 'model/MQuiz.php';
include_once 'model/MInterviewee.php';
include_once 'DAO/IntervieweeDAO.php';
include_once 'DAO/QuizDAO.php';
class AuthorQuizView {
    private $mauthor;
    private $author;
    public function __construct($id_author){
        $this->mauthor= new MAuthorQuiz();
        $this->mauthor->setIdUser($id_author);
        $this->author= new AuthorQuizDAO();
        $this->init();
    }
    public function init (){
        if(isset($_GET['action']) && !empty($_GET['action'])){
            if($_GET['action'] == 'deleteQuiz' && !empty ($_GET['id_quiz'])){  
                $this->deleteQuiz($_GET['id_quiz']);
                header("Location: author_quiz.php");      
				exit;
            }
        }
    }
    public function deleteQuiz($id_quiz) {
        $QuizDAO = new QuizDAO();
        $QuizDAO->deleteCascadeQuiz($id_quiz);
    }
    public function getAuthorQuizs(){
       return $this->author->getDataQuiz($this->mauthor);
    }
}
