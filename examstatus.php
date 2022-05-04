<?php 
	require 'dbconnect.php';

	$examid=$_GET['examid'];
	$status="Inactive";

	$update="UPDATE exam SET status='$status' WHERE examid='$examid'";
 	$result=mysqli_query($connection,$update);

	if ($result) 
	{
		echo "<script>window.alert('Exam successfully removed!')</script>";
		echo "<script>window.location='examadd.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in exam remove : " . mysqli_error($connection) . "</p>";
	}
 ?>