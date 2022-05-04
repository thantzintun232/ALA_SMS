<?php 
	require 'dbconnect.php';

	$studentid=$_GET['studentid'];

	$delete="DELETE FROM student WHERE studentid='$studentid'";
	$result=mysqli_query($connection,$delete);

	if ($result) 
	{
		echo "<script>window.alert('Student Deleted Successfully!')</script>";
		echo "<script>window.location='studentlist.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Student Delete : " . mysqli_error($connection) . "</p>";
	}
 ?>