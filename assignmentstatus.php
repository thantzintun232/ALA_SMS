<?php 
	require 'dbconnect.php';

	$assignmentid=$_GET['assignmentid'];
	$status="Inactive";

	$update="UPDATE assignment SET status='$status' WHERE assignmentid='$assignmentid'";
 	$result=mysqli_query($connection,$update);

	if ($result) 
	{
		// echo "<script>window.alert('T!')</script>";
		echo "<script>window.location='assignmentadd.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in assignment remove : " . mysqli_error($connection) . "</p>";
	}
 ?>