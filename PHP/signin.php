<?php
include("connection.php");
extract($_POST);
if(isset($_POST['signin']))
{	 
     $firstname = $_POST['firstname'];
	 $lastname = $_POST['lastname'];
	 $email = $_POST['email'];
	 $password = $_POST['password'];
	 $password_hash = password_hash($password, PASSWORD_DEFAULT);
	 $sql = "INSERT INTO users (firstname,lastname,email,password_hash)
	 VALUES ('$firstname','$lastname','$email','$password_hash')";
	 if (mysqli_query($conn, $sql)) {
		echo "New record created successfully !";
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>