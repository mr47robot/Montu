<?php
ob_start();
include('dbcon.php');


// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function checkitem($select , $from , $value) {

        global $con;

        $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

        $statement->execute(array($value));

        $count = $statement->rowcount();

        return $count;
    }
                           
           echo "<div class='container'>" ;
           //Get Variables From The Form
           
           $Name   = $_GET['Name'];
           $Email   = $_GET['Email'];
           $TeamLeaderName = $_GET['TeamLeaderName'];
           $games = $_GET['Code'];
           $level   = $_GET['level'] ;
           $PlayersNumber   = $_GET['PlayersNumber'] ;
           $Location   = $_GET['Location'] ;
           $profilepicture   = $_GET['profilepicture'] ;


                   
        //    // validate the form
        //    $formerrors = array();
          
        //    if(empty($Name)) {
               
        //        $formerrors[] = 'Name cant be empty' ;
        //    }
        //    if(empty($Email)) {
               
        //        $formerrors[] = 'Email cant be empty' ;
        //    }
        //    if(empty($games)) {
               
        //        $formerrors[] = 'games cant be empty' ;
        //    }

        //    if(empty($level)) {
               
        //     $formerrors[] = 'level cant be empty' ;
        // } 
        // if(empty($PlayersNumber)) {
               
        //     $formerrors[] = 'PlayersNumber cant be empty' ;
        // } 
        // if(empty($Location)) {
               
        //     $formerrors[] = 'Location cant be empty' ;
        // } 

           
        //    // loop into error array and echo it
        //    foreach($formerrors as $error) {
               
        //        echo "<div class='alert alert-danger'>" . $error . "</div>";
        //    }




           // check if there's no error proceed the update operation
    
        //    if (empty($formerrors)) {

               // check if team exist in database 

            //    $check = checkitem("Name" , "team" , $Name) ;
            //    $check2 = checkitem("game_code" , "team" , $games) ;
               
            //    if ($check == 1 && $check2 == 1) {

            //        $themsg = " <div'>sorry this team is exist</div>" ;
            //        echo $themsg;
            //    }

            //    else {
            //     if(isset($_GET['uploadfilesub'])) {

                    //declaring variables
                    // $filename = $_FILES['logo']['name'];
                    // $filetmpname = $_FILES['logo']['tmp_name'];

                    //folder where images will be uploaded
                    // $folder = 'img//';

                    //function for saving the uploaded images in a specific folder
                    // move_uploaded_file($filetmpname, $folder.$filename);
                    //$file= str_replace(' ', '', $folder.$filename);
                    // $file = $folder.$filename;

        
                    // Insert team To  DATABASE
                    $stmt = $con->prepare("
                    INSERT INTO 
                    team(Name , Email, game_code , TeamLeaderName ,  level , PlayersNumber , Location , logo )
                    VALUES(:zname, :zEmail, :zgame_code , :zTeamLeaderName , :zlevel , :zPlayersNumber , :zLocation , :zlogo )
                                        ");
                    $stmt->execute(array(

                        'zname' => $Name,
                        'zEmail' => $Email,
                        'zgame_code' => $games,
                        'zTeamLeaderName' => $TeamLeaderName,
                        'zlevel' => $level ,
                        'zPlayersNumber' => $PlayersNumber ,
                        'zLocation' => $Location ,               
                        'zlogo' => $profilepicture
                    ));
                    
                // }
                // CHeck if get requset userid is numeric & get the intger value of it
                $do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
                if ($do == 'createteam') { 
           
           // select all data depond on this id

        $check = checkitem('UserName', 'player', $_SESSION['UserName'] );        

   // if there is such id show the form
           if($check > 0) { 

            $_SESSION['regst'] = 2 ;
            

            $stmt = $con->prepare("UPDATE player SET regst = 2 , teamcode = LAST_INSERT_ID() , playertype = 'coach' WHERE UserName = ?");

            $stmt->execute(array($_SESSION['UserName']));

            header("location:game.php?Code=$games");
           }
        
        }

                    // }
                // }
            // }