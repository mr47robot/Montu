<?php
ob_start();
include('dbcon.php');
$CODE = $_GET['Code'] ;
$tcode = $_GET['tcode'] ;
$do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
?>
<?php
if ($do == 'upq') {   


    $Question = $_POST['Question'] ;
    $corrans = $_POST['corrans'] ;
    $answer1 = $_POST['answer1'] ;
    $answer2 = $_POST['answer2'] ;
    $answer3 = $_POST['answer3'] ;
    $answer4 = $_POST['answer4'] ;


               $stmt = $con->prepare("
               UPDATE
                    test
               SET
                    Question=?, answer1=?, answer2=?, answer3=?, answer4=?, corrans=?
               WHERE
                     Code = ?
               ");

               $stmt->execute(array($Question,$answer1,$answer2,$answer3,$answer4,$corrans,$CODE));

               header("location:editquestion.php?Code=$tcode");





}
    
?>

<!-- /////////////////////////////////////////////////////////////////////////////////////// -->

<?php
if ($do == 'deq') {   


    $CODE = $_GET['Code'] ;



               $stmt = $con->prepare("
               DELETE FROM 
               test
               WHERE
               Code = ?
               ");

               $stmt->execute(array($CODE));

               header("location:editquestion.php?Code=$tcode");






    } 
?>
