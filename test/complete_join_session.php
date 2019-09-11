<?php
// Include config file
require_once "config.php";
 // Initialize the session
session_start();
// Define variables and initialize with empty values
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

$sessionId = $queries['sessionId'];

$mentee_id = $_SESSION["userid"];

$sql = "UPDATE sessions SET mentee_id =" . $mentee_id . " WHERE session_id =" . $sessionId;
         
mysqli_query($link, $sql);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
</head>
<body>
    <div class="wrapper">
        <h2>Join Session  </h2>
        <p>You have successfully joined a session.</p>
        <p>
        <a href="welcome.php" class="btn btn-danger">Back to main</a>
    </p>
    </div>    
</body>
</html>