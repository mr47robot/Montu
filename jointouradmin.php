<?php
ob_start();
include('dbcon.php');

if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{
     
$Code = $_GET['Code'] ;
$TEAM_LEADER = $_GET['TeamLeaderName'] ;
$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;


$stmt1 = $con->prepare(
    'SELECT 
    *
    FROM
    team
    WHERE
    TeamLeaderName = ? 
    '
      );
    // execute query
    $stmt1->execute(array($TEAM_LEADER));
    // fatch the data
    $row1 = $stmt1->fetch();

$stmt2 = $con->prepare(
    'SELECT 
    *
    FROM
    Tournament
    WHERE
    Code = ? 
    '
      );
    // execute query
    $stmt2->execute(array($Code));
    // fatch the data
    $row2 = $stmt2->fetch();

    $TEAM_CODE = $row1['Code'] ;
    $TEAM_NAME = $row1['Name'] ;
    $TEAM_LOGO = $row1['logo'] ;
    $TEAM_LEADER = $row1['TeamLeaderName'] ;
    $TOURNAMENT_CODE = $row2['Code'] ;
    $TOURNAMENT_NAME = $row2['Name'] ;
    $TOURNAMENT_game = $row2['game_code'] ;




function checkitem($select , $from , $value) {

    global $con;

    $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

    $statement->execute(array($value));

    $count = $statement->rowcount();

    return $count;
}



        //request tour

        if ($do == 'jointour') { 


               $stmt = $con->prepare("
               UPDATE
                    team
               SET 
                    regst = 2
               WHERE
               TeamLeaderName = ?
                                   ");
               $stmt->execute(array($TEAM_LEADER));

               $stmt2= $con->prepare("
               UPDATE
                    `join`
               SET 
                    regst = 2
               WHERE
               TEAM_CODE = ?
                                   ");
               $stmt2->execute(array($TEAM_CODE));

               header('location:tourpage.php?do=tour&Code='.$TOURNAMENT_CODE.'');
                }

        if ($do == 'jointourreq') { 


               $stmt = $con->prepare("
               UPDATE
                    team
               SET 
                    regst = 2
               WHERE
               TeamLeaderName = ?
                                   ");
               $stmt->execute(array($TEAM_LEADER));

               $stmt2= $con->prepare("
               UPDATE
                    `join`
               SET 
                    regst = 2
               WHERE
               TEAM_CODE = ?
                                   ");
               $stmt2->execute(array($TEAM_CODE));

               header('location:sport requests.php?do=gamereq&Code='.$TOURNAMENT_game.'');
                }

             if ($do == 'exittour') { 

                            $stmt3 = $con->prepare("
                    UPDATE
                         team
                    SET 
                         regst = ''
                    WHERE
                    TeamLeaderName = ?
                                        ");
                    $stmt3->execute(array($TEAM_LEADER));

                    $stmt4 = $con->prepare("
                    DELETE 
                    FROM 
                         `join` 
                    WHERE 
                         TEAM_CODE = ?
                    AND
                       TOURNAMENT_CODE = ?

                                        ");
                    $stmt4->execute(array($TEAM_CODE , $TOURNAMENT_CODE));

                    header('location:tourpage.php?do=tour&Code='.$TOURNAMENT_CODE.'');
             }

             if ($do == 'exittourreq') { 

                            $stmt3 = $con->prepare("
                    UPDATE
                         team
                    SET 
                         regst = ''
                    WHERE
                    TeamLeaderName = ?
                                        ");
                    $stmt3->execute(array($TEAM_LEADER));

                    $stmt4 = $con->prepare("
                    DELETE 
                    FROM 
                         `join` 
                    WHERE 
                         TEAM_CODE = ?
                         AND
                         TOURNAMENT_CODE = ?
  
                                          ");
                      $stmt4->execute(array($TEAM_CODE , $TOURNAMENT_CODE));

                    header('location:sport requests.php?do=gamereq&Code='.$TOURNAMENT_game.'');
             }
             ?>
<?php }
  
  else {
   header("location:game.php");
 
 } ?>
