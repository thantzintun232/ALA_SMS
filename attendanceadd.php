<?php 
	require 'dbconnect.php';
	include 'header.php';

  $staffid=$_SESSION['staffid'];

	if (isset($_POST['btnsearch'])) 
	{
		$sltcourse=$_POST['sltcourse'];
    $query="SELECT c.coursename as coursename, e.enrollmentid as enrollmentid, s.studentid as studentid, s.name as name FROM course c, student s, enrollment e 
            WHERE c.courseid=e.courseid
            AND s.studentid=e.studentid
            AND c.courseid='$sltcourse'
            AND c.staffid='$staffid'";
  	$result=mysqli_query($connection,$query);
	}
  else
  {
    $query="SELECT c.coursename as coursename, e.enrollmentid as enrollmentid, s.studentid as studentid, s.name as name FROM course c, student s, enrollment e 
            WHERE c.courseid=e.courseid
            AND s.studentid=e.studentid
            AND c.staffid='$staffid'";
    $result=mysqli_query($connection,$query);
  }

 ?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Attendance</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="teacherhome.php">Home</a></li>
          <li class="breadcrumb-item active">Add Attendance</li>
          <li class="breadcrumb-item"><a href="attendancecourse.php">Course Attendance</a></li>
          <li class="breadcrumb-item"><a href="attendancestudent.php">Student Attendance</a></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title">Select Course:</h5>

            <form class="row g-3" action="attendanceadd.php" method="post">
                <div class="col-12">
                    <select class="form-select" aria-label="Default select example" name="sltcourse">
                      <?php 
                        $coursedata="SELECT c.*, l.languagename as languagename FROM course c, language l, staff s WHERE c.languageid=l.languageid AND c.staffid=s.staffid AND c.staffid='$staffid'";
                        $cresult=mysqli_query($connection,$coursedata);
                        $ccount=mysqli_num_rows($cresult);

                        for ($i=0; $i <$ccount ; $i++) { 
                          $row=mysqli_fetch_array($cresult);
                          $courseid=$row['courseid'];
                          $coursename=$row['coursename'];
                          $languagename=$row['languagename'];

                          echo "<option value='$courseid'>$languagename - $coursename</option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btnsearch">Search</button>
                  <button type="reset" class="btn btn-secondary" name="btnreset">Cancel</button>
                </div>                
            </form>
            </div>
          </div>
        </div>
      </div>
    </section> 

  <?php 
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
              <h5 class="card-title">Total Student: <?php echo $count ?> <span style="color: red;">(Today's Date : <?php echo $todaysDate = date("m-d-Y");?>)</span></h5>
              <div class="table-responsive">
              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>StudentID</th>
                    <th>Name</th>
                    <th>CourseName</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
        				<?php 
        				$a=1; 
        				for($i=0;$i<$count;$i++) 
        				{ 
    					  $rows=mysqli_fetch_array($result);
    					  $enrollmentid=$rows['enrollmentid'];
                $coursename=$rows['coursename'];
    					  $studentid=$rows['studentid'];
    					  $name=$rows['name'];	
      				?>
		        		<tr>
		                  <th><?php echo $a++ ?></th>
		                  <td><?php echo $studentid ?></td>
		                  <td><?php echo $name ?></td>
                      <td><?php echo $coursename ?></td>
		                  <td>
		                      <a href="attendancestatus.php?enrollmentid1=<?=$enrollmentid?>"class="btn btn-outline-success">Present</a>
                          <a href="attendancestatus.php?enrollmentid2=<?=$enrollmentid?>"class="btn btn-outline-danger">Absent</a>
                          <a href="attendancestatus.php?enrollmentid3=<?=$enrollmentid?>"class="btn btn-outline-info">Leave</a>
		                	</td>
		                </tr>
		                <?php } ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
<?php } ?>
</main><!-- End #main -->
<?php 
 	include 'footer.php';
?>