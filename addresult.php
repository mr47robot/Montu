<?php
ob_start();
include('dbcon.php');
function checkitem($select , $from , $value) {

    global $con;

    $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

    $statement->execute(array($value));

    $count = $statement->rowcount();

    return $count;
}
function capture_output_buffer() {
    ob_start();
    return function() {
        $buffer = ob_get_contents();
        ob_end_clean();
        return $buffer;
    };
}

$CODE = $_GET['Code'] ;
$ID = $_SESSION['ID'] ;
$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;




//////////////////////////////////////

$stmt2 = $con->prepare("
SELECT
    *
FROM 
    test 
WHERE
  tcode = ?
  
                    ");

                    
                    
$stmt2->execute(array(
  $CODE
));
$rows2 = $stmt2->fetchall();



if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

    $answersum = 0 ;
    $acount = 1 ;

    foreach($rows2 as $rec) {

   $answer = $_POST['answer'.$acount.''] ;
   
   $acount++;

    
if($answer == 1) {
    $answersum ++ ;

}



}



   $stmt = $con->prepare("
    UPDATE
        player
    SET
         test_degree = ?
    WHERE
        ID = ?
                        ");

        $stmt->execute(array(
            $answersum,$ID
        ));



///////////////////////////////////////////////////////////////

foreach($rows2 as $rec) {

    $TEST_CODE = $rec['Code'] ;

    $stmt2 = $con->prepare("
    INSERT INTO 
    request( P_ID , TEST_CODE , TEAM_CODE  )
    VALUES( :zP_ID , :zTEST_CODE , :zTEAM_CODE  )
                        ");

        $stmt2->execute(array(
            ':zP_ID'  => $ID  , 
            ':zTEST_CODE'  => $TEST_CODE  ,
            ':zTEAM_CODE' => $CODE  
        )); 
    }

$stmt = $con->prepare(
    'SELECT 
    *
    FROM
    team
    WHERE
    Code  = ? 
    '
      );
    // execute query
    $stmt->execute(array($CODE));
    // fatch the data
    $row = $stmt->fetch();


$_SESSION['regst'] = 5 ;
$_SESSION['teamcode'] = $row['Code'] ;

$stmt = $con->prepare("UPDATE player SET regst = 5 , teamcode = ".$row['Code']." WHERE UserName = ?");

$stmt->execute(array($_SESSION['UserName']));

header("location:Team.php?do=team&Code=$CODE");

}



        