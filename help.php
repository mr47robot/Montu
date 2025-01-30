<?php
include('dbcon.php');
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
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <content="width=device-width, initial-scale="1.0">
     <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&family=Poppins:wght@400;500;700&display=swap"
    rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/help.css">
</head>
<>
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
      <section class="contact">
        <div class="container">
            <div class="headings">
                <h2 class="head-contact">Can I Help You</h2>
            </div>
            <div class="Questions"> 
            <div class="quee">
              <h2>Q: How are physical sports different from e-sports?</h2>
              <p>A: Physical sports involve real-world athletic activities that require physical prowess and skills, whereas e-sports involve competitive video gaming where players compete virtually using controllers or keyboards.</p>
            </div>
            <div class="quee">
              <h2>Q: What are e-sports?</h2>
              <p>A: E-sports, short for electronic sports, refer to competitive video gaming where professional players or teams compete against each other in organized tournaments.</p>
            </div>
            <div class="quee">
              <h2>Q: How do e-sports tournaments work?</h2>
              <p>A: E-sports tournaments typically involve teams or individual players competing against each other in a structured format. They can feature round-robin group stages, double-elimination brackets, or other formats to determine the winner.</p>
            </div>
            <div class="quee">
              <h2>Q: How do professional e-sports players make money?</h2>
              <p>A: Professional e-sports players earn money through various avenues such as tournament prize pools, sponsorships, streaming revenue, merchandise sales, and salaries from professional teams or organizations.</p>
            </div>
            <div class="quee">
              <h2>Q: Can anyone become a professional e-sports player?</h2>
              <p>A: While anyone can aspire to become a professional e-sports player, it requires exceptional skill, dedication, practice, and a deep understanding of the game. Only a small percentage of players reach the professional level.</p>
            </div>
            <div class="quee">
              <h2>Q: What is physical sport?</h2>
              <p>A: Physical sport refers to any form of physical activity or competition that involves exertion of the body and requires physical skills, such as running, jumping, throwing, or striking.</p>
            </div>
            <div class="quee">
              <h2>Q: What are the health benefits of participating in physical sports?</h2>
              <p>A: Participating in physical sports offers several health benefits, including improved cardiovascular fitness, strength and muscle development, increased endurance, enhanced coordination and balance, weight management, and reduced risk of various health conditions.</p>
            </div>
            <div class="quee">
              <h2>Q: How can someone get started in a physical sport?</h2>
              <p>A: To get started in a physical sport, individuals can join local community leagues, school teams, or sports clubs. They can also seek guidance from coaches, enroll in training programs, and gradually develop their skills through practice and participation.</p>
            </div>
            <div class="quee">
              <h2>Q: How do physical sports contribute to social interaction and community engagement?</h2>
              <p>A: Physical sports provide opportunities for social interaction, teamwork, and community engagement. They bring people together, promote camaraderie, foster a sense of belonging, and create platforms for community events and celebrations.</p>
            </div>
          </div> 
          </div>
          </section>
          

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
        
      </div>
    </div>
  </footer>
    <script src="js/faq.js"></script>
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
 </php>