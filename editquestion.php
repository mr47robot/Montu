<?php
ob_start();
include('dbcon.php');
$CODE = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;


function checkitem($select , $from , $value) {

	global $con;

	$statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

	$statement->execute(array($value));

	$count = $statement->rowcount();

	return $count;
}
	

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

$stmt2 = $con->prepare("
SELECT
    *
FROM 
    test 
WHERE
  tcode = ?
  
                    ");

                    
                    
$stmt2->execute(array(
  $CODE
));

$rows2 = $stmt2->fetchall();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CHeck if get requset userid is numeric & get the intger value of it
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
	$stmt->execute(array($CODE));
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
  <title>Question</title>
  <link rel="stylesheet" href="css/miniqui.css">
  <style>
		  .button {
			margin-top: 20px;
    top:50%;
    background-color: rgb(255, 100, 0);
    color: white;
    border:none; 
    border-radius:10px; 
    padding:15px;
    min-height:30px; 
    min-width: 120px;
	clip-path: polygon(90% 0, 100% 34%, 100% 100%, 10% 100%, 0 66%, 0 0);
	font-size: larger;
	cursor: pointer;
	transition: 0.5 ease;

  }
 

	</style>
</head>
<body>
	<!-- <span class="back" > <img src="img/arrow-left-solid.svg"></span> -->
<?php
		if(        $check = checkitem('tcode', 'test' , $CODE ) > 0 ) {


?>
<!-- partial:index.partial.html -->
<table>
     <thead>
        <tr>
		
          <th><?php echo '<a href="Team.php?do=team&Code='.$CODE.'"><span class="back"><img src="img/arrow-left-solid.svg"></span></a>' ; ?>
		  <label class="elol"></label></th>
          <th><label >Question</label></th>
          <th><label>Answer 1</label></th>
          <th><label>Answer 2</label></th>
          <th><label>Answer 3</label></th>
          <th><label>Answer 4</label></th>
          <th><label>Correct Answer</label></th>
          <th><label>UPdata</label></th>
		  <th><label>delete</label></th>
        </tr>
      </thead>
      <tbody>
	  <?php
					              $i=1;

				foreach($rows2 as $row2) {
					echo'
					<form action="updateque.php?do=upq&Code='.$row2['Code'].'&tcode='.$CODE.'" method="POST" enctype="multipart/form-data" > 
					';
					echo '
					<tr>
					<td data-label="#">
					'.$i++.'
					</td> ' ;
					echo '
					<td data-label="Question"><textarea  class="vk150" name="Question">'.$row2['Question'].'</textarea></td>
					<td data-label="Answer 1"><textarea  class="vk150" name="answer1">'.$row2['answer1'].'</textarea></td>
					<td data-label="Answer 2"><textarea  class="vk150" name="answer2">'.$row2['answer2'].'</textarea></td>
					<td data-label="Answer 3"><textarea  class="vk150" name="answer3">'.$row2['answer3'].'</textarea></td>
					<td data-label="Answer 4"><textarea  class="vk150" name="answer4">'.$row2['answer4'].'</textarea></td>
					<td data-label="Correct Answer"><textarea  class="vk150" name="corrans">'.$row2['corrans'].'</textarea></td>
					<td data-label="Actions"><span class="btn">Update</span>
					
					</td>
					<td>
					<a href="updateque.php?do=deq&Code='.$row2['Code'].'&tcode='.$CODE.'"><span class="btn-del">Delete</span>
					</td>
					</form>		
        			</tr>
					' ;
				}
		?>
      </tbody>
    </table>
	<?php echo '<center><a href="createque.php?Code='.$CODE.'"><button class="button">ADD MORE</button></a></center></div> '; ?>

<!-- partial -->
  
</body>
</html>
<!--  -->
<?php }else{
	header("location:createque.php?Code=$CODE");
}}?>