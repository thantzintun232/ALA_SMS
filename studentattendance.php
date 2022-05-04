<?php 
	require 'dbconnect.php';
	include 'studentheader.php';

  $studentid=$_SESSION['studentid'];
  $query="SELECT c.coursename as coursename, a.attendance_date as attendance_date , a.status as status,s.studentid as studentid, s.name as name FROM course c, student s, enrollment e, attendance a 
          WHERE c.courseid=e.courseid
          AND s.studentid=e.studentid
          AND a.enrollmentid=e.enrollmentid
          AND s.studentid='$studentid'";
	$result=mysqli_query($connection,$query);

  $query1="SELECT s.name as name, c.coursename as coursename FROM course c, student s, enrollment e, attendance a 
          WHERE c.courseid=e.courseid
          AND s.studentid=e.studentid
          AND a.enrollmentid=e.enrollmentid
          AND s.studentid='$studentid'";
  $result1=mysqli_query($connection,$query1);
  $count1=mysqli_num_rows($result1);
  $row1=mysqli_fetch_array($result1);

  $query2="SELECT * FROM course c, student s, enrollment e, attendance a 
          WHERE c.courseid=e.courseid
          AND s.studentid=e.studentid
          AND a.enrollmentid=e.enrollmentid
          AND s.studentid='$studentid'
          AND a.status='Present'";
  $result2=mysqli_query($connection,$query2);
  $count2=mysqli_num_rows($result2);
  $row2=mysqli_fetch_array($result2);

  $query3="SELECT * FROM course c, student s, enrollment e, attendance a 
          WHERE c.courseid=e.courseid
          AND s.studentid=e.studentid
          AND a.enrollmentid=e.enrollmentid
          AND s.studentid='$studentid'
          AND a.status='Absent'";
  $result3=mysqli_query($connection,$query3);
  $count3=mysqli_num_rows($result3);
  $row3=mysqli_fetch_array($result3);

  $query4="SELECT * FROM course c, student s, enrollment e, attendance a 
          WHERE c.courseid=e.courseid
          AND s.studentid=e.studentid
          AND a.enrollmentid=e.enrollmentid
          AND s.studentid='$studentid'
          AND a.status='Leave'";
  $result4=mysqli_query($connection,$query4);
  $count4=mysqli_num_rows($result4);
  $row4=mysqli_fetch_array($result4);

  $total=($count2/$count1)*(100/100);
  $per=ceil($total*100);
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>My Attendance</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="studenthome.php">Home</a></li>
          <li class="breadcrumb-item active">My Attendance</li>
        </ol>
      </nav>
    </div>

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
              <h5 class="card-title">Student Attendance</h5>
              <div>
                <table class="table">
                  <tr>
                    <td class="col-2">Course Name:</td>
                    <td class="col-10"><b><?php echo $row1['coursename'] ?></b></td>
                  </tr>
                  <tr>
                    <td class="col-2">Student Name:</td>
                    <td class="col-10"><b><?php echo $row1['name'] ?></b></td>
                  </tr>
                  <tr>
                    <td class="col-2">Completed:  </td>
                    <td class="col-10"><b><?php echo $count1 ?></b></td>
                  </tr>
                  <tr>
                    <td class="col-2">Present:  </td>
                    <td class="col-10"><b><?php echo $count2 ?></b></td>
                  </tr>
                  <tr>
                    <td class="col-2">Absent:  </td>
                    <td class="col-10"><b><?php echo $count3 ?></b></td>
                  </tr>
                  <tr>
                    <td class="col-2">Leave:  </td>
                    <td class="col-10"><b><?php echo $count4 ?></b></td>
                  </tr>
                  <tr>
                    <td class="col-2">Percent:  </td>
                    <td class="col-10"><b><?php echo $per ?> %</b></td>
                  </tr>

                </table>
                <!-- <p><i>Course Name -</i> <b><?php echo $row1['coursename'] ?></b><br>
                   <i>Student Name -</i> <b><?php echo $row1['name'] ?></b><br>
                   <i>Completed -</i> <b><?php echo $count1 ?></b><br>
                   <i>Present -</i> <b><?php echo $count2 ?></b><br>
                   <i>Absent -</i> <b><?php echo $count3 ?></b><br>
                   <i>Leave -</i> <b><?php echo $count4 ?></b><br>
                   <i>Percent -</i> <b><?php echo $per ?>%</b><br>
                </p> -->

              </div>

              <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>StudentID</th>
                    <th>Name</th>
                    <th>CourseName</th>
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
      				?>
		        		<tr>
		                  <th><?php echo $a++ ?></th>
		                  <td><?php echo $studentid ?></td>
		                  <td><?php echo $name ?></td>
                      <td><?php echo $coursename ?></td>
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