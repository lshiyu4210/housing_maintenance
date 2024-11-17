<?php
session_start();
require_once "config.php";



?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>student</title>
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
        form{text-align: center;}

    </style>
</head>

<body>

    <section>
    <br>
    <div class="top">
        <h1 style="color:White;position:relative;left:0px;top:10px;font-size: 50px;">Welcome, <?php echo $_SESSION["username"] ?> </h1>
    </div>
    <br>
    <br>
    <div class="topright">
        <font style="color:White; position:absolute; left:-525px; top:10px;">Housing Maintenance Requesting System</font>
        <a href="logout.php" class="btn btn-warning ml-3"; style="float: right;position:absolute; left:-108px; top:0px;";>Sign Out</a>
        <a href="myactivity.php" class="btn btn-light ml-3"; style="float: right;position:absolute; left:-225px; top:0px;">My Activity</a>
    </div>
<p  style="color:White; position:relative; left:15px; top:15px;">Your room is <?php echo $_SESSION["room_name"] ?>. </p>
    <br>
    </section>
    <hr>

    <section>
    <div class="havemargin">
    <br>
    <table style="width:75%">
        <thead>
            <tr>
                <th style="width:6%;text-align:center">#</th>
                <th style="width:80%">Item</th>
                <th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // select all tasks if page is visited or refreshed

                    // Prepare a select statement
            $sql = "SELECT * FROM items WHERE is_broken = false AND location_id = ?";
        
                $stmt = mysqli_prepare($link, $sql);
            // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $location_id);
            
                // Set parameters
                $location_id = $_SESSION["location_id"];
            
            // Attempt to execute the prepared statement
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            // $items = mysqli_query($link, "SELECT * FROM items WHERE is_broken = false AND location_id = ?");
    
            $i = 1; while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td style="text-align:center;"> <?php echo $i; ?> </td>
                    <td class="item"> <?php echo $row['item_name']; ?> </td>
                    <td style="text-align:center;"; class="report"> 
                        <a href="report.php?report_item=<?php echo $row['id'] ?>">Report</a> 
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