<?php
ob_start();
include('dbcon.php');
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{
    

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
$scode = $_GET['scode'] ;
$stmt = $con->prepare("
SELECT
    *
FROM 
   videos 
WHERE
    s_code = ?
                    ");
// execute query
$stmt->execute(array($scode));
// fatch the data
$rows = $stmt->fetchall();
///////////////////////////////
$stmt4 = $con->prepare("
SELECT * FROM player Where playertype = 'admin' 

               ");

$stmt4->execute();

$rows4 = $stmt4->fetch();
// the raw count to check the id in database
$count = $stmt->rowcount(); 
function checkitem($select , $from , $value) {

    global $con;

    $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

    $statement->execute(array($value));

    $count = $statement->rowcount();

    return $count;

}
if($count > 0) 
{
    ?>

<!-- /////////////////////////////////////////////////////////////////////////////////////// -->

<?php
if ($do == 'dwo') {   


    $CODE = $_GET['Code'] ;

           // select all data depond on this id

        $check = checkitem('id', 'warmup', $CODE );        

   // if there is such id show the form
           if($check > 0) { 

               $stmt = $con->prepare("
               DELETE FROM 
               warmup
               WHERE
               id = ?
               ");

               $stmt->execute(array($CODE));

               header("location:editvideos.php?do=edw&Code=$scode");





}
    } 
?>


<!-- /////////////////////////////////////////////////////////////////////////////////////// -->

<?php
if ($do == 'uwo') {   

    $wfilename = $_FILES['wfile']['name']  ;
    $wfiletempname = $_FILES['wfile']['tmp_name'] ;
    $wfilefolder = 'img//' ;
    move_uploaded_file($wfiletempname, $wfilefolder.$wfilename);
    $wfile = $wfilefolder.$wfilename ;


    $CODE = $_GET['Code'] ;
    $wname  = $_POST['wname'] ;
    $wdes   = $_POST['wdes'] ;
    $wlogo = $_POST['wlogo'];

           // select all data depond on this id

        $check = checkitem('id', 'warmup', $CODE );        

   // if there is such id show the form
           if($check > 0) { 

               $stmt = $con->prepare("
               UPDATE
                    warmup
               SET
                    name=?, descripition=?, img=?
               WHERE
                     id = ?
               ");

               $stmt->execute(array($wname,$wdes,$wlogo,$CODE));

               header("location:editvideos.php?do=edw&Code=$scode");

}
if($check > 0 && $wfile !== 'img//' ) { 
    
    $stmt = $con->prepare("
    UPDATE
         warmup
    SET
         Name=?, descripition=?, img=?
    WHERE
          id = ?
    ");

    $stmt->execute(array($wname,$wdes,$wfile,$CODE));

    header("location:editvideos.php?do=edw&Code=$scode");

    } 
}
?>


<!-- /////////////////////////////////////////////////////////////////////////////////////// -->

<?php
if ($do == 'dto') {   


    $CODE = $_GET['Code'] ;

           // select all data depond on this id

        $check = checkitem('id', 'tools', $CODE );        

   // if there is such id show the form
           if($check > 0) { 

               $stmt = $con->prepare("
               DELETE FROM 
               tools
               WHERE
               id = ?
               ");

               $stmt->execute(array($CODE));

               header("location:editvideos.php?do=edt&Code=$scode");





}
    } 
?>


<!-- /////////////////////////////////////////////////////////////////////////////////////// -->

<?php
if ($do == 'uto') {   

    $tfilename = $_FILES['tfile']['name']  ;
    $tfiletempname = $_FILES['tfile']['tmp_name'] ;
    $tfilefolder = 'img//' ;
    move_uploaded_file($tfiletempname, $tfilefolder.$tfilename);
    $tfile = $tfilefolder.$tfilename ;


    $CODE = $_GET['Code'] ;
    $tname  = $_POST['tname'] ;
    $tdes   = $_POST['tdes'] ;
    $tlogo = $_POST['tlogo'];

           // select all data depond on this id

        $check = checkitem('id', 'tools', $CODE );        

   // if there is such id show the form
           if($check > 0) { 

               $stmt = $con->prepare("
               UPDATE
                    tools
               SET
                    name=?, descripition=?, img=?
               WHERE
                     id = ?
               ");

               $stmt->execute(array($tname,$tdes,$tlogo,$CODE));

               header("location:editvideos.php?do=edt&Code=$scode");

}
if($check > 0 && $tfile !== 'img//' ) { 
    
    $stmt = $con->prepare("
    UPDATE
         tools
    SET
         Name=?, descripition=?, img=?
    WHERE
          id = ?
    ");

    $stmt->execute(array($tname,$tdes,$tfile,$CODE));

    header("location:editvideos.php?do=edt&Code=$scode");

    } 
}
?>

<!-- /////////////////////////////////////////////////////////////////////////////////////// -->

<?php
if ($do == 'dvo') {   


    $CODE = $_GET['Code'] ;

           // select all data depond on this id

        $check = checkitem('Code', 'videos', $CODE );        

   // if there is such id show the form
           if($check > 0) { 

               $stmt = $con->prepare("
               DELETE FROM 
               videos
               WHERE
               Code = ?
               ");

               $stmt->execute(array($CODE));

               header("location:editvideos.php?do=edv&Code=$scode");





}
    } 
?>
<!-- /////////////////////////////////////////////////////////////////////////////////////// -->

<?php
if ($do == 'uvo') {   


    $CODE = $_GET['Code'] ;
    $vname  = $_POST['vname'] ;
    $vurl   = $_POST['vurl'] ;
    $vdes = $_POST['vdes'];

           // select all data depond on this id

        $check = checkitem('Code', 'videos', $CODE );        

   // if there is such id show the form
           if($check > 0) { 

               $stmt = $con->prepare("
               UPDATE
                    videos
               SET
                    Name=?, URL=?, description=?
               WHERE
                     Code = ?
               ");

               $stmt->execute(array($vname,$vurl,$vdes,$CODE));

               header("location:editvideos.php?do=edv&Code=$scode");





}
    } 
?>

<!-- /////////////////////////////////////////////////////////////////////////////////////// -->



<?php }
}
 else {
  header("location:game.php");

} ?>
