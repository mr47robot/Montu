<?php
ob_start();
include('dbcon.php');
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
$Code = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;

if ($do == 'updatetour') {   

  $stmt = $con->prepare(
'SELECT 
*
FROM
tournament
WHERE
Code  = ? 
'
  );
// execute query
$stmt->execute(array($Code));
// fatch the data
$row = $stmt->fetch();
// the raw count to check the id in database
$count = $stmt->rowcount(); 
// if there is such id show the form
  if($count > 0) {

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function checkitem($select , $from , $value) {

        global $con;

        $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

        $statement->execute(array($value));

        $count = $statement->rowcount();

        return $count;
    }
                           
           //Get Variables From The Form
           $tournamentcode  = $_POST['tournament-code'] ;
           $tournamentname   = $_POST['tournament-name'] ;
           $tournamentemail = $_POST['tournament-email'];
           $tournamentdiscription = $_POST['tournament-discription'];
           $tournamentStart_Date = $_POST['tournament-Start_Date'];
           $tournamentEnd_date = $_POST['tournament-End_date'];
           $tournamentsize = $_POST['tournament-size'];
           $tournamentLocation = $_POST['tournament-Location'];
           $tournamentOrganizer = $_POST['tournament-Organizer'];
           $tournamentlogo = $_POST['tournament-logo'];
      

                   
           // validate the form
           $formerrors = array();
          
           if(empty($tournamentname)) {
               
               $formerrors[] = 'Name cant be empty' ;
           }
           if(empty($tournamentemail)) {
               
               $formerrors[] = 'tournamentemail cant be empty' ;
           }
           if(empty($tournamentdiscription)) {
               
            $formerrors[] = 'tournamentdiscription cant be empty' ;
        } 
           if(empty($tournamentOrganizer)) {
               
            $formerrors[] = 'tournamentOrganizer cant be empty' ;
        } 
           if(empty($tournamentStart_Date)) {
               
            $formerrors[] = 'tournamentStart_Date cant be empty' ;
        } 
           if(empty($tournamentEnd_date)) {
               
            $formerrors[] = 'tournamentEnd_date cant be empty' ;
        } 
           if(empty($tournamentsize )) {
               
            $formerrors[] = 'tournamentsize  cant be empty' ;
        } 
           if(empty($tournamentLocation)) {
               
            $formerrors[] = 'tournamentLocation cant be empty' ;
        } 
       
           
           // loop into error array and echo it
           foreach($formerrors as $error) {
               
               echo "<div class='alert alert-danger'>" . $error . "</div>";
           }




           // check if there's no error proceed the update operation
    
           if (empty($formerrors)) {

               //declaring variables
               $filename = $_FILES['logo']['name'];
               $filetmpname = $_FILES['logo']['tmp_name'];

               //folder where images will be uploaded
               $folder = 'img//';

               //function for saving the uploaded images in a specific folder
               move_uploaded_file($filetmpname, $folder.$filename);
               //$file= str_replace(' ', '', $folder.$filename);
               $file = $folder.$filename;

               // check if team exist in database 

               $check = checkitem("Name" , "tournament" , $tournamentname) ;
               
               if ($check == 1 && $tournamentname !== $row['Name']) {

                   $themsg = " <div'>sorry this team is exist</div>" ;
                   echo $themsg;
               }

               else {
                if($file !== 'img//') {

                  
 
         
                     // Insert team To  DATABASE
                     $stmt = $con->prepare("
                     UPDATE
                             tournament
                     SET 
                              Name=?, Contact_Email=?, Description=?, logo=?,
                              Organizer=?, Location=?, Start_Date=?, End_date=?
                     WHERE
                             Code =?
                                         ");
                     $stmt->execute(array(
                     $tournamentname,$tournamentemail,$tournamentdiscription,$file,
                     $tournamentOrganizer,$tournamentLocation,$tournamentStart_Date,$tournamentEnd_date,
                     $tournamentcode
                     
                     ));
                     $stmt2 = $con->prepare("
                     UPDATE
                          `join`
                     SET 
                         TOURNAMENT_NAME=?, TOURNAMENT_LOGO=?,TOURNAMENT_Start_Date=?, TOURNAMENT_End_date	=?
                     WHERE
                      TOURNAMENT_CODE  =?
                                          ");
                     $stmt2->execute(array(
                     $tournamentname,$tournamentlogo,
                     $tournamentStart_Date,$tournamentEnd_date,
                     $tournamentcode
                     
                     ));
 
                     header('location:tourpage.php?do=tour&Code='.$row['Code'].'');

                  
                } 
                else {

                        // Insert team To  DATABASE
                        $stmt = $con->prepare("
                        UPDATE
                                tournament
                        SET 
                                Name=?, Contact_Email=?, Description=?, logo=?,
                                Organizer=?, Location=?, Start_Date=?, End_date=?, TEAMS_NUMBER=?
                        WHERE
                                Code =?
                                            ");
                        $stmt->execute(array(
                        $tournamentname,$tournamentemail,$tournamentdiscription,$tournamentlogo,
                        $tournamentOrganizer,$tournamentLocation,$tournamentStart_Date,$tournamentEnd_date,$tournamentsize,
                        $tournamentcode
                        
                        ));
                        $stmt2 = $con->prepare("
                        UPDATE
                             `join`
                        SET 
                            TOURNAMENT_NAME=?, TOURNAMENT_LOGO=?,TOURNAMENT_Start_Date=?, TOURNAMENT_End_date	=?
                        WHERE
                         TOURNAMENT_CODE  =?
                                             ");
                        $stmt2->execute(array(
                        $tournamentname,$tournamentlogo,
                        $tournamentStart_Date,$tournamentEnd_date,
                        $tournamentcode
                        
                        ));

                        header('location:tourpage.php?do=tour&Code='.$row['Code'].'');

                   
                } 
            }
        }
     }  
  }
}
if ($do == 'updatebracket') { 

    $stmt = $con->prepare(
  'SELECT 
  *
  FROM
  tournament
  WHERE
  Code  = ? 
  '
    );
  // execute query
  $stmt->execute(array($Code));
  // fatch the data
  $row = $stmt->fetch();
  // the raw count to check the id in database
  $count = $stmt->rowcount(); 
  // if there is such id show the form
    if($count > 0) {
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      
             //Get Variables From The Form
             $tournamentbracket  = $_POST['tournamentbracket'] ;
             $tournamentbracketadmin  = $_POST['tournamentbracketadmin'] ;

           
                       // Insert team To  DATABASE
                       $stmt = $con->prepare("
                       UPDATE
                               tournament
                       SET 
                               bracket=?,bracket_admin=?
                       WHERE
                               Code =?
                                           ");
                       $stmt->execute(array(
                        $tournamentbracket,$tournamentbracketadmin ,$Code
                       ));
   
                       header('location:tourpage.php?do=tour&Code='.$row['Code'].'');
  
                    
                  } 
                     
                  } 
              }
            /////////////////////////////////////////////
            if ($do == 'topteam') { 

                $stmt = $con->prepare(
              'SELECT 
              *
              FROM
              tournament
              WHERE
              Code  = ? 
              '
                );
              // execute query
              $stmt->execute(array($Code));
              // fatch the data
              $row = $stmt->fetch();
              // the raw count to check the id in database
              $count = $stmt->rowcount(); 
              // if there is such id show the form
                if($count > 0) {
              
              if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  
                        //Get Variables From The Form
                        $topone = $_POST['topone'] ;
                        $toptwo = $_POST['toptwo'] ;
                        $topthree = $_POST['topthree'] ;
  

                      
                                  // Insert team To  DATABASE
                                  $stmt = $con->prepare("
                                  UPDATE
                                          tournament
                                  SET 
                                        top_team_one_id=?, top_team_two_id=?, top_team_three_id=?
                                  WHERE
                                          Code =?
                                                      ");
                                  $stmt->execute(array(
                                    $topone,$toptwo,$topthree,$Code
                                  ));
              
                                  header('location:tourpage.php?do=tour&Code='.$row['Code'].'');
              
                                
                              } 
                                
                              } 
                          }
            /////////////////////////////////////////////
            /////////////////////////////////////////////
            if ($do == 'dtour') { 

              $stmt = $con->prepare(
            'SELECT 
            *
            FROM
            tournament
            WHERE
            Code  = ? 
            '
              );
            // execute query
            $stmt->execute(array($Code));
            // fatch the data
            $row = $stmt->fetch();
            $gamecode = $row['game_code'] ;
            // the raw count to check the id in database
            $count = $stmt->rowcount(); 
            // if there is such id show the form
              if($count > 0) {
            

              $stmt = $con->prepare("
              DELETE FROM 
              tournament
              WHERE
              Code = ?
              ");

              $stmt->execute(array($Code));

              header("location: sport tournaments.php?do=gametour&Code=$gamecode");





            }}

                ?>
                <?php } else {
              header("location:game.php");

} ?>