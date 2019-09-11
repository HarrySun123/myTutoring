<?php
// Include config file
require_once "config.php";
 // Initialize the session
session_start();

$feedback_err  = "";
$feedback = $sessionId ="";
$mentor_id = $_SESSION["userid"];
if($_SERVER["REQUEST_METHOD"] != "POST"){
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    $_SESSION["sessionId"]= $queries['sessionId'];
}


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate feedback
    if(empty(trim($_POST["feedback"]))){
        $feedback_err = "Please enter feedback.";
    }  
    
    if(empty($feedback_err)){
        $sessionId = $_SESSION["sessionId"];
        $feedback = $_POST["feedback"];

        if($_SESSION["userrole"] == "mentor") {
            $sql = "UPDATE sessions SET mentor_feedback ='" . $feedback . "' WHERE session_id =" . $sessionId;
            mysqli_query($link, $sql);
        }else {
            $sql = "UPDATE sessions SET mentee_feedback ='" . $feedback . "' WHERE session_id =" . $sessionId;
            mysqli_query($link, $sql);
        }
         
            
        // Close connection
        mysqli_close($link);
        header("location: welcome.php");
    }

}
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
        <h2>Feedback from  <?php echo htmlspecialchars($_SESSION["userid"] );?></h2>
        <p>Please fill your feedback for the session.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">   
            <div class="form-group <?php echo (!empty($subject_err)) ? 'has-error' : ''; ?>">
                <label>Feedback</label>
                <textarea name="feedback" rows="4" cols="50"></textarea>
                <span class="help-block"><?php echo $feedback_err; ?></span>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
          
        </form>
    </div>    
</body>
</html>