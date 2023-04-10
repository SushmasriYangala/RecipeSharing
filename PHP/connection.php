<?php
$conn=mysqli_connect("localhost","root","","recipe");
if($conn)
{
	echo "connection established";
}
else
{
	echo "connection not established";
}


?>
