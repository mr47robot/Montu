<?php
ob_start();
include('dbcon.php');
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
$Code = $_GET['Code'] ;
if ($do == 'gamereq') {   
    $stmt = $con->prepare("
    SELECT
        *
    FROM 
       `join` 
    WHERE
        TOURNAMENT_GAME = ? AND regst = 1
                        ");
// execute query
$stmt->execute(array($Code));
// fatch the data
$rows = $stmt->fetchall();
///////////////////////////////
$stmt4 = $con->prepare("
SELECT * FROM player Where playertype = 'admin' 

                   ");

$stmt4->execute();
    
$rows4 = $stmt4->fetch();
// the raw count to check the id in database
$count = $stmt->rowcount(); 
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Requests</title>
    <link rel="stylesheet" href="CSS/requests.css" />
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
      <a href="requests.PHP"
        ><i class="fa-solid fa-user-plus"></i><span>requests</span></a
      >
      <a href="tournaments.php"
        ><i class="fa-solid fa-trophy"></i><span>tournaments</span></a
      >
      <a href="./editsports.php"
        ><i class="fa-solid fa-basketball"></i><span>sports</span></a>
    </div>
    <!--sidebar end-->
    <div class="content">
      <table class="table" id="myTable">
        <caption>
          <h2>valorant requests</h2>
        </caption>
        <thead class="thead-inverse">
          <tr>
            <th class="sorting">#<span class="icon-arrow">&UpArrow;</span></th>
            <th class="sorting">
              Name<span class="icon-arrow">&UpArrow;</span>
            </th>
            <th class="sorting">
              tournament<span class="icon-arrow">&UpArrow;</span>
            </th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
                      <?php 

              $i=1;

              foreach($rows as $rowss) {
                  echo '<tr>' ;
                  echo '<td>'.$i++.'</td>' ;
                  echo '<td>'.$rowss['TEAM_NAME'].'</td>' ;
                  echo '<td>'.$rowss['TOURNAMENT_NAME'].'</td>' ;
                  echo '<td class="buttons">' ;
                  echo '<a class="accept" id="update" href="jointouradmin.php?do=jointourreq&Code='.$rowss['TOURNAMENT_CODE'].'&TeamLeaderName='.$rowss['TEAM_LEADER'].'">accept</a> ' ;
                  echo '<a class="remove" id="delete" href="jointouradmin.php?do=exittourreq&Code='.$rowss['TOURNAMENT_CODE'].'&TeamLeaderName='.$rowss['TEAM_LEADER'].'">remove</a> ' ;
                  echo '</td>' ;
                  echo '</tr>' ;
              }
                ?>
        </tbody>
      </table>
    </div>
    <script src="JS/requests.js"></script>
  </body>
</html>
<?php }} else {
              header("location:game.php");

} ?>