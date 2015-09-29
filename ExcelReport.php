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
//include_once 'DAO/AdministrationDAO.php';

// Создаем объект класса PHPExcel
$xls = new PHPExcel();
$authorDAO = new AuthorQuizDAO();
$testingDAO = new TestingDAO();
$intervieweeDAO=new IntervieweeDAO();
//$admDAO = new AdministrationDAO();

$quiz = $authorDAO->getListObjQuiz($_GET['id_quiz']);
$questions = $authorDAO->getListQuestion($_GET['id_quiz']);
$users = $authorDAO->getTestingUsers($_GET['id_quiz']);
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Таблица умножения');

// Вставляем текст в ячейку A1
$sheet->setCellValue("A1", 'Тема');
$sheet->setCellValue("D1", $quiz->topic);
$sheet->setCellValue("A2", 'Комментарии');
$sheet->setCellValue("D2", $quiz->comment_test);
$sheet->setCellValue("A3", 'Временное ограничение');
$sheet->setCellValue("D3", $quiz->time_limit);
//$sheet->getStyle('A1')->getFill()->setFillType(
//    PHPExcel_Style_Fill::FILL_SOLID);
//$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');

// Объединяем ячейки
$sheet->mergeCells('A1:C1');
$sheet->mergeCells('A2:C2');
$sheet->mergeCells('A3:C3');

$i = 2;


$j = 6;
foreach($users as $user) {
    $obj = $authorDAO->getUserData($user);
    $id_testing = $testingDAO->getIdTesting($user, $_GET['id_quiz']);
    $sheet->setCellValue("F3", $id_testing);
    //$listOfAnswers = $intervieweeDAO->getListOfAnswers($id_testing);
    $sheet->setCellValueByColumnAndRow(0, $j, $obj->last_name." ".$obj->first_name);
    $j++;
    foreach($questions as $question) {
        $sheet->setCellValueByColumnAndRow($i, 5, $listOfAnswers[$question]);
        $i++;
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



// Выводим HTTP-заголовки
 header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
 header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
 header ( "Cache-Control: no-cache, must-revalidate" );
 header ( "Pragma: no-cache" );
 header ( "Content-type: application/vnd.ms-excel" );
 header ( "Content-Disposition: attachment; filename=matrix".$_GET['id_quiz'].".xls" );

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
