<?php
  ob_start();
function countItems($item , $table ,$WHERE,$VALUE) {
        
  global $con ;

  $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table WHERE $WHERE = $VALUE");

  $stmt2->execute();

  return $stmt2->fetchColumn();

}

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
if ($do == 'team') {   

include('dbcon.php');



//////////////////////////////////////////////////////////////////////////////////////////////////////////////


$stmt3 = $con->prepare("
(SELECT * FROM player Where playertype = 'coach' )
UNION
(SELECT * FROM player Where regst = 3 )
                   ");
 /*$stmt3 = $con->prepare("

  SELECT * FROM player
  
                       ");*/

$stmt3->execute();
    
$rows3 = $stmt3->fetchAll();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

$stmt = $con->prepare("
    SELECT
    *
    FROM 
        team 
                        ");
        
    $stmt->execute();
        
    $rows = $stmt->fetchAll();
              
  // CHeck if get requset userid is numeric & get the intger value of it
  
  $Code = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;
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
/////////////////////////////////////////
$stmt6 = $con->prepare(
  'SELECT 
  *
  FROM
  sport
  WHERE
  Code  = ? 
  '
    );
  // execute query
  $stmt6->execute(array($row['game_code']));
  // fatch the data
  $row6 = $stmt6->fetch();
  /////////////////////////////
  $stmt9 = $con->prepare(
    'SELECT 
    *
    FROM
    `join`
    WHERE
    TEAM_CODE  = ? 
     ');
    // execute query
    $stmt9->execute(array($Code));
    // fatch the data
    $rows9 = $stmt9->fetchall();
    // the raw count to check the id in database
    $count = $stmt->rowcount(); 
    /////////////////////////////////////////
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
?>
<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <content="width=device-width, initial-scale="1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css'>
    <!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'> -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css'>
    <link rel="stylesheet" href="css/teamwolf.css">
  </head>
<body>
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
          </li> ' ; }

          echo '
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
    <!-- 
      - #HERO
    -->

      <!-- --straboutteam -->

      <div class="contaier">
        <h2 class="h2 section-title">About Team</h2>
        <div class="cont">
          <div class="img">
          <?php
          echo "
            <img src=".$row['logo']."> " ;
            ?>         
            </div>
          <div class="text">
            <div class="text-values">
              <?php echo "
              <div>
                <label>Name :</label>
                <span>".$row['Name']."</span>
                </div>
              <div>
                <label>location :</label>
                <span>".$row['Location']."</span>
                </div>
              <div>
                <label>level :</label>
                <span>".$row['level']."</span>
                </div>
              <div>
                <label>Games :</label>
                <span>".$row6['Name']."</span>
                </div>
              <div>
                <label>Player :</label>
                <span>".$row['PlayersNumber']."</span>
                </div>
            </div>
            ";
            ?>
          </div>
          <div class="jion">
          <?php

           
           if(isset($_SESSION['regst']) && $_SESSION['regst'] == 2 && $row['TeamLeaderName'] == $_SESSION['UserName']) 
           {
            echo '
            <a href="editteam.php?Code='.$row['Code'].'"><button class="btn-join">Edit Team</button></a> 
            <a href="addplayertable.php?do=addplayer&Code='.$row['Code'].'"><button class="btn-join">Edit Players</button></a> 
            <a href="editquestion.php?Code='.$row['Code'].'"><button class="btn-join">questions</button></a> 
            ';
          }
          if(isset($_SESSION['regst']) && $_SESSION['regst'] == 1 ) 
          {
            echo '
            <a href="viewque.php?Code='.$Code.'"> <button class="btn-join">Join team</button></a>
                ';
          }
          if(isset($_SESSION['regst']) && $_SESSION['regst'] == 5 && $row['Code'] == $_SESSION['teamcode']) 
          {
            echo '
            <center> <h5 style="color: rgb(255 100 0);" > Your Test Is Submited , Please Wait The Team Coach To Approve Your Requset </h5> </center>
            <br>
            <br>
            <br>
              ';
            echo '
            <a href="jointeam.php?do=outteam&Code='.$Code.'"> <button class="btn-join">Exit team</button></a>
              ';
          }
          if(isset($_SESSION['regst']) && $_SESSION['regst'] == 3 && $row['Code'] == $_SESSION['teamcode']) 
           {
            echo '
            <center> <h5 style="color: rgb(255 100 0);" > congratulation Your Request Is Approved , Team Coach Will Contact You SOON </h5> </center>
            <br>
            <br>
            <br>
            <a href="jointeam.php?do=outteam&Code='.$Code.'"> <button class="btn-join">Exit team</button></a>
                ';
           }
           elseif(!isset($_SESSION['regst'])) {
            echo '
            <a href="login.php"> <button class="btn-join">You Want To Join ? <br> Login Now</button></a>
                ';
           }
            ?>
          </div>
        </div>
      </div>

    <!-- --endaboutteam -->
      <!-- 
        - #GEARS
      -->
      <section class="gears" id="gears" style="background-image: url(img/gears-card-bg.png) no-repeat;">
        <div class="cont">
          <h2 class="h2 section-title">Tournament</h2>
          <ul class="gears-list">
          <?php 
              foreach($rows9 as $row9) {
                echo '
              <li>
                <div class="gears-card">
                  <div class="card-banner"> 
                    <a href="#">
                      <img src="'.$row9['TOURNAMENT_LOGO'].'" alt="Headphone">
                    </a>
                    <div class="card-time-wrapper">
                      <ion-icon name="time-outline"></ion-icon>
                      <span class="days">'.$row9['TOURNAMENT_Start_Date'].'</span>
                    </div>
                  </div>
                  <div class="card-content">
                    <div class="card-title-wrapper">
                      <h3 class="h3 card-title">'.$row9['TOURNAMENT_NAME'].'</h3>
                      <p class="card-subtitle">e-sports</p>
                    </div>
                  </div>
                  <div class="card-actions">
                  <a href="MAINTOUR.php?do=tour&Code='.$row9['TOURNAMENT_CODE'].'">
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



      <!-- --strteam -->
      <h2 class="h2 section-title">Player</h2>
<section class="game-section">

  <div class="owl-carousel custom-carousel owl-theme">
  <?php
foreach($rows3 as $row2) {
  if($row['Code'] == $row2['teamcode']) {
    $dateOfBirth = $row2['BirthDate'] ;
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
  echo '<div class="item active" style="background-image: url('.$row2['profilepic'].');"> ' ;
  echo '<div class="item-desc">' ;
  echo '<h3>' .$row2['playertype']. '</h3>' ; 
  echo '<h4> Full Name :  ' .$row2['FullName']. '</h4>';
  echo '<h4> User Name : ' .$row2['UserName']. '</h4>';
  echo '<h4>Age : ' .$diff->format('%y'). '</h3>';
  echo '</div>' ;   
  echo '</div>' ;
                                        }
                         }
 ?>
  </div>
</section>
      <!-- --endteam -->
<!-- 
  - #FOOTER
-->

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



        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
<script src="js/teamwolf.js"></script>
</body>
</php>
<?php
        }  ?>