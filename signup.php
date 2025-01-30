<?php
include('dbcon.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $username = $_POST['username'];
  $email = $_POST['Email'];


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

          if ($count == 0 && $count2 == 0) {
           
            // header('Location: insertplayer.php?regst='.$_POST['regst'].'&playertype='.$_POST['playertype'].'&fullname='.$_POST['fullname'].'&username='.$_POST['username'].'&Email='.$_POST['Email'].'&password='.$_POST['password'].'&bdate='.$_POST['bdate'].'&phone='.$_POST['phone'].'&profilepicture='.$_POST['profilepicture'].'');
            $regst = $_POST['regst'];
            $playertype = $_POST['playertype'];
            $name   = $_POST['fullname'];
            $user   = $_POST['username'];
            $email  = $_POST['Email'];
            $pass   = $_POST['password'] ;
            $hashpass = sha1($_POST['password']);
            $bdate   = $_POST['bdate'] ;
            $phone   = $_POST['phone'] ;
            $profilepicture   = $_POST['profilepicture'] ;
        
            $stmt = $con->prepare("
            INSERT INTO 
            player(FullName, playertype, regst, Username, profilepic, Email, Password , BirthDate , Phone  )
            VALUES(:zname , :zplayertype , :zregst ,:zuser , :zprofilepic, :zemail , :zpass , :zbdate , :zPhone )
                                ");
      

            $stmt->execute(array(

                'zname' => $name,
                'zregst' => $regst,
                'zplayertype' => $playertype,
                'zprofilepic' => $profilepicture,
                'zuser' => $user,
                'zemail' => $email,
                'zpass' => $hashpass,
                'zbdate' => $bdate,
                'zPhone' => $phone 
            
            ));

            header('location: login.php');
          }

    }

?>
  <!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
     <content="width=device-width, initial-scale="1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/signup.css">
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
        <img
            src="img/logo edit sport copy new.png"
            class="plogo"
            alt="GameX logo"
          />
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
      </ul>
    </nav>
    <div class="header-actions">
		<a href="login.php">
		<button class="btn-sign_in">
		  <div class="icon-box">
			<ion-icon name="log-in-outline"></ion-icon>
		  </div>
		<span>Log-in</span>
		</button>
    </a>
	  </div>
	</div>
</header>
<div class="container new-container">
    <div class="card">
    <h1>Sign-Up</h1>
      <div class="left">
        <div class="contt">
            <!-- Add Card -->
            <div class="card" id="addCard" >
              <button>
                <input type="file" name="profilepic" id="fileInput"/>
                Upload IMAGE
              </button>
              <!-- <p>Choose an image to makes it transparent</p> -->
            </div>
            <!-- Display Card -->
            <div class="card" id="displayCard" style="display: flex; flex-wrap:nowrap ;">
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
            <div class="card" id="loadingCard" style="display: flex; flex-wrap:nowrap ;" >
              <div class="loader"></div>
            </div>
            <!-- Download Card -->
            <div class="card" id="downloadCard" style="display: flex; flex-wrap:nowrap ;">
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
          <form  class="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">

              <input type="hidden" name="regst" value="1">

              <input type="hidden" name="playertype" value="player">

              <input style="display: none;" type="text" id="profilepicture" name="profilepicture" value="">

              <div class="username">
                <input  type="text" name="fullname" placeholder="Enter your Name" pattern=^[a-zA-Z\s]*$ required >
              </div>
              <div class="username">
                <input type="text" name="username" placeholder="Enter your username" required>
                <?php
              if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // if count > 0 this mean database contain record about this username

                   if ($count > 0) {
                    echo "this username is exist" ;
                   }
                  }
                ?>
              </div>
              <div class="useremail">
                <input type="email"  name="Email" placeholder="Enter your email" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$" required>
                <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  // if count > 0 this mean database contain record about this username

                    if ($count2 > 0) {
                      echo "this email is exist" ;
                    }
                  }
                ?>
              </div>
              <div class="useremail">
                <input  type="tel" name="phone" placeholder="Enter your phone"pattern="[0-9]{11}" required>
              </div>
              <div class="username">
                          <input
              placeholder="Enter your birthdate"
              name="bdate"
              class="textbox-n"
              type="text"
              onfocus="(this.type='date')"
              id="date" required/>
              </div>
              <div class="useremail">
                <input type="password"   class="password" id="password" placeholder="Enter your password" pattern=^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$ required onkeyup='check()'>
              </div>
              <div class="useremail">
                <input type="password" id="checkPassword" class="password" name="password" placeholder="Confirm your password" pattern=^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$ required onkeyup='check()'>
              </div>
              <p id="alertPassword"></p>
              <div class="usersubmit">
                <input id="sub" onclick="check()" type="submit" name="submit" value="Sign-up">
              </div>
            </form>
            <?php
              if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo ' </form> ' ;

              }
            ?>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <footer>

    <div class="footer-top" style="background-image: url(img/footer-bg.jpg) no-repeat;">
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
                <a href="index.php" class="footer-menu-link">Home</a>
              </li>
              <li>
                <a href="E-Sport.php" class="footer-menu-link">E-Sport</a>
              </li>
              <li>
                <a href="Tournament.php" class="footer-menu-link">Tournament</a>
              
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
  <script>
    var check = function() {
      if (document.getElementById('password').value ==
          document.getElementById('checkPassword').value) {
          document.getElementById('alertPassword').style.color = '#8CC63E';
          document.getElementById('alertPassword').innerHTML = '<span><i class="fas fa-check-circle"></i>Match password</span>';
          document.getElementById('sub').style.display = 'block';
      } else {
      		document.getElementById('alertPassword').style.color = '#EE2B39';
          document.getElementById('alertPassword').innerHTML = '<span><i class="fas fa-exclamation-triangle"></i>not matching password</span>';
          document.getElementById('sub').style.display = 'none';
      }
  }
  </script>
<script src="js/create-team.js"></script> 

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></scrip>
<script>
    AOS.init();
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</php>
