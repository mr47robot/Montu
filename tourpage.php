<?php
ob_start();
include('dbcon.php');
if (isset($_SESSION['UserName']) && $_SESSION['regst'] == 4) {

  $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
  $Code = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;

  if ($do == 'tour') {

    $stmt = $con->prepare(
      'SELECT 
*
FROM
tournament
WHERE
Code  = ? 
'
    );
    // execute query
    $stmt->execute(array($Code));
    // fatch the data
    $row = $stmt->fetch();
    // the raw count to check the id in database
    $count = $stmt->rowcount();
    
    ////////////////////////////
    $stmt2 = $con->prepare(
      'SELECT 
  *
  FROM
  `join`
  WHERE
  TOURNAMENT_CODE = ? AND regst = 1
   '
    );
    // execute query
    $stmt2->execute(array($Code));
    // fatch the data
    $row2 = $stmt2->fetchall();
    // the raw count to check the id in database
    $count2 = $stmt2->rowcount();
    ////////////////////////////
    $stmt3 = $con->prepare(
      'SELECT 
  *
  FROM
  `join`
  WHERE
  TOURNAMENT_CODE = ? AND regst = 2
   '
    );
    // execute query
    $stmt3->execute(array($Code));
    // fatch the data
    $row3 = $stmt3->fetchall();
    // the raw count to check the id in database
    $count3 = $stmt3->rowcount();
    ///////////////////////////////////
    $stmt4 = $con->prepare("
SELECT * FROM player Where playertype = 'admin' 

                   ");

    $stmt4->execute();

    $rows4 = $stmt4->fetch();

////////////////////////////
$stmt5 = $con->prepare(
  'SELECT 
*
FROM
sport
WHERE
Code  = ? 
'
);
// execute query
$stmt5->execute(array($row['game_code']));
// fatch the data
$row5 = $stmt5->fetch();
// the raw count to check the id in database
$count5 = $stmt5->rowcount();
/////////////////////////////////////////
$stmt6 = $con->prepare("
SELECT
    *
FROM 
  team 
WHERE
Code = ?
                    ");
// execute query
$stmt6->execute(array($row['top_team_one_id']));
// fatch the data
$rows6 = $stmt6->fetch();
$count6 = $stmt6->rowcount();

//////////////////////////////////

$stmt7 = $con->prepare("
SELECT
    *
FROM 
team 
WHERE
Code = ?
                    ");
// execute query
$stmt7->execute(array($row['top_team_two_id']));
// fatch the data
$rows7 = $stmt7->fetch();
$count7 = $stmt7->rowcount();

//////////////////////////////////

$stmt8 = $con->prepare("
SELECT
    *
FROM 
team 
WHERE
Code = ?
                    ");
// execute query
$stmt8->execute(array($row['top_team_three_id']));
// fatch the data
$rows8 = $stmt8->fetch();
$count8 = $stmt8->rowcount();

    // if there is such id show the form
    if ($count > 0) {

      ?>
      <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Tournament Page</title>
        <link rel="stylesheet" href="CSS/tourpage.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
        <link rel="stylesheet" href="fontawesome-free-6.3.0-web/css/all.min.css" />
        <script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
        <script src="https://cdn.jsdelivr.net/clipboard.js/1.6.0/clipboard.min.js"></script>
      </head>

      <body>
        <input type="checkbox" id="check" />
        <!--header area start-->
        <header>
          <div class="show">
            <label for="check">
              <i class="fas fa-bars" id="sidebar_btn"></i>
            </label>
          </div>
          <?php echo '
      <img
        src="' . $rows4['profilepic'] . '"
        class="user-img"
        id="togglemenu"
        alt=""
      /> ';
          ?>
          <div class="sub-menu-wrab" id="sub-menu">
            <div class="sub-menu">
              <div class="user-info">
                <?php echo ' 
                        <img src="' . $rows4['profilepic'] . '"/>
                        <h2>' . $rows4['FullName'] . '</h2>
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
            <img src="./img/logo edit sport copy new.png" class="profile_image" alt="" />
            <!-- <h4>P & E Sports</h4> -->
          </center>
          <a href="dashboard.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
          <a href="requests.PHP"><i class="fa-solid fa-user-plus"></i><span>requests</span></a>
          <a href="tournaments.php"><i class="fa-solid fa-trophy"></i><span>tournaments</span></a>
          <a href="./editsports.php"><i class="fa-solid fa-basketball"></i><span>sports</span></a>
        </div>
        <!--sidebar end-->
        <div class="content">
          <?php echo  '<div class="tourhead" style="background-image: url('.$row5['cover'].');">' ; ?>
            <div class="game"></div>
            <div class="tour-info">
              <?php
              echo '
          <img
            src="'.$row['logo'].'"
            class="tourlogo"
            alt="" 
          /> ';
              ?>
              <div class="tour-name">
                <?php
                echo '
            <span>' . $row['Name'] . '</span>
            ';
                ?>
              </div>
              <div class="team-number">
                <div>
                <?php echo ' <span contenteditable="">'.count($row3).' </span> '; ?>
                </div>
                <hr />
                <div>
                  <?php echo ' <span contenteditable="">'. $row['TEAMS_NUMBER'] .' team</span> ' ; ?>
                </div>
              </div>
            </div>
          </div>
          <ul class="tabs">
            <li class="btnactive" data-cont=".one">general</li>
            <li data-cont=".two">placement</li>
            <li data-cont=".three">matchs</li>
            <li data-cont=".four">Participant</li>
            <li data-cont=".five">requests</li>
            <li data-cont=".six">top 3</li>
          </ul>
          <div class="tebs-content">
            <div class="one">
              <?php
              echo '
          <form action="updatetour.php?do=updatetour&Code=' . $row['Code'] . '" method="POST" enctype="multipart/form-data">
   
          <div class="name">
            <label for="">tournament name</label>
            <input type="text" name="tournament-name" value="' . $row['Name'] . '" />
          </div>
          <div class="name">
            <label for="">organizer</label>
            <input type="text" name="tournament-Organizer"  value="' . $row['Organizer'] . '"/>
          </div>
          <div class="name">
            <label for="">location</label>
            <textarea name="tournament-Location" cols="30" rows="10" >' . $row['Location'] . '</textarea>
    
          </div>
          <div class="name">
            <label for="">start date</label>
            <input type="date" name="tournament-Start_Date" value="' . $row['Start_Date'] . '" />
          </div>
          <div class="name">
            <label for="">end date</label>
            <input type="date" name="tournament-End_date" value="' . $row['End_date'] . '" />
          </div>
          <div class="name">
            <label for="">size</label>
            <input type="number" name="tournament-size" value="' . $row['TEAMS_NUMBER'] . '" class="tour-size" />
          </div>
          <div class="name">
            <label for="">contact email</label>
            <input type="email" name="tournament-email" value="' . $row['Contact_Email'] . '" />
          </div>
          <div class="name">
            <label for="">tournament discription</label>
            <textarea cols="30" rows="10" name="tournament-discription"  >' . $row['Description'] . '</textarea>
          </div>
          <div class="name">
            <label for="">logo</label>
            <input type="file" id="file"  name="logo"  accept="image/*"/>
          </div>
          <input type="hidden" name="tournament-code" value="' . $row['Code'] . '">
          <input type="hidden" name="tournament-logo" value="' . $row['logo'] . '">
          <div class="sandrev">
            <button class="saving" id="update"  name="update" >update</button>
            <a class="delete" href="updatetour.php?do=dtour&Code=' . $row['Code'] . '">DELETE</a>
            </div> ';

              ?>
              </form>
            </div>
            <div class="two">
              <div class="try">
                <table class="content-table">
                  <caption>
                    seeding
                  </caption>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($row3 as $rowss3)
                      echo '
                <tr>
                <td>' . $i++ . '</td>
                  <td class="td" id="brack-box">
                    <span
                      id="team-drag"
                      ondragstart="drag(event)"
                      draggable="true"
                      >' . $rowss3['TEAM_NAME'] . '</span
                    >
                  </td>
                </tr>
                ';
    //               if($count3 == 0) {
    //                   echo '
    //                  <tr>
    //               <td>1</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >raad</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>2</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >anubis</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>3</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >ngx</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>4</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >geekay</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>5</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >onemore</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>6</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >twisted minds</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>7</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >Triple</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>8</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >MKH</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>9</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >zoz</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>10</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >mr47robot</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>11</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >NENE</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>12</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >selio</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>13</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >brock</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>14</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >mark</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>15</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >brim</span
    //                 >
    //               </td>
    //             </tr>
    //             <tr>
    //               <td>16</td>
    //               <td class="td" id="brack-box">
    //                 <span
    //                   id="team-drag"
    //                   ondragstart="drag(event)"
    //                   draggable="true"
    //                   >omen</span
    //                 >
    //               </td>
    //             </tr> ' ;
    // }
                ?>
                  </tbody>
                </table>
              </div>
              <div class="brack-head">
                <p>single elimination</p>
                <i class="recycle"></i>
              </div>
              <div class="brackets" id="brackets"></div>
              <div class="sandrev">
                <button class="saving" id="update">update</button>
              </div>
            </div>
            <div class="three">
            <div class="brackets" id="brackets">
            <?php
              echo $row['bracket_admin'] ;
              ?>
              </div> 
              <?php echo '
                <form id="tournamentbracketform" action="updatetour.php?do=updatebracket&Code=' . $row['Code'] . '" method="POST" enctype="multipart/form-data">   
                <input type="text" id="tournamentbracket" name="tournamentbracket" value="">
                <input type="hidden" id="tournamentbracketadmin" name="tournamentbracketadmin" value="">
                </form>
                      ' ;
                ?>
                <div class="sandrev">
                <button id="save" >update</button>
                </div>
                <section>
            <span class="overlay"></span>
            <div class="modal-box container">
              <div class="text">match details</div>
              <div class="teams-name">
                <div class="teama-name"></div>
                <div class="vs">VS</div>
                <div class="teamb-name"></div>
              </div>
              <ul class="tabs2">
                <li class="newactive" data-cont=".newone">result</li>
                <li data-cont=".newtwo">info</li>
              </ul>
              <div class="tab2">
                <div class="newone">
                  <div class="teams-res">
                    <table>
                      <thead>
                        <tr>
                          <th>name</th>
                          <th>score</th>
                          <th>
                            result
                            <div class="clear-mark"></div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="teama-name"></div>
                          </td>
                          <td>
                            <input class="teama-score" type="number" />
                          </td>
                          <td>
                            <label id="taw" for="taw">w</label>
                            <label id="tal" for="tal">l</label>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="teamb-name"></div>
                          </td>
                          <td>
                            <input class="teamb-score" type="number" />
                          </td>
                          <td>
                            <label id="tbw" for="tbw"><span>w</span></label>
                            <label id="tbl" for="tbl"><span>l</span></label>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="sandrev">
                      <button class="saving" id="savematch">update</button>
                    </div>
                  </div>
                </div>
                <div class="newtwo">
                  <div>
                    <label for="" class="date">match date</label>
                    <input type="date" name="" id="date" />
                  </div>
                  <div>
                    <label for="" class="time">match time</label>
                    <input type="time" name="" id="time" />
                  </div>
                  <div class="sandrev">
                    <button class="savedate" id="savedate">save</button>
                  </div>
                </div>
              </div>
            </div>
          </section>
             </div>
            <div class="four">
              <table>
                <caption>
                  List of participants
                </caption>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>logo</th>
                    <th>name</th>
                    <th>email</th>
                    <th>action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1; foreach ($row3 as $rows3) {
                    echo '
              <tr>
                <td>' . $i++ . '</td>
                <td><img src="' . $rows3['TEAM_LOGO'] . '" alt="" /></td>
                <td>' . $rows3['TEAM_NAME'] . '</td>
                <td>' . $rows3['TEAM_EMAIL'] . '</td>
                <td>
                  <div class="sandrev">
                  <a href="jointouradmin.php?do=exittour&Code=' . $Code . '&TeamLeaderName=' . $rows3['TEAM_LEADER'] . '">remove</a>
                  </div>
                </td>
              </tr>
              ';
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="five">
              <table>
                <caption>
                  tournament requests
                </caption>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>logo</th>
                    <th>name</th>
                    <th>team leader</th>
                    <th>action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $i = 1;

                  foreach ($row2 as $rows2) {

                    echo '<tr> ';
                    echo ' <td>' . $i++ . '</td>  ';
                    echo ' <td><img src="' . $rows2['TEAM_LOGO'] . '" alt="" /></td> ';
                    echo ' <td>' . $rows2['TEAM_NAME'] . '</td> ';
                    echo ' <td>' . $rows2['TEAM_LEADER'] . '</td> ';
                    echo ' <td> ';
                    echo ' <div class="sandrev">';
                    echo '<a class="saving" id="update" href="jointouradmin.php?do=jointour&Code=' . $Code . '&TeamLeaderName=' . $rows2['TEAM_LEADER'] . '">Accept</a> ';
                    echo ' <a class="delete" id="delete" href="jointouradmin.php?do=exittour&Code=' . $Code . '&TeamLeaderName=' . $rows2['TEAM_LEADER'] . '">Reject</a> ';
                    echo ' </div> ';
                    echo ' </td>';
                    echo ' </tr>';

                  }

                  ?>
                </tbody>
              </table>
            </div>
             <div class="six">
             <?php echo '  <form action="updatetour.php?do=topteam&Code=' . $row['Code'] . '" method="POST" enctype="multipart/form-data">' ; ?>
            <h1>top teams</h1>
            <div class="services">
              <div class="services__box">
                <div class="services__icon">
                  <img
                    src="./Pictures/icons8-medal-first-place-100 (1).png"
                    alt=""
                  />
                </div>
                <div class="services__content">
                <select name="topone" id="team1" required>
                  <option value="">Select first team</option>
                  <?php 
                  if($count3 > 0){ 
                      foreach($row3 as $rows3){  
                          echo '<option value="'.$rows3['TEAM_CODE'].'">'.$rows3['TEAM_NAME'].'</option>'; 
                      } 
                  }else{ 
                      echo '<option value="">teams not available</option>'; 
                  } 
                  ?>
              </select>
                  <input
                    type="text"
                    name=""
                    value="<?php  if($count6 > 0) { echo $rows6['Name'] ; } ?>"
                    disabled
                    class="oldplana"
                  />
                </div>
              </div>
              <!--  -->
              <div class="services__box">
                <div class="services__icon">
                  <img
                    src="./Pictures/icons8-medal-second-place-100 (1).png"
                    alt=""
                  />
                </div>
                <div class="services__content">
                <select  name="toptwo" id="team2" required>
                  <option  value="" >Select second team</option>
                  <?php 
                  if($count3 > 0){ 
                      foreach($row3 as $rows3){  
                          echo '<option value="'.$rows3['TEAM_CODE'].'">'.$rows3['TEAM_NAME'].'</option>'; 
                      } 
                  }else{ 
                      echo '<option value="">teams not available</option>'; 
                  } 
                  ?>
              </select>
                  <input
                    type="text"
                    name=""
                    value="<?php if($count7 > 0) { echo $rows7['Name'] ; }  ?>"
                    disabled
                    class="oldplana"
                  />
                </div>
              </div>
              <!--  -->
              <div class="services__box">
                <div class="services__icon">
                  <img
                    src="./Pictures/icons8-medal-third-place-100.png"
                    alt=""
                  />
                </div>
                <div class="services__content">
                <select name="topthree"  id="team3" required>
                  <option value="">Select third team</option>
                  <?php 
                  if($count3 > 0){ 
                      foreach($row3 as $rows3){  
                          echo '<option value="'.$rows3['TEAM_CODE'].'">'.$rows3['TEAM_NAME'].'</option>'; 
                      } 
                  }else{ 
                      echo '<option value="">teams not available</option>'; 
                  } 
                  ?>
              </select>
                  <input
                    type="text"
                    name=""
                    value="<?php if($count8 > 0) { echo $rows8['Name'] ; }  ?>"
                    disabled
                    class="oldplana"
                  />
                </div>
              </div>
            </div>
            <div class="sandrev">
              <button class="saving">save</button>
            </div>
          </form>             
          </div>
        </div>
        <script src="JS/tourpage.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- <script>
        $(document).ready(function(){
            $('#team1').on('change', function(){
                var tcode1 = $(this).val();
                if(tcode1){
                    $.ajax({
                        type:'POST',
                        url:'selecttopteam.php',
                        data:'TEAM_CODE1='+tcode1,
                        success:function(html){
                            $('#player1').html(html);
                        }
                    }); 
                }
            });
        });
        ///////////////////////////////////////////
        $(document).ready(function(){
            $('#team2').on('change', function(){
                var tcode2 = $(this).val();
                if(tcode2){
                    $.ajax({
                        type:'POST',
                        url:'selecttopteam.php',
                        data:'TEAM_CODE2='+tcode2,
                        success:function(html){
                            $('#player2').html(html);
                        }
                    }); 
                }
            });
        });
        ///////////////////////////////////////////
        $(document).ready(function(){
            $('#team3').on('change', function(){
                var tcode3 = $(this).val();
                if(tcode3){
                    $.ajax({
                        type:'POST',
                        url:'selecttopteam.php',
                        data:'TEAM_CODE3='+tcode3,
                        success:function(html){
                            $('#player3').html(html);
                        }
                    }); 
                }
            });
        }); -->
</script>
      </body>

      </html>

    <?php }
  }
} else {
  header("location:game.php");

} ?>