<?php
/** Error reporting */
error_reporting(E_ALL);

/** PHPExcel */
include 'Excel/PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'Excel/PHPExcel/Writer/Excel2007.php';
include 'DAO/AuthorQuizDAO.php';
include 'DAO/TestingDAO.php';
include 'DAO/IntervieweeDAO.php';
//include 'DAO/QuestionDAO.php';
//include 'DAO/AnswerOptionsDAO.php';
//include 'model/MInterviewee.php';
//include_once 'DAO/AdministrationDAO.php';

// Создаем объект класса PHPExcel
$xls = new PHPExcel();
$authorDAO = new AuthorQuizDAO();
$testingDAO = new TestingDAO();
$intervieweeDAO=new IntervieweeDAO();
$answerOptionsDAO=new AnswerOptionsDAO();
$questionDAO = new QuestionDAO();
//$admDAO = new AdministrationDAO();

$quiz = $authorDAO->getListObjQuiz($_GET['id_quiz']);
$questionsId = $authorDAO->getListQuestion($_GET['id_quiz']);
$users = $authorDAO->getTestingUsers($_GET['id_quiz']);
$questions = $authorDAO->getDataQuestions($_GET['id_quiz']);
$typeQuestions = $questionDAO->getQuestionType();
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Ответы');

$sheet->getColumnDimension('A')->setAutoSize(true);
for($i=1;$i<8;$i++){
    $sheet->getRowDimension($i)->setRowHeight(15);
}

function coordinates($x,$y){
    return PHPExcel_Cell::stringFromColumnIndex($x).$y;
}

$arHeadStyle = array(
    'font'  => array(
        'color' =>array(
            'rgb' => 'ffffff'), 
        'name'  => 'Verdana', 
        'size'     	=> 11,
    ),
    'fill' => array(
        'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
        'color'=>array(
            'rgb' => '999999'
        )
    ),
    'borders'=>array(
        'bottom'=>array(
            'style'=>PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb'=>'000000'
            )
        ),
        'right'=>array(
            'style'=>PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb'=>'000000'
            )
        ),
        'left'=>array(
            'style'=>PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb'=>'000000'
            )
        ),
        'top'=>array(
            'style'=>PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb'=>'000000'
            )
        )
    ));
    
$sheet->getStyle('A1')->applyFromArray($arHeadStyle);
$sheet->getStyle('A2')->applyFromArray($arHeadStyle);
$sheet->getStyle('A3')->applyFromArray($arHeadStyle);
$sheet->getStyle('A4')->applyFromArray($arHeadStyle);

// Вставляем текст в ячейку A1
$sheet->setCellValue("A1", 'Тема');
$sheet->setCellValue("B1", $quiz->topic);
$sheet->setCellValue("A2", 'Комментарии');
$sheet->setCellValue("B2", $quiz->comment_test);
$sheet->setCellValue("A3", 'Временное ограничение');
$sheet->setCellValue("B3", $quiz->time_limit);
$sheet->setCellValue("A4", 'Экспортировано');
$sheet->setCellValue("B4", date("d.m.y H:i:s"));
//$sheet->getStyle('A1')->getFill()->setFillType(
//    PHPExcel_Style_Fill::FILL_SOLID);
//$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');

// Объединяем ячейки
$sheet->mergeCells('B1:E1');
$sheet->mergeCells('B2:E2');
$sheet->mergeCells('B3:E3');
$sheet->mergeCells('B4:E4');

//Style of cell in user answers

$rightBorder = array(
    'borders'=>array(
        'right'=>array(
            'style'=>PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb'=>'000000'
            )
        )
    )
);

$hor = 8;
if(isset($users[0])){
    foreach($users as $user) {
        $rightAnswers = 0;
        $ver = 1;
        $sheet->getRowDimension($hor)->setRowHeight(17);
        $sheet->setCellValueByColumnAndRow(0, 6, 'Номер вопроса');
        $sheet->getStyleByColumnAndRow(0, 6)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyleByColumnAndRow(0, 6)->applyFromArray($arHeadStyle);
        $sheet->getStyleByColumnAndRow(0, 7)->applyFromArray($arHeadStyle);
        $obj = $authorDAO->getUserData($user);
        $id_testing = $testingDAO->getIdTesting($user, $_GET['id_quiz']);
        $minterviewee = new MInterviewee();
        $minterviewee->setIdTesting($id_testing);
        $listOfAnswers = $intervieweeDAO->getListOfAnswers($minterviewee);
        $sheet->getStyleByColumnAndRow(0, $hor)->applyFromArray($arHeadStyle);
        $sheet->setCellValueByColumnAndRow(0, $hor, $obj->last_name." ".$obj->first_name);
        $iterator = 0;
        foreach($questions as $question) {
            $iterator++;
            $answerOption = $answerOptionsDAO->getDataAnswerOtions($question->id_question);
            if(isset($listOfAnswers[$question->id_question])) {
                for($j=0; $j<count($listOfAnswers[$question->id_question]); $j++){
                    $flag = true;
                    if(isset($listOfAnswers[$question->id_question][$j])){
                        if($question->id_questions_type != 4){
                            if($question->id_questions_type != 5){
                                $obj=$answerOptionsDAO->getRightAnswerOptions($listOfAnswers[$question->id_question][$j]);
                                if($obj != ''){
                                    if($obj == 'Y') {
                                        $flag = true;
                                    } else {
                                        $flag = false;
                                    }
                                    if($j==count($listOfAnswers[$question->id_question])-1) {
                                       $countOfRight = $answerOptionsDAO->getCountOfRightAnswers($question->id_question);
                                        if($flag && $countOfRight == count($listOfAnswers[$question->id_question])) {
                                            //$sheet->getStyleByColumnAndRow($ver, $hor)->applyFromArray($success);
                                            $str = '';
                                            foreach($listOfAnswers[$question->id_question] as $id) {
                                                if($str == ''){
                                                    if(isset($answerOptionsDAO->getListObjAnswerOption($id)->answer_the_questions)) {
                                                        $str = $str.$answerOptionsDAO->getListObjAnswerOption($id)->answer_the_questions;
                                                    }
                                                }
                                                else {
                                                    if(isset($answerOptionsDAO->getListObjAnswerOption($id)->answer_the_questions)) {
                                                        $str = $str.'; '.$answerOptionsDAO->getListObjAnswerOption($id)->answer_the_questions;
                                                    }
                                                }
                                            }   
                                            $sheet->setCellValueByColumnAndRow($ver, $hor, $str);
                                            $sheet->setCellValueByColumnAndRow($ver+1, $hor, 'Правильно');
                                            $sheet->getStyleByColumnAndRow($ver+1, $hor)->applyFromArray($rightBorder);
                                            $rightAnswers = $rightAnswers + $question->weight;
                                        } else {
                                            //$sheet->getStyleByColumnAndRow($ver, $hor)->applyFromArray($danger);
                                            $str = '';
                                            foreach($listOfAnswers[$question->id_question] as $id) {
                                                if($str == ''){
                                                    if(isset($answerOptionsDAO->getListObjAnswerOption($id)->answer_the_questions)) {
                                                        $str = $str.$answerOptionsDAO->getListObjAnswerOption($id)->answer_the_questions;
                                                    }
                                                }
                                                else {
                                                    if(isset($answerOptionsDAO->getListObjAnswerOption($id)->answer_the_questions)) {
                                                        $str = $str.'; '.$answerOptionsDAO->getListObjAnswerOption($id)->answer_the_questions;
                                                    }
                                                }
                                            }
                                            $sheet->setCellValueByColumnAndRow($ver, $hor, $str);
                                            $sheet->setCellValueByColumnAndRow($ver+1, $hor, 'Неправильно');
                                            $sheet->getStyleByColumnAndRow($ver+1, $hor)->applyFromArray($rightBorder);
                                        }
                                    }
                                }
                            }
                            else {
                                $str = '';
                                foreach($listOfAnswers[$question->id_question] as $id) {
                                    if(isset($answerOptionsDAO->getListObjAnswerOption($id)->answer_the_questions)) {
                                        $str = ' '.$questionDAO->getRate($answerOptionsDAO->getListObjAnswerOption($id)->answer_the_questions);
                                    }
                                }
                                $sheet->setCellValueByColumnAndRow($ver, $hor, $str);
                                $sheet->setCellValueByColumnAndRow($ver+1, $hor, ' '); 
                                $sheet->getStyleByColumnAndRow($ver+1, $hor)->applyFromArray($rightBorder);      
                            }
                        }
                        else {
                            $str = ''.$listOfAnswers[$question->id_question][0];
                            $sheet->setCellValueByColumnAndRow($ver, $hor, $str);
                            $sheet->setCellValueByColumnAndRow($ver+1, $hor, ' ');
                            $sheet->getStyleByColumnAndRow($ver+1, $hor)->applyFromArray($rightBorder);
                            
                            if($listOfAnswers[$question->id_question][0]!=''){
                            $height = substr_count($listOfAnswers[$question->id_question][0], PHP_EOL)*15+15;
                                $sheet->getRowDimension($hor)->setRowHeight($height);
                            }
                        }
                    } 
                    else {
                        //$sheet->getStyleByColumnAndRow($ver, $hor)->applyFromArray($skip);
                        $sheet->setCellValueByColumnAndRow($ver+1, $hor, 'Пропущено');
                        $sheet->getStyleByColumnAndRow($ver+1, $hor)->applyFromArray($rightBorder);
                    }
                }
                
            }
            $sheet->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($ver))->setAutoSize(true);
            $sheet->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($ver+1))->setAutoSize(true);
            $sheet->getStyleByColumnAndRow($ver, 6)->applyFromArray($arHeadStyle);
            $sheet->getStyleByColumnAndRow($ver, 6)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $sheet->getStyleByColumnAndRow($ver+1, 6)->applyFromArray($arHeadStyle);
            $sheet->mergeCells(coordinates($ver, 6).':'.coordinates($ver+1, 6));
            $sheet->setCellValueByColumnAndRow($ver, 6, $iterator);
            $sheet->setCellValueByColumnAndRow($ver, 7, 'Ответ');
            $sheet->getStyleByColumnAndRow($ver, 7)->applyFromArray($arHeadStyle);
            $sheet->setCellValueByColumnAndRow($ver+1, 7, 'Правильность');
            $sheet->getStyleByColumnAndRow($ver+1, 7)->applyFromArray($arHeadStyle);
            /*if(isset($listOfAnswers[$question->id_question][0])) {
                $sheet->setCellValueByColumnAndRow($ver, $hor, $listOfAnswers[$question->id_question][0]);
            }*/
            $ver = $ver+2;
        }   
        $sheet->setCellValueByColumnAndRow($ver, $hor, $rightAnswers);
        $sheet->setCellValueByColumnAndRow($ver+1, $hor, $testingDAO->getInterval($id_testing));
        $sheet->setCellValueByColumnAndRow($ver, 6, 'Баллы');
        $sheet->setCellValueByColumnAndRow($ver+1, 6, 'Время');
        $sheet->getStyleByColumnAndRow($ver, 6)->applyFromArray($arHeadStyle);
        $sheet->getStyleByColumnAndRow($ver+1, 6)->applyFromArray($arHeadStyle);
        $sheet->getStyleByColumnAndRow($ver, 7)->applyFromArray($arHeadStyle);
        $sheet->getStyleByColumnAndRow($ver+1, 7)->applyFromArray($arHeadStyle);
        $hor++;
    }
}
// Выравнивание текста
//$sheet->getStyle('A1')->getAlignment()->setHorizontal(
//    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

/*for ($i = 2; $i < 10; $i++) {
	for ($j = 2; $j < 10; $j++) {
        // Выводим таблицу умножения
        $sheet->setCellValueByColumnAndRow(
                                          $i - 2,
                                          $j,
                                          $i . "x" .$j . "=" . ($i*$j));
	    // Применяем выравнивание
	    $sheet->getStyleByColumnAndRow($i - 2, $j)->getAlignment()->
                setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	}
}*/
$xls->createSheet();
$xls->setActiveSheetIndex(1);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Вопросы');

$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setWidth(40);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);

$sheet->setCellValueByColumnAndRow(0, 1, 'Порядок вопроса');
$sheet->setCellValueByColumnAndRow(1, 1, 'Текст');
$sheet->setCellValueByColumnAndRow(2, 1, 'Тип вопроса');
$sheet->setCellValueByColumnAndRow(3, 1, 'Доп. Информация');
$sheet->setCellValueByColumnAndRow(4, 1, 'Правильные ответы');
$sheet->setCellValueByColumnAndRow(5, 1, 'Вес');

$arHeadStyle = array(
    'font'  => array(
        'color' =>array(
            'rgb' => 'ffffff'), 
        'name'  => 'Verdana'
    ),
    'fill' => array(
        'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
        'color'=>array(
            'rgb' => '999999'
        )
    ),
    'borders'=>array(
        'bottom'=>array(
            'style'=>PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb'=>'000000'
            )
        )
    ));
    
$sheet->getStyle('A1')->applyFromArray($arHeadStyle);
$sheet->getStyle('B1')->applyFromArray($arHeadStyle);
$sheet->getStyle('C1')->applyFromArray($arHeadStyle);
$sheet->getStyle('D1')->applyFromArray($arHeadStyle);
$sheet->getStyle('E1')->applyFromArray($arHeadStyle);
$sheet->getStyle('F1')->applyFromArray($arHeadStyle);

$i=2;
$iterator = 0;
foreach($questions as $question) {
    if(isset($question->id_question)) {
        $iterator++;
        $answerOption = $answerOptionsDAO->getDataAnswerOtions($question->id_question);
        $sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValueByColumnAndRow(0, $i, $iterator);
        $sheet->setCellValueByColumnAndRow(1, $i, $question->text_question);
        $sheet->setCellValueByColumnAndRow(2, $i, $typeQuestions[$question->id_questions_type-1]);
        $sheet->setCellValueByColumnAndRow(3, $i, " ".$question->comment_question);
        $str = '';
        $height = 15;
        foreach($answerOption as $oneOption){
            if(isset($oneOption->right_answer) && $oneOption->right_answer == 'Y') {
                $str = $str." \n".$oneOption->answer_the_questions;
                $height = $height + 10;
            }
        }
        $sheet->getRowDimension($i)->setRowHeight($height);
        $sheet->setCellValueByColumnAndRow(4, $i, $str);
        $sheet->setCellValueByColumnAndRow(5, $i, $question->weight);
        $i++;
    }
}   



$xls->setActiveSheetIndex(0);
// Выводим HTTP-заголовки
 header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
 header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
 header ( "Cache-Control: no-cache, must-revalidate" );
 header ( "Pragma: no-cache" );
 header ( "Content-type: application/vnd.ms-excel" );
 header ( "Content-Disposition: attachment; filename=".$quiz->topic." - ".date("d.m.y H:i:s").".xls" );

// Выводим содержимое файла
 $objWriter = new PHPExcel_Writer_Excel5($xls);
 $objWriter->save('php://output');
/*$file = ("primer.php");
header ("Content-Type: application/octet-stream");
header ("Accept-Ranges: bytes");
header ("Content-Length: ".filesize($file));
header ("Content-Disposition: attachment; filename=".$file);  
readfile($file);*/

// Echo done
echo date('H:i:s') . " Done writing file.\r\n";
