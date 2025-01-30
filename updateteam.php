<?php
include('dbcon.php');


    $do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
    $CODE = $_GET['Codes'] ;

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
    /////////////////////////////////////////
    $stmt1 = $con->prepare(
        'SELECT 
        *
        FROM
        team
        WHERE
        TeamLeaderName  = ? 
        '
          );
        // execute query
        $stmt1->execute(array($_SESSION['UserName']));
        // fatch the data
        $row1 = $stmt1->fetch();

if ($do == 'updateteam') { 
   
    function checkitem($select , $from , $value) {

        global $con;

        $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

        $statement->execute(array($value));

        $count = $statement->rowcount();

        return $count;
    }
                           
    $Name   = $_GET['Name'];
    $Email   = $_GET['Email'];
    $TeamLeaderName = $_GET['TeamLeaderName'];
    $games = $_GET['game_code'];
    $level   = $_GET['level'] ;
    $PlayersNumber   = $_GET['PlayersNumber'] ;
    $Location   = $_GET['Location'] ;
    $profilepicture   = $_GET['profilepicture'] ;


            
//     // validate the form
//     $formerrors = array();
   
//     if(empty($Name)) {
        
//         $formerrors[] = 'Name cant be empty' ;
//     }
//     if(empty($Email)) {
        
//         $formerrors[] = 'Email cant be empty' ;
//     }
//     /*if(empty($TeamLeaderName)) {
        
//         $formerrors[] = 'Team Leader Name cant be empty' ;
//     }*/
//     // if(empty($games)) {
        
//     //     $formerrors[] = 'games cant be empty' ;
//     // }
//  //    if(empty($mini_rank)) {
        
//  //        $formerrors[] = 'mini_rank cant be empty' ;
//  //    }
//  //    if(empty($max_rank)) {
        
//  //        $formerrors[] = 'max_rank cant be empty' ;
//  //    } 
//     if(empty($level)) {
        
//      $formerrors[] = 'level cant be empty' ;
//  } 
//  if(empty($PlayersNumber)) {
        
//      $formerrors[] = 'PlayersNumber cant be empty' ;
//  } 
//  if(empty($Location)) {
        
//      $formerrors[] = 'Location cant be empty' ;
//  } 
//  /*if(empty($logo)) {
        
//      $formerrors[] = 'logo cant be empty' ;
//  }*/
    
//     // loop into error array and echo it
//     foreach($formerrors as $error) {
        
//         echo "<div class='alert alert-danger'>" . $error . "</div>";
//     }




//     // check if there's no error proceed the update operation

//     if (empty($formerrors)) {

//                // check if user exist in database 

//                // check if team exist in database 

//                $check = checkitem("Name" , "team" , $Name) ;
//                $check2 = checkitem("game_code" , "team" , $games) ;

//                if ($check == 1 && $Name !== $row['Name'] && $check2 == 1 ) {

//                    $themsg = " <div'>sorry this team is exist</div>" ;
//                    echo $themsg;
//                }

//                else {
//                 if(isset($_POST['uploadfilesub'])) {

                //declaring variables
                // $filename = $_FILES['profilepic']['name'];
                // $filetmpname = $_FILES['profilepic']['tmp_name'];

                //folder where images will be uploaded
                // $folder = 'img//';

                //function for saving the uploaded images in a specific folder
                // move_uploaded_file($filetmpname, $folder.$filename);
                //$file= str_replace(' ', '', $folder.$filename);
                // $file = $folder.$filename;

            // Insert UseerInfo To  DATABASE
            
               $stmt = $con->prepare("
               UPDATE
                     team
                SET
                  Name=? , Email=? , level=?  , PlayersNumber=?  , Location=?  , logo=?    
                WHERE
                    Code=?
                    ");
         

               $stmt->execute(array(
                $Name,$Email,$level,
                $PlayersNumber,$Location,$profilepicture,$CODE
               
               ));
               $stmt2 = $con->prepare("
               UPDATE
                     `join` 
                SET
                TEAM_NAME=? , TEAM_LOGO=? , TEAM_EMAIL=?    
                WHERE 
                  TEAM_CODE = ?
                    ");
         

               $stmt2->execute(array(
                $Name,$profilepicture,$Email,$CODE
               ));
               
         
           //Echo Success Message
           header("location:Team.php?do=team&Code=$CODE");

            }
         
//     }

// }
// }
    
 
if($do == "deleteteam" ) {
  
        function checkitem($select , $from , $value) {
    
            global $con;
    
            $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");
    
            $statement->execute(array($value));
    
            $count = $statement->rowcount();
    
            return $count;
        }

        $games = $_GET['game_code'];
        $check = checkitem('Code', 'team', $CODE );        
        $check2 = checkitem('UserName', 'player', $_SESSION['UserName'] );        

   // if there is such id show the form
           if($check > 0) { 

               $stmt = $con->prepare("
               DELETE FROM team WHERE Code = ?

               ");

               $stmt->execute(array($CODE));

               header("location:E-Sport.php");

               $stmt2 = $con->prepare("
               DELETE
               FROM 
                    `join` 
               WHERE 
                    TEAM_CODE = ?
                                   ");
               $stmt2->execute(array($CODE));
           }
           if($check2 > 0) { 

               $_SESSION['regst'] = 1 ;


               $stmt = $con->prepare("
    
               UPDATE player SET regst = 1 , teamcode = '' , playertype = 'player' WHERE UserName = ?
               
               ");

               $stmt->execute(array($_SESSION['UserName']));

               header("location:game.php?Code=$games");
           }
        }
        





