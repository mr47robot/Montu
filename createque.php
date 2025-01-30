<?php
ob_start();
include('dbcon.php');


$do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
$CODE = isset($_GET['Code']) && is_numeric($_GET['Code']) ? intval($_GET['Code']) : 0;


$stmt = $con->prepare("
SELECT
    *
FROM 
    team 
WHERE
 Code = ?
                    ");

$stmt->execute(array($CODE));

$rows = $stmt->fetchall();

/////////////////////////////////


?>
<!DOCTYPE php>
<php lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Questions</title>
    <link rel="stylesheet" href="css/createque.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&family=Poppins:wght@400;500;700&display=swap"
    rel="stylesheet">
  </head>
  <body>

    <form class="createqs" > 
    <?php echo '<a href="Team.php?do=team&Code='.$CODE.'"><span class="back"><img src="img/arrow-left-solid.svg"></span></a>' ; ?>

      <input type="number" name="" id="qsn" placeholder="Questions number" />
      <button id="qsn-btn">create</button>
      <button id="delate-all">delete all</button>
    </form>
    <div class="values">
      <div class="qsncontain">
        <p class="qsnumber">0</p>
        <p>Question</p>
      </div>
      <?php echo  ' <form class="qanadata" action="addque.php?Code='.$CODE.'" method="POST" enctype="multipart/form-data" >  ' ; ?>
      <button id="save">save</button>
      <div id="qanda"></div>
      </form>
    </div>
    

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="js/createque.js"></script>
  </body>
</php>
