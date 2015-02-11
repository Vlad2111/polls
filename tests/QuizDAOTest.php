<?php
include_once 'DAO/QuizDAO.php';
include_once 'model/ValuesQuiz.php';
include_once 'lib/DB.php';
class QuizDAOTest extends PHPUnit_Framework_TestCase{
    public $quiz;
    public $values_quiz;
    public function getValues(){
        include_once 'DAO/QuizDAO.php';
        include_once 'model/ValuesQuiz.php';
        $values_quiz=new ValuesQuiz();
        $values_quiz->setTopic('Test');
        $values_quiz->setTimeLimit(0);
        $values_quiz->setCommentQuiz('test');
        $values_quiz->setSeeTheResult('Y');
        $values_quiz->setSeeDetails('Y');
        $values_quiz->setStatus('for_test');
        $values_quiz->setIdQuiz(1);
        $values_quiz->setTexts('Question Test');
        $values_quiz->setType(1);
        $values_quiz->setAnswer('Test');
        $values_quiz->setCommentQuestion('test');
        $this->quiz=new QuizDAO();
        
       
    }
    /**
     * @depends getValues
     */
    public function testCreateQuiz(){      
        $this->assertContainsOnly('resource', $this->quiz->createQuiz($this->values_quiz));
    }
    /**
     * @depends testCreateQuiz
     */
    public function getIdTestQuiz(){
        $query="SELECT id_test FROM test WHERE topic='$1' and time_limit='$2' and"
                . " comment_test='$3', see_the_result='$4' and"
                . " see_details='$5' and status='$6';";
        $array_params=array();
        $array_params[]=$quiz->getTopic();
        $array_params[]=$quiz->getTimeLimit();
        $array_params[]=$quiz->getCommentTest();
        $array_params[]=$quiz->getSeeTheResult();
        $array_params[]=$quiz->getSeeDetails();
        $array_params[]=$quiz->getStatus();
        $result=$this->db->execute($query,$array_params);
        $obj= $this->db->getFetchObject($result);
        $this->values_quiz->setIdQuiz($obj->id_test);
    }
     /**
     * @depends getIdTestQuiz
     */
    public function testUpdateQuiz(){
        $this->assertContainsOnly('resource', $this->quiz->updateQuiz($this->values_quiz));
    }    
    /**
     * @depends getValues
     */
    public function testCreateQuestion(){
        $this->assertContainsOnly('resource', $this->quiz->createQuestion($this->values_quiz));
    }
    /**
     * @depends testCreateQuestion
     */
    public function getIdTestQuestion(){
        $query="SELECT id_question FROM questions WHERE texts=$1 and type=$2 and"
                . " answer=$3 and comment_question=$4;";
        $array_params=array();
        $array_params[]=$quiz->getTexts();
        $array_params[]=$quiz->getType();
        $array_params[]=$quiz->getAnswer();
        $array_params[]=$quiz->getCommentQuestion(); 
        $result=$this->db->execute($query,$array_params);
        $obj= $this->db->getFetchObject($result);
        $this->values_quiz->setIdQuiz($obj->id_question);
    }
    /**
     * @depends getIdTestQuestion
     */
    public function testUpdateQuestion(){
        $this->assertContainsOnly('resource', $this->quiz->updateQuestion($this->values_quiz));
    }
    /**
     * @depends testUpdateQuestion
     */
    public function testAddQuestion(){
        $this->assertContainsOnly('resource', $this->quiz->addQuestion($this->values_quiz));
    }
    /**
     * @depends testAddQuestion
     */
    public function testDeleteQuestion(){
        $this->assertContainsOnly('resource', $this->quiz->deleteQuestion($this->values_quiz));
    }
    /**
     * @depends getIdTestQuiz
     */
    public function testDeleteQuiz(){
        $this->assertContainsOnly('resource', $this->quiz->deleteQuiz($this->values_quiz));
    }
    /**
     * @depends testDeleteQuestion
     */
    
    public function testDeleteQuizQuestion(){
        $this->assertContainsOnly('resource', $this->quiz->deleteQuizQuestion($this->values_quiz));
    }
}


?>