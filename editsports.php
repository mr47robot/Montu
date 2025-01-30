<?php
ob_start();
include('dbcon.php');
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{
$stmt1 = $con->prepare("
SELECT
    *
FROM 
  sport_type
WHERE
  code = 1
                    ");
    
$stmt1->execute();
    
$rows1 = $stmt1->fetch();
////////////////////////////////
$stmt2 = $con->prepare("
SELECT
    *
FROM 
  sport_type
WHERE
  code = 2
                    ");
    
$stmt2->execute();
    
$rows2 = $stmt2->fetch();
////////////////////////////////////
$stmt4 = $con->prepare("
SELECT * FROM player Where playertype = 'admin' 

                   ");

$stmt4->execute();
    
$rows4 = $stmt4->fetch();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sports</title>
    <link rel="stylesheet" href="./CSS/editsports.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="./fontawesome-free-6.3.0-web/css/all.min.css"
    />
    <style>
      .sports-content:first-child div {
  background-size: cover;
  background-image:  url("../<?php echo $rows2['logo'];?>");
}
.sports-item:last-child .sports-content div {
  background-image: url("../<?php echo $rows1['logo'];?>");
}
    </style>
  </head>
  <body>
    <input type="checkbox" id="check" />
    <!--header area start-->
    <header>
      <!-- <input type="checkbox" id="check" /> -->
      <div class="show">
        <label for="check">
          <i class="fas fa-bars" id="sidebar_btn"></i>
        </label>
      </div>
      <?php echo'
      <img
        src="'.$rows4['profilepic'].'"
        class="user-img"
        id="togglemenu"
        alt=""
      /> ';
      ?>
      <div class="sub-menu-wrab" id="sub-menu">
        <div class="sub-menu">
          <div class="user-info">
          <?php echo ' 
                        <img src="'.$rows4['profilepic'].'"/>
                        <h2>'.$rows4['FullName'].'</h2>
            '; ?>
          </div>
          <hr />
          <a href="index.php" class="sub-menu-link">
            <div class="contain">
            <i class="fa-solid fa-house"></i>
              <span>Home</span>
            </div>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a href="logout.php" class="sub-menu-link">
            <div class="contain">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
              <span>Logout</span>
            </div>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </header>
    <!--header area end-->
    <!--sidebar start-->
    <div class="sidebar">
      <center class="sidebar-header">
        <img
          src="./img/logo edit sport copy new.png"
          class="profile_image"
          alt=""
        />
        <!-- <h4>P & E Sports</h4> -->
      </center>
      <a href="./dashboard.php"
        ><i class="fas fa-desktop"></i><span>Dashboard</span></a
      >
      <a href="./requests.php"
        ><i class="fa-solid fa-user-plus"></i><span>requests</span></a
      >
      <a href="./tournaments.php"
        ><i class="fa-solid fa-trophy"></i><span>tournaments</span></a
      >
      <a href="#"
        ><i class="fa-solid fa-basketball active"></i><span>sports</span></a
      >
    </div>
    <!--sidebar end-->
    <div class="content">
      <div class="sports">
        <div class="sports-item">
          <div class="sports-content">
            <div></div>
            <h2><?php echo $rows2['name'];?><br /><span>add new sport</span></h2>
            <?php echo '<a href="./viewsport.php?do=psport&Code='.$rows2['code'].'">add</a>' ; ?>
          </div>
        </div>
        <div class="sports-item">
          <div class="sports-content">
            <div></div>
            <h2><?php echo $rows1['name'];?><br /><span>add new esport</span></h2>
            <?php echo '<a href="./viewsport.php?do=esport&Code='.$rows1['code'].'">add</a>' ; ?>         
           </div>
        </div>
      </div>
      <!-- <div class="try">
        <a
          href="https://www.mythrillfiction.com/the-dark-rider"
          alt="Mythrill"
          target="_blank"
        >
          <div class="card">
            <div class="wrapper">
              <img
                src="../Pictures/valorant___omen_by_mizuriau_ddys457-fullview.jpg"
                class="cover-image"
              />
            </div>
            <img
              src="https://ggayane.github.io/css-experiments/cards/dark_rider-title.png"
              class="title"
            />
            <img
              src="../Pictures/ddyto0j-f5f79549-5003-4214-ae75-aca8c67e26c3.png"
              class="character"
            />
          </div>
        </a>

        <a
          href="https://www.mythrillfiction.com/force-mage"
          alt="Mythrill"
          target="_blank"
        >
          <div class="card">
            <div class="wrapper">
              <img
                src="https://ggayane.github.io/css-experiments/cards/force_mage-cover.jpg"
                class="cover-image"
              />
            </div>
            <img
              src="https://ggayane.github.io/css-experiments/cards/force_mage-title.png"
              class="title"
            />
            <img
              src="https://ggayane.github.io/css-experiments/cards/force_mage-character.webp"
              class="character"
            />
          </div>
        </a>
      </div> -->
    </div>
    <script src="./JS/editsports.js"></script>
  </body>
</html>
<?php } ?>