<?php 
 	require 'dbconnect.php';
 	include 'header.php';

  if (isset($_POST['btnsearch'])) 
  {
    $rdosearchtype=$_POST['rdosearchtype'];

    if ($rdosearchtype == 1) 
    {
      $studentid=$_POST['sltstudent'];
      $query="SELECT e.*, s.name as studentname, c.coursename as coursename, r.roomname as      roomname, b.branchname as branchname, l.languagename FROM enrollment e, student s, course c, room r, branch b, language l WHERE e.studentid='$studentid' AND e.studentid=s.studentid AND e.courseid=c.courseid AND c.roomid=r.roomid AND r.branchid=b.branchid AND c.languageid=l.languageid";
      $result=mysqli_query($connection,$query);
    }
    elseif($rdosearchtype == 2)
    {
      $courseid=$_POST['sltcourse'];
      $query="SELECT e.*, s.name as studentname, c.coursename as coursename, r.roomname as      roomname, b.branchname as branchname, l.languagename FROM enrollment e, student s, course c, room r, branch b, language l WHERE e.courseid='$courseid' AND e.studentid=s.studentid AND e.courseid=c.courseid AND c.roomid=r.roomid AND r.branchid=b.branchid AND c.languageid=l.languageid";
      $result=mysqli_query($connection,$query);
    }
    elseif ($rdosearchtype == 3) 
    {
      $txtdate=$_POST['txtdate'];
      $query="SELECT e.*, s.name as studentname, c.coursename as coursename, r.roomname as      roomname, b.branchname as branchname, l.languagename FROM enrollment e, student s, course c, room r, branch b, language l WHERE e.registerdate='$txtdate' AND e.studentid=s.studentid AND e.courseid=c.courseid AND c.roomid=r.roomid AND r.branchid=b.branchid AND c.languageid=l.languageid";
      $result=mysqli_query($connection,$query);
    } 
  }
  elseif(isset($_POST['btnshowall']))
  {
    $query="SELECT e.*, s.name as studentname, c.coursename as coursename, r.roomname as roomname, b.branchname as branchname, l.languagename FROM enrollment e INNER JOIN student s ON e.studentid=s.studentid INNER JOIN course c ON e.courseid=c.courseid INNER JOIN room r ON c.roomid=r.roomid INNER JOIN branch b ON r.branchid=b.branchid INNER JOIN language l ON c.languageid=l.languageid ORDER BY e.enrollmentid DESC";
    $result=mysqli_query($connection,$query);
  }
  else
  {
    $query="SELECT e.*, s.name as studentname, c.coursename as coursename, r.roomname as roomname, b.branchname as branchname, l.languagename FROM enrollment e INNER JOIN student s ON e.studentid=s.studentid INNER JOIN course c ON e.courseid=c.courseid INNER JOIN room r ON c.roomid=r.roomid INNER JOIN branch b ON r.branchid=b.branchid INNER JOIN language l ON c.languageid=l.languageid ORDER BY e.enrollmentid DESC";
    $result=mysqli_query($connection,$query);
  }
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Enrollment Search</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="enrollmentadd.php">Add Enrollment</a></li>
          <li class="breadcrumb-item active">Search Enrollment</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
          	<div class="card-body">
              <h5 class="card-title">Search Option:</h5>

            <form class="row g-3" action="enrollmentsearch.php" method="post">

                <div class="col-4">
                  <input type="radio" name="rdosearchtype" value="1" checked="">
                  <label for="student" class="form-label">Search by StudentID</label>
                    <select class="form-select" aria-label="Default select example" id="student" name="sltstudent">
                      <option >-- Choose StudentID --</option>
                      <?php 
                        $studentdata="SELECT * FROM student";
                        $sresult=mysqli_query($connection,$studentdata);
                        $scount=mysqli_num_rows($sresult);

                        for ($i=0; $i <$scount ; $i++) { 
                          $row=mysqli_fetch_array($sresult);
                          $studentid=$row['studentid'];

                          echo "<option value='$studentid'>$studentid</option>";
                        }
                       ?>                      
                    </select>               
                </div>

                <div class="col-4">
                  <input type="radio" name="rdosearchtype" value="2">
                  <label for="course" class="form-label">Search by Course</label>
                    <select class="form-select" aria-label="Default select example" id="course" name="sltcourse">
                      <option >-- Choose Course --</option>
                      <?php 
                        $coursedata="SELECT c.*, l.languagename as languagename FROM course c INNER JOIN language l ON c.languageid=l.languageid";
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

                <div class="col-4">
                  <input type="radio" name="rdosearchtype" value="3">
                  <label for="date" class="form-label">Search by Date</label>
                  <input type="date" class="form-control" name="txtdate"/>              
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
              <h5 class="card-title">Enrollment List</h5>

              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>EnrollmentID</th>
                    <th>Student Name</th>
                    <th>Course Name</th>
                    <th>Language</th>
                    <th>Branch</th>
                    <th>Register Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
        <?php 
        for($i=0;$i<$count;$i++) 
        { 
          $rows=mysqli_fetch_array($result);
          $enrollmentid=$rows['enrollmentid'];
          $studentname=$rows['studentname'];
          $coursename=$rows['coursename'];
          $languagename=$rows['languagename'];
          $branchname=$rows['branchname'];
          $registerdate=$rows['registerdate']; 
          $rdate=date("M d, Y",strtotime($registerdate));     
        ?>
              <tr>
                <th><?php echo $enrollmentid ?></th>
                <td><?php echo $studentname ?></td>
                <td><?php echo $coursename ?></td>
                <td><?php echo $languagename ?></td>
                <td><?php echo $branchname ?></td>
                <td><?php echo $rdate ?></td>
                <td>
                  <a onClick="javascript: return confirm('Are you sure you want to delete?');" href="enrollmentdelete.php?enrollmentid=<?=$enrollmentid?>" class="btn btn-danger">
                      <i class="bi bi-trash"></i>
                  </a>
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