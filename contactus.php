<?php 
include("dbcon.php") ;
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
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  $user = filter_var($_POST['username'] , FILTER_SANITIZE_STRING);
  $mail = FILTER_VAR($_POST['email'] , FILTER_SANITIZE_EMAIL);
  $msg = filter_var($_POST['textarea'] , FILTER_SANITIZE_STRING);
  
  $formERRORS = array();
  
  if(strlen($user) < 3){ 
    
      $formERRORS[] = 'username should be more than <strong> 3 </strong> characters</br>';
      
      
  }
  
  if(strlen($mail) == 0 ) {
      
    $formERRORS[] = 'You Should Enter Your <strong> Email </strong> </br>' ;


}
  if(strlen($msg) < 10 ) {
      
    $formERRORS[] = 'Your Text Message Shouldn Be More Than <strong> 10 characters </strong>
    ' ;


}
$myemail = 'ma19988302@gmail.com' ;
$subject = 'test contact form' ;
$headers = 'From: ' . $mail . '/r/n' ;
if(empty($formERRORS)) {
    mail($myemail, $subject, $msg, $headers);
}
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <content="width=device-width, initial-scale="1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/cotactus.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body style="background-image: url(img/test3.jpg)">
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
    <div class="new-container">
      <div class="card">
        <h1>Contact Us</h1>
        <div class="left">
          <img src="img/logo edit sport copy new.png" class="plogo" />
        </div>
        <div class="right">
        <form class="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="username">
              <input type="text" name="username"  placeholder="Enter Your Name" />
            </div>
            <div class="useremail">
              <input type="email" name="email"  placeholder="Enter Your Mmail" required />
            </div>
            <div class="usermessage">
              <textarea placeholder="Enter Your Message"  name="textarea"  required></textarea>
            </div>
            <div class="usersubmit">
          <input type="submit" value="Send Message" />
        </div>
          </form>
        </div>

      </div>
    </div>
    <footer>
      <div
        class="footer-top"
        style="background-image: url(img/footer-bg.jpg) no-repeat"
      >
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
                  <a href="Tournament.php" class="footer-menu-link"
                    >Tournament</a
                  >
                </li>

                <li>
                  <a href="P-Sport" class="footer-menu-link">P-Sport</a>
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

                <button class="btn btn-primary">
                  <ion-icon name="search-outline"></ion-icon>
                </button>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </footer>
    <script src="js/contact.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>
