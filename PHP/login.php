<?php
include("connection.php");
extract($_POST);
if(isset($_POST['signin']))
{	 
     $firstname = $_POST['firstname'];
	 $lastname = $_POST['lastname'];
	 $email = $_POST['email'];
	 $password = $_POST['password'];
	 $sql = "INSERT INTO users (firstname,lastname,email,password)
	 VALUES ('$firstname','$lastname','$email','$password')";
	 if (mysqli_query($conn, $sql)) {
		echo "New record created successfully !";
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>