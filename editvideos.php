<?php
ob_start();
include('dbcon.php');
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{
$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
$CODE = $_GET['Code'] ;
///////////////////////////////
$stmt4 = $con->prepare("
SELECT * FROM player Where playertype = 'admin' 

                   ");

$stmt4->execute();
    
$rows4 = $stmt4->fetch();
////////////////////////////
if ($do == 'edv') {   
    $stmt = $con->prepare("
    SELECT
        *
    FROM 
       videos 
    WHERE
        s_code = ?
                        ");
// execute query
$stmt->execute(array($CODE));
// fatch the data
$rows = $stmt->fetchall();

// the raw count to check the id in database
$count = $stmt->rowcount(); 
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tournament Page</title>
    <link rel="stylesheet" href="./CSS/editvideos.css" />

    <link
      rel="stylesheet"
      href="./fontawesome-free-6.3.0-web/css/all.min.css"
    />
  </head>
  <body class="trty">
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
      <a href="./editsports.php"
        ><i class="fa-solid fa-basketball"></i><span>sports</span></a
      >
    </div>
    <!--sidebar end-->
    <div class="content">
          <table>
          <caption>
            created videos
          </caption>
          <thead>
            <tr>
              <th>#</th>
              <th>name</th>
              <th>URL</th>
              <th>discription</th>
              <th>action</th>
            </tr>
          </thead>
          <tbody>
          <?php 

$i=1;

foreach($rows as $rows) {
    echo '<form action="updatevideos.php?do=uvo&scode='.$CODE.'&Code='.$rows['Code'].'" method="POST" enctype="multipart/form-data">  ' ;
    echo '<tr>' ;
    echo '<td>'.$i++.'</td>' ;
    echo '<td><input type="text" name="vname" value="'.$rows['Name'].'" /></td>' ;
    echo '<td><input type="text" name="vurl" id="" value="'.$rows['URL'].'" /></td>' ;
    echo '<td><textarea name="vdes" id="" cols="30" rows="10">'.$rows['description'].'</textarea></td>' ;
    echo '<td class="buttons">' ;
    echo '<div class="sandrev">' ;
    echo '<button class="saving">update</button> ' ;
    echo '<button class="delete" id="delete">
          <a href="updatevideos.php?do=dvo&scode='.$CODE.'&Code='.$rows['Code'].'" id="db">remove</a>
          </button> ' ;
    echo '</div>' ;
    echo '</td>' ;
    echo '</tr>' ;
    echo '</form>' ;

}
  ?>
          </tbody>
        </table>
    </div>
    <script src="./JS/editvideos.js"></script>
  </body>
</html>
<?php } ?>
<?php
if ($do == 'edt') {   
  $stmt = $con->prepare("
  SELECT
      *
  FROM 
     tools 
  WHERE
      s_code = ?
                      ");
// execute query
$stmt->execute(array($CODE));
// fatch the data
$rows = $stmt->fetchall();
// the raw count to check the id in database
$count = $stmt->rowcount(); 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tournament Page</title>
    <link rel="stylesheet" href="./CSS/editvideos.css" />

    <link
      rel="stylesheet"
      href="./fontawesome-free-6.3.0-web/css/all.min.css"
    />
  </head>
  <body class="trty">
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
      <a href="./editsports.php"
        ><i class="fa-solid fa-basketball"></i><span>sports</span></a
      >
    </div>
    <!--sidebar end-->
    <div class="content">
          <table>
          <caption>
            created tools
          </caption>
          <thead>
            <tr>
              <th>#</th>
              <th>name</th>
              <th>description</th>
              <th>image</th>
              <th>action</th>
            </tr>
          </thead>
          <tbody>
          <?php 

$i=1;

foreach($rows as $rows) {
    echo '<form action="updatevideos.php?do=uto&scode='.$CODE.'&Code='.$rows['id'].'" method="POST" enctype="multipart/form-data">  ' ;
    echo '<tr>' ;
    echo '<td>'.$i++.'</td>' ;
    echo '<td><input type="text" name="tname" value="'.$rows['name'].'" /></td>' ;
    echo '<td><input type="text" name="tdes" id="" value="'.$rows['descripition'].'" /></td>' ;
    echo '<td><input type="file" name="tfile" id="" /></td>' ;
    echo '<input type="hidden" name="tlogo" value="'.$rows['img'].'">' ;
    echo '<td class="buttons">' ;
    echo '<div class="sandrev">' ;
    echo '<button class="saving">update</button> ' ;
    echo '<button class="delete" id="delete">
          <a href="updatevideos.php?do=dto&scode='.$CODE.'&Code='.$rows['id'].'" id="db">remove</a>
          </button> ' ;
    echo '</div>' ;
    echo '</td>' ;
    echo '</tr>' ;
    echo '</form>' ;

}
  ?>
          </tbody>
        </table>
    </div>
    <script src="./JS/editvideos.js"></script>
  </body>
</html>
<?php } ?>
<?php
if ($do == 'edw') {   
  $stmt = $con->prepare("
  SELECT
      *
  FROM 
     warmup 
  WHERE
      s_code = ?
                      ");
// execute query
$stmt->execute(array($CODE));
// fatch the data
$rows = $stmt->fetchall();
// the raw count to check the id in database
$count = $stmt->rowcount(); 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tournament Page</title>
    <link rel="stylesheet" href="./CSS/editvideos.css" />

    <link
      rel="stylesheet"
      href="./fontawesome-free-6.3.0-web/css/all.min.css"
    />
  </head>
  <body class="trty">
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
      <a href="./editsports.php"
        ><i class="fa-solid fa-basketball"></i><span>sports</span></a
      >
    </div>
    <!--sidebar end-->
    <div class="content">
          <table>
          <caption>
            created warmup
          </caption>
          <thead>
            <tr>
              <th>#</th>
              <th>name</th>
              <th>description</th>
              <th>image</th>
              <th>action</th>
            </tr>
          </thead>
          <tbody>
          <?php 

$i=1;

foreach($rows as $rows) {
    echo '<form action="updatevideos.php?do=uwo&scode='.$CODE.'&Code='.$rows['id'].'" method="POST" enctype="multipart/form-data">  ' ;
    echo '<tr>' ;
    echo '<td>'.$i++.'</td>' ;
    echo '<td><input type="text" name="wname" value="'.$rows['name'].'" /></td>' ;
    echo '<td><input type="text" name="wdes" id="" value="'.$rows['descripition'].'" /></td>' ;
    echo '<td><input type="file" name="wfile" id="" /></td>' ;
    echo '<input type="hidden" name="wlogo" value="'.$rows['img'].'">' ;
    echo '<td class="buttons">' ;
    echo '<div class="sandrev">' ;
    echo '<button class="saving">update</button> ' ;
    echo '<button class="delete" id="delete">
          <a href="updatevideos.php?do=dwo&scode='.$CODE.'&Code='.$rows['id'].'" id="db">remove</a>
          </button> ' ;
    echo '</div>' ;
    echo '</td>' ;
    echo '</tr>' ;
    echo '</form>' ;

}
  ?>
          </tbody>
        </table>
    </div>
    <script src="./JS/editvideos.js"></script>
  </body>
</html>
<?php } ?>

<?php
}
 else {
  header("location:game.php");

} ?>
