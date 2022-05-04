<?php 
	require 'dbconnect.php';
	include 'header.php';

  $staffid=$_SESSION['staffid'];
	if (isset($_POST['btnsearch'])) 
	{
		$sltassignment=$_POST['sltassignment'];

    // echo "<script>window.alert('$sltassignment')</script>";

    $query="SELECT s.*, a.name as assignmentname FROM student s, assignment a, assignmentdetail ad WHERE s.studentid=ad.studentid AND a.assignmentid=ad.assignmentid AND s.studentid IN (SELECT studentid FROM student EXCEPT SELECT DISTINCT studentid FROM assignmentdetail WHERE assignmentid='$sltassignment')";
  	$result=mysqli_query($connection,$query);

    $query1="SELECT * FROM assignment WHERE assignmentid='$sltassignment'";
    $result1=mysqli_query($connection,$query1);
    $row1=mysqli_fetch_array($result1);
	}
  else
  {
    $query="SELECT s.*, a.name as assignmentname FROM assignment a, assignmentdetail ad, student s WHERE a.assignmentid=ad.assignmentid AND ad.studentid=s.studentid AND s.studentid=null";
    $result=mysqli_query($connection,$query);
  }
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Not Uploaded Students</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="teacherhome.php">Home</a></li>
          <li class="breadcrumb-item active">Not Uploaded Students</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title">Select Assignment</h5>

            <form class="row g-3" action="notuploadstudentlist.php" method="post">
                <div class="col-12">
                    <select class="form-select" aria-label="Default select example" name="sltassignment" required>
                      <?php 
                        $assignmentdata="SELECT a.* FROM assignment a, staff s WHERE a.staffid=s.staffid AND a.staffid='$staffid' AND a.status='Active'";
                        $aresult=mysqli_query($connection,$assignmentdata);
                        $acount=mysqli_num_rows($aresult);

                        for ($i=0; $i <$acount ; $i++) { 
                          $row=mysqli_fetch_array($aresult);
                          $assignmentid=$row['assignmentid'];
                          $name=$row['name'];

                          echo "<option value='$assignmentid'>$name</option>";
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
              <h5 class="card-title"><?php echo $row1['name'] ?> Assignment not uploaded students list:</h5>
              <div class="table-responsive">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr >
                    <th>#</th>
                    <th>StudentID</th>
                    <th>Name</th>
                    <th>Assignment</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
        				<?php 
        				$a=1; 
        				for($i=0;$i<$count;$i++) 
        				{ 
                $rows=mysqli_fetch_array($result);
                $studentid=$rows['studentid'];
                $studentname=$rows['name'];
                $assignmentname=$rows['assignmentname'];
      				?>
		        		<tr>
		                  <th><?php echo $a++ ?></th>
		                  <td><?php echo $studentid ?></td>
		                  <td><?php echo $studentname ?></td>
                      <td><?php echo $row1['name'] ?></td>
		                  <th>Not Uploaded</th>
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