<?php
include('dbcon.php');
// check if user coming from http post request 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashedPass = sha1($password);
    
    // check if the user exist
    
    $stmt = $con->prepare('
    SELECT 
		*
    FROM
		player
    WHERE
		UserName = ?
    AND 
        password = ?
						');

    $stmt->execute(array($username , $hashedPass));
    $row = $stmt->fetchall();
    $count = $stmt->rowcount();
    
    // if count > 0 this mean database contain record about this username
    
    if ($count > 0) {
        foreach($row as $rows){
        $_SESSION['UserName'] = $username;  // Reqister Session Name
        $_SESSION['ID'] = $rows['ID'];  // Reqister Session Name
        $_SESSION['teamcode']= $rows['teamcode']; // Reqister Session teamcode
        $_SESSION['regst']= $rows['regst']; // Reqister Session regst
        header('Location: E-Sport.php');
        exit();
        }
                    
    }

                    
    }
    

 

?>
<!DOCTYPE php>
<php>
<head>
<title>Login </title>
<meta name="viewport" content="width=devic­­e-width, initial-scale=1">

<link rel="stylesheet" href="css/login.css">
</head>
<body>
<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method='POST'>
	
	<div class="logo">
		<img src="../img/logo edit sport copy new.png">
	</div>

	<div class="inputs">
		<input type="text" name="username" placeholder="Your user name">
		<input type="password" name="password" id="password" placeholder="Your secret password">
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($count == 0) {
      echo '<h5 style="color: red;"> username or password not correct </h5>' ;
    }
  }
    ?>
    <br>
    <div class="btnlog">
    <button>Continue</button> 
    </div>
	
		<p>Dont have an account? <a href="signup.php">Sign up</a></p>
	</div>

</form>

</body>

</php>