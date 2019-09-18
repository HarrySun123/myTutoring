<?php
// Include config file
require_once "config.php";
 // Initialize the session
session_start();
// Define variables and initialize with empty values
$subject = $date = $time = $session_date = $location="";
$location = $additional_info = "";
$subject_err = $time_err  = "";
$mentor_id = $_SESSION["userid"];
$mentor_name = $_SESSION["username"];

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate subject
    if(empty(trim($_POST["subject"]))){
        $subject_err = "Please enter a subject.";
    } 
    // Validate time
    if(empty(trim($_POST["time"]))){
        $time_err = "Please enter a time.";     
    } 
    $param_subject = $subject = trim($_POST["subject"]);
    $param_time =  $time = trim($_POST["time"]);
    $param_status = $status = "active";
    if(isset($_POST['mentor_id'])){
        $param_mentor_id = $mentor_id = trim($_POST["mentor_id"]);
    }
    if(isset($_POST['session_date'])){
        $param_session_date = $session_date = trim($_POST["session_date"]);
    }
    $param_location =  $location = trim($_POST["location"]);
    
    
    // Check input errors before inserting in database
    if(empty($subject_err) && empty($time_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO sessions (mentor_id, mentor_name, subject, session_date, time, location, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_mentor_id, $param_mentor_name, $param_subject, $param_session_date, $param_time, $param_location, $param_status);
            
            // Set parameters
            $param_mentor_id = $mentor_id;
            $param_subject= $subject;
            $param_time= $time;
            $param_status= $status;
            $param_session_date= $session_date;
            $param_location= $location;
            $param_mentor_name= $mentor_name;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: welcome.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
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
        <h2>Create Session </h2>
        <p>Please fill this form to create an session.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>mentor id</label>
                <input type="text" name="mentor_id" class="form-control" value="<?php echo $mentor_id; ?>">
            </div>    
            <div class="form-group <?php echo (!empty($subject_err)) ? 'has-error' : ''; ?>">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control" value="<?php echo $subject; ?>">
                <span class="help-block"><?php echo $subject_err; ?></span>
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" class="form-control" value="<?php echo $location; ?>">
            
            </div>
            <div class="form-group">
            <label>Session Date</label>
            <p><input type="text" class="form-control" name="session_date" id="datepicker" value="<?php echo $session_date; ?>" ></p>
            </div>
            <div class="form-group <?php echo (!empty($time_err)) ? 'has-error' : ''; ?>">
                <label>Time</label>
                <input type="text" name="time" class="form-control" value="<?php echo $time; ?>">
                <span class="help-block"><?php echo $time_err; ?></span>
            </div>

            


            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>