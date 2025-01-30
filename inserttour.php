<?php
ob_start();
include('dbcon.php');
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{

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
           $tournamentgame   = $_POST['tournament-game'] ;
           $tournamentname   = $_POST['tournament-name'] ;
           $teamsnumber  = $_POST['teams-number'];
           $tournamentemail = $_POST['tournament-email'];
           $tournamentdiscription = $_POST['tournament-discription'];
      

                   
           // validate the form
           $formerrors = array();
          
           if(empty($tournamentname)) {
               
               $formerrors[] = 'Name cant be empty' ;
           }
           /*if(empty($TeamLeaderName)) {
               
               $formerrors[] = 'Team Leader Name cant be empty' ;
           }*/
           if(empty($teamsnumber)) {
               
               $formerrors[] = 'teamsnumber cant be empty' ;
           }
           if(empty($tournamentemail)) {
               
               $formerrors[] = 'tournamentemail cant be empty' ;
           }
           if(empty($tournamentdiscription)) {
               
            $formerrors[] = 'tournamentdiscription cant be empty' ;
        } 
       
           
           // loop into error array and echo it
           foreach($formerrors as $error) {
               
               echo "<div class='alert alert-danger'>" . $error . "</div>";
           }




           // check if there's no error proceed the update operation
    
           if (empty($formerrors)) {

               // check if team exist in database 

               $check = checkitem("Name" , "tournament" , $tournamentname) ;
               
               if ($check == 1) {

                   $themsg = " <div'>sorry this team is exist</div>" ;
                   echo $themsg;
               }

               else {
                if(isset($_POST['create'])) {

                    //declaring variables
                    $filename = $_FILES['logo']['name'];
                    $filetmpname = $_FILES['logo']['tmp_name'];

                    //folder where images will be uploaded
                    $folder = 'img//';

                    //function for saving the uploaded images in a specific folder
                    move_uploaded_file($filetmpname, $folder.$filename);
                    //$file= str_replace(' ', '', $folder.$filename);
                    $file = $folder.$filename;

        
                    // Insert team To  DATABASE
                    $stmt = $con->prepare("
                    INSERT INTO 
                    tournament(Name , game_code , TEAMS_NUMBER , Contact_Email , Description , logo)
                    VALUES(:zname, :zgame , :zTEAMS_NUMBER , :zContact_Email , :zDescription , :zlogo )
                                        ");
                    $stmt->execute(array(

                        'zname' => $tournamentname,
                        'zgame' => $tournamentgame,
                        'zTEAMS_NUMBER' => $teamsnumber,
                        'zContact_Email' => $tournamentemail,
                        'zDescription' => $tournamentdiscription,
                        'zlogo' => $file 

                    ));

                    header("location:sport tournaments.php?do=gametour&Code=$tournamentgame");;
                } 
            }
        }
    }

                ?>
                <?php } else {
              header("location:game.php");

} ?>