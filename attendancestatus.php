<?php 
	require 'dbconnect.php';
	include 'auto_ID.php';

  	if (isset($_GET['enrollmentid1'])) {

    $enrollmentid1=$_GET['enrollmentid1'];
    $datetaken = date("Y-m-d");
    $status='Present';

    $check="SELECT * FROM attendance WHERE enrollmentid='$enrollmentid1' AND attendance_date='$datetaken'";
    $result=mysqli_query($connection,$check);
    $count=mysqli_num_rows($result);

    if($count > 0) 
    {
        echo "<script>window.alert('Attendance already given!')</script>";
        echo "<script>window.location='attendanceadd.php'</script>";
    }
    else
    {
		$insert="INSERT INTO attendance
		         (attendance_date,status,enrollmentid)
		         VALUES
		         ('$datetaken','$status','$enrollmentid1')";
		$result=mysqli_query($connection,$insert);
    }

    if($result) 
    {
        echo "<script>window.alert('Present!')</script>";
        echo "<script>window.location='attendanceadd.php'</script>";
    }
    else
    {
        echo "<p>Something went wrong: " . mysqli_error($connection) . "</p>";
    }
	}

	//-------------------------

	if (isset($_GET['enrollmentid2'])) {

    $enrollmentid2=$_GET['enrollmentid2'];
    $datetaken = date("Y-m-d");
    $status='Absent';

    $check="SELECT * FROM attendance WHERE enrollmentid='$enrollmentid2' AND attendance_date='$datetaken'";
    $result=mysqli_query($connection,$check);
    $count=mysqli_num_rows($result);

    if($count > 0) 
    {
        echo "<script>window.alert('Attendance already given!')</script>";
        echo "<script>window.location='attendanceadd.php'</script>";
    }
    else
    {
		$insert="INSERT INTO attendance
		         (attendance_date,status,enrollmentid)
		         VALUES
		         ('$datetaken','$status','$enrollmentid2')";
		$result=mysqli_query($connection,$insert);
    }

    if($result) 
    {
        echo "<script>window.alert('Absent!')</script>";
        echo "<script>window.location='attendanceadd.php'</script>";
    }
    else
    {
        echo "<p>Something went wrong: " . mysqli_error($connection) . "</p>";
    }
	}

	//--------------------------

	if (isset($_GET['enrollmentid3'])) {

    $enrollmentid3=$_GET['enrollmentid3'];
    $datetaken = date("Y-m-d");
    $status='Leave';

    $check="SELECT * FROM attendance WHERE enrollmentid='$enrollmentid3' AND attendance_date='$datetaken'";
    $result=mysqli_query($connection,$check);
    $count=mysqli_num_rows($result);

    if($count > 0) 
    {
        echo "<script>window.alert('Attendance already given!')</script>";
        echo "<script>window.location='attendanceadd.php'</script>";
    }
    else
    {
		$insert="INSERT INTO attendance
		         (attendance_date,status,enrollmentid)
		         VALUES
		         ('$datetaken','$status','$enrollmentid3')";
		$result=mysqli_query($connection,$insert);
    }

    if($result) 
    {
        echo "<script>window.alert('Leave!')</script>";
        echo "<script>window.location='attendanceadd.php'</script>";
    }
    else
    {
        echo "<p>Something went wrong: " . mysqli_error($connection) . "</p>";
    }
	}
 ?>