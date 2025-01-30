<?php
ob_start();
include('dbcon.php');
$ID = $_SESSION['ID'];
$stmt = $con->prepare("
    SELECT
        *
    FROM 
      player
    WHERE 
        ID = ?
        ");
// execute query
if(isset($ID)) {
$stmt->execute(array($ID));
// fatch the data
$rows = $stmt->fetch();
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
  $count3 = $stmt3->rowcount();
  }
  //////////////////////////////////
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    $username = $_POST['username'];
    $email = $_POST['Email'];

    $email2 = $rows['Email'];
    $username2 = $rows['UserName'];
   

// check if the user exist

$stmt = $con->prepare('
SELECT 
*
FROM
player
WHERE
UserName = ?

      ');

$stmt->execute(array($username));
$row = $stmt->fetchall();
$count = $stmt->rowcount();
//////////////////////////////////////////
$stmt2 = $con->prepare('
SELECT 
*
FROM
player
WHERE
Email = ?
      ');

$stmt2->execute(array($email));
$row = $stmt2->fetchall();
$count2 = $stmt2->rowcount();
///////////////////////////////////
  // if count > 0 this mean database contain record about this username

          if ($username = $username2 && $email = $email2) {
          
            // header('Location: updateplayer.php?do=up&ID='.$ID.'&regst='.$_POST['regst'].'&playertype='.$_POST['playertype'].'&fullname='.$_POST['fullname'].'&username='.$_POST['username'].'&Email='.$_POST['Email'].'&oldpassword='.$_POST['password'].'&bdate='.$_POST['bdate'].'&phone='.$_POST['phone'].'&profilepicture='.$_POST['profilepicture'].'&teamcode='.$_POST['teamcode'].'');
            if(sha1($_POST['oldpassword']) == $rows['Password']) {
              //Get Variables From The Form
              
              $regst = $_POST['regst'];
              $playertype = $_POST['playertype'];
              $name   = $_POST['fullname'];
              $user   = $_POST['username'];
              $teamcode = $_POST['teamcode'];
              $email  = $_POST['Email'];
              $bdate   = $_POST['bdate'] ;
              $phone   = $_POST['phone'] ;
              $profilepicture   = $_POST['profilepicture'] ;
   
              if($_POST['password'] == "") {
               $hashpass = $rows['Password'] ;
              }
              elseif(sha1($_POST['oldpassword']) == $rows['Password'] && $_POST['password'] !== "" ){
                $pass = $_POST['password'] ;
              $hashpass = sha1($_POST['password']);
              }
              $stmt = $con->prepare("
              UPDATE
                    player
               SET
                   FullName=?, Username=?, profilepic=?, Email=?, Password=?, BirthDate=? ,Phone=?
               WHERE
                   ID=?
                   ");
        

              $stmt->execute(array(
               $name,$user,$profilepicture,
               $email,$hashpass,$bdate,$phone ,$ID
                
              
              ));
              $stmt2 = $con->prepare("
              UPDATE
                    team
               SET
                    TeamLeaderName=?
               WHERE
                   Code=?
                   ");
        

              $stmt2->execute(array($user,$teamcode));
              $_SESSION['UserName'] = $user ;

              $stmt3 = $con->prepare("
              UPDATE
                    `join` 
               SET
               TEAM_LEADER=?   
               WHERE 
                 TEAM_CODE = ?
                   ");
        

              $stmt3->execute(array(
              $user,$teamcode
              ));
          //Echo Success Message
          header("location:playerinfo.php?ID=$ID");

           }
        } 
        elseif ($count == 0 && $count2 == 0) {
                    //Get Variables From The Form
                    if(sha1($_POST['oldpassword']) == $rows['Password']) {

              
                    $regst = $_POST['regst'];
                    $playertype = $_POST['playertype'];
                    $name   = $_POST['fullname'];
                    $user   = $_POST['username'];
                    $teamcode = $_POST['teamcode'];
                    $email  = $_POST['Email'];
                    $bdate   = $_POST['bdate'] ;
                    $phone   = $_POST['phone'] ;
                    $profilepicture   = $_POST['profilepicture'] ;
         
                    if($_POST['password'] == "") {
                     $hashpass = $rows['Password'] ;
                    }
                    elseif(sha1($_POST['oldpassword']) == $rows['Password'] && $_POST['password'] !== "" ){
                    $pass = $_POST['password'] ;
                    $hashpass = sha1($_POST['password']);
                    }
                    $stmt = $con->prepare("
                    UPDATE
                          player
                     SET
                         FullName=?, Username=?, profilepic=?, Email=?, Password=?, BirthDate=? ,Phone=?
                     WHERE
                         ID=?
                         ");
              
      
                    $stmt->execute(array(
                     $name,$user,$profilepicture,
                     $email,$hashpass,$bdate,$phone ,$ID
                      
                    
                    ));
                    $stmt2 = $con->prepare("
                    UPDATE
                          team
                     SET
                          TeamLeaderName=?
                     WHERE
                         Code=?
                         ");
              
      
                    $stmt2->execute(array($user,$teamcode));
                    $_SESSION['UserName'] = $user ;
      
                    $stmt3 = $con->prepare("
                    UPDATE
                          `join` 
                     SET
                     TEAM_LEADER=?   
                     WHERE 
                       TEAM_CODE = ?
                         ");
              
      
                    $stmt3->execute(array(
                    $user,$teamcode
                    ));
                //Echo Success Message
                header("location:playerinfo.php?ID=$ID");
                  }
          }
        
   }
          

    
  
?>
<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
     <content="width=device-width, initial-scale="1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/playerinfo.css">
</head>
<body>
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
          if (isset($_SESSION['UserName']) && $count3 > 0) {
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
          </li> ' ; }          echo '
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
                if (isset($_SESSION['UserName']) && $count3 > 0) {
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
    <div class="header-img">

    </div>
  </header>

<div class="container">
    <div class="card ">
      <div class="left">
        <div class="contt">
          
            <!-- Add Card -->
            <div class="card" id="addCard">
            <div class="image-cont">
            <img id="" src="<?php echo $rows['profilepic'] ?>" alt="">
            </div>
              <button>
                <input type="file" name="profilepic" id="fileInput" />
                Upload IMAGE
              </button>
              <!-- <p>Choose an image to makes it transparent</p> -->
            </div>
            <!-- Display Card -->
            <div class="card" id="displayCard">
              <div class="image-cont">
                <img
                  id="display-img"
                  src=""
                  alt=""
                />
              </div>
              <button id="startBtn">Start</button>
            </div>
            <!-- Loading Card -->
            <div class="card" id="loadingCard">
              <div class="loader"></div>
            </div>
            <!-- Download Card -->
            <div class="card" id="downloadCard">
              <div class="image-cont">
                
                <img
                  class="image-before"
                  src=""
                  alt=""
                />
                <img
                  class="image-after" 
                  src=""
                  alt=""
                />
              </div>
              <div style="display: flex; gap: 10px">
                <button id="uploadAnother">Upload Another</button>
              </div>
            </div>
          </div>
      </div>
      <div class="right">
        <h2>Update Profile</h2>
        <div class="contact">
          <div class="form-container">
            <?php echo '<form class="form" action="'.$_SERVER['PHP_SELF'].'" method="POST" enctype="multipart/form-data">' ;?>
            
              <input type="hidden" name="regst" value="3">

              <input type="hidden" name="playertype" value="player">

              <input type="hidden" name="teamcode" value="<?php echo $rows['teamcode'] ?>">
              
              <input style="display: none;" type="text" id="profilepicture" name="profilepicture" value="<?php echo $rows['profilepic'] ?>">

              <div class="username">
                <input type="text" name="fullname" placeholder="Enter your Name" value="<?php echo $rows['FullName'] ?>" pattern=^[a-zA-Z\s]*$ required>
              </div>
              <div class="username">
                <input type="text" name="username" placeholder="Enter your username" value="<?php echo $rows['UserName'] ?>" required>
                <?php
              if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // if count > 0 this mean database contain record about this username

                   if ($count > 0 && $_POST['username'] !== $rows['UserName']) {
                    echo "this username is exist" ;
                   }
                  }
                ?>
              </div>
              <div class="useremail">
                <input type="email" name="Email" placeholder="Enter your email" value="<?php echo $rows['Email'] ?>" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$" required>
                <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  // if count > 0 this mean database contain record about this username

                    if ($count2 > 0 && $_POST['Email'] !== $rows['Email']) {
                      echo "this email is exist" ;
                    }
                  }
                ?>
              </div>
              <div class="username">
                          <input
                          value="<?php echo $rows['BirthDate'] ?>"
              placeholder="Enter your birthdate"
              name="bdate"
              class="textbox-n"
              type="text"
              onfocus="(this.type='date')"
              id="date" required/>
              </div>
              <div class="useremail">
                <input type="phone" name="phone" value="<?php echo $rows['Phone'] ?>" pattern="[0-9]{11}" required>
              </div>
              <div class="useremail">
                <input type="password" name="oldpassword" placeholder="type your current password" >
                <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  // if count > 0 this mean database contain record about this username

                  if(sha1($_POST['oldpassword']) !== $rows['Password']) {
                    echo "please enter your right password" ;
                    }
                  }
                ?>
              </div>
              <div class="useremail">
                <input type="password"  placeholder="Enter your new password" pattern=^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$  class="password" id="password" onkeyup='check()'>
                <p>if you dont want to change your password leave it</p>
              </div>
              <div class="useremail">
                <input type="password" name="password" placeholder="Confirm your new password " pattern=^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$ class="password" id="checkPassword" onkeyup='check()' >
                <p>if you dont want to change your password leave it</p>
              </div>
              <!-- <div class="useremail">
              <input type="file" name="profilepic">
              </div> -->
              <p id="alertPassword"></p>

              <div class="usersubmit">
                <input  id="sub" onclick="check()"  type="submit" name="submit" value="Update">
              </div>
            </form>
            <br>
            <br>
            <?php echo '<a href="updateplayer.php?do=dp&ID='.$ID.'"><button class="btn-sign_in">delete your account</button></a>' ; ?>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    

  <footer style="margin-top: 100px;">
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

            <div class="footer-menu-wrapper">
              <ul class="footer-menu-list">
                <li>
                  <a href="Home.html" class="footer-menu-link">Home</a>
                </li>
                <li>
                  <a href="E-Sport.html" class="footer-menu-link">E-Sport</a>
                </li>
                <li>
                  <a href="Tournament.html" class="footer-menu-link"
                    >Tournament</a
                  >
                </li>

                <li>
                  <a href="P-Sport" class="footer-menu-link">P-Sport</a>
                </li>

                <li>
                  <a href="help.html" class="footer-menu-link">faq</a>
                </li>
                <li>
                  <a href="contactus.html" class="footer-menu-link">Contact</a>
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
          <div class="copyright-text">
            <p>
              <!-- Copyright © 2023 All rights reserved | This template is made with -->
              you can find the best practice videos about Physical sports for
              your fit health on
              <a href="./p-sport.html" target="_blank">PSPORTS</a>
            </p>
          </div>
        </div>
      </div>
    </footer>
<script src="js/create-team.js"></script> 
<script>
    var check = function() {
      if (document.getElementById('password').value ==
          document.getElementById('checkPassword').value) {
          document.getElementById('alertPassword').style.color = '#8CC63E';
          if (document.getElementById('password').value ==
          document.getElementById('checkPassword').value && document.getElementById('password').value !== '' && document.getElementById('checkPassword').value !== '' ) {
          document.getElementById('alertPassword').innerHTML = '<span><i class="fas fa-check-circle"></i>Match !</span>';
          }
          document.getElementById('sub').style.display = 'block';
      } else {
      		document.getElementById('alertPassword').style.color = '#EE2B39';
          document.getElementById('alertPassword').innerHTML = '<span><i class="fas fa-exclamation-triangle"></i>not matching</span>';
          document.getElementById('sub').style.display = 'none';
      }
  }
  </script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></scrip>
<script>
    AOS.init();
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</php>
<?php } ?>