<?php
session_start();
require_once "config.php";

?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>staff</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        /* .wrapper{ width: 1080px; padding: 20px; } */
        p{text-align: center;}
        h1{text-align: center;}
        form{text-align: center;}

        
    .topright {
        position: absolute;
        top: 15px;
        right: 22px;
        font-size: 16px;
    }
    
    .top {
        position: absolute;
        top: 0px;
        left: 20px;
        font-size: 18px;
        text-shadow: 5px 5px Black;
    }

    .havemargin {
        position: relative;
        left: 40px;
        font-size: 24px;
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
    
    table, th, td {
        width: 800;
        left:25px;
        /* margin: auto; */
        font-size:20px;
        padding:15px;
        /* text-align:left; */
        border:1px solid #A8A8A8;
        border-collapse:collapse;
    }

    body{ font: 20px sans-serif; }
        /* .wrapper{ width: 1080px; padding: 20px; } */
        p{text-align: left; margin: 25px;}
        h1{text-align: left; margin: 20px;}
        h2{text-align: left; margin: 20px;}
        form{text-align: center;
    }

    </style>
</head>

<body>

    <!-- <h1>Welcome, <?php echo $_SESSION["username"] ?> </h1>
    <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a> -->

    
    <section>
    <br>
    <div class="top">
        <h1 style="color:White;position:relative; left:0px; top:10px;font-size: 50px;">Welcome, <?php echo $_SESSION["username"] ?> </h1>
    </div>
    <br>
    <br>
    <div class="topright">
        <font style="color:White; position:absolute; left:-410px; top:10px;">Housing Maintenance Requesting System</font>
        <a href="logout.php" class="btn btn-warning ml-3"; style="float: right;position:absolute; left:-105px; top:0px;";>Sign Out</a>
    </div>
    </section>
    <hr>

    <section>
    <div class="havemargin">
    <br>
    <table style="width:80%">
        <thead>
            <tr>
                <th style="width:5%;text-align:center">#</th>
                <th style="width:12%">request_id</th>
                <th style="width:12%">building</th>
                <th style="width:8%">room</th>
                <th style="width:12%">item</th>
                <th style="width:30%">description</th>
                <th style="width:13%">status</th>
                <th style="text-align:center">action</th>
                
            </tr>
        </thead>
    
        <tbody>
            <?php 
            // select all tasks if page is visited or refreshed

                    // Prepare a select statement
            $sql = "SELECT DISTINCT building,room,item_name,request.description AS RD,request.id AS RI,item_id, is_completed
            FROM ((locations INNER JOIN items ON locations.id = items.location_id)
            INNER JOIN responsible_for ON items.location_id = responsible_for.location_id)
            INNER JOIN request 
            ON items.id = request.item_id
            WHERE responsible_for.user_id = ?";
        
                $stmt = mysqli_prepare($link, $sql);
            // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $user_id);
            
                // Set parameters
                $user_id = $_SESSION["netid"];
            
            // Attempt to execute the prepared statement
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            // $items = mysqli_query($link, "SELECT * FROM items WHERE is_broken = false AND location_id = ?");
    
            $i = 1; while ($row = mysqli_fetch_array($result)) { ?>
                 <?php 
                if ($row['is_completed']){
                    $req_status = "Completed";
                } else {
                    $req_status = "Waiting";
                }
                ?>
                <tr>
                    <td style="text-align:center"> <?php echo $i; ?> </td>
                    <td class="request"> <?php echo $row['RI']; ?> </td>
                    <td class="building"> <?php echo $row['building']; ?> </td>
                    <td class="room"> <?php echo $row['room']; ?> </td>
                    <td class="item"> <?php echo $row['item_name']; ?> </td>
                    <td class="description"><?php echo $row['RD']; ?></td>
                    <td class="status"> <?php echo $req_status; ?> </td>
                    <td class="complete"> 
                        <a <?php if($row['is_completed']){echo 'hidden';} ?> href="complete.php?data[]=<?php echo $row['RI']?>&data[]=<?php echo $row['item_id']?>">Complete</a> 
                    </td>
                </tr>
            <?php $i++; } ?>	

        </tbody>
    </table>
    </div>
    
    <br>
    <br>
    <br>
    <hr>
    <br>
    </section>
</body>

</html>