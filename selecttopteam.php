<?php 
// Include the database config file 
include('dbcon.php');
 
if(!empty($_POST["TEAM_CODE1"])){ 
    // Fetch player data based on the specific team 
    $query = "SELECT * FROM player WHERE teamcode = ".$_POST['TEAM_CODE1']." "; 
    $result = $con->query($query); 

    // Generate HTML of state options list 
    $count = $result->rowcount();
    if($count > 0){ 
        echo '<option value="">Select Top 1 player</option>'; 
        foreach($result as $row) {
            echo '<option  value="'.$row['ID'].'">'.$row['FullName'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">player top 1 not available</option>'; 
    } 
}
if(!empty($_POST["TEAM_CODE2"])){ 
    // Fetch player data based on the specific team 
    $query = "SELECT * FROM player WHERE teamcode = ".$_POST['TEAM_CODE2']." "; 
    $result = $con->query($query); 

    // Generate HTML of state options list 
    $count = $result->rowcount();
    if($count > 0){ 
        echo '<option value="">Select Top 2 player</option>'; 
        foreach($result as $row) {
            echo '<option  value="'.$row['ID'].'">'.$row['FullName'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">player Top 2 not available</option>'; 
    } 
}
if(!empty($_POST["TEAM_CODE3"])){ 
    // Fetch player data based on the specific team 
    $query = "SELECT * FROM player WHERE teamcode = ".$_POST['TEAM_CODE3']." "; 
    $result = $con->query($query); 

    // Generate HTML of state options list 
    $count = $result->rowcount();
    if($count > 0){ 
        echo '<option value="">Select Top 3 player</option>'; 
        foreach($result as $row) {
            echo '<option  value="'.$row['ID'].'">'.$row['FullName'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">player Top 3 not available</option>'; 
    } 
}
?>