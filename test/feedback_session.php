<?php
// Initialize the session
session_start();


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>

</head>
<body>
    <div class="page-header">
        <h2>Please give your feedback.</h2>
    </div>
    <?php

        require_once "config.php";
        $param_userid = $_SESSION["userid"];
        $result = mysqli_query($link,"SELECT * FROM sessions WHERE mentee_id = " . $param_userid . " or mentor_id = " . $param_userid);

        echo "<div><table border='1' style='margin-left:300px;width:60%;margin-top:12px;margin-bottom:12px;'>
            <tr>
            <th>Session id</th>
            <th>Subject</th>
            <th>Location</th>
            <th>Date</th>
            <th>Time</th>
            <th>Action</th>
            </tr>";

            while($row = mysqli_fetch_array($result))
            {
            echo "<tr>";
            echo "<td>" . $row['session_id'] . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . $row['session_date'] . "</td>";
            echo "<td>" . $row['time'] . "</td>";
            echo "<td>" . " <a href='complete_feedback_session.php?sessionId=" . $row['session_id'] . "' style='margin:4px;' class='btn btn-info'>Feedback</a>". "</td>";
            echo "</tr>";
            }
            echo "</table></div>";
      
    ?>
    <p>
      
    </p>

</body>
</html>