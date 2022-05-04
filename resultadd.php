<?php 
 	require 'dbconnect.php';
 	include 'header.php';

  $staffid=$_SESSION['staffid'];
 	if (isset($_POST['btnsubmit'])) {
 		$sltstudent=$_POST['sltstudent'];
 		$sltexam=$_POST['sltexam'];
    $txtmark=$_POST['txtmark'];

    $check="SELECT * FROM result WHERE examid='$sltexam' AND studentid='$sltstudent'";
    $result=mysqli_query($connection,$check);
    $count=mysqli_num_rows($result);

    if ($count>0) {
      echo "<script>window.alert('Result Already Exist!')</script>";
      echo "<script>window.location='resultadd.php'</script>";
    }

    else {

      $check2="SELECT * FROM exam WHERE examid='$sltexam'";
      $result2=mysqli_query($connection,$check2);
      $row=mysqli_fetch_array($result2);

      if ($txtmark >= $row['min_mark'] && $txtmark <= $row['max_mark']) {
        $rdostatus="Pass";
      
        $insert="INSERT INTO result (mark,status,studentid,examid) VALUES ('$txtmark','$rdostatus','$sltstudent','$sltexam')";
        $result=mysqli_query($connection,$insert);

        if ($result) {
          echo "<script>window.alert('Result Added Successfully!')</script>";
          echo "<script>window.location='resultadd.php'</script>";
        }

        else{
          echo "<p>Something went wrong in Result Add : " . mysqli_error($connection) . "</p>";
        }
      } 

      else if ($txtmark < $row['min_mark'] && $txtmark >= 0) {
        $rdostatus="Fail";
      
        $insert="INSERT INTO result (mark,status,studentid,examid) VALUES ('$txtmark','$rdostatus','$sltstudent','$sltexam')";
        $result=mysqli_query($connection,$insert);

        if ($result) {
          echo "<script>window.alert('Result Added Successfully!')</script>";
          echo "<script>window.location='resultadd.php'</script>";
        }

        else{
          echo "<p>Something went wrong in Result Add : " . mysqli_error($connection) . "</p>";
        }
      }  

      else {
        echo "<script>window.alert('The result must be between the range of 0 to 100')</script>";
      }		
 	  }
  }
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Result</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="teacherhome.php">Home</a></li>
          <li class="breadcrumb-item active">Add Result</li>
          <li class="breadcrumb-item"><a href="resultsearch.php">Search Result</a></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title text-center">Add Result</h5>

            <form class="row g-3" action="resultadd.php" method="post">
                <div class="col-12">
                  <label for="student" class="form-label">Student <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="student" name="sltstudent">
                      <option>-- Select Student --</option>
                      <?php 
                        $studentdata="SELECT s.* FROM student s, enrollment e, course c, staff st WHERE s.studentid=e.studentid AND c.courseid=e.courseid AND c.staffid=st.staffid AND st.staffid='$staffid'";
                        $sresult=mysqli_query($connection,$studentdata);
                        $scount=mysqli_num_rows($sresult);

                        for ($i=0; $i <$scount ; $i++) { 
                          $row=mysqli_fetch_array($sresult);
                          $studentid=$row['studentid'];
                          $name=$row['name'];

                          echo "<option value='$studentid'>$studentid - $name</option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="col-12">
                  <label for="exam" class="form-label">Exam <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="exam" name="sltexam">
                      <option>-- Select Exam --</option>
                      <?php 
                        $examdata="SELECT e.*, c.coursename as coursename FROM exam e, course c, staff s WHERE e.courseid=c.courseid AND c.staffid=s.staffid AND s.staffid='$staffid' AND e.status='Active'";
                        $eresult=mysqli_query($connection,$examdata);
                        $ecount=mysqli_num_rows($eresult);

                        for ($i=0; $i <$ecount ; $i++) { 
                          $row=mysqli_fetch_array($eresult);
                          $examid=$row['examid'];
                          $examname=$row['examname'];
                          $coursename=$row['coursename'];

                          echo "<option value='$examid'>$coursename - $examname</option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="col-12">
                  <label for="mark" class="form-label">Student Mark <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" name="txtmark" id="mark" required="">
                </div>                

              <!--   <div class="col-12">
                  <label for="status" class="form-label">Status <span style="color: red;">*</span></label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdostatus" id="pass" value="Pass" checked>
                    <label class="form-check-label" for="pass">Pass</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdostatus" id="fail" value="Fail">
                    <label class="form-check-label" for="fail">Fail</label>
                  </div>
                </div> -->

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
  $query="SELECT r.*, s.studentid as studentid,s.name as studentname, e.examname as examname, c.coursename as coursename FROM result r, student s, exam e, course c, staff st 
          WHERE r.studentid=s.studentid
          AND r.examid=e.examid
          AND e.courseid=c.courseid
          AND c.staffid=st.staffid
          AND st.staffid='$staffid'";
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
              <h5 class="card-title">Result List</h5>
              <div class="table-responsive">
              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>StudentID</th>
                    <th>Name</th>
                    <th>Student Mark</th>
                    <th>Exam</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $a=1;
                for($i=0;$i<$count;$i++) 
                { 
                  $rows=mysqli_fetch_array($result);
                  $resultid=$rows['resultid'];
                  $studentid=$rows['studentid'];
                  $name=$rows['studentname'];
                  $mark=$rows['mark'];
                  $status=$rows['status'];
                  $examname=$rows['examname'];
                  $coursename=$rows['coursename'];  
                ?>
              <tr>
                <th><?php echo $a++ ?></th>
                <th><?php echo $studentid ?></th>
                <td><?php echo $name; ?></td>
                <td><?php echo $mark ?></td>
                <td><?php echo $examname ?></td>
                <td><?php echo $coursename ?></td>
                <th><?php echo $status ?></th>
                <td>
                 <a href="resultdelete.php?resultid=<?=$resultid?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
<?php 
 	include 'footer.php';
?>