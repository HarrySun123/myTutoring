<html>
    <head>
        <title>PHP insertion</title>
        <link rel="stylesheet" href="css/insert.css" />
    </head>
    <body>
		<div class="maindiv">
		<!--HTML form -->
			<div class="form_div">
				<div class="title"><h2>Insert Data In Database Using PHP.</h2></div>

				<form action="insert.php" method="post">    <!-- method can be set POST for hiding values in URL-->
					<h2>Form</h2>
					<label>Name:</label>
					<br />
					<input class="input" type="text" name="name" value="" />
					<br />
					<label>Email:</label><br />
					<input class="input" type="text" name="email" value="" />
					<br />
					<label>Contact:</label><br />
					<input class="input" type="text" name="contact" value="" />
					<br />
					<label>Address:</label><br />
					<textarea rows="5" cols="25" name="address"></textarea>
					<br />
					<input class="submit" type="submit" name="submit" value="Insert" />

<?php
	//Establishing Connection with Server
	$connection = mysqli_connect("localhost", "root", "");

	//Selecting Database from Server
	$db = mysqli_select_db( $connection, "colleges");
	if(isset($_POST['submit'])){

	//Fetching variables of the form which travels in URL

    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    if($name !=''||$email !=''){
	//Insert Query of SQL
    $query = mysqli_query($connection, "insert into students(student_name, student_email, student_contact, student_address) values ('$name', '$email', '$contact', '$address')");
    $queryText = "insert into students(student_name, student_email, student_contact, student_address) values ('$name', '$email', '$contact', '$address')";
    echo "<br/><br/>query is: '$queryText'";

	echo "<br/><br/><span>Data Inserted successfully...!!</span>";
    }
    else{
    echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";
    }

	}
	//Closing Connection with Server
	mysqli_close($connection);
?>
				</form>
			</div>

    </body>
</html>
