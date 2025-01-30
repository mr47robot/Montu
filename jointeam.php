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

            
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // accept player

                if ($do == 'jointeamaccept') { 

                $ID = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;

                    // select all data depond on this id
         
                 $check = checkitem('ID', 'player', $ID );        
         
            // if there is such id show the form
                    if($check > 0) { 

                        $stmt = $con->prepare("UPDATE player SET regst = 3 WHERE ID = ?");
         
                        $stmt->execute(array($ID));
         
                        header("location:Team.php?do=team&Code=$Code");
                    }
                 }
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // out player

                if ($do == 'outteam') { 


                    // select all data depond on this id
         
                    $check = checkitem('UserName', 'player', $_SESSION['UserName'] );        

                    // if there is such id show the form
                            if($check > 0) { 
                                
                                $_SESSION['regst'] = 1 ;
                                $_SESSION['teamcode'] = '' ;

                                $stmt = $con->prepare("UPDATE player SET regst = 1 , teamcode = '' WHERE UserName = ?");
                 
                                $stmt->execute(array($_SESSION['UserName']));

                                $stmt2 = $con->prepare("DELETE FROM request WHERE P_ID = ?");
                 
                                $stmt2->execute(array($_SESSION['ID']));

                                $stmt3 = $con->prepare("
                                UPDATE
                                    player
                                SET
                                     test_degree = 0
                                WHERE
                                    ID = ?
                                                    ");
                            
                                    $stmt3->execute(array($_SESSION['ID']));
                 
                                header("location:Team.php?do=team&Code=$Code");
                            }
                 }
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////

                // delete player

                if ($do == 'deleteteam') { 

                    $ID = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;

                    // select all data depond on this id
         
                    $check = checkitem('ID', 'player', $ID );        

                    // if there is such id show the form
                            if($check > 0) { 
                                             
                                $stmt = $con->prepare("UPDATE player SET regst = 1 , teamcode = '' WHERE ID = ?");
                 
                                $stmt->execute(array($ID));

                                $stmt2 = $con->prepare("DELETE FROM request WHERE P_ID = ?");
                 
                                $stmt2->execute(array($ID));

                                $stmt3 = $con->prepare("
                                UPDATE
                                    player
                                SET
                                     test_degree = 0
                                WHERE
                                    ID = ?
                                                    ");
                            
                                    $stmt3->execute(array($ID));
                                
                 
                                header("location:Team.php?do=team&Code=$Code");
                            }
                 }


           ?>