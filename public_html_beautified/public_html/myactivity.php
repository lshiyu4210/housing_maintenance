<?php
session_start();
require_once "config.php";

?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>My Activity</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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
        height: 180px;
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

    .button {
        background-color: White;
        border: none;
        color: #000066;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 32px;
    }

    .button1 {border-radius: 2px;}

    </style>
</head>

<body>

    <section>
    <br>
    <div class="top">
        <h1 style="color:White">Welcome, <?php echo $_SESSION["username"] ?> </h1>
    </div>
    <br>
    <br>
    <div class="topright">
        <font style="color:White; position:absolute; left:-525px; top:10px;">Housing Maintenance Requesting System</font>
        <a href="logout.php" class="btn btn-warning ml-3"; style="float: right;position:absolute; left:-108px; top:0px;";>Sign Out</a>
        <a href="student.php" class="btn btn-light ml-3"; style="float: right;position:absolute; left:-225px; top:0px;">Homepage</a>

        <!-- <font color="White">Housing Maintenance Requesting System</font>
        <a href="logout.php" class="btn btn-warning ml-3"; style="float: right;">Sign Out</a>
        <a href="student.php" class="btn btn-light ml-3">Homepage</a> -->
    </div>
    <button class="button button1"; style="position:relative; left:50px; top:35px;">My Activity</button>
    </section>

    </section>
    <hr>
    <div class="havemargin">
    <br>
    <table style="width:75%">
        <thead>
            <tr>
                <th style="width:6%;text-align:center">#</th>
                <th style="width:12%">Item</th>
                <th style="width:15%">Date</th>
                <th style="width:35%">Description</th>
                <th style="width:15%">Status</th>
                <th style="text-align:center">Action</th>
            </tr>
            <tr>
                
            </tr>
        </thead>
    
        <tbody>
            <?php 
            // select all tasks if page is visited or refreshed

                    // Prepare a select statement
            $sql = "SELECT request.id, requestDate, description, is_completed, item_id, item_name
            FROM request INNER JOIN items ON items.id = request.item_id
            WHERE request.user_id = ?";
        
                $stmt = mysqli_prepare($link, $sql);
            // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_userid);      //?
            
                // Set parameters
                $param_userid = $_SESSION["netid"];
            
            // Attempt to execute the prepared statement
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            // $items = mysqli_query($link, "SELECT * FROM items WHERE is_broken = false AND location_id = ?");
    
            $i = 1; while ($row = mysqli_fetch_array($result)) { ?>
            <?php 
                if ($row['is_completed']){
                    $req_status = "Completed";
                } else {
                    $req_status = "Pending";
                }
                ?>
                <tr>
                    <td style="text-align:center"> <?php echo $i; ?> </td>
                    <td class="item"> <?php echo $row['item_name']; ?> </td>
                    <td class="date"> <?php echo $row['requestDate']; ?> </td>
                    <td class="description"> <?php echo $row['description']; ?> </td>
                    <td class="status"> <?php echo $req_status; ?> </td>
                    
                    <td class="withdraw"; style="text-align:center"> 
                        <a <?php if($row['is_completed']){echo 'hidden';} ?> href="withdraw.php?data[]=<?php echo $row['id'] ?>&data[]=<?php echo $row['item_id'] ?> ">Withdraw</a> 
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
    </section>
</body>

</html>