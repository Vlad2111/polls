<?php
include_once 'DAO/AuthorQuizDAO.php';
include_once 'model/MAuthorQuiz.php';
include_once 'model/MQuiz.php';
include_once 'DAO/QuizDAO.php';
include_once 'model/MUser.php';
include_once 'DAO/UserDAO.php';
class CreateQuizView{
    public $id_author;
    public function __construct($id_author_quiz) {
        $this->id_author=$id_author_quiz;
    }
    public function createQuiz($topic_quiz, $time_limit, $set_time_limit, $comment_test, $see_the_result, $see_details, $status_test){
        $quiz=new QuizDAO();
        $muser=new MUser();
        $muser->setIdUser($this->id_author);     
        $mquiz= new MQuiz();
        $mquiz->setTopic($topic_quiz);
        if($time_limit=='N'){
            $set_time_limit=null;
        }        
        $mquiz->setTimeLimit($set_time_limit);
        $mquiz->setCommentQuiz($comment_test);
        $mquiz->setSeeTheResult($see_the_result);
        $mquiz->setSeeDetails($see_details);
        $mquiz->setIdStatusQuiz($status_test);
        return $quiz->createQuiz($mquiz, $muser);;
    }
    public function addQuestion($text_question, $comment_question, $question_type, $new_id_quiz){  
        $mquestion= new MQuestion();
        $question= new QuestionDAO();
        $mquestion->setTextQuestion($text_question);
        $mquestion->setCommentQuestion($comment_question);
        $mquestion->setIdQuestionsType($question_type);
        $mquestion->setIdTest($new_id_quiz);     
        $question->createQuestion($mquestion);
    }
}
