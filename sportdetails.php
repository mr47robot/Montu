<?php
ob_start();
include('dbcon.php');
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{
$do = isset($_GET['do']) ? $_GET['do'] : 'Mange'  ;
$CODE = $_GET['Code'] ;

    $stmt = $con->prepare("
    SELECT
        *
    FROM 
      sport 
    WHERE
    Code = ?
                        ");
// execute query
$stmt->execute(array($CODE));
// fatch the data
$rows = $stmt->fetch();
////////////////////////////////////
$stmt4 = $con->prepare("
SELECT * FROM player Where playertype = 'admin' 

                   ");

$stmt4->execute();
    
$rows4 = $stmt4->fetch();
////////////////////////////////////
$stmt2 = $con->prepare("
SELECT
    *
FROM 
   videos 
WHERE
    s_code = ?
                    ");
// execute query
$stmt2->execute(array($CODE));
// fatch the data
$rows2 = $stmt2->fetch();
////////////////////////////////////
function checkitem($select , $from , $value) {

  global $con;

  $statement = $con->prepare(" SELECT $select FROM $from WHERE $select = ? ");

  $statement->execute(array($value));

  $count = $statement->rowcount();

  return $count;

}
if(isset($_SESSION['UserName']) && $_SESSION['regst'] == 4)
{
    if ($do == 'ed') {   
      echo ' 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sports Details</title>
    <link rel="stylesheet" href="./CSS/edetails.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="./fontawesome-free-6.3.0-web/css/all.min.css"
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
      <img
        src="'.$rows4['profilepic'].'"
        class="user-img"
        id="togglemenu"
        alt=""
      /> 
      <div class="sub-menu-wrab" id="sub-menu">
        <div class="sub-menu">
          <div class="user-info">
          
                        <img src="'.$rows4['profilepic'].'"/>
                        <h2>'.$rows4['FullName'].'</h2>
            
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
      <p>game details</p>
      <form action="updatesport.php?do=ue&Code='.$rows['Code'].'" method="POST" enctype="multipart/form-data">
        <div>
          <label for="">game name</label>
          <input type="text" name="gamename" value="'.$rows['Name'].'" id="" />
        </div>
        <div>
          <label for="">game discription</label>
          <textarea name="gamedescription" id="" cols="30" rows="10">'.$rows['description'].'</textarea>
        </div>
        <div>
        <label for="">video name</label>
        <input type="text" name="videoename" value="'; if(checkitem('s_code' , 'videos' , $CODE) > 0){ echo $rows2['Name'] ;}echo '" id="" />
        </div>
        <div>
        <label for="">video discription</label>
        <textarea name="videodescription" id="" cols="30" rows="10">'; if(checkitem('s_code' , 'videos' , $CODE)  > 0){ echo $rows2['description'] ;}echo '</textarea>
      </div>
        <div>
          <label for="">video File</label>
          <input type="file" name="videofile" id="" />
        </div>
        <div>
          <label for="">cover</label>
          <input type="file" name="cover" id="" />
        </div>
        <div>
          <label for="">logo</label>
          <input type="file" name="logo" id="" />
        </div>
        <input type="hidden" name="videourl" value="'; if(checkitem('s_code' , 'videos' , $CODE) > 0){ echo $rows2['URL'] ;}echo '" > 
        <input type="hidden" name="gamelogo" value="'.$rows['logo'].'" name="gamelogo" >
        <input type="hidden" name="gamecover" value="'.$rows['cover'].'" name="gamecover" >
        <div>
        <button>update</button>
        <a href="deletesport.php?do=des&Code='.$CODE.'">DELETE</a>
        </div>
      </form>
      '; ?>


    </div>
    <script src="./JS/edetails.js"></script>
  </body>
</html>
<?php  }} ?>
<!-- ///////////////////////////////////////////////////////////////////////// -->
<?php     if ($do == 'pd') {   
  echo '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sports Details</title>
    <link rel="stylesheet" href="./CSS/pdetails.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="./fontawesome-free-6.3.0-web/css/all.min.css"
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
    <img
      src="'.$rows4['profilepic'].'"
      class="user-img"
      id="togglemenu"
      alt=""
    /> 
    <div class="sub-menu-wrab" id="sub-menu">
      <div class="sub-menu">
        <div class="user-info">
        
                      <img src="'.$rows4['profilepic'].'"/>
                      <h2>'.$rows4['FullName'].'</h2>
          
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
    <!--sidebar start-->
    <div class="sidebar">
      <center class="sidebar-header">
        <img
          src="./img/logo edit sport copy new.png"
          class="profile_image"
          alt=""
        />
        
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
      <p>game details</p>
      <form action="updatesport.php?do=up&Code='.$rows['Code'].'" method="POST" enctype="multipart/form-data"">
        <div class="div">
          <label for="" name="">sport name</label>
          <input type="text" name="sportname" id="" value="'.$rows['Name'].'" />
        </div>
        <div class="div">
          <label for="">sport discription</label>
          <textarea name="sportdescription" id="" cols="30" rows="10">'.$rows['description'].'</textarea>
        </div>

        <input type="hidden" name="sportlogo" value="'.$rows['logo'].'" name="gamelogo" >
        <input type="hidden" name="sportcover" value="'.$rows['cover'].'" name="gamelogo" >

        <div class="div">
          <input type="number" name="" id="tn" placeholder="tools number" />
          <button id="tcreate">create tools</button> ' ;
          if(checkitem('s_code', 'tools', $CODE ) > 0) {

            echo '
          <a id="KITEDIT" href="editvideos.php?do=edt&Code='.$CODE.'">edit tools</a> ' ;
          
        }
        echo '
        </div>
  
        <div class="tcot"></div>

        <div class="div">
          <input type="number" name="" id="wn" placeholder="warmup number" />
          <button id="wcreate">create warmup</button> ';
          if(checkitem('s_code', 'warmup', $CODE ) > 0) {

          echo '<a id="KITEDIT" href="editvideos.php?do=edw&Code='.$CODE.'">edit warmup</a>' ;
          
        }
          echo '
        </div>
  
        <div class="wcot"></div>

        <div class="div">
          <input type="number" name="" id="vn" placeholder="videos number" />
          <button id="create">create Videos</button>
          ' ;

          if(checkitem('s_code', 'videos', $CODE ) > 0) {
          echo '
          <a id="KITEDIT" href="editvideos.php?do=edv&Code='.$CODE.'">edit Videos</a> ' ;
          }
          echo '

        </div>
  
        <div class="cot"></div>

        <div class="div">
          <label for="">cover</label>
          <input type="file" name="cover" id="" />
        </div>
        <div class="div">
          <label for="">logo</label>
          <input type="file" name="logo" id="" />
        </div>

        <div class="div">
          <button>save</button>

          <a class="delete" href="deletesport.php?do=dep&Code='.$CODE.'">DELETE</a>

          </div>
      </form>

    </div>
    <script src="./JS/pdetails.js"></script>
  </body>
</html>
' ; } ?>
<?php }
  
  else {
   header("location:game.php");
 
 } ?>
