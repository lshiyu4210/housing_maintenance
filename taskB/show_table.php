<?php
session_start();
require_once "config.php";

?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>tables</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        /* .wrapper{ width: 1080px; padding: 20px; } */
        p{text-align: center;}
        h1{text-align: center;}
        form{text-align: center;}
        table{text-align: center;}
        
    .havemargin {
        position: relative;
        left: 40px;
        font-size: 24px;
    }

    .topright {
        position: absolute;
        top: 15px;
        right: 22px;
        font-size: 16px;
    }
    
    table, th, td {
        width: 600;
        left:25px;
        /* margin: auto; */
        font-size:15px;
        padding:10px;
        /* text-align:left; */
        border:1px solid #A8A8A8;
        border-collapse:collapse;
    }

    </style>
</head>

<body>

    <div class="havemargin">
    <br>
    <h1>All tables from the database </h1>
            <?php 
            // select all tasks if page is visited or refreshed

                    // Prepare a select statement
            $sql1 = "SELECT * FROM locations";
            $sql2 = "SELECT * FROM users";
            $sql3 = "SELECT * FROM items";
            $sql4 = "SELECT * FROM request";
            $sql5 = "SELECT * FROM responsible_for";
        
                $locations = mysqli_query($link,$sql1);

                $users = mysqli_query($link,$sql2);

                $items = mysqli_query($link,$sql3);

                $request = mysqli_query($link,$sql4);

                $responsible_for = mysqli_query($link,$sql5);
            ?>

            <h2>locations</h2>
            <table> 
            <thead>
                <tr>
                    <th>id</th>
                    <th>building</th>
                    <th>room</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1; while ($row = mysqli_fetch_array($locations)) {?>
                <tr>
                    <td> <?php echo $row['id']; ?> </td>
                    <td> <?php echo $row['building']; ?> </td>
                    <td> <?php echo $row['room']; ?> </td>
                </tr>
            </tbody>
            <?php $i++; } ?>
            </table>

            <br>
            <h2>user</h2>
            <table> 
            <thead>
                <tr>
                    <th>netid</th>
                    <th>user_name</th>
                    <th>phone</th>
                    <th>email</th>
                    <th>is_student</th>
                    <th>location_id</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1; while ($row = mysqli_fetch_array($users)) {?>
                    <tr>
                        <td> <?php echo $row['netid']; ?> </td>
                        <td> <?php echo $row['user_name']; ?> </td>
                        <td> <?php echo $row['phone']; ?> </td>
                        <td> <?php echo $row['email']; ?> </td>
                        <td> <?php echo $row['is_student']; ?> </td>
                        <td> <?php echo $row['location_id']; ?> </td>
                    </tr>
            </tbody>
            <?php $i++; } ?>
            </table>

            <br>
            <h2>items</h2>
            <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>item_name</th>
                    <th>is_broken</th>
                    <th>location_id</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1; while ($row = mysqli_fetch_array($items)) {?>
                <tr>
                    <td> <?php echo $row['id']; ?> </td>
                    <td> <?php echo $row['item_name']; ?> </td>
                    <td> <?php echo $row['is_broken']; ?> </td>
                    <td> <?php echo $row['location_id']; ?> </td>
                </tr>
            </tbody>
            <?php $i++; } ?>
            </table>

            <br>
            <h2>request</h2>
            <table> 
            <thead>
                <tr>
                    <th>id</th>
                    <th>user_id</th>
                    <th>item_id</th>
                    <th>description</th>
                    <th>requestDate</th>
                    <th>is_completed</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1; while ($row = mysqli_fetch_array($request)) {?>
                <tr>
                    <td> <?php echo $row['id']; ?> </td>
                    <td> <?php echo $row['user_id']; ?> </td>
                    <td> <?php echo $row['item_id']; ?> </td>
                    <td> <?php echo $row['description']; ?> </td>
                    <td> <?php echo $row['requestDate']; ?> </td>
                    <td> <?php echo $row['is_completed']; ?> </td>
                </tr>
            </tbody>
            <?php $i++; } ?>
            </table>

            <br>
            <h2>responsible_for</h2>
            <thead>
            <table> 
                <tr>
                    <th>user_id</th>
                    <th>location_id</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1; while ($row = mysqli_fetch_array($responsible_for)) {?>
                <tr>
                    <td> <?php echo $row['user_id']; ?> </td>
                    <td> <?php echo $row['location_id']; ?> </td>
                </tr>
            </tbody>
            <?php $i++; } ?>
            </table>
    </div>
    
    <div class="topright">
        <a href="login.php" class="btn btn-danger ml-3" style="position:relative; left:10px; top:0px;">Back to Login</a>
    </div>

</body>

</html>



<?php

// echo "<table>";
// while(){


// }
// echo "</table>";
?>