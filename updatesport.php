<?php
ob_start();
include('dbcon.php');
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
$CODE = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;



    $stmt = $con->prepare("
    SELECT
        *
    FROM 
      sport 
    WHERE
    Code = ?
                        ");
// execute query
$stmt->execute(array($CODE));
// fatch the data
$rows = $stmt->fetch();
// the raw count to check the id in database
$count = $stmt->rowcount(); 
// if there is such id show the form
  if($count > 0) {
if ($do == 'ue') {   
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function checkitem($select , $from , $value) {

        global $con;

        $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

        $statement->execute(array($value));

        $count = $statement->rowcount();

        return $count;
    }
                           
           //Get Variables From The Form
           $gamename   = $_POST['gamename'] ;
           $gamedescription = $_POST['gamedescription'] ;
           $gamelogo   = $_POST['gamelogo'] ;
           $gamecover   = $_POST['gamecover'] ;
           $videoename   = $_POST['videoename'] ;
           $videodescription   = $_POST['videodescription'] ;
           $videourl   = $_POST['videourl'] ;

      

                   
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

            $check = checkitem("Name" , "sport" , $gamename) ;

               if ($check == 1 && $gamename !== $rows['Name']) {

                   $themsg = " <div'>sorry this game is exist</div>" ;
                   echo $themsg;
               }

               else {
                if($file !== 'img//' && $file2 !== 'img//'  && $videofile !== 'img//' ) {

                  
 
         
                     // Insert team To  DATABASE
                     $stmt = $con->prepare("
                     UPDATE
                             sport
                     SET 
                              Name=?, description=?, logo=?, cover=?
                     WHERE
                             Code =?
                                         ");
                     $stmt->execute(array(
                     $gamename,$gamedescription,$file,$file2,
                     $CODE
                     ));
 

                     $stmt2 = $con->prepare("
                     UPDATE
                           videos
                       SET 
                            Name=? , URL=?, description=?
                     WHERE
                             s_code =?
                                         ");
                 
                         $stmt2->execute(array(
                         $videoename,
                         $videofile,
                         $videodescription,
                         $CODE 
                    )); 

                    header('location:sportdetails.php?do=ed&Code='.$rows['Code'].'');

                } 
                elseif($videofile !== 'img//' && $file2 !== 'img//'  ) {

                  
 
         
                    // Insert team To  DATABASE
                    $stmt = $con->prepare("
                    UPDATE
                            sport
                    SET 
                             Name=?, description=?, logo=?, cover=?
                    WHERE
                            Code =?
                                        ");
                    $stmt->execute(array(
                    $gamename,$gamedescription,$gamelogo,$file2,
                    $CODE
                    ));
    
                        $stmt2 = $con->prepare("
                         UPDATE
                               videos
                           SET 
                                Name=? , URL=?, description=?
                         WHERE
                                 s_code =?
                                             ");
                     
                             $stmt2->execute(array(
                             $videoename,
                             $videofile,
                             $videodescription,
                             $CODE 
                        )); 
    
    
                    header('location:sportdetails.php?do=ed&Code='.$rows['Code'].'');
    
                 
               } 
                elseif($videofile !== 'img//' && $file !== 'img//' ) {

                  
 
         
                    // Insert team To  DATABASE
                    $stmt = $con->prepare("
                    UPDATE
                            sport
                    SET 
                             Name=?, description=?, logo=?, cover=?
                    WHERE
                            Code =?
                                        ");
                    $stmt->execute(array(
                    $gamename,$gamedescription,$file,$gamecover,
                    $CODE
                    ));

                        $stmt2 = $con->prepare("
                         UPDATE
                               videos
                           SET 
                                Name=? , URL=?, description=?
                         WHERE
                                 s_code =?
                                             ");
                     
                             $stmt2->execute(array(
                             $videoename,
                             $videofile,
                             $videodescription,
                             $CODE 
                        )); 


                    header('location:sportdetails.php?do=ed&Code='.$rows['Code'].'');

                 
               } 
      
           elseif($file !== 'img//' && $file2 !== 'img//' ) {

                  
 
         
            // Insert team To  DATABASE
            $stmt = $con->prepare("
            UPDATE
                    sport
            SET 
                     Name=?, description=?, logo=?, cover=?
            WHERE
                    Code =?
                                ");

            $stmt->execute(array(
            $gamename,$gamedescription,$file,$file2,
            $CODE
            ));

                $stmt2 = $con->prepare("
                 UPDATE
                       videos
                   SET 
                        Name=? , URL=?, description=?
                 WHERE
                         s_code =?
                                     ");
             
                     $stmt2->execute(array(
                     $videoename,
                     $videourl,
                     $videodescription,
                     $CODE 
                )); 


            header('location:sportdetails.php?do=ed&Code='.$rows['Code'].'');

         
       } 
       elseif($videofile !== 'img//' ) {

                  
 
         
        // Insert team To  DATABASE
        $stmt = $con->prepare("
        UPDATE
                sport
        SET 
                 Name=?, description=?, logo=?, cover=?
        WHERE
                Code =?
                            ");
        $stmt->execute(array(
        $gamename,$gamedescription,$gamelogo,$gamecover,
        $CODE
        ));

        $stmt2 = $con->prepare("
        UPDATE
              videos
          SET 
               Name=? , URL=?, description=?
        WHERE
                s_code =?
                            ");
    
            $stmt2->execute(array(
                 $videoename,
                 $videofile,
                 $videodescription,
                 $CODE 
            )); 


        header('location:sportdetails.php?do=ed&Code='.$rows['Code'].'');

     
   } 
   elseif($file2 !== 'img//' ) {

                  
 
         
    // Insert team To  DATABASE
    $stmt = $con->prepare("
    UPDATE
            sport
    SET 
             Name=?, description=?, logo=?, cover=?
    WHERE
            Code =?
                        ");
    $stmt->execute(array(
    $gamename,$gamedescription,$gamelogo,$file2,
    $CODE
    ));

        $stmt2 = $con->prepare("
         UPDATE
               videos
           SET 
                Name=? , URL=?, description=?
         WHERE
                 s_code =?
                             ");
     
             $stmt2->execute(array(
             $videoename,
             $videourl,
             $videodescription,
             $CODE 
        )); 


    header('location:sportdetails.php?do=ed&Code='.$rows['Code'].'');

 
} 
               elseif($file !== 'img//') {

                  
 
         
                     // Insert team To  DATABASE
                     $stmt = $con->prepare("
                     UPDATE
                             sport
                     SET 
                              Name=?, description=?, logo=?, cover=?
                     WHERE
                             Code =?
                                         ");
                     $stmt->execute(array(
                     $gamename,$gamedescription,$file,$gamecover,
                     $CODE
                     ));
 
                         $stmt2 = $con->prepare("
                          UPDATE
                                videos
                            SET 
                                 Name=? , URL=?, description=?
                          WHERE
                                  s_code =?
                                              ");
                      
                              $stmt2->execute(array(
                              $videoename,
                              $videourl,
                              $videodescription,
                              $CODE 
                         )); 

                     header('location:sportdetails.php?do=ed&Code='.$rows['Code'].'');

                  
                } 
   
  

      
       
                else {

                        // Insert team To  DATABASE
                        $stmt = $con->prepare("
                        UPDATE
                               sport
                        SET 
                                 Name=?, description=?, logo=?, cover=?
                        WHERE
                                Code =?
                                            ");
                         $stmt->execute(array(

                            $gamename,$gamedescription,$gamelogo,$gamecover,
                            $CODE
                        
                          ));

                          $stmt2 = $con->prepare("
                          UPDATE
                                videos
                            SET 
                                 Name=? , URL=?, description=?
                          WHERE
                                  s_code =?
                                              ");
                      
                              $stmt2->execute(array(
                                 $videoename,
                                  $videourl,
                                  $videodescription,
                                  $CODE 
                              )); 
     
                          header('location:sportdetails.php?do=ed&Code='.$rows['Code'].'');


                   
                    } 
                    } 
                    
                    } 
                    } 
                  }
                }
            
        

?>
<!-- //////////////////////////////////////////////////////////////////////////////// -->
<?php
if ($do == 'up') {   
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function checkitem($select , $from , $value) {

        global $con;

        $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

        $statement->execute(array($value));

        $count = $statement->rowcount();

        return $count;
    }
                           
           //Get Variables From The Form
           $sportname   = $_POST['sportname'] ;
           $sportdescription = $_POST['sportdescription'] ;

          
           $sportlogo   = $_POST['sportlogo'] ;
           $sportcover   = $_POST['sportcover'] ;

       
           if (isset($_POST['videoname']) && isset($_POST['videodiscription'])  && isset($_POST['videosource']) ){
           $videoname = $_POST['videoname'] ;
           $videodiscription = $_POST['videodiscription'] ;
           $videosource = $_POST['videosource'] ;
}
if (isset($_POST['warmupname']) ){

           $warmupname = $_POST['warmupname'] ;
}
if (isset($_POST['toolsname']) ){

           $toolsname = $_POST['toolsname'] ;
}
   




      

                   
           // validate the form
           $formerrors = array();
          
           if(empty($sportname)) {
               
               $formerrors[] = 'gamename cant be empty' ;
           }
           /*if(empty($TeamLeaderName)) {
               
               $formerrors[] = 'Team Leader Name cant be empty' ;
           }*/
           if(empty($sportdescription)) {
               
               $formerrors[] = 'gamedescription cant be empty' ;
           }

       
           
           // loop into error array and echo it
           foreach($formerrors as $error) {
               
               echo "<div class='alert alert-danger'>" . $error . "</div>";
           }


           // check if there's no error proceed the update operation
    
           if (empty($formerrors)) {

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
          

            $check = checkitem("Name" , "sport" , $sportname) ;

               if ($check == 1 && $sportname !== $rows['Name']) {

                   $themsg = " <div'>sorry this sport is exist</div>" ;
                   echo $themsg;
               }

               else {
                if (isset($_POST['videoname']) && isset($_POST['videodiscription'])  && isset($_POST['videosource']) ){

                foreach($videoname as $rec => $value) {


                    $videonames = $_POST['videoname'][$rec] ;
            
                    $videodiscriptions = $_POST['videodiscription'][$rec]  ;
            
                    $videosources = $_POST['videosource'][$rec] ;

                    
                $stmt = $con->prepare("
                INSERT INTO 
                videos(Name , URL , description , s_code )
                VALUES(:zName, :zURL , :zdescription , :zs_code  )
                                    ");
            
                    $stmt->execute(array(
                        ':zName' => $videonames,
                        ':zURL' => $videosources,
                        ':zdescription' => $videodiscriptions,
                        ':zs_code' => $CODE 
                    )); 
                    header('location:sportdetails.php?do=pd&Code='.$rows['Code'].'');

                }
        }

        if (isset($_POST['warmupname']) ){
                foreach($warmupname as $rec => $value) {

                        $warmuplogoname = $_FILES['warmuplogo']['name'][$rec]  ;
                        $warmuplogotempname = $_FILES['warmuplogo']['tmp_name'][$rec] ;
                        $warmuplogofolder = 'img//' ;
                        move_uploaded_file($warmuplogotempname, $warmuplogofolder.$warmuplogoname);
                        $warmuplogofile = $warmuplogofolder.$warmuplogoname ;


                    $warmupname = $_POST['warmupname'][$rec] ;
            
                    $warmupdiscription = $_POST['warmupdiscription'][$rec]  ;
            
                    
                $stmt = $con->prepare("
                INSERT INTO 
                warmup(name , descripition , img , s_code )
                VALUES(:zName, :zdescription , :zimg , :zs_code)
                                    ");
            
                    $stmt->execute(array(
                        ':zName' =>  $warmupname,
                         ':zdescription' =>  $warmupdiscription,
                        ':zimg' => $warmuplogofile,
                        ':zs_code' =>   $CODE
                    )); 
                    
                header('location:sportdetails.php?do=pd&Code='.$rows['Code'].'');

            
                }
        }
        if (isset($_POST['toolsname']) ){

                foreach($toolsname as $rec => $value) {

                        $toolslogoname = $_FILES['toolslogo']['name'][$rec]  ;
                        $toolslogotempname = $_FILES['toolslogo']['tmp_name'][$rec] ;
                        $toolslogofolder = 'img//' ;
                        move_uploaded_file($toolslogotempname, $toolslogofolder.$toolslogoname);
                        $toolslogofile = $toolslogofolder.$toolslogoname ;


                    $toolsname = $_POST['toolsname'][$rec] ;
            
                    $toolsdiscription = $_POST['toolsdiscription'][$rec] ;
            
                    
                $stmt = $con->prepare("
                INSERT INTO 
                tools(name , descripition , img , s_code )
                VALUES(:zName, :zdescription , :zimg , :zs_code)
                                    ");
            
                    $stmt->execute(array(
                        ':zName' =>   $toolsname,
                        ':zdescription' =>   $toolsdiscription,
                        ':zimg' => $toolslogofile,
                        ':zs_code' =>     $CODE
                    )); 
            
                }
                header('location:sportdetails.php?do=pd&Code='.$rows['Code'].'');


        }
                if($file !== 'img//' ) {

                  
 
         
                                         // Insert team To  DATABASE
                                         $stmt = $con->prepare("
                                         UPDATE
                                                 sport
                                         SET 
                                                 logo=?, cover=?
                                         WHERE
                                                 Code =?
                                                             ");
                                         $stmt->execute(array($file,$sportcover,$CODE
                                         ));
                     
                                         header('location:sportdetails.php?do=pd&Code='.$rows['Code'].'');
                  
                } 
                if($file2 !== 'img//'  ) {

                  
 
         
                                         // Insert team To  DATABASE
                                         $stmt = $con->prepare("
                                         UPDATE
                                                 sport
                                         SET 
                                                  logo=?, cover=?
                                         WHERE
                                                 Code =?
                                                             ");
                                         $stmt->execute(array($sportlogo,$file2,$CODE
                                         ));
                     
                                         header('location:sportdetails.php?do=pd&Code='.$rows['Code'].'');
                  
                } 
                if($file !== 'img//' && $file2 !== 'img//'  ) {

                  
 
         
                                         // Insert team To  DATABASE
                                         $stmt = $con->prepare("
                                         UPDATE
                                                 sport
                                         SET 
                                                  logo=?, cover=?
                                         WHERE
                                                 Code =?
                                                             ");
                                         $stmt->execute(array($file,$file2,$CODE
                                         ));
                     
                                         header('location:sportdetails.php?do=pd&Code='.$rows['Code'].'');
                  
                } 
              

                }
                
        }

}

}
            
        
                   
                   
                    
              
                   
                  
?>
<!-- //////////////////////////////////////////////////////////////////////////////// -->
<?php
if ($do == 'vp') {   
    $CODE = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $videoname = $_POST['videoname'] ;
    // $videonames = implode(', ', $_POST['videoname']); 

    $videodiscription = $_POST['videodiscription'] ;
    // $videodiscriptions = implode(', ', $_POST['videodiscription']); 
    // echo $videodiscriptions ;

    $videosource = $_POST['videosource'] ;
    // $videosources = implode(', ',  $_POST['videosource']); 

    // Insert team To  DATABASE
    foreach($videoname as $rec => $value) {

        $videonames = $_POST['videoname'][$rec] ;

        $videodiscriptions = $_POST['videodiscription'][$rec]  ;

        $videosources = $_POST['videosource'][$rec] ;
    $stmt = $con->prepare("
    INSERT INTO 
    videos(Name , URL , description , s_code )
    VALUES(:zName, :zURL , :zdescription , :zs_code )
                        ");

        $stmt->execute(array(
             $videonames,
             $videosources,
             $videodiscriptions,
             $CODE
        )); 

    }

    // header("location:viewsport.php?do=esport&Code=$CODE");
}
}
    ?>
<?php } else {
    header("location:slider.php");

} ?>