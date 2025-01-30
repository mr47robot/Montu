<?php
include('dbcon.php');


    $do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
    $ID = $_GET['ID'] ;

    if(isset($ID)) {

        $stmt = $con->prepare("
        SELECT
            *
        FROM 
          player
        WHERE 
            ID = ?
            ");
    // execute query
    $stmt->execute(array($ID));
    // fatch the data
    $rows = $stmt->fetch();
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
        $stmt1->execute(array($rows['UserName']));
        // fatch the data
        $row1 = $stmt1->fetch();

if ($do == 'up') { 
   
    function checkitem($select , $from , $value) {

        global $con;

        $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

        $statement->execute(array($value));

        $count = $statement->rowcount();

        return $count;
    }
                           
    if(sha1($_GET['oldpassword']) == $rows['Password']) {
           //Get Variables From The Form
           
           $regst = $_GET['regst'];
           $playertype = $_GET['playertype'];
           $name   = $_GET['fullname'];
           $user   = $_GET['username'];
           $teamcode = $_GET['teamcode'];
           $email  = $_GET['Email'];
           $bdate   = $_GET['bdate'] ;
           $phone   = $_GET['phone'] ;
           $profilepicture   = $_GET['profilepicture'] ;

           if($_GET['password'] == "") {
            $hashpass = $rows['Password'] ;
           }
           else{
           $pass = $_GET['password'] ;
           $hashpass = sha1($_GET['password']);
           }

        //    // validate the form
        //    $formerrors = array();
           
        //    if (strlen($user) < 4) {
               
        //        $formerrors[] = 'username cant be less than 4 charactres' ;
               
        //    }
        //    if (strlen($user) > 20) {
               
        //        $formerrors[] = 'username cant be more than 20 charactres' ;
        //    }
        // //    if (strlen($pass) < 6) {
               
        // //        $formerrors[] = 'password cant be less than 6 charactres' ;
        // //    }

        //    if (strlen($phone) < 11) {
               
        //     $formerrors[] = 'phone cant be less than 11 numbers' ;
        // }
          
        //    if(empty($user)) {
               
        //        $formerrors[] = 'username cant be empty' ;
        //    }
        // //    if(empty($pass)) {
               
        // //        $formerrors[] = 'password cant be empty' ;
        // //    }
        //    if(empty($name)) {
               
        //        $formerrors[] = 'name cant be empty' ;
        //    }
        //    if(empty($email)) {
               
        //        $formerrors[] = 'email cant be empty' ;
        //    } 
        //    if(empty($bdate)) {
               
        //     $formerrors[] = 'bdate cant be empty' ;
        // } 
        // if(empty($phone)) {
               
        //     $formerrors[] = 'phone cant be empty' ;
        // } 
           
        //    // loop into error array and echo it
        //    foreach($formerrors as $error) {
               
        //        echo "<div class='alert alert-danger'>" . $error . "</div>";
        //    }
           
        //    // check if there's no error proceed the update operation
           
        //    if (empty($formerrors)) {

               // check if user exist in database 

            //    $check = checkitem("UserName" , "player" , $user) ;
               
            //    if ($check == 1 && $user !== $rows['UserName'] ) {

            //        $themsg = " <div'>sorry this user is exist</div>" ;
            //        echo $themsg;
            //    }

            //    else {

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
                     player
                SET
                    FullName=?, Username=?, profilepic=?, Email=?, Password=?, BirthDate=? ,Phone=?
                WHERE
                    ID=?
                    ");
         

               $stmt->execute(array(
                $name,$user,$profilepicture,
                $email,$hashpass,$bdate,$phone ,$ID
                 
               
               ));
               $stmt2 = $con->prepare("
               UPDATE
                     team
                SET
                     TeamLeaderName=?
                WHERE
                    Code=?
                    ");
         

               $stmt2->execute(array($user,$teamcode));
               $_SESSION['UserName'] = $user ;

               $stmt3 = $con->prepare("
               UPDATE
                     `join` 
                SET
                TEAM_LEADER=?   
                WHERE 
                  TEAM_CODE = ?
                    ");
         

               $stmt3->execute(array(
               $user,$teamcode
               ));
           //Echo Success Message
           header("location:playerinfo.php?ID=$ID");

            }
         }
    }
    else {
        echo 'your old password not right' ;
    }

 

if($do == "dp" ) {
  
        function checkitem($select , $from , $value) {
    
            global $con;
    
            $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");
    
            $statement->execute(array($value));
    
            $count = $statement->rowcount();
    
            return $count;
        }
                      
         // select all data depond on this id

         $check = checkitem('Code', 'team', $row1['Code'] );        
         $check2 = checkitem('ID', 'player', $ID );        
 
    // if there is such id show the form
            if($check > 0) { 
 
                $stmt = $con->prepare("
                DELETE FROM team WHERE Code = ?
 
                ");
 
                $stmt->execute(array($row1['Code']));
 
                header("location:E-Sport.php");
 
                $stmt2 = $con->prepare("
                DELETE
                FROM 
                     `join` 
                WHERE 
                     TEAM_CODE = ?
                                    ");
                $stmt2->execute(array($row1['Code']));
            }
            if($check2 > 0) { 
 
                $stmt = $con->prepare("
                DELETE FROM player WHERE ID = ?
 
                ");
 
                $stmt->execute(array($ID));
 
                header("location:logout.php");
 
            
            }

            
                }

        





