<?php 
	require 'dbconnect.php';

	$resultid=$_GET['resultid'];

	$delete="DELETE FROM result WHERE resultid='$resultid'";
	$result=mysqli_query($connection,$delete);

	if ($result) 
	{
		echo "<script>window.confirm('Result Deleted Successfully!')</script>";
		echo "<script>window.location='resultadd.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Result Delete : " . mysqli_error($connection) . "</p>";
	}
 ?>