<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>

</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>
       </b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <?php

        require_once "config.php";
        $param_userid = $_SESSION["userid"];
        $result = mysqli_query($link,"SELECT * FROM sessions WHERE mentor_id =" . $param_userid);

        echo "<div><table border='1'>
            <tr>
            <th>Session id</th>
            <th>Subject</th>
            <th>Location</th>
            <th>Date</th>
            <th>Time</th>
            </tr>";

            while($row = mysqli_fetch_array($result))
            {
            echo "<tr>";
            echo "<td>" . $row['session_id'] . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . $row['session_date'] . "</td>";
            echo "<td>" . $row['time'] . "</td>";
            echo "</tr>";
            }
            echo "</table></div>";
    ?>
    <p>
        <a href="new_session.php" class="btn btn-danger">New Session</a>
    </p>

</body>
</html>