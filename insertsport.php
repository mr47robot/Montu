<?php
ob_start();
include('dbcon.php');
$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;

if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{
    if ($do == 'addesport') {   
        

$CODE = $_GET['Code'] ;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function checkitem($select , $from , $value) {

        global $con;

        $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

        $statement->execute(array($value));

        $count = $statement->rowcount();

        return $count;
    }
                           
           echo "<div class='container'>" ;
           //Get Variables From The Form
           $gamename   = $_POST['gamename'] ;
           $gamedescription   = $_POST['gamedescription'] ;
           $videoename   = $_POST['videoename'] ;
           $videodescription   = $_POST['videodescription'] ;

      

                   
           // validate the form
           $formerrors = array();
          
           if(empty($gamename)) {
               
               $formerrors[] = 'gamename cant be empty' ;
           }
           /*if(empty($TeamLeaderName)) {
               
               $formerrors[] = 'Team Leader Name cant be empty' ;
           }*/
           if(empty($gamedescription)) {
               
               $formerrors[] = 'gamedescription cant be empty' ;
           }

       
           
           // loop into error array and echo it
           foreach($formerrors as $error) {
               
               echo "<div class='alert alert-danger'>" . $error . "</div>";
           }




           // check if there's no error proceed the update operation
    
           if (empty($formerrors)) {

               // check if team exist in database 

               $check = checkitem("Name" , "sport" , $gamename) ;
               
               if ($check == 1) {

                   $themsg = " <div'>sorry this game is exist</div>" ;
                   echo $themsg;
               }

               else {
                if(isset($_POST['create'])) {

                    //declaring variables
                    $filename = $_FILES['logo']['name'];
                    $filename2 = $_FILES['cover']['name'];
                    $videofilen = $_FILES['videofile']['name'] ;

                    $filetmpname = $_FILES['logo']['tmp_name'];
                    $filetmpname2 = $_FILES['cover']['tmp_name'];
                    $videofilet = $_FILES['videofile']['tmp_name'] ;

                    //folder where images will be uploaded
                    $folder = 'img//';
                    $folder2 = 'img//';
                    $videofilef = 'img//' ;

                    //function for saving the uploaded images in a specific folder
                    move_uploaded_file($filetmpname, $folder.$filename);
                    move_uploaded_file($filetmpname2, $folder2.$filename2);
                    move_uploaded_file($videofilet, $videofilef.$videofilen);

                    //$file= str_replace(' ', '', $folder.$filename);
                    $file = $folder.$filename;
                    $file2 = $folder2.$filename2;
                    $videofile = $videofilef.$videofilen ;

        
                    // Insert team To  DATABASE
                    $stmt = $con->prepare("
                    INSERT INTO 
                    sport(Name , TypeCode , description , logo , cover)
                    VALUES(:zName, :zTypeCode , :zdescription , :zlogo , :zcover)
                                        ");
                    $stmt->execute(array(

                        'zName' => $gamename,
                        'zTypeCode' => $CODE,
                        'zdescription' => $gamedescription,
                        'zlogo' => $file,
                        'zcover' => $file2,
      

                    ));

                    $stmt = $con->prepare("
                    INSERT INTO 
                    videos(Name , URL , description , s_code )
                    VALUES(:zName, :zURL , :zdescription , LAST_INSERT_ID()  )
                                        ");
                
                        $stmt->execute(array(
                            ':zName' => $videoename,
                            ':zURL' => $videofile,
                            ':zdescription' => $videodescription,
                        )); 

                    header("location:viewsport.php?do=esport&Code=$CODE");
                } 
            }
        }
    }
}
?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<?php

    if($do == 'addpsport') {   

$CODE = $_GET['Code'] ;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function checkitem($select , $from , $value) {

        global $con;

        $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

        $statement->execute(array($value));

        $count = $statement->rowcount();

        return $count;
    }
                           
           echo "<div class='container'>" ;
           //Get Variables From The Form
           $sportname   = $_POST['sportname'] ;
           $sportdescription   = $_POST['sportdescription'] ;

      

                   
           // validate the form
           $formerrors = array();
          
           if(empty($sportname)) {
               
               $formerrors[] = 'sportname cant be empty' ;
           }

           if(empty($sportdescription)) {
               
               $formerrors[] = 'sportdescription cant be empty' ;
           }
    
       
           
           // loop into error array and echo it
           foreach($formerrors as $error) {
               
               echo "<div class='alert alert-danger'>" . $error . "</div>";
           }




           // check if there's no error proceed the update operation
    
           if (empty($formerrors)) {

               // check if team exist in database 

               $check = checkitem("Name" , "sport" , $sportname) ;
               
               if ($check == 1) {

                   $themsg = " <div'>sorry this sportname is exist</div>" ;
                   echo $themsg;
               }

               else {
                if(isset($_POST['create'])) {

                       //declaring variables
                       $filename = $_FILES['logo']['name'];
                       $filename2 = $_FILES['cover']['name'];
                       $filetmpname = $_FILES['logo']['tmp_name'];
                       $filetmpname2 = $_FILES['cover']['tmp_name'];
   
                       //folder where images will be uploaded
                       $folder = 'img//';
                       $folder2 = 'img//';
   
                       //function for saving the uploaded images in a specific folder
                       move_uploaded_file($filetmpname, $folder.$filename);
                       move_uploaded_file($filetmpname2, $folder2.$filename2);
                       //$file= str_replace(' ', '', $folder.$filename);
                       $file = $folder.$filename;
                       $file2 = $folder2.$filename2;
   
           
                       // Insert team To  DATABASE
                       $stmt = $con->prepare("
                       INSERT INTO 
                       sport(Name , TypeCode , description , logo , cover)
                       VALUES(:zName, :zTypeCode , :zdescription , :zlogo , :zcover)
                                           ");
                       $stmt->execute(array(
   
                           'zName' => $sportname,
                           'zTypeCode' => $CODE,
                           'zdescription' => $sportdescription,
                           'zlogo' => $file,
                           'zcover' => $file2,
         
   
                       ));
   
                       header("location:viewsport.php?do=psport&Code=$CODE");
                } 
            }
        }
    }
}

                ?>
                <?php } else {
              header("location:game.php");

} ?>