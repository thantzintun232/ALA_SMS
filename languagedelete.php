<?php 
	require 'dbconnect.php';

	$languageid=$_GET['languageid'];

	$delete="DELETE FROM language WHERE languageid='$languageid'";
	$result=mysqli_query($connection,$delete);

	if ($result) 
	{
		echo "<script>window.alert('Language Deleted Successfully!')</script>";
		echo "<script>window.location='languageadd.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Language Delete : " . mysqli_error($connection) . "</p>";
	}
 ?>