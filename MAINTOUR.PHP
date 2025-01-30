<?php
ob_start();
include('dbcon.php');

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
$Code = $_GET['Code'] ;

if ($do == 'tour') {   

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
/////////////////////////
  $stmt2 = $con->prepare(
'SELECT 
*
FROM
team
WHERE
TeamLeaderName  = ? 
'
  );
// execute query
if(isset($_SESSION['UserName'])){
$stmt2->execute(array($_SESSION['UserName']));
}
// fatch the data
$row2 = $stmt2->fetch();
/////////////////////////////
  $stmt3 = $con->prepare(
'SELECT 
*
FROM
`join`
WHERE
TEAM_LEADER  = ? 
AND
TOURNAMENT_CODE  = ?
 ');
// execute query
if(isset($_SESSION['UserName'])){
$stmt3->execute(array($_SESSION['UserName'] , $Code));
}
// fatch the data
$row3 = $stmt3->fetch();
// the raw count to check the id in database
$count = $stmt->rowcount(); 
/////////////////////////////////////////
$stmt5 = $con->prepare("
SELECT
    *
FROM 
team 
WHERE
Code = ?
                    ");
// execute query
$stmt5->execute(array($row['top_team_one_id']));
// fatch the data
$rows5 = $stmt5->fetch();
// the raw count to check the id in database
$count5 = $stmt5->rowcount(); 
//////////////////////////////////

$stmt6 = $con->prepare("
SELECT
    *
FROM 
team 
WHERE
Code = ?
                    ");
// execute query
$stmt6->execute(array($row['top_team_two_id']));
// fatch the data
$rows6 = $stmt6->fetch();
// the raw count to check the id in database
$count6 = $stmt6->rowcount(); 
//////////////////////////////////

$stmt7 = $con->prepare("
SELECT
    *
FROM 
team 
WHERE
Code = ?
                    ");
// execute query
$stmt7->execute(array($row['top_team_three_id']));
// fatch the data
$rows7 = $stmt7->fetch();
// the raw count to check the id in database
$count7 = $stmt7->rowcount(); 
////////////////////////////
$stmt8 = $con->prepare(
  'SELECT 
*
FROM
`join`
WHERE
TOURNAMENT_CODE = ? AND regst = 2
'
);
// execute query
$stmt8->execute(array($Code));
// fatch the data
$row8 = $stmt8->fetchall();
// the raw count to check the id in database
$count8 = $stmt8->rowcount();
///////////////////////////////////
$stmt9 = $con->prepare(
  'SELECT 
*
FROM
sport
WHERE
Code  = ? 
'
);
// execute query
$stmt9->execute(array($row['game_code']));
// fatch the data
$row9 = $stmt9->fetch();
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
<!DOCTYPE PHP>
<PHP lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css'>
    <link rel="stylesheet" href="css/etl.css">
    <title>Document</title>
    <style>

        .button {
          border: none;
    font-size: 1.1rem;
    padding: 20px;
    background: var(--orange);
    position: relative;
    top: -20px;
    clip-path: polygon(90% 0, 100% 34%, 100% 100%, 10% 100%, 0 66%, 0 0);
    color: white;
    cursor: pointer;
    margin-top: 55px;
    /* top:50%;
    background-color:yellow;
    color: black;
    border:none; 
    border-radius:10px; 
    padding:15px;
    min-height:30px; 
    min-width: 120px;
    position: relative;
    text-decoration: none;
    font-weight: 500; */
  }
  .land {
    background: url("<?php echo $row9['cover'];?>") no-repeat;
  background-size: cover;
  background-position: top;
  /* background-attachment: fixed; */
  margin-top: 90px;
  /* padding: var(--section-padding) 0; */
  height: 60vh;
}

    </style>
</head>
<body>
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

    <section class="land" id="land">
      <div class="tour-head">
        <div class="tour-info">
          <div class="sig">
            <img src="<?php echo $row['logo'];?>" class="tourlogo" alt="" />
            <span><?php echo $row['Name'];?></span>
          </div>
          <div class="team-number">
            <div>
              <span
                >accepted
                <p><?php echo count($row8);?></p></span
              >
            </div>
            <hr />
            <div>
              <span
                >limit
                <p><?php echo $row['TEAMS_NUMBER'];?></p></span
              >
            </div>
          </div>
          <!-- <div class="all-buttons">
            <button class="button" id="save-tour">save</button>
            <button class="button" id="remove-tour">remove</button>
          </div> -->
        </div>
      </div>
    </section>

 
   
      </section>
      <?php 
      if(count($row8) == $row['TEAMS_NUMBER']) {
        echo '' ;
      }
      elseif(isset($_SESSION['regst']) && $_SESSION['regst'] == 2 && !isset($row3['regst'])  &&  $row['game_code'] == $row2['game_code'] ){
  echo '
     <div class="img">
     <center><a class="button" href="jointour.php?do=jointour&Code='.$Code.'">join Tournament</a></center> 
     </div> 
    ' ;
  }

  
    ?>
  <?php if(isset($_SESSION['regst']) && $_SESSION['regst'] == 2 && isset($row3['regst'])  && $row3['regst'] == 1 && $row['game_code'] == $row2['game_code'] && $row['Name'] == $row3['TOURNAMENT_NAME'] ){
  echo '
     <div >
     <center>
     <h5 style="color: rgb(255 100 0); position: relative; bottom: -48px;" > Your Join Request Is Submited , Please Wait The Tournament Organizer To Accept Your Request </h5>
     <a class="button" href="jointour.php?do=exittour&Code='.$Code.'">Exit Tournament</a>
     </center> 
     </div> 
    ' ;
  }
  ?>
  <?php if(isset($_SESSION['regst']) && $_SESSION['regst'] == 2 && isset($row3['regst'])  && $row3['regst'] == 2 && $row['game_code'] == $row2['game_code'] && $row['Name'] == $row3['TOURNAMENT_NAME']){
  echo '
     <div >
     <center>
     <h5 style="color: rgb(255 100 0); position: relative; bottom: -48px;" > congratulation Your Request Is Approved , Follow The Tournament Page For Matches Times </h5>
    <a class="button" href="jointour.php?do=exittour&Code='.$Code.'">Exit Tournament</a></center> 
     </div> 
    ' ;
  }
  ?>
    <!-- --sec1 -->
    <br>
    <BR>
    <h2 class="h2 section-title">Matchs</h2>
    <div class="brackets" id="brackets">
   
    <?php
    if($row['bracket'] !== "" ) {
  echo '
     <div class="img">
       <center><img src="'.$row['bracket'].'"></center> 
    </div> 
    ' ;
    }
    else{
      echo '<center><h1 style="color: rgb(255 100 0);">there is no matchs</h1></center>' ;
  
    } ?>
    
    </div>
    
  
   
    <div class="ttop" style="margin-top: 5px;">
    <h2 class="h2 section-title">Top Teams</h2>

    <div class="flex-container-cards">
      
    <?php
  if( $count5 !== 0 ) {  echo '
  <div class="card">
    <div class="card-img-shadow"><img src="'.$rows5['logo'].'" alt="wanda"></div>
    <div class="card-content">
      <h2>TOP 1</h2>
      <div class="button-shadow">
        <div class="card-button">'.$rows5['Name'].'</div>
      </div>
    </div>
  </div>
' ; 
  } ?>
    
    <?php
  if( $count6 !== 0 ) {  echo '
  <div class="card">
    <div class="card-img-shadow"><img src="'.$rows6['logo'].'" alt="wanda"></div>
    <div class="card-content">
      <h2>TOP 2</h2>
      <div class="button-shadow">
        <div class="card-button">'.$rows6['Name'].'</div>
      </div>
    </div>
  </div>
' ; 
  } ?>
      
      <?php
  if( $count7 !== 0 ) {  echo '
  <div class="card">
    <div class="card-img-shadow"><img src="'.$rows7['logo'].'" alt="wanda"></div>
    <div class="card-content">
      <h2>TOP 3</h2>
      <div class="button-shadow">
        <div class="card-button">'.$rows7['Name'].'</div>
      </div>
    </div>
    </div>
' ; 
  }else{
    echo '<center><h1 style="color: rgb(255 100 0);">top 3 TEAMS will be show in the end of the tour</h1></center>' ;

  } ?>

</div>

<!-- --s -->
<h2 class="h2 section-title" style="margin-top: 50px;">Participant Teams</h2>

<section class="game-section">
  <!-- <h2 class="line-title">trending games</h2> -->
  <div class="owl-carousel custom-carousel owl-theme">
  <?php
      if(count($row8) > 0) {
      foreach ($row8 as $rows8) {
        echo '
            <a href="Team.php?do=team&Code=' . $rows8['TEAM_CODE'] . '"> ';
        echo '<div class="item active" style="background-image: url(' . $rows8['TEAM_LOGO'] . ');">';
        echo '<div class="item-desc"> ';
        echo '<h3>' . $rows8['TEAM_NAME'] . '</h3> ';
        echo '<p> Team leader :' . $rows8['TEAM_LEADER'] . '</p> ';
        echo '</div> ';
        echo ' </div>';
        echo ' </a>';

      }
    }

    ?>
  </div>
  <?php

    if(count($row8) == 0) {
      echo '<center><h1 style="color: rgb(255 100 0);"> there no participant teams </h1></center>' ;
    }

  ?>
</section>
<!-- --s -->





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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      <script src="js/etlpubg.js"></script>
      <script>
//         let landingpage =document.querySelector('.land');
// let imgarray=["<?php echo$row['logo'];?>","<?php echo$row['logo'];?>"];
// setInterval(()=>{
// let randomnumber=Math.floor(Math.random()*imgarray.length);
// landingpage.style.backgroundImage='url("' + imgarray[randomnumber] + '")';
// },2000);

      </script>
</body>
</PHP>
<?php } ?>