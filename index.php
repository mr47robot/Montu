<?php
ob_start();
include('dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Montu</title>
    <link rel="stylesheet" href="./css/home.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
  </head>
  <body>
    <header>
      <a href="index.php" class="logo"></a>
      <input type="checkbox" id="active" />
      <label for="active" class="menu-btn"><i class="fas fa-bars"></i></label>
      <div class="wrapper">
        <ul>
          <!-- <li><a href="index.php">home</a></li> -->
          <!-- <li><a href="#">news</a></li> -->
          <li><a href="Tournament.php">tournaments</a></li>
          <li><a href="help.php">FAQ</a></li>
          <li><a href="contactus.php">contact us</a></li>
          <?php
          if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
        {
        echo '<li><a href="dashboard.php">dashboard</a></li>' ;
        }
          
          ?>
        </ul>
      </div>
      <div class="container">
        <div class="button-left">
         <a href="E-Sport.php"> <span class="view">electronic</span></a>
        </div>
        <div class="button-right">
          <a href="p-sport.php"> <span class="view">physical</span></a>
        </div>
        
          <div class="child-left-1">
            <div class="left1 left"></div>
            <div class="left2 left"></div>
            <div class="left3 left"></div>
            <div class="left4 left"></div>
            <div class="left5 left"></div>
          </div>
      
        
          <div class="child-right-1">
            <div class="right1 right"></div>
            <div class="right2 right"></div>
            <div class="right3 right"></div>
            <div class="right4 right"></div>
            <div class="right5 right"></div>
          </div>
      </div>
    </header>
    <!-- <div class="sources">
      <div class="caption">sources</div>
      <div class="links">
        <a href="https://arabesports.com/en">arab esports</a>
        <a href="#">MKH</a>
        <a href="#">MKH</a>
        <a href="#">MKH</a>
      </div>
    </div> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script> -->
    <!-- <script src="./js/home.js"></script> -->
  </body>
</html>
