<?php
// Code from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php

session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
//     header("location: student.php");
//     exit;
// }
 
// Include config file 
require_once "config.php";
 
// Define variables and initialize with empty values
$username = "";
$username_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Validate credentials
    if(empty($username_err)){
        // Prepare a select statement
        $sql = "SELECT netid, user_name, is_student, location_id, building, room  FROM users inner join locations on location_id = id WHERE netid = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $netid, $user_name, $is_student, $location_id, $building, $room );

                    if(mysqli_stmt_fetch($stmt)){
                    session_start();
                    
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["netid"] = $netid;
                    $_SESSION["username"] = $user_name;                            
                    $_SESSION["is_student"] = $is_student;                            
                    $_SESSION["location_id"] = $location_id;     
                    $_SESSION["room_name"] = $building.$room;     
  
                    // Redirect user to welcome page
                    
                    if ($is_student){
                        header("location: student.php");
                    } else{
                        header("location: staff.php");
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    } 
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 18px sans-serif; }
        /* .wrapper{ width: 1080px; padding: 20px; } */
        p{text-align: center;}
        h1{text-align: center;}
        h2{text-align: center;}
        form{text-align: center;}
        
    .top {
        position: absolute;
        top: 0px;
        left: 20px;
        font-size: 18px;
        text-shadow: 5px 5px Black;
    }

    .center {
        position: absolute;
        top: 70%;
        width: 100%;
        text-align: center;
        font-size: 18px;
        height: 0px;
    }

    section {
        height: 120px;
    }

    section:nth-child(1) {
        background: #000066;
    }

    section:nth-child(2) {
        background: White;
    }
    
    </style>
</head>
<body>

    <section>
    <div class="top">
        <br>
        <h1 style="color:White;position:relative; left:20px;top:9px;font-size: 50px;">Welcome </h1>
    </div>
    </section>

    <section>
    <div class="wrapper">
        <h1 style="position:relative; top:100px;">Housing Maintenance Requesting System</h1>
        <br>
        <br>
        <p style="position:relative; top:115px;">Please login with your NetID.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }    
        ?>

        <?php 
        if(!empty($username_err)){
            echo '<div class="alert alert-danger">' . $username_err . '</div>';
        }    
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="position:relative; top:115px;">
            <div class="form-group">
                <label>NetID</label>
                <input type="text" name="username"  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            
        </form>

        <div class="center">
            <p style="position:relative; left:-60px; top:145px;">Access all the relations in the database from here:</p>
            <a href="show_table.php" class="btn btn-primary ml-3"; style="position:relative; left:190px; top:100px;">Click Here</a>
        </div>
    </div>
    </section>
</body>
</html>