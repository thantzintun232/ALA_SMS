<?php 
	require 'dbconnect.php';

	$timetableid=$_GET['timetableid'];
	$status="Inactive";

	$update="UPDATE timetable SET status='$status' WHERE id='$timetableid'";
 	$result=mysqli_query($connection,$update);

	if ($result) 
	{
		echo "<script>window.alert('Timetable Removed Successfully!')</script>";
		echo "<script>window.location='timetableadd.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in timetable remove : " . mysqli_error($connection) . "</p>";
	}
 ?>