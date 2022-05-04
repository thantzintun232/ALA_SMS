<?php 
	require 'dbconnect.php';

	$assignmentdetailid=$_GET['assignmentdetailid'];
	$status="Graded";

	$update="UPDATE assignmentdetail SET status='$status' WHERE assignmentdetailid='$assignmentdetailid'";
 	$result=mysqli_query($connection,$update);

	if ($result) 
	{
		// echo "<script>window.alert('T!')</script>";
		echo "<script>window.location='studentassignmentlist.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in student assignment status : " . mysqli_error($connection) . "</p>";
	}
 ?>