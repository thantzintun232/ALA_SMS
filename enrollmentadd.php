<?php 
 	require 'dbconnect.php';
 	include 'header.php';

 	if (isset($_POST['btnsubmit'])) {
    $txtenrollmentid=$_POST['txtenrollmentid'];
 		$sltstudent=$_POST['sltstudent'];
 		$sltcourse=$_POST['sltcourse'];

 		$insert="INSERT INTO enrollment (enrollmentid,studentid,courseid) VALUES ('$txtenrollmentid','$sltstudent','$sltcourse')";
 		$result=mysqli_query($connection,$insert);

 		if ($result) {
 			echo "<script>window.alert('Enrollment Added Successfully!')</script>";
 			echo "<script>window.location='enrollmentadd.php'</script>";
 		}

 		else{
 			echo "<p>Something went wrong in Enrollment Entry : " . mysqli_error($connection) . "</p>";
 		}
 	}

  //----------------
  if (isset($_POST['btnsearch'])) 
  {
    $sltcoursename=$_POST['sltcoursename'];
    $txtstudentname=$_POST['txtstudentname'];

    $QUERY="SELECT r.*, s.studentid as studentid,s.name as studentname, c.coursename as coursename, l.languagename as languagename FROM result r, student s, exam e, course c, language l
              WHERE r.studentid=s.studentid
              AND r.examid=e.examid
              AND e.courseid=c.courseid
              AND c.languageid=l.languageid
              AND e.courseid='$sltcoursename'
              AND s.name='$txtstudentname'";
    $RESULT=mysqli_query($connection,$QUERY);
  }

  else
  {
    $QUERY="SELECT r.*, s.studentid as studentid,s.name as studentname, e.examname as examname, c.coursename as coursename, l.languagename as languagename FROM result r, student s, exam e, course c, language l
              WHERE r.studentid=s.studentid
              AND r.examid=e.examid
              AND e.courseid=c.courseid
              AND c.languageid=l.languageid
              AND s.studentid='null'";
    $RESULT=mysqli_query($connection,$QUERY);
  }
?>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Enrollment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Add Enrollment</li>
          <li class="breadcrumb-item"><a href="enrollmentsearch.php">Search Enrollment</a></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Enrollment Register</h5>

            <form class="row g-3" action="enrollmentadd.php" method="post">
                <div class="col-12">
                  <label for="enrollment" class="form-label">Enrollment ID <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtenrollmentid" value="<?php echo AutoID('enrollment','enrollmentid','E-',6)?>" readonly>
                </div>

                <div class="col-12">
                  <label for="student" class="form-label">Student <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="student" name="sltstudent">
                      <option>-- Select Student --</option>
                      <?php 
                        $studentdata="SELECT * FROM student";
                        $result=mysqli_query($connection,$studentdata);
                        $count=mysqli_num_rows($result);

                        for ($i=0; $i <$count ; $i++) { 
                          $row=mysqli_fetch_array($result);
                          $studentid=$row['studentid'];
                          $studentname=$row['name'];
                          $email=$row['email'];

                          echo "<option value='$studentid'> $studentname ( $email )</option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="col-12">
                  <label for="course" class="form-label">Course <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="course" name="sltcourse">
                      <option>-- Select Course --</option>
                      <?php 
                        $coursedata="SELECT c.*, l.languagename as languagename FROM course c INNER JOIN language l ON c.languageid=l.languageid";
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
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Search Student Result:</h5>

            <form class="row g-3" action="enrollmentadd.php" method="post">
                <div class="col-6 ">
                    <select class="form-select" aria-label="Default select example" id="course" name="sltcoursename" required="">
                      <option>-- Choose Course --</option>
                      <?php 
                        $coursedata="SELECT c.*, l.languagename as languagename FROM course c, language l WHERE c.languageid=l.languageid";
                        $cresult=mysqli_query($connection,$coursedata);
                        $ccount=mysqli_num_rows($cresult);

                        for ($i=0; $i <$ccount ; $i++) { 
                          $row=mysqli_fetch_array($cresult);
                          $courseid=$row['courseid'];
                          $coursename=$row['coursename'];
                          $languagename=$row['languagename'];

                          echo "<option value='$courseid'>$coursename - $languagename</option>";
                        }
                       ?>                       
                    </select>               
                </div>  

                <div class="col-6"> 
                  <input type="text" class="form-control" name="txtstudentname" placeholder="Enter Student Name" required="">              
                </div>          

                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btnsearch">Search</button>
                  <button type="reset" class="btn btn-secondary" name="btnreset">Reset</button>
                </div>                
            </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php 
  $count=mysqli_num_rows($RESULT);

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
              <form action="resultexport.php" method="post">
                <h5 class="card-title">Result</h5>
              </form>
              <div class="table-responsive">
              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>StudentID</th>
                    <th>Name</th>
                    <th>Student Mark</th>
                    <th>Course</th>
                    <th>Language</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $a=1;
                for($i=0;$i<$count;$i++) 
                { 
                  $rows=mysqli_fetch_array($RESULT);
                  $resultid=$rows['resultid'];
                  $studentid=$rows['studentid'];
                  $name=$rows['studentname'];
                  $mark=$rows['mark'];
                  $status=$rows['status'];
                  $coursename=$rows['coursename']; 
                  $languagename=$rows['languagename']; 
                ?>
              <tr>
                <th><?php echo $a++ ?></th>
                <th><?php echo $studentid ?></th>
                <td><?php echo $name; ?></td>
                <td><?php echo $mark ?></td>
                <td><?php echo $coursename ?></td>
                <td><?php echo $languagename ?></td>
                <th><?php echo $status ?></th>
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
<?php 
 	include 'footer.php';
?>