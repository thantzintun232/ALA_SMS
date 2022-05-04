<?php 
	require 'dbconnect.php';

	$courseid=$_GET['courseid'];
	$status="Inactive";

	$update="UPDATE course SET 
            status='$status'
            WHERE courseid='$courseid'";
	$result=mysqli_query($connection,$update);

	if ($result) 
	{
		echo "<script>window.confirm('Course Deleted Successfully!')</script>";
		echo "<script>window.location='coursesearch.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Course Delete : " . mysqli_error($connection) . "</p>";
	}
 ?>