<?php
ob_start();
include('dbcon.php');
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{
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

///////////////////////////////////
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
    <title>Requests</title>
    <link rel="stylesheet" href="CSS/tournaments.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="fontawesome-free-6.3.0-web/css/all.min.css"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"
    ></script>
    <script>
      $(document).ready(function () {
        $("#myTable").tablesorter();
      });
    </script>
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
      <a href="dashboard.php"
        ><i class="fas fa-desktop"></i><span>Dashboard</span></a
      >
      <a href="#"
        ><i class="fa-solid fa-user-plus active"></i><span>requests</span></a
      >
      <a href="tournaments.php"
        ><i class="fa-solid fa-trophy"></i><span>tournaments</span></a
      >
      <a href="./editsports.php"
        ><i class="fa-solid fa-basketball"></i><span>sports</span></a>
    </div>
    <!--sidebar end-->
    <div class="content">
      <div class="sports">
      <?php
        foreach($rows as $row) {
          echo '
        <div class="sports-item">
          <div class="sports-content">
            <img src="'.$row['logo'].'" alt="" />
            <h2>'.$row['Name'].'<br /><span>requests</span></h2>
            <a href="sport requests.php?do=gamereq&Code='.$row['Code'].'">view</a>
          </div>
        </div> ' ;
        }
        ?>
      </div>
    </div>
    <script src="JS/requests.js"></script>
  </body>
</html>
<?php } else {
              header("location:game.php");

} ?>