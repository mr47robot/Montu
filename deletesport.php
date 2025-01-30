<?php
ob_start();
include('dbcon.php');
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;


if ($do == 'des') {   
    $CODE = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;
    $stmt = $con->prepare("
    SELECT
        *
    FROM 
      sport 
    WHERE
    Code = ?
                        ");
// execute query
$stmt->execute(array($CODE));
// fatch the data
$rows = $stmt->fetch();
// the raw count to check the id in database
$count = $stmt->rowcount(); 
// if there is such id show the form
  if($count > 0) {

    function checkitem($select , $from , $value) {

        global $con;

        $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

        $statement->execute(array($value));

        $count = $statement->rowcount();

        return $count;
    }
           
           // select all data depond on this id

        $check = checkitem('Code', 'sport', $CODE );        

   // if there is such id show the form
           if($check > 0) { 

               $stmt = $con->prepare("
               DELETE FROM 
               sport
               WHERE
               Code = ?
               ");

               $stmt->execute(array($CODE));

               header("location:viewsport.php?do=esport&Code=1");

              
           }

        }

    }

if ($do == 'dep') {   
    $CODE = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;
    $stmt = $con->prepare("
    SELECT
        *
    FROM 
      sport 
    WHERE
    Code = ?
                        ");
// execute query
$stmt->execute(array($CODE));
// fatch the data
$rows = $stmt->fetch();
// the raw count to check the id in database
$count = $stmt->rowcount(); 
// if there is such id show the form
  if($count > 0) {

    function checkitem($select , $from , $value) {

        global $con;

        $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

        $statement->execute(array($value));

        $count = $statement->rowcount();

        return $count;
    }
           
           // select all data depond on this id

        $check = checkitem('Code', 'sport', $CODE );        

   // if there is such id show the form
           if($check > 0) { 

               $stmt = $con->prepare("
               DELETE FROM 
               sport
               WHERE
               Code = ?
               ");

               $stmt->execute(array($CODE));

               header("location:viewsport.php?do=psport&Code=2");

              
           }

        }

    }
}
 
  
 else {
  header("location:game.php");

} ?>
