<?php 
	require 'dbconnect.php';

	$staffid=$_GET['staffid'];

	$delete="DELETE FROM staff WHERE staffid='$staffid'";
	$result=mysqli_query($connection,$delete);

	if ($result) 
	{
		echo "<script>window.alert('Staff Deleted Successfully!')</script>";
		echo "<script>window.location='stafflist.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Staff Delete : " . mysqli_error($connection) . "</p>";
	}
 ?>