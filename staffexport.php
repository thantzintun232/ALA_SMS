<?php
include 'dbconnect.php'; 

if (isset($_POST['csvexport'])) {
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=stafflist.csv');
	$output= fopen("php://output", "w");
	fputcsv($output, array('StaffID','Name','Gender','DOB','NRC','Address','Phone','Email','Entry Date','Basic Salary'));
	$query="SELECT staffid,name,gender,dob,nrc,address,phone,email,entrydate,basicsalary FROM staff";
	$result=mysqli_query($connection,$query);
	while ($row=mysqli_fetch_assoc($result)) {
		fputcsv($output, $row);
	}
	fclose($output);
}
?>