<?php 
	require 'dbconnect.php';

	$enrollmentid=$_GET['enrollmentid'];

	$delete="DELETE FROM enrollment WHERE enrollmentid='$enrollmentid'";
	$result=mysqli_query($connection,$delete);

	if ($result) 
	{
		echo "<script>window.alert('Enrollment Deleted Successfully!')</script>";
		echo "<script>window.location='enrollmentsearch.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Enrollment Delete : " . mysqli_error($connection) . "</p>";
	}
 ?>