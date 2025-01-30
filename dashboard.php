<?php
ob_start();
include('dbcon.php');
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{
function countItems($item , $table) {
        
  global $con ;

  $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");

  $stmt2->execute();

  return $stmt2->fetchColumn();

}
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
    <title>Dashboard</title>
    <link rel="stylesheet" href="CSS/dashboard.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="fontawesome-free-6.3.0-web/css/all.min.css"
    />
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
      <a href="#"
        ><i class="fas fa-desktop active"></i><span>Dashboard</span></a
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
      <div class="bgback">
        <div class="curser"></div>
        <div class="row">
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
        </div>
        <div class="row">
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
        </div>
        <div class="row">
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
        </div>
        <div class="row">
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
        </div>
        <div class="row">
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
        </div>
        <div class="row">
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
        </div>
        <div class="row">
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
        </div>
        <div class="row">
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
        </div>
        <div class="row">
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
        </div>
        <div class="row">
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
        </div>
        <div class="row">
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
          <div class="hexagon"></div>
        </div>
      </div>
      <div class="cards-container">
        <div class="card">
          <div class="card-flow">
            <svg>
              <circle r="70" cx="147" cy="95" class="progress players"></circle>
            </svg>
            <div class="number">
              <p id="players-number"><?php echo countItems( '*' , 'player' ) ; ?></p>
            </div>
          </div>
          <div class="card-title"><h3>total players</h3></div>
        </div>
        <div class="card">
          <div class="card-flow">
            <svg>
              <circle r="70" cx="147" cy="95" class="progress teams"></circle>
            </svg>
            <div class="number">
              <p id="teams-number"><?php echo countItems( '*' , 'team' ) ; ?></p>
            </div>
          </div>
          <div class="card-title"><h3>total teams</h3></div>
        </div>
        <div class="card">
          <div class="card-flow">
            <svg>
              <circle
                r="70"
                cx="147"
                cy="95"
                class="progress tournaments"
              ></circle>
            </svg>
            <div class="number">
              <p id="tournaments-number"><?php echo countItems( '*' , 'tournament' ) ; ?></p>
            </div>
          </div>
          <div class="card-title"><h3>total tournaments</h3></div>
        </div>
      </div>
    </div>
    <script src="JS/dashboard.js"></script>
  </body>
</html>
<?php } else {
              header("location:E-Sport.php");

} ?>
