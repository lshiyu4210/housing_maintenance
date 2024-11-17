<?php
session_start();
require_once "config.php";
$des_error = '';
$date_error = '';

if (isset($_GET['report_item'])) {
	$item_id = $_GET['report_item'];
    $sql = "SELECT item_name, room, building  FROM items INNER JOIN locations ON items.location_id = locations.id WHERE items.id = ?";
        
    $stmt = mysqli_prepare($link, $sql);
// Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $id);
    // Set parameters
    $id = $item_id;
// Attempt to execute the prepared statement
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $item_name, $item_room, $item_building );
    mysqli_stmt_fetch($stmt);
}
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["des"]))){
        $des_error = "Please enter descriptions.";
    } 

    if(empty($_POST["dt"])){
        $date_error = "Please enter date.";
    } 

    if(empty($form_error) and empty($date_error)){ 
	// header('location: student.php');
    $sql1 = "INSERT INTO request (description, requestDate, is_completed, user_id, item_id) VALUES (?, ?, 0, ?, ?) ";
    $stmt1 = mysqli_prepare($link, $sql1);
// Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt1, "sssi", $description, $requestDate, $user_id, $itemid);
    // Set parameters
    $description = $_POST["des"]; 
    $requestDate = $_POST["dt"]; 
    $user_id = $_SESSION["netid"]; 
    $itemid =  $_POST["item_id"];
// Attempt to execute the prepared statement
    mysqli_stmt_execute($stmt1);
    // mysqli_stmt_store_result($stmt1);
    // mysqli_stmt_bind_result($stmt1, $item_name, $item_room, $item_building );
    // mysqli_stmt_fetch($stmt1);


    mysqli_query($link, "UPDATE items SET is_broken = 1 WHERE id=".$itemid);


    header('location: student.php');
    }
}
mysqli_close($link);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <title>Maintenance Request Form</title>
        <style>
            /* h1{text-align: center;} */
            /* form{text-align: center;} */

            .havemargin {
        position: relative;
        left: 50px;
        top: 20px;
        
    }

    .topright {
        position: absolute;
        top: 15px;
        right: 22px;
        font-size: 19px;
    }
 
    body{ font-size: 20px; }
    .tab {
            display: inline-block;
            margin-left: 50px;
    }

        </style>
    </head>

    <body>
    <div class="topright">
        <font style="color:Black; position:absolute; left:-330px; top:10px;">Housing Maintenance Requesting System</font>
    </div>
    <div class="havemargin">
        <h1>Maintenance Request Form</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="building">Building: &nbsp; <?php echo $item_building ;?></label><span class="tab"></span>
            <label for="room">Room: &nbsp; <?php echo $item_room ;?></label><span class="tab"></span>
            <label for="item">Item: &nbsp; <?php echo $item_name ;?></label><br>
            <input type="hidden" name = "item_id" value=<?php echo $item_id ;?> ><br><br>
            <label for="des">Description:</label><br><br>
            
        <?php 
        if(!empty($des_error)){
            echo '<div class="alert alert-danger">' . $des_error . '</div>';
        }    
        ?>
            <textarea rows="15" name= "des" cols="100" maxlength="300" placeholder="please fill in a description of the broken item" required></textarea><br><br>
            <label for="dt">Date:</label>&nbsp;
            <?php 
            if(!empty($date_error)){
            echo '<div class="alert alert-danger">' . $date_error . '</div>';
        }    
        ?>
            <input type="date" name = "dt" name="submission_date" required><br><br>
            <input type="button" onclick="history.back();" value="Back" style="font-size:20px"> &nbsp; &nbsp; &nbsp; 
            <input type="reset" style="font-size:20px"> &nbsp; &nbsp; &nbsp; 
            <input type="submit" style="font-size:20px">
        </form>
    </div> 
    </body>
</html>