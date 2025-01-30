<?php
ob_start();
include('dbcon.php');

function countItems1($item , $table ,$WHERE,$VALUE) {
        
	global $con ;
  
	$stmt4 = $con->prepare("
	(SELECT COUNT($item) FROM $table Where $WHERE = $VALUE AND regst = 5  )
	");
  
	$stmt4->execute();
  
	return $stmt4->fetchColumn();
  
  }
	function countItems2($item , $table ,$WHERE,$VALUE) {
        
		global $con ;
	  
		$stmt2 = $con->prepare("
		(SELECT COUNT($item) FROM $table Where $WHERE = $VALUE AND regst = 3  )
		");
	  
		$stmt2->execute();
	  
		return $stmt2->fetchColumn();
	  
	  }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

$stmt3 = $con->prepare("

(SELECT * FROM player Where regst = 5  )
UNION
(SELECT * FROM player Where regst = 3  )

                   ");

$stmt3->execute();
    
$rows3 = $stmt3->fetchAll();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CHeck if get requset userid is numeric & get the intger value of it
$Code = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;
$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
if ($do == 'addplayer') {  
// select all data depond on this id
  
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
	$stmt->execute(array($Code));
	// fatch the data
	$row = $stmt->fetch();
	// the raw count to check the id in database
	$count = $stmt->rowcount(); 
	// if there is such id show the form
	  if($count > 0) {
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Edit Players</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/1.3.1/css/fontawesome-iconpicker.css'>
<link rel="stylesheet" href="css/styleadd.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
  <div class="row row--top-40">
    <div class="col-md-12">
      <h2 class="row__title"> <?php echo '<a href="Team.php?do=team&Code='.$Code.'"><span class="back"><img src="img/icons8-arrow-100.png"></span></a>Edit Players</h2>' ; ?>
    </div>
  </div>
  <div class="row row--top-20">
    <div class="col-md-12">
      <div class="table-container">
	  <?php
		if(countItems1('*' , 'player' , 'teamcode' ,$row['Code']) > 0 || countItems2('*' , 'player' , 'teamcode' ,$row['Code']) > 0) {


?>
        <table class="table">
          <thead class="table__thead">
            <tr>
              <th class="table__th">Player</th>
              <th class="table__th">Age</th>
              <th class="table__th">Email</th>
              <th class="table__th">Phone</th>
              <th class="table__th">Test Degree</th>
              <th class="table__th">Action</th>
            </tr>
          </thead>
          <tbody class="table__tbody">
            <?php
            foreach($rows3 as $row2) {
              if($row['Code'] == $row2['teamcode']) {
              $dateOfBirth = $row2['BirthDate'] ;
              $today = date("Y-m-d");
              $diff = date_diff(date_create($dateOfBirth), date_create($today));
              echo '
            <tr class="table-row table-row--chris">
              <td data-column="Player" class="table-row__td">
                <div class="table-row__img" style="background-image: url('.$row2['profilepic'].');"></div>
                <div class="table-row__info">
                  <p class="table-row__name">'.$row2['FullName'].'</p>
                  <span class="table-row__small">'.$row2['UserName'].'</span>
                </div>
              </td>
              <td data-column="Age" class="table-row__td">'.$diff->format('%y').'</td>
              <td data-column="Email" class="table-row__td"><p class="table-row__">'.$row2['Email'].' </p></td>
              <td data-column="Phone" class="table-row__td">  '.$row2['Phone'].'</td>
              <td data-column="Test Degree" class="table-row__td">  '.$row2['test_degree'].'  </td> ' ;
              if($row2['regst'] == 5) {
                echo '
              <td data-column="Action" class="table-row__td">		<a class="btn btn-success" href="jointeam.php?do=jointeamaccept&ID='.$row2['ID'].'&Code='.$Code.'" target="_blank">Accept</a>
                <a class="btn btn-danger" href="jointeam.php?do=deleteteam&ID='.$row2['ID'].'&Code='.$Code.'" target="_blank">Delete</a> </td>
                ' ;
              }
              elseif($row2['regst'] == 3) {
                echo '
                <td data-column="Action" class="table-row__td">
                  <a href="jointeam.php?do=deleteteam&ID='.$row2['ID'].'&Code='.$Code.'" target="_blank"><span class="btn btn-danger">Delete</span></a> </td>
                  ' ;
                }
                echo '
                </tr>
              ' ;
              }}?>
            
            
            
            
 
          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
</body>
</html>


<!--  -->

<?php }}else{
	echo "<center><h2 class='row__title'>there is no request from players</h2></center>" ;
}} ?>