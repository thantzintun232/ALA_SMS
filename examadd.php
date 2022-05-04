<?php 
 	require 'dbconnect.php';
 	include 'header.php';

  $staffid=$_SESSION['staffid'];

 	if (isset($_POST['btnsubmit'])) {
 	$txtexamname=$_POST['txtexamname'];
  $txtdate=$_POST['txtdate'];
  $txtmin=$_POST['txtmin'];
  $txtmax=$_POST['txtmax'];
  $sltcourse=$_POST['sltcourse'];
  $txtstatus='Active';

  $check="SELECT * FROM exam WHERE courseid='$sltcourse' AND status='Active'";
  $result=mysqli_query($connection,$check);
  $count=mysqli_num_rows($result);

  if ($count>0) {
    echo "<script>window.alert('Exam already exit!')</script>";
    echo "<script>window.location='examadd.php'</script>";
  }

  else {

	$insert="INSERT INTO exam (examname,exam_date,min_mark,max_mark,status,courseid) VALUES ('$txtexamname','$txtdate','$txtmin','$txtmax','$txtstatus','$sltcourse')";
	$result=mysqli_query($connection,$insert);

	if ($result) {
		echo "<script>window.alert('Exam Added Successfully!')</script>";
		echo "<script>window.location='examadd.php'</script>";
	}

	else{
		echo "<p>Something went wrong in Exam Entry : " . mysqli_error($connection) . "</p>";
	}
}
}
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Exam</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="teacherhome.php">Home</a></li>
          <li class="breadcrumb-item active">Add Exam</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Exam Register</h5>

              <form class="row g-3" action="examadd.php" method="post">
                <div class="col-12">
                  <label for="examname" class="form-label">Exam Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="examname" name="txtexamname" placeholder="Enter Exam Name" required="">
                </div>

                <div class="col-12">
                  <label for="date" class="form-label">Date <span style="color: red;">*</span></label>
                  <input type="date" class="form-control" id="date" name="txtdate" required="">
                </div>

                <div class="col-12">
                  <label for="min" class="form-label">Minimum Mark</label>
                  <input type="number" class="form-control" id="min" name="txtmin">
                </div>

                <div class="col-12">
                  <label for="max" class="form-label">Maximum Mark</label>
                  <input type="number" class="form-control" id="max" name="txtmax">
                </div>

                <div class="col-12">
                  <label for="course" class="form-label">Course <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="course" name="sltcourse" required="">
                      <option>-- Select Course --</option>
                      <?php 
                        $coursedata="SELECT c.*, l.languagename as languagename FROM course c, language l, staff s WHERE c.languageid=l.languageid AND s.staffid=c.staffid AND s.staffid='$staffid'";
                        $result=mysqli_query($connection,$coursedata);
                        $count=mysqli_num_rows($result);

                        for ($i=0; $i <$count ; $i++) { 
                          $row=mysqli_fetch_array($result);
                          $courseid=$row['courseid'];
                          $coursename=$row['coursename'];
                          $languagename=$row['languagename'];

                          echo "<option value='$courseid'>$languagename - $coursename</option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btnsubmit">Submit</button>
                  <button type="reset" class="btn btn-secondary" name="btnreset">Reset</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>


 	<?php 
 	$query="SELECT e.*, c.coursename as coursename FROM exam e, course c, staff s WHERE e.courseid=c.courseid AND c.staffid=s.staffid AND s.staffid='$staffid' AND e.status='Active'";
	$result=mysqli_query($connection,$query);
	$count=mysqli_num_rows($result);

	if($count<1){
		echo "<p>No Record Found!</p>";
	}
	else{
	?>
	<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Exam List</h5>

              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>Exam</th>
                    <th>Date</th>
                    <th>Min Mark</th>
                    <th>Max Mark</th>
                    <th>Course</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
        				<?php 
        				$a=1; 
        				for($i=0;$i<$count;$i++) 
        				{ 
        					$rows=mysqli_fetch_array($result);
        					$examid=$rows['examid'];
        					$examname=$rows['examname'];
                  $date=$rows['exam_date'];
                  $examdate=date("M d, Y",strtotime($date));
                  $min=$rows['min_mark'];
                  $max=$rows['max_mark'];
                  $course=$rows['coursename'];
        				?>
        				<tr>
                    <th><?php echo $a?></th>
                    <td><?php echo $examname ?></td>
                    <td><?php echo $examdate ?></td>
                    <td><?php echo $min ?></td>
                    <td><?php echo $max ?></td>
                    <td><?php echo $course ?></td>
                    <td>
                        <a href="examstatus.php?examid=<?=$examid?>" class="btn btn-danger">Finished</a>
                 	  </td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </section>
  <?php } ?>
</main><!-- End #main -->

<?php include 'footer.php' ?>