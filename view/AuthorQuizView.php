<?php
include_once 'DAO/AuthorQuizDAO.php';
include_once 'model/MAuthorQuiz.php';
include_once 'DAO/QuizDAO.php';     
include_once 'view/AdministrationView.php';
include_once 'model/MUser.php';
include_once 'model/MQuiz.php';
include_once 'model/MInterviewee.php';
include_once 'DAO/IntervieweeDAO.php';
class AuthorQuizView {
    private $mauthor;
    private $author;
    public function __construct($id_author){
        $this->mauthor= new MAuthorQuiz();
        $this->mauthor->setIdUser($id_author);
        $this->author= new AuthorQuizDAO();
    }
    public function getAuthorQuizs(){
       return $this->author->getDataQuiz($this->mauthor);
    }
}
