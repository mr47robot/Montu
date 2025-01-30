<?php
ob_start();
include('dbcon.php');
$Code = $_GET['Code'] ;
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
    $stmt1->execute(array($_SESSION['UserName']));
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
    $TEAM_EMAIL = $row1['EMAIL'] ;
    $TEAM_LEADER = $row1['TeamLeaderName'] ;
    $TOURNAMENT_CODE = $row2['Code'] ;
    $TOURNAMENT_NAME = $row2['Name'] ;
    $TOURNAMENT_GAME = $row2['game_code'] ;
    $TOURNAMENT_LOGO = $row2['logo'] ;
    $TOURNAMENT_Start_Date = $row2['Start_Date'] ;
    $TOURNAMENT_End_date = $row2['End_date'] ;




function checkitem($select , $from , $value) {

    global $con;

    $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

    $statement->execute(array($value));

    $count = $statement->rowcount();

    return $count;
}



        //request tour

        if ($do == 'jointour') { 

        // select all data depond on this id

        $check = checkitem('UserName', 'player', $_SESSION['UserName'] );        

        // if there is such id show the form
                if($check > 0) { 

                    $stmt = $con->prepare("
                    INSERT INTO
                    `join`(TEAM_CODE , TEAM_NAME , TEAM_LOGO , TEAM_LEADER , TEAM_EMAIL , TOURNAMENT_CODE , TOURNAMENT_NAME , TOURNAMENT_GAME , TOURNAMENT_LOGO, TOURNAMENT_Start_Date , TOURNAMENT_End_date , regst)
                    VALUES(:zTEAM_CODE, :zTEAM_NAME , :zTEAM_LOGO , :zTEAM_LEADER , :zTEAM_EMAIL , :zTOURNAMENT_CODE , :zTOURNAMENT_NAME, :zTOURNAMENT_GAME , :zTOURNAMENT_LOGO , :zTOURNAMENT_Start_Date , :zTOURNAMENT_End_date ,  1)
                                        ");
                    $stmt->execute(array(

                        'zTEAM_CODE' => $TEAM_CODE,
                        'zTEAM_NAME' => $TEAM_NAME,
                        'zTEAM_LOGO' => $TEAM_LOGO,
                        'zTEAM_LEADER' => $TEAM_LEADER,
                        'zTEAM_EMAIL' => $TEAM_EMAIL,
                        'zTOURNAMENT_CODE' => $TOURNAMENT_CODE,
                        'zTOURNAMENT_NAME' => $TOURNAMENT_NAME ,
                        'zTOURNAMENT_GAME' => $TOURNAMENT_GAME ,
                        'zTOURNAMENT_LOGO' => $TOURNAMENT_LOGO ,
                        'zTOURNAMENT_Start_Date' => $TOURNAMENT_Start_Date ,
                        'zTOURNAMENT_End_date' => $TOURNAMENT_End_date 

                    ));

                    $stmt2 = $con->prepare("
                    UPDATE
                         team
                    SET 
                         regst = 1
                    WHERE
                    TeamLeaderName = ?
                                        ");
                    $stmt2->execute(array($_SESSION['UserName']));

                    header("location:MAINTOUR.PHP?do=tour&Code=$Code");

                }
             }

             if ($do == 'exittour') { 

                $check = checkitem('UserName', 'player', $_SESSION['UserName'] );        

                // if there is such id show the form
                        if($check > 0) { 
                            $stmt3 = $con->prepare("
                    UPDATE
                         team
                    SET 
                         regst = ''
                    WHERE
                    TeamLeaderName = ?
                                        ");
                    $stmt3->execute(array($_SESSION['UserName']));

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

                    header("location:MAINTOUR.PHP?do=tour&Code=$Code");

             }

            }