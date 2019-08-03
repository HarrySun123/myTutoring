<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$userid = $password = $confirm_password = "";
$username = $useryear = $useremail = $userrole = $usertutorgroup = "";
$userid_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate userid
    if(empty(trim($_POST["userid"]))){
        $userid_err = "Please enter a userid.";
    } else{
        // Prepare a select statement
        $sql = "SELECT user_id FROM users WHERE user_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_userid);
            
            // Set parameters
            $param_userid = trim($_POST["userid"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $userid_err = "This id is already taken.";
                } else{
                    $userid = trim($_POST["userid"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must have atleast 8 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    $param_username = $username = trim($_POST["username"]);
    $param_usertutorgroup =  $usertutorgroup = trim($_POST["usertutorgroup"]);
    $param_useryear = $useryear = trim($_POST["useryear"]);
    $param_useremail = $useremail = trim($_POST["useremail"]);
    $param_userrole = $userrole = trim($_POST["userrole"]);
    // Check input errors before inserting in database
    if(empty($userid_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (user_id, user_name, user_password, user_year, user_email, user_role, user_tutor_group) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_userid, $param_username, $param_password, $param_useryear, $param_useremail, $param_userrole, $param_usertutorgroup);
            
            // Set parameters
            $param_userid = $userid;
            $param_username= $username;
            $param_useryear= $useryear;
            $param_useremail= $useremail;
            $param_userrole= $userrole;
            $param_usertutorgroup= $usertutorgroup;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($userid_err)) ? 'has-error' : ''; ?>">
                <label>userid</label>
                <input type="text" name="userid" class="form-control" value="<?php echo $userid; ?>">
                <span class="help-block"><?php echo $userid_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            </div>    
            <div class="form-group">
                <label>User year</label>
                <input type="text" name="useryear" class="form-control" value="<?php echo $useryear; ?>">
            </div>    
            <div class="form-group">
                <label>User email</label>
                <input type="text" name="useremail" class="form-control" value="<?php echo $useremail; ?>">
            </div>    
            <div class="form-group">
                <label>User role</label>
                <input type="text" name="userrole" class="form-control" value="<?php echo $userrole; ?>">
            </div>    
            <div class="form-group">
                <label>Tutor group</label>
                <input type="text" name="usertutorgroup" class="form-control" value="<?php echo $usertutorgroup; ?>">
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