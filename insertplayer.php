<?php
include('dbcon.php');

        function checkitem($select , $from , $value) {
    
            global $con;
    
            $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");
    
            $statement->execute(array($value));
    
            $count = $statement->rowcount();
    
            return $count;
        }
                               
               echo "<div class='container'>" ;
               //Get Variables From The Form
               
               $regst = $_GET['regst'];
               $playertype = $_GET['playertype'];
               $name   = $_GET['fullname'];
               $user   = $_GET['username'];
               $email  = $_GET['Email'];
               $pass   = $_GET['password'] ;
               $hashpass = sha1($_GET['password']);
               $bdate   = $_GET['bdate'] ;
               $phone   = $_GET['phone'] ;
               $profilepicture   = $_GET['profilepicture'] ;
    
                       
            //    // validate the form
            //    $formerrors = array();
               
            //    if (strlen($user) < 4) {
                   
            //        $formerrors[] = 'username cant be less than 4 charactres' ;
                   
            //    }
            //    if (strlen($user) > 20) {
                   
            //        $formerrors[] = 'username cant be more than 20 charactres' ;
            //    }
            //    if (strlen($pass) < 6) {
                   
            //        $formerrors[] = 'password cant be less than 6 charactres' ;
            //    }
    
            //    if (strlen($phone) < 11) {
                   
            //     $formerrors[] = 'phone cant be less than 11 numbers' ;
            // }
              
            //    if(empty($user)) {
                   
            //        $formerrors[] = 'username cant be empty' ;
            //    }
            //    if(empty($pass)) {
                   
            //        $formerrors[] = 'password cant be empty' ;
            //    }
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
                   
                //    if ($check == 1) {
    
                //        $themsg = " <div'>sorry this user is exist</div>" ;
                //        echo $themsg;
                //    }
    
                //    else {
    
                    // declaring variables
                    // $filename = $_FILES['profilepic']['name'];
                    // $filetmpname = $_FILES['profilepic']['tmp_name'];
    
                    // folder where images will be uploaded
                    // $folder = 'img//';
    
                    //function for saving the uploaded images in a specific folder
                    // move_uploaded_file($filetmpname, $folder.$filename);
                    //$file= str_replace(' ', '', $folder.$filename);
                    // $file = $folder.$filename;
    
                // Insert UseerInfo To  DATABASE
                
                   $stmt = $con->prepare("
                   INSERT INTO 
                   player(FullName, playertype, regst, Username, profilepic, Email, Password , BirthDate , Phone  )
                   VALUES(:zname , :zplayertype , :zregst ,:zuser , :zprofilepic, :zemail , :zpass , :zbdate , :zPhone )
                                       ");
             
    
                   $stmt->execute(array(
    
                       'zname' => $name,
                       'zregst' => $regst,
                       'zplayertype' => $playertype,
                       'zprofilepic' => $profilepicture,
                       'zuser' => $user,
                       'zemail' => $email,
                       'zpass' => $hashpass,
                       'zbdate' => $bdate,
                       'zPhone' => $phone 
                   
                   ));
    
                   header('location: login.php');

                // }
             
        // }
