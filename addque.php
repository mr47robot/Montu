<?php
ob_start();
include('dbcon.php');

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
$CODE = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Question = $_POST['Question'] ;
    $corrans = $_POST['corrans'] ;
    $answer1 = $_POST['answer1'] ;
    $answer2 = $_POST['answer2'] ;
    $answer3 = $_POST['answer3'] ;
    $answer4 = $_POST['answer4'] ;


    foreach($Question as $rec => $value) {

        $Question = $_POST['Question'][$rec] ;

        $corrans = $_POST['corrans'][$rec] ;

        $answer1 = $_POST['answer1'][$rec] ;

        $answer2 = $_POST['answer2'][$rec] ;

        $answer3 = $_POST['answer3'][$rec] ;

        $answer4 = $_POST['answer4'][$rec] ;


        
    $stmt = $con->prepare("
    INSERT INTO 
    test(Question , corrans , answer1 , answer2 , answer3 , answer4 , tcode )
    VALUES(:zQuestion , :zcorrans , :zanswer1 , :zanswer2 , :zanswer3 , :zanswer4 , :ztcode  )
                        ");

        $stmt->execute(array(
            ':zQuestion' => $Question,
            ':zcorrans' => $corrans,
            ':zanswer1' => $answer1,
            ':zanswer2' => $answer2,
            ':zanswer3' => $answer3,
            ':zanswer4' => $answer4 ,
            ':ztcode' => $CODE 
        ));


        header("location:editquestion.php?Code=$CODE") ;


    }


}