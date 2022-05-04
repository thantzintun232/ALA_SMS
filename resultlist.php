<?php 
	require 'dbconnect.php';
	include 'header.php';

	if (isset($_POST['btnsearch'])) 
	{
		$rdosearchtype=$_POST['rdosearchtype'];

		if ($rdosearchtype == 1) 
		{
			$sltcourse=$_POST['sltcourse'];

      $query="SELECT r.*, s.studentid as studentid,s.name as studentname, e.examname as examname, c.coursename as coursename, l.languagename as languagename FROM result r, student s, exam e, course c, language l
              WHERE r.studentid=s.studentid
              AND r.examid=e.examid
              AND e.courseid=c.courseid
              AND c.languageid=l.languageid
              AND e.courseid='$sltcourse'";
      $result=mysqli_query($connection,$query);
		}

    else if($rdosearchtype == 3)
    {
      $sltstudent=$_POST['sltstudent'];

      $query="SELECT r.*, s.studentid as studentid,s.name as studentname, e.examname as examname, c.coursename as coursename, l.languagename as languagename FROM result r, student s, exam e, course c, language l
              WHERE r.studentid=s.studentid
              AND r.examid=e.examid
              AND e.courseid=c.courseid
              AND c.languageid=l.languageid
              AND r.studentid='$sltstudent'";
      $result=mysqli_query($connection,$query);
    }
	}

	else
	{
    $query="SELECT r.*, s.studentid as studentid,s.name as studentname, e.examname as examname, c.coursename as coursename, l.languagename as languagename FROM result r, student s, exam e, course c, language l
              WHERE r.studentid=s.studentid
              AND r.examid=e.examid
              AND e.courseid=c.courseid
              AND c.languageid=l.languageid";
    $result=mysqli_query($connection,$query);
	}
 ?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Result</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Student Result</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title">Search Option:</h5>

            <form class="row g-3" action="resultlist.php" method="post">
                <div class="col-6">
                <input type="radio" name="rdosearchtype" value="1" checked="">
                  <label for="course" class="form-label">Search by Course</label>
                    <select class="form-select" aria-label="Default select example" id="course" name="sltcourse">
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

                <!-- <div class="col-4">
                  <input type="radio" name="rdosearchtype" value="2">
                  <label for="exam" class="form-label">Search by Exam</label>
                    <select class="form-select" aria-label="Default select example" id="exam" name="sltexam">
                      <option>-- Choose Exam --</option>
                      <?php 
                        $examdata="SELECT e.*, c.coursename as coursename, l.languagename as languagename FROM exam e, course c, language l WHERE e.courseid=c.courseid AND c.languageid=l.languageid AND e.status='Active'";
                        $eresult=mysqli_query($connection,$examdata);
                        $ecount=mysqli_num_rows($eresult);

                        for ($i=0; $i <$ecount ; $i++) { 
                          $row=mysqli_fetch_array($eresult);
                          $examid=$row['examid'];
                          $examname=$row['examname'];
                          $coursename=$row['coursename'];
                          $languagename=$row['languagename'];

                          echo "<option value='$examid'>$examname - $coursename - $languagename</option>";
                        }
                       ?>                       
                    </select>               
                </div>  
 -->
                <div class="col-6">
                  <input type="radio" name="rdosearchtype" value="3">
                  <label for="student" class="form-label">Search by Student</label>
                    <select class="form-select" aria-label="Default select example" id="student" name="sltstudent">
                      <option>-- Choose Student --</option>
                      <?php 
                        $studentdata="SELECT * FROM student";
                        $sresult=mysqli_query($connection,$studentdata);
                        $scount=mysqli_num_rows($sresult);

                        for ($i=0; $i <$scount ; $i++) { 
                          $row=mysqli_fetch_array($sresult);
                          $studentid=$row['studentid'];
                          $name=$row['name'];
                          $email=$row['email'];

                          echo "<option value='$studentid'>$name ($email)</option>";
                        }
                       ?>                       
                    </select>               
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
              <form action="resultexport.php" method="post">
                <h5 class="card-title">Result List | <button class="btn btn-primary" name="resultexport">CSV Export</button></h5>
              </form>
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
                    <th>Language</th>
                    <th>Status</th>
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
                  $languagename=$rows['languagename']; 
                ?>
              <tr>
                <th><?php echo $a++ ?></th>
                <th><?php echo $studentid ?></th>
                <td><?php echo $name; ?></td>
                <td><?php echo $mark ?></td>
                <td><?php echo $examname ?></td>
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