<?php
ob_start();
include('dbcon.php');
// if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
// {

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
$CODE = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;


$stmt3 = $con->prepare("
    SELECT
        *
    FROM 
      sport 
    WHERE
    Code = ?
                        ");
// execute query
$stmt3->execute(array($CODE));
// fatch the data
$rows3 = $stmt3->fetch();
// the raw count to check the id in database
$count = $stmt3->rowcount();
// if there is such id show the form
if ($count > 0) {
  $stmt = $con->prepare("
    SELECT
        *
    FROM 
        team 
    WHERE
     game_code = ?
                        ");

  $stmt->execute(array($CODE));

  $rows = $stmt->fetchall();
  /////////////////////////////////
  $stmt4 = $con->prepare("
SELECT
    *
FROM 
  tournament 
WHERE
game_code  = ?
                    ");
// execute query
$stmt4->execute(array($CODE));
// fatch the data
$rows4 = $stmt4->fetchall();

  function countItems($item, $table)
  {

    global $con;

    $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");

    $stmt2->execute();

    return $stmt2->fetchColumn();

  }
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
  $count = $stmt3->rowcount();
  }
  //////////////////////////////////
$stmt00 = $con->prepare("
SELECT
    *
FROM 
   videos 
WHERE
    s_code = ?
                    ");
// execute query
$stmt00->execute(array($CODE));
// fatch the data
$rows00 = $stmt00->fetch();
////////////////////////////////////
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="css/pubg.css">
    <title>Games</title>
    <style>
      .button {
    top:50%;
    background-color:yellow;
    color: black;
    border:none; 
    border-radius:10px; 
    padding:15px;
    min-height:30px; 
    min-width: 120px;
  }
    </style>
</head>
<body style="background-image: url(<?php echo $rows3['cover'] ; ?>) no-repeat;">
<header class="header">
    <div class="overlay" data-overlay></div>
    <div class="container">
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
          if (isset($_SESSION['UserName']) && $count > 0) {
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
                if (isset($_SESSION['UserName']) && $count > 0) {
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
      <section class="land" id="hero" style="background-image: url(<?php echo $rows3['cover'] ; ?>)">

    
    </section>
    <br>
    <br>
    <section class="discription">
        <div class="container">
            <h2 class="h2 section-title"><?php echo $rows3['Name'] ?></h2>
            <p>
            <?php echo $rows3['description'] ?>
            </p>
            <?php
      if (isset($_SESSION['regst']) && $_SESSION['regst'] == 1) {
        echo '<center><a href="create-team.php?Code='.$CODE.'" target="_blank"><button class="btn-sign_in">create team</button></a> </center>';
      } elseif (!isset($_SESSION['regst'])) {
        echo '<center><a href="login.php" target="_blank"><button class="btn-sign_in">You Want To build Your Team ? <br> Login Now</button></a></center>';
      }
      ?>
        </div>
    
    </section>
    <br>
<br>
<?php
  if (countItems("*", "team") > 0) {

    echo '<h2 class="h2 section-title"data-aos="fade-right">Team</h2>';

  }
  ?>
<!-- __strgreas -->
 <section class="gears" id="gears" style="background-image: url(img/gears-card-bg.png) no-repeat;">
      <div class="container">
        <h2 class="h2 section-title">Tournament</h2>
        <ul class="gears-list">
        <?php 
              foreach($rows4 as $row4) {
                echo '
              <li>
                <div class="gears-card">
                  <div class="card-banner"> 
                    <a href="#">
                      <img src="'.$row4['logo'].'" alt="Headphone">
                    </a>
                    <div class="card-time-wrapper">
                      <ion-icon name="time-outline"></ion-icon>
                      <span class="days">'.$row4['Start_Date'].'</span>
                    </div>
                  </div>
                  <div class="card-content">
                    <div class="card-title-wrapper">
                      <h3 class="h3 card-title">'.$row4['Name'].'</h3>
                      <p class="card-subtitle">e-sports</p>
                    </div>
                  </div>
                  <div class="card-actions">
                  <a href="MAINTOUR.php?do=tour&Code='.$row4['Code'].'">
                    <button class="btn btn-primary">
                     <span>View</span>
                    </button>
                    </a>
                  </div>
                </div>
              </li>
              ' ; }
              ?>
        </ul>
      </div>
    </section>
<!-- --endgreas -->
<h2 class="h2 section-title">teames</h2>
<section class="game-section">
  <!-- <h2 class="line-title">trending games</h2> -->
  <div class="owl-carousel custom-carousel owl-theme">
  <?php
      foreach ($rows as $row) {
        echo '
            <a href="Team.php?do=team&Code=' . $row['Code'] . '"> ';
        echo '<div class="item active" style="background-image: url(' . $row['logo'] . ');">';
        echo '<div class="item-desc"> ';
        echo '<h3>' . $row['Name'] . '</h3> ';
        echo '<p> Team leader :' . $row['TeamLeaderName'] . '</p> ';
        echo '</div> ';
        echo ' </div>';
        echo ' </a>';

      }
      ?>
  </div>
</section>
<br>
<br>
<footer>

    <div class="footer-top" style="background-image: url(img/footer-bg.jpg) no-repeat;">
      <div class="container">

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
                <a href="index.php" class="footer-menu-link">Home</a>
              </li>
              <li>
                <a href="E-Sport.php" class="footer-menu-link">E-Sport</a>
              </li>
              <li>
                <a href="Tournament.php" class="footer-menu-link">Tournament</a>
              
              </li>

              <li>
                <a href="P-Sport.php" class="footer-menu-link">P-Sport</a>
              </li>

              <li>
                <a href="help.php" class="footer-menu-link">faq</a>
              </li>
              <li>
                <a href="contactus.php" class="footer-menu-link">Contact</a>
              </li>

            </ul>

            <div class="footer-input-wrapper">
              <input type="text" name="message" required placeholder="Find Here Now" class="footer-input">

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
              <a href="p-sport.php" target="_blank">PSPORTS</a>
            </p>
          </div>
      </div>
    </div>
  </footer>
      <div class="overlayyy">
        <div class="videoBox" id="videobox">
          <span onclick="cloesvideo()" class="closevideo"> Close </span>
          <video autoplay autoplay controls src="<?php echo $rows00['URL'] ; ?>"></video>
        </div>
     
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
      <script src="js/pubg.js"></script>
</body>
</html>
<?php } ?>