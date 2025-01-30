<?php

ob_start();
include('dbcon.php');
if(isset($_GET['Code'] )) {
$CODE = $_GET['Code'] ;

//////////////////////////////////
if(isset($_SESSION['UserName'])) {
  $stmt3 = $con->prepare("
      SELECT
          *
      FROM 
        team 
      WHERE
      Code = ?
                          ");
  // execute query
  $stmt3->execute(array($rows0['teamcode']));
  // fatch the data
  $rowss3 = $stmt3->fetch();
  // the raw count to check the id in database
  $count3 = $stmt3->rowcount();
  }

$stmt = $con->prepare("
SELECT
    *
FROM 
  sport
WHERE
  TypeCode = 1

                    ");
    
$stmt->execute();
    
$rows = $stmt->fetchAll();
/////////////////////////////////
$stmt2 = $con->prepare("
SELECT
    *
FROM 
  sport
WHERE
  Code = ?

                    ");
    
$stmt2->execute(array($CODE));
    
$rows2 = $stmt2->fetch();

$TeamLeaderName = $_SESSION['UserName'] ;
}
//////////////////////////////////////////

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $CODE = $_POST['Teamcode'] ;
$stmt = $con->prepare("
SELECT
    *
FROM 
  sport
WHERE
  TypeCode = 1

                    ");
    
$stmt->execute();
    
$rows = $stmt->fetchAll();
/////////////////////////////////
$stmt2 = $con->prepare("
SELECT
    *
FROM 
  sport
WHERE
  Code = ?

                    ");
    
$stmt2->execute(array($CODE));
    
$rows2 = $stmt2->fetch();

$TeamLeaderName = $_SESSION['UserName'] ;
//////////////////////////////////////////
function checkitem($select1 , $select2 , $from , $value1 , $value2) {

  global $con;

  $statement = $con->prepare(" SELECT $select1 , $select2  FROM $from WHERE $select1 = ? AND $select2 = ? ");

  $statement->execute(array($value1,$value2));

  $count = $statement->rowcount();

  return $count;
}

$check = checkitem("Name" , "game_code" , "team" , $_POST['Name'] , $_POST['Code'] ) ;

if ($check == 0 ) {

  // header('Location: insertteam.php?do=createteam&UserName='.$_SESSION['UserName'].'&TeamLeaderName='.$_POST['TeamLeaderName'].'&profilepicture='.$_POST['profilepicture'].'&Code='.$_POST['Code'].'&Name='.$_POST['Name'].'&Email='.$_POST['Email'].'&Location='.$_POST['Location'].'&PlayersNumber='.$_POST['PlayersNumber'].'&level='.$_POST['level'].'');
  $Name   = $_POST['Name'];
  $Email   = $_POST['Email'];
  $TeamLeaderName = $_POST['TeamLeaderName'];
  $games = $_POST['Code'];
  $level   = $_POST['level'] ;
  $PlayersNumber   = $_POST['PlayersNumber'] ;
  $Location   = $_POST['Location'] ;
  $profilepicture   = $_POST['profilepicture'] ;
  $stmt = $con->prepare("
  INSERT INTO 
  team(Name , Email, game_code , TeamLeaderName ,  level , PlayersNumber , Location , logo )
  VALUES(:zname, :zEmail, :zgame_code , :zTeamLeaderName , :zlevel , :zPlayersNumber , :zLocation , :zlogo )
                      ");
  $stmt->execute(array(

      'zname' => $Name,
      'zEmail' => $Email,
      'zgame_code' => $games,
      'zTeamLeaderName' => $TeamLeaderName,
      'zlevel' => $level ,
      'zPlayersNumber' => $PlayersNumber ,
      'zLocation' => $Location ,               
      'zlogo' => $profilepicture
  ));
  

$_SESSION['regst'] = 2 ;


$stmt = $con->prepare("UPDATE player SET regst = 2 , teamcode = LAST_INSERT_ID() , playertype = 'coach' WHERE UserName = ?");

$stmt->execute(array($_SESSION['UserName']));

header("location:game.php?Code=$games");
}

}

  



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <content="width=device-width, initial-scale="1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/create-team.css">
</head>
<body style="background-image: url(img/test3.jpg);">
<header class="header">
    <div class="overlay" data-overlay></div>
    <div class="cont">
    <a href="#" class="logo">
          <img
            src="img/logo edit sport copy new.png"
            class="plogo"
            alt="GameX logo"
          />
        </a>
      <button class="nav-open-btn" data-nav-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>
      <nav class="navbar" data-nav>
        <div class="navbar-top">
          <a href="#" class="logo">
          <?php if(isset($rows0['profilepic'])) { echo ' <img src="'.$rows0['profilepic'].'" alt="" style="width=50%;" />  ';
            } else {
              echo ' <img src="img/logo edit sport copy new.png" alt="" style="width=50%;" /> ';
            } ?>
          </a>
          <button class="nav-close-btn" data-nav-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>
        </div>
        <ul class="navbar-list">
          <li>
            <a href="index.php" class="navbar-link">Home</a>
          </li>
          <li>
            <a href="E-Sport.php" class="navbar-link">E-sport</a>
          </li>
          <li>
            <a href="Tournament.php" class="navbar-link">Tournament</a>
          </li>
          <li>
            <a href="p-sport.php" class="navbar-link">p-sport</a>
          </li>
          <li>
            <a href="help.php" class="navbar-link">faq</a>
          </li>
          <li>
            <a href="contactus.php" class="navbar-link">Contact</a>
          </li>
          <?php 

if (isset($_SESSION['UserName'])) {
  
  echo '
          <li class="head-item">
            <a href="playerinfo.php?ID='.$_SESSION['ID'].'" class="navbar-link">information</a>
          </li>
          ';
          if (isset($_SESSION['UserName']) && $count3 > 0) {
            echo '
            <li class="head-item">
              <a href="Team.php?do=team&Code=' . $rowss3['Code'] . '" class="navbar-link">Your Team</a>
            </li>
            '; 
          } 
          if (isset($_SESSION['UserName']) && $_SESSION['regst'] == 4) {
echo '
          <li class="head-item">
            <a href="dashboard.php" class="navbar-link">dashboard</a>
          </li> ' ; }          echo '
          <li class="head-item">
          <a href="logout.php" class="navbar-link">logout</a>
          </li>
          ';


} else {
  echo '
  <li class="head-item">
  <a href="login.php" class="navbar-link">login</a>
  </li>
  ';
}
          ?>
        

        </ul>
      </nav>
      <div class="head-logo">
        <!-- <input type="checkbox" id="check" /> -->
        <div class="show">
          <label for="check">
            <i class="fas fa-bars" id="sidebar_btn"></i>
          </label>
        </div>

        <?php 

        if (isset($_SESSION['UserName'])) {
          echo '
        <img src="'.$rows0['profilepic'].'" class="user-img" id="togglemenu" alt="" />
        <div class="sub-menu-wrab" id="sub-menu">
          <div class="sub-menu">
            <div class="user-info">
              <img src="'.$rows0['profilepic'].'" alt="" />
              <h2>'.$rows0['FullName'].'</h2>
            </div>
            <hr />
            <a href="#" class="sub-menu-link">
              <div class="contain">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <a href="playerinfo.php?ID='.$_SESSION['ID'].'"> <span style="color: white;">information</span></a>
                ' ;
                if (isset($_SESSION['UserName']) && $count3 > 0) {
                  echo '
                    <a href="Team.php?do=team&Code=' . $rowss3['Code'] . '" > <span style="color: white;">Your Team</span></a>
                  '; 
                } 
                if (isset($_SESSION['UserName']) && $_SESSION['regst'] == 4) {
               echo' <a href="dashboard.php"> <span style="color: white;">dashboard</span></a> ';
              }
              echo '
              <a href="logout.php"> <span style="color: white;">logout</span></a>
              </div>
              
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div> ';
        } else { 
        ?>
        <?php echo '
      </div>
      <div class="header-actions" >
        <a href="login.php">
        <button class="btn-sign_in">
          <div class="icon-box">
            <ion-icon name="log-in-outline"></ion-icon>
          </div>
        <span>Log-in</span>
        </button>
      </div> '; }
      ?>
    </a>
    </div>
  </header>

<div class="container">
    <div class="card">
      <div class="left">
        <div class="contt">
   
            <!-- Add Card -->
            <div class="card" id="addCard">
              <button>
                <input type="file" name="" id="fileInput" required />
                Upload LOGO
              </button>
              <!-- <p>Choose an image to makes it transparent</p> -->
            </div>
            <!-- Display Card -->
            <div class="card" id="displayCard">
              <div class="image-cont">
                <img
                  id="display-img"
                  src=""
                  alt=""
                />
              </div>
              <button id="startBtn">Start</button>
            </div>
            <!-- Loading Card -->
            <div class="card" id="loadingCard">
              <div class="loader"></div>
            </div>
            <!-- Download Card -->
            <div class="card" id="downloadCard">
              <div class="image-cont">
                <img
                  class="image-before"
                  src=""
                  alt=""
                />
                <img
                  class="image-after" 
                  src=""
                  alt=""
                />
              </div>
              <div style="display: flex; gap: 10px">
                <button id="uploadAnother">Upload Another</button>
              </div>
            </div>
          </div>
      </div>
      <div class="right">
        <h2>create-team</h2>
        <div class="contact">
          <div class="form-container">
          <?php echo '<form class="form" action="'.$_SERVER['PHP_SELF'].'" method="POST" enctype="multipart/form-data">';?>          
              
          <input type="hidden" name="TeamLeaderName" value="<?php echo $TeamLeaderName ; ?>">
          
          <input style="display: none;" type="text" id="profilepicture" name="profilepicture" value="">
         
          <input type="hidden" name="Code" value="<?php echo $rows2['Code'] ; ?>">

          <input type="hidden" name="Teamcode" value="<?php echo $CODE ; ?>">
              
          <div class="username">
                <input type="text" name="Name" placeholder="Enter Team Name" pattern=^[a-zA-Z\s]*$ required>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  if($check > 0 ) {
                    echo ' this team exist ' ;
                } }?>
              </div>
              <div class="useremail">
                <input type="email" name="Email" placeholder="Enter Team email" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$" required>
              </div>
              <div class="useremail">
                <input type="text" name="Location" placeholder="Enter your location" required>
              </div>
              <div class="useremail">
                <input type="number" name="PlayersNumber" placeholder="Enter Team Size" required>
              </div>
              <div class="useremail">
                <input type="number" name="level" placeholder="Enter level" required>
              </div>
              <div class="usersubmit">
              <input type="submit" name="uploadfilesub">
                          </div>
            </form>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    
  <footer style="margin-top: 100px;">
      <div
        class="footer-top"
        style="background-image: url(img/footer-bg.jpg) no-repeat"
      >
        <div class="cont">
          <div class="footer-brand-wrapper">
            <a href="#" class="logo">
              <img
                src="img/logo edit sport copy new.png"
                class="plogo"
                alt="GameX logo"
              />
            </a>

            <div class="footer-menu-wrapper">
              <ul class="footer-menu-list">
                <li>
                  <a href="Home.html" class="footer-menu-link">Home</a>
                </li>
                <li>
                  <a href="E-Sport.html" class="footer-menu-link">E-Sport</a>
                </li>
                <li>
                  <a href="Tournament.html" class="footer-menu-link"
                    >Tournament</a
                  >
                </li>

                <li>
                  <a href="P-Sport" class="footer-menu-link">P-Sport</a>
                </li>

                <li>
                  <a href="help.html" class="footer-menu-link">faq</a>
                </li>
                <li>
                  <a href="contactus.html" class="footer-menu-link">Contact</a>
                </li>
              </ul>

              <div class="footer-input-wrapper">
                <input
                  type="text"
                  name="message"
                  required
                  placeholder="Find Here Now"
                  class="footer-input"
                />

                <button class="btn btn-primary">
                  <ion-icon name="search-outline"></ion-icon>
                </button>
              </div>
            </div>
          </div>
          <div class="copyright-text">
            <p>
              <!-- Copyright © 2023 All rights reserved | This template is made with -->
              you can find the best practice videos about Physical sports for
              your fit health on
              <a href="./p-sport.html" target="_blank">PSPORTS</a>
            </p>
          </div>
        </div>
      </div>
    </footer>
<script src="js/create-team.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>