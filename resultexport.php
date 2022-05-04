<?php
include 'dbconnect.php'; 

if (isset($_POST['resultexport'])) {
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=result list.csv');
	$output= fopen("php://output", "w");
	fputcsv($output, array('StudentID','Name','Mark','Exam','Course','Language','Status'));
	$query="SELECT s.studentid, s.name, r.mark, e.examname, c.coursename, l.languagename, r.status FROM result r, student s, course c, language l, exam e WHERE r.examid=e.examid AND r.studentid=s.studentid AND e.courseid=c.courseid AND c.languageid=l.languageid";
	$result=mysqli_query($connection,$query);
	while ($row=mysqli_fetch_assoc($result)) {
		fputcsv($output, $row);
	}
	fclose($output);
}
?>