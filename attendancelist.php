<?php 
	require 'dbconnect.php';
	include 'header.php';

	if (isset($_POST['btnsearch'])) 
	{
		$sltcourse=$_POST['sltcourse'];
    $txtdate=$_POST['txtdate'];
    $query="SELECT c.coursename as coursename,l.languagename as languagename, a.attendance_date as attendance_date , a.status as status,s.studentid as studentid, s.name as name FROM course c, student s, enrollment e, attendance a, language l 
            WHERE c.courseid=e.courseid
            AND s.studentid=e.studentid
            AND a.enrollmentid=e.enrollmentid
            AND c.languageid=l.languageid
            AND c.courseid='$sltcourse'
            AND a.attendance_date='$txtdate'";
  	$result=mysqli_query($connection,$query);

    $query1="SELECT * FROM course WHERE courseid='$sltcourse'";
    $result1=mysqli_query($connection,$query1);
    $row1=mysqli_fetch_array($result1);
	}
  else
  {
    $query="SELECT c.coursename as coursename,l.languagename as languagename, a.attendance_date as attendance_date , a.status as status,s.studentid as studentid, s.name as name FROM course c, student s, enrollment e, attendance a, language l 
            WHERE c.courseid=e.courseid
            AND s.studentid=e.studentid
            AND a.enrollmentid=e.enrollmentid
            AND c.languageid=l.languageid
            AND a.attendance_date=null";
    $result=mysqli_query($connection,$query);
  }
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Attendance</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Student Attendance</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title">Select Course and Date: <span style="color: red;">Note: Please select course and date </span></h5>

            <form class="row g-3" action="attendancelist.php" method="post">
                <div class="col-6">
                    <select class="form-select" aria-label="Default select example" name="sltcourse"required>
                      <?php 
                        $coursedata="SELECT c.*, l.languagename as languagename FROM course c, language l WHERE c.languageid=l.languageid";
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

                <div class="col-6">
                  <input type="date" class="form-control" name="txtdate" required="" />              
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
              <h5 class="card-title"><?php echo $row1['coursename'] ?> Course</h5>
              <div class="table-responsive">
              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>StudentID</th>
                    <th>Name</th>
                    <th>CourseName</th>
                    <th>Language</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
        				<?php 
        				$a=1; 
        				for($i=0;$i<$count;$i++) 
        				{ 
                $rows=mysqli_fetch_array($result);
                $coursename=$rows['coursename'];
    					  $studentid=$rows['studentid'];
    					  $name=$rows['name'];	
                $attendancedate=$rows['attendance_date'];
                $attdate=date("M d, Y",strtotime($attendancedate)); 
                $status=$rows['status'];
                $languagename=$rows['languagename'];
      				?>
		        		<tr>
		                  <th><?php echo $a++ ?></th>
		                  <th><?php echo $studentid ?></th>
		                  <td><?php echo $name ?></td>
                      <td><?php echo $coursename ?></td>
                      <td><?php echo $languagename ?></td>
                      <td><?php echo $attdate; ?></td>
		                  <th><?php echo $status ?></th>
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