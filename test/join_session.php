<?php
// Initialize the sessio
session_start();
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./join_session.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>

</head>
<body>
    <div class="page-header">
        <h2>Please search and join a session.</h2>
    </div>
    <form class="example"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" placeholder="Search.." name="searchText">
        <button type="submit"><i class="fa fa-search"></i></button>
        <a href="welcome.php" class="btn btn-danger">Back to main</a>
    </form>
    <?php
    $searchText = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $param_searchText = $searchText = trim($_POST["searchText"]);

        require_once "config.php";
        $param_userid = $_SESSION["userid"];
        $result = mysqli_query($link,"SELECT * FROM sessions WHERE subject like '%" . $param_searchText ."%'");

        echo "<div><table border='1' style='margin-left:300px;width:60%;margin-top:12px;margin-bottom:12px;'>
            <tr>
            <th>Mentor name</th>
            <th>Subject</th>
            <th>Location</th>
            <th>Date</th>
            <th>Time</th>
            <th>Action</th>
            </tr>";

            while($row = mysqli_fetch_array($result))
            {
            echo "<tr>";
            echo "<td>" . $row['mentor_name'] . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . $row['session_date'] . "</td>";
            echo "<td>" . $row['time'] . "</td>";
            echo "<td>" . " <a href='complete_join_session.php?sessionId=" . $row['session_id'] . "' style='margin:4px;' class='btn btn-info'>Join Session</a>". "</td>";
            echo "</tr>";
            }
            echo "</table></div>";
        }
    ?>
    <p>
      
    </p>

</body>
</html>