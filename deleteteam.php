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
$Code = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;
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
    $stmt->execute(array($Code));
    // fatch the data
    $row = $stmt->fetch();
    $do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;

                //request player

                if ($do == 'deleteteam') { 
           
           // select all data depond on this id

        $check = checkitem('Code', 'team', $Code );        
        $check2 = checkitem('UserName', 'player', $_SESSION['UserName'] );        

   // if there is such id show the form
           if($check > 0) { 

               $stmt = $con->prepare("
               DELETE FROM team WHERE Code = ?

               ");

               $stmt->execute(array($Code));

               header("location:E-Sport.php");

               $stmt2 = $con->prepare("
               DELETE
               FROM 
                    `join` 
               WHERE 
                    TEAM_CODE = ?
                                   ");
               $stmt2->execute(array($Code));
           }
           if($check2 > 0) { 

               $_SESSION['regst'] = 1 ;


               $stmt = $con->prepare("
    
               UPDATE player SET regst = 1 , teamcode = '' , playertype = 'player' WHERE UserName = ?
               
               ");

               $stmt->execute(array($_SESSION['UserName']));

               header("location:E-Sport.php");
           }
        }