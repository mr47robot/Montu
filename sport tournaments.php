<?php
ob_start();
include('dbcon.php');
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
$CODE = $_GET['Code'] ;
if ($do == 'gametour') {   
    $stmt = $con->prepare("
    SELECT
        *
    FROM 
      tournament 
    WHERE
    game_code = ?
                        ");
// execute query
$stmt->execute(array($CODE));
// fatch the data
$rows = $stmt->fetchall();
////////////////////////////////////
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
    <link rel="stylesheet" href="CSS/tourcontent.css" />
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
    <div class="sports">
              <div class="main">
                <div></div>
            </div>
            <?php 
            foreach($rows as $row) { 
              echo '
              <div class="sports-item">
                <div class="sports-content">
                  <img
                    src="'.$row['logo'].'"
                    alt=""
                  />
                  <h2>'.$row['Name'].'</h2>
                  <a href="tourpage.php?do=tour&Code='.$row['Code'].'">view Detalis</a>
                </div>
              </div>
          ' ;
            }
            ?>
      </div>
      <section>
        <span class="overlay"></span>
        <div class="modal-box container">
          <div class="text">create tournament</div>
        <?php echo '<form action="inserttour.php?Name='.$CODE.'" method="POST" enctype="multipart/form-data">' ; ?>
            <div class="form-row">
            <input type="hidden" name="tournament-game" value="<?php echo $CODE ; ?>">
              <div class="input-data">
                <input type="text" id="tournament-name"  name="tournament-name" required />
                <div class="underline"></div>
                <label for="">name</label>
              </div>
              <div class="input-data">
                <input
                  type="number"
                  id="teams-number"
                  name="teams-number"
                  required
                />
                <div class="underline"></div>
                <label for="">teams number</label>
              </div>
            </div>
            <div class="form-row">
              <div class="input-data">
                <input type="text" id="tournament-email" name="tournament-email" required />
                <div class="underline"></div>
                <label for="">Email</label>
              </div>
              <div class="input-data">
                <input type="file" id="file"  name="logo" accept="image/*" required />
                <div for="file" class="file">logo</div>
              </div>
            </div>
            <div class="form-row">
              <div class="input-data textarea">
                <textarea
                  rows="8"
                  cols="80"
                  id="tournament-discription"
                  name="tournament-discription"
                  required
                ></textarea>
                <br />
                <div class="underline"></div>
                <label for="">discription</label>
                <br />
                <div class="form-row submit-btn">
                  <div class="input-data">
                    <div class="inner"></div>
                    <!-- <button id="create">create</button> -->
                    <input type="submit" value="submit" id="create" name="create" />
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>
    </div>
    <script src="JS/tourcontent.js"></script>
  </body>
</html>
<?php }} else {
              header("location:index.php");

} ?>