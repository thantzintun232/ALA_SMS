<?php 
	require 'dbconnect.php';

	$roomid=$_GET['roomid'];

	$delete="DELETE FROM room WHERE roomid='$roomid'";
	$result=mysqli_query($connection,$delete);

	if ($result) 
	{
		echo "<script>window.alert('Room Deleted Successfully!')</script>";
		echo "<script>window.location='roomadd.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Room Delete : " . mysqli_error($connection) . "</p>";
	}
 ?>