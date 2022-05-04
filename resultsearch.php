<?php 
	require 'dbconnect.php';
	include 'header.php';

  $staffid=$_SESSION['staffid'];
	if (isset($_POST['btnsearch'])) 
	{
		$rdosearchtype=$_POST['rdosearchtype'];

		if ($rdosearchtype == 1) 
		{
			$sltcourse=$_POST['sltcourse'];

      $query="SELECT r.*, s.studentid as studentid,s.name as studentname, e.examname as examname,e.min_mark as minmark, c.coursename as coursename FROM result r, student s, exam e, course c
              WHERE r.studentid=s.studentid
              AND r.examid=e.examid
              AND e.courseid=c.courseid
              AND e.courseid='$sltcourse'";
      $result=mysqli_query($connection,$query);
		}
		else if($rdosearchtype == 2)
		{
			$sltstudent=$_POST['sltstudent'];

      $query="SELECT r.*, s.studentid as studentid,s.name as studentname, e.examname as examname,e.min_mark as minmark, c.coursename as coursename, l.languagename as languagename FROM result r, student s, exam e, course c, language l
              WHERE r.studentid=s.studentid
              AND r.examid=e.examid
              AND e.courseid=c.courseid
              AND c.languageid=l.languageid
              AND r.studentid='$sltstudent'";
      $result=mysqli_query($connection,$query);
		}
	}
	else if (isset($_POST['btnshowall'])) 
	{
    $query="SELECT r.*, s.studentid as studentid,s.name as studentname, e.examname as examname,e.min_mark as minmark, c.coursename as coursename FROM result r, student s, exam e, course c, staff st 
            WHERE r.studentid=s.studentid
            AND r.examid=e.examid
            AND e.courseid=c.courseid
            AND c.staffid=st.staffid
            AND st.staffid='$staffid'";
    $result=mysqli_query($connection,$query);
	}

	else
	{
		$query="SELECT r.*, s.studentid as studentid,s.name as studentname, e.examname as examname,e.min_mark as minmark, c.coursename as coursename FROM result r, student s, exam e, course c, staff st 
          WHERE r.studentid=s.studentid
          AND r.examid=e.examid
          AND e.courseid=c.courseid
          AND c.staffid=st.staffid
          AND st.staffid='$staffid'";
    $result=mysqli_query($connection,$query);
	}
 ?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Result Search</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="teacherhome.php">Home</a></li>
          <li class="breadcrumb-item"><a href="resultadd.php">Add Result</a></li>
          <li class="breadcrumb-item active">Search Result</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title">Search Option:</h5>

            <form class="row g-3" action="resultsearch.php" method="post">
                <div class="col-6">
                <input type="radio" name="rdosearchtype" value="1" checked="">
                  <label for="course" class="form-label">Search by Course</label>
                    <select class="form-select" aria-label="Default select example" id="course" name="sltcourse">
                      <option>-- Choose Course --</option>
                      <?php 
                        $coursedata="SELECT c.* FROM course c, staff s WHERE c.staffid=s.staffid AND s.staffid='$staffid'";
                        $cresult=mysqli_query($connection,$coursedata);
                        $ccount=mysqli_num_rows($cresult);

                        for ($i=0; $i <$ccount ; $i++) { 
                          $row=mysqli_fetch_array($cresult);
                          $courseid=$row['courseid'];
                          $coursename=$row['coursename'];

                          echo "<option value='$courseid'>$coursename</option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="col-6">
                  <input type="radio" name="rdosearchtype" value="2">
                  <label for="student" class="form-label">Search by Student</label>
                    <select class="form-select" aria-label="Default select example" id="student" name="sltstudent">
                      <option>-- Choose Student --</option>
                      <?php 
                        $studentdata="SELECT * FROM student s, result r WHERE r.studentid=s.studentid";
                        $sresult=mysqli_query($connection,$studentdata);
                        $scount=mysqli_num_rows($sresult);

                        for ($i=0; $i <$scount ; $i++) { 
                          $row=mysqli_fetch_array($sresult);
                          $studentid=$row['studentid'];
                          $name=$row['name'];
                          $email=$row['email'];

                          echo "<option value='$studentid'>$studentid - $name</option>";
                        }
                       ?>                       
                    </select>               
                </div>           

                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btnsearch">Search</button>
                  <button type="reset" class="btn btn-secondary" name="btnreset">Reset</button>
                  <button type="submit" class="btn btn-success" name="btnshowall">Show All</button>
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
                    <th>Minimum Mark</th>
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
                  $minmark=$rows['minmark'];
                ?>
              <tr>
                <th><?php echo $a++ ?></th>
                <th><?php echo $studentid ?></th>
                <td><?php echo $name; ?></td>
                <td><?php echo $mark ?></td>
                <td><?php echo $examname ?></td>
                <td><?php echo $minmark ?></td>
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