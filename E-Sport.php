<?php
ob_start();
include('dbcon.php');
// if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
// {

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;

    $stmt = $con->prepare("
    SELECT
        *
    FROM 
      sport 
    WHERE
    TypeCode = 1
                        ");
// execute query
$stmt->execute();
// fatch the data
$rows = $stmt->fetchall();
//////////////////////////////////
$stmt1 = $con->prepare("
SELECT
    *
FROM 
  tournament 
LIMIT
  3
                    ");
// execute query
$stmt1->execute();
// fatch the data
$rows1 = $stmt1->fetchall();
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
$stmt4 = $con->prepare("
SELECT
    *
FROM 
  tournament 
WHERE
game_code  = 4
                    ");
// execute query
$stmt4->execute();
// fatch the data
$rows4 = $stmt4->fetchall();

?>
<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Sport</title>
  <link rel="stylesheet" href="css/E-Sport.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&family=Poppins:wght@400;500;700&display=swap"
    rel="stylesheet">
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

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
      <section
      class="land"
      id="land"
      style="background-image: url(img/esports-2021-scaled.jpeg)"
    >
      <div class="container"></div>
    </section>

    
      <!-- -#Games -->
      <h2 class="h2 section-title" style="margin-top: 50px;">Games</h2>
      <section class="all">
      <div class="containers">
      <?php
      foreach($rows as $row) {
        echo ' <div class="card" data-aos="fade-up-right"data-aos-duration="3000"> ' ;
        echo ' <a href="game.php?Code='.$row['Code'].'"><img src="'.$row['logo'].'"> ' ;
        echo ' <div class="card__head">'.$row['Name'].'</div></a> ' ;
        echo '</div> ' ;
      }
        ?>
         </div>     
      </section>
      <!-- -------- -->
      <div class="parent">

              <?php
      foreach($rows as $row) {
        echo '
        <div>
            <div class="first hero">
                <img class="hero-profile-img" src="'.$row['cover'].'" alt="">
                <div class="hero-description-bk"></div>
                <div class="hero-logo">
                    <img src="'.$row['logo'].'" alt="" style="margin-left: -30px;">
                </div>
                <div class="hero-description">
                    <p></p>
                </div>
                <div class="hero-btn">
                <a href="game.php?Code='.$row['Code'].'">'.$row['Name'].'</a>
                </div>
            </div>
          </div>
        ';
      }
        ?>

                </div>

       <!-- <img src="" alt=""> -->
       <div style="background-image: url(<?php echo $rows0['profilepic'] ;?>) ;" >

       </div>
        <!-- 
          - #GEARS
        -->
        <section class="gears" id="gears" style="background-image: url(img/gears-card-bg.png) no-repeat;">
          <div class="container">
            <h2 class="h2 section-title">check our Tournament</h2>
            <ul class="gears-list">
              <?php 
              foreach($rows1 as $row1) {
                echo '
              <li>
                <div class="gears-card">
                  <div class="card-banner"> 
                    <a href="#">
                      <img src="'.$row1['logo'].'" alt="Headphone">
                    </a>
                    <div class="card-time-wrapper">
                      <ion-icon name="time-outline"></ion-icon>
                      <span class="days">'.$row1['Start_Date'].'</span>
                    </div>
                  </div>
                  <div class="card-content">
                    <div class="card-title-wrapper">
                      <h3 class="h3 card-title">'.$row1['Name'].'</h3>
                      <p class="card-subtitle">e-sports</p>
                    </div>
                  </div>
                  <div class="card-actions">
                  <a href="MAINTOUR.php?do=tour&Code='.$row1['Code'].'"> 
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

       <!-- 
          - #ABOUT
        -->
       
        <section class="about" id="about">
      <h2 class="h2 section-title">about</h2>
      <div class="container">
        <figure class="about-banner">
          <img src="img/about-img.png" alt="M shape" class="about-img" />

          <img
            src="img/character-1.png"
            alt="Game character"
            class="character character-1"
          />

          <img
            src="img/new-neon.png"
            alt="Game character"
            class="character character-2"
            style="
              width: 720px;
              height: 460px;
              margin-top: -195px;
              margin-left: -200px;
            "
          />

          <img
            src="img/zed.png"
            alt="Game character"
            class="character character-3"
          />
        </figure>

        <div class="about-content">
          <p class="about-subtitle">Find team member</p>

          <h2 class="about-title">
            Experience just for gamers <strong>offer</strong>
          </h2>

          <p class="about-text">
            Esports short for electronic sports, is a form of competition using
            video games. Esports often takes the form of organized, multiplayer
            video game competitions, particularly between professional players,
            individually or as teams
          </p>

          <p class="about-bottom-text">
            <ion-icon name="arrow-forward-circle-outline"></ion-icon>

            <span>Esports Will sharpen your brain and focus</span>
          </p>
        </div>
      </div>
    </section>


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

  <!-- 
    - #GO TO TOP
  -->







  <!-- 
    - custom js link
  -->
  <script src="js/E-sport.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</php>