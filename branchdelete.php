<?php 
	require 'dbconnect.php';

	$branchid=$_GET['branchid'];

	$delete="DELETE FROM branch WHERE branchid='$branchid'";
	$result=mysqli_query($connection,$delete);

	if ($result) 
	{
		echo "<script>window.alert('Branch Deleted Successfully!')</script>";
		echo "<script>window.location='branchadd.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in branch Delete : " . mysqli_error($connection) . "</p>";
	}
 ?>