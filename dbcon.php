<?php
ob_start();
session_start();
    $dsn = 'mysql:host=localhost;dbname=e&p-sports';
    $user = 'root';
    $pass = '';
    $option = array(
    
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    
    );

    try {
        $con = new PDO($dsn , $user ,$pass ,$option);
        $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    catch(PDOException $e) {
        echo 'Failed To Connect' . $e->getMessage();
    }
    $stmt0 = $con->prepare("
    SELECT
        *
    FROM 
      player
    WHERE 
        ID = ?
        ");
// execute query
if(isset($_SESSION['ID'])) {
$stmt0->execute(array($_SESSION['ID']));
// fatch the data
$rows0 = $stmt0->fetch();
}
    ?>