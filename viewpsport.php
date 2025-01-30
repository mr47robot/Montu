<?php
ob_start();
include('dbcon.php');
// if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
// {

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
$CODE = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;

$stmt = $con->prepare("
SELECT
    *
FROM 
    videos 
WHERE
 s_code = ?
                    ");
    
$stmt->execute(array($CODE));
    
$rows = $stmt->fetchall();


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
  if($count > 0) {
    $stmt4 = $con->prepare("
    SELECT
        *
    FROM 
        warmup 
    WHERE
     s_code = ?
                        ");
        
    $stmt4->execute(array($CODE));
        
    $rows4 = $stmt4->fetchall();
//////////////////////////////////////////////
    $stmt5 = $con->prepare("
    SELECT
        *
    FROM 
        tools 
    WHERE
     s_code = ?
                        ");
        
    $stmt5->execute(array($CODE));
        
    $rows5 = $stmt5->fetchall();
//////////////////////////////////////////////

    function countItems($item , $table) {
        
      global $con ;

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
?>
<!DOCTYPE php>
<php lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gutim Template">
    <meta name="keywords" content="Gutim, unica, creative, php">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $rows3['Name'] ; ?></title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/secondstyle.css" type="text/css">
</head>

<body >   
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
      <nav class="navbar" style="margin-bottom: 0;" data-nav>
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
        </button> </a>
      </div> '; }
      ?>

    </div>
  </header>


    <!-- Hero Section Begin -->
    <section  class="hero-section set-bg"  data-setbg="" >
        <div class="container"       
          style="
          width: 100%;
          height: 107%;
          background-size: cover;
          background-repeat: no-repeat;
          background-position: inherit;
          margin-top:-13px;
          background-image: url(<?php echo $rows3['cover'] ; ?>);
        ">
            <div class="row">
                <div class="col-lg-8">
                    <div class="hero-text">
                        <span> <?php echo $rows3['Name'] ; ?> </span>
                        <p><?php echo $rows3['description'] ; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
     <!-- Latest Blog Section Begin -->
     <section class="latest-blog-section spad" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2> tools</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                  <?php
                    foreach($rows5 as $rowz5){
                  echo '
                  <div class="col-lg-4 col-md-6">
                    <div class="single-blog-item">
                    <div class="imgcont">
                    <img src="'.$rowz5['img'].'" alt="">
                    </div>
                        <div class="blog-widget">
                         <div class="text-center">'.$rowz5['name'].'</div>
                        </div>
                        <h4>'.$rowz5['descripition'].'</h4>
                    </div>
                    </div>
                    '; }
                    ?>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->
    <!-- Trainer Section Begin -->

    <!-- Hero Section End -->
   
    <!-- Trainer Section Begin -->

    <section class="latest-blog-section spad" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2> WarmUp</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                  <?php
                    foreach($rows4 as $rowz4){
                  echo '
                  <div class="col-lg-4 col-md-6">
                    <div class="single-blog-item">
                    <div class="imgcont">
                    <img src="'.$rowz4['img'].'" alt="">
                    </div>
                        <div class="blog-widget">
                         <div class="text-center">'.$rowz4['name'].'</div>
                        </div>
                        <h4>'.$rowz4['descripition'].'</h4>
                    </div>
                    </div>
                    '; }
                    ?>
            </div>
        </div>
    </section>


                      <!-- //
                      
                     <section class="trainer-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2> WarmUp </h2>
                    </div>
                </div>
            </div>
            <div class="row">

              <?php
            //   foreach($rows4 as $rowz4) {
            //     echo '
            //     <div class="col-lg-4 col-md-6">

            //         <div class="single-trainer-item">
            //         <img src="'.$rowz4['img'].'" class="w-25" alt="" />
            //             <div class="trainer-text">
            //             <h5>'.$rowz4['name'].'</h5>
            //                 <p>'.$rowz4['descripition'].'</p>
            //             </div>
            //         </div>
            //         </div>

            // '; }
            ?>

        </div>
        </div>
    </section>
                    
                    -->
   
    <!-- Trainer Section End --> 
  
     <!-- Classes Section Begin -->
     <section class="classes-section classes-page spad ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2> CLASSES video </h2>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php
        foreach($rows as $rowss){
          echo '
          <div class="col-lg-4 col-md-6">
            <div class="single-class-item set-bg">
              <div class="about-pic">
              <a href="psportvideos.php?Code='.$rowss['Code'].'&pscode='.$CODE.'">

              <img class="allsports" src="http://img.youtube.com/vi/'.$rowss['URL'].'/hqdefault.jpg" 
               />
               </a>
              </div>
              <div class="si-text">
                <h4>'.$rowss['Name'].'</h4>
                <span><i class="fa fa-user"></i>'.$rowss['description'].'</span>
              </div>
            </div>           
          </div> 
            ' ;
          }
    ?>
            </div>
        </div>
    </section>
    <footer>
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

            <div class=".footer-brand-wrapper" style="display: flex">
              <ul class="footer-menu-list" style="width: 82%;">
                <li>
                  <a href="Home.php" class="footer-menu-link">Home</a>
                </li>
                <li>
                  <a href="E-Sport.php" class="footer-menu-link">E-Sport</a>
                </li>
                <li>
                  <a href="Tournament.php" class="footer-menu-link"
                    >Tournament</a
                  >
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
                <input
                  type="text"
                  name="message"
                  required
                  placeholder="Find Here Now"
                  class="footer-input"
                />

                <button class="btn btn-primaryy">
                  <ion-icon name="search-outline"></ion-icon>
                </button>
              </div>
            </div>
          </div>
          <div class="copyright-text">
            <p>
              you can find an ESports team for exploiting your potential,
              joining Tournaments and wining it here
              <a href="E-Sport.php" target="_blank">ESPORTS</a>
            </p>
          </div>
        </div>
      </div>
    </footer>
    <!-- Classes Section End -->
    <!-- Js Plugins -->
    <script src="js/header.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="./js/youga.js"></script>
    <script src="js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</php>
<?php } 
  
 else {
  header("location:game.php");

} ?>