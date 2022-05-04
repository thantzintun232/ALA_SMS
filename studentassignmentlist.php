<?php 
 	require 'dbconnect.php';
 	include 'header.php';
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Students' Assignments</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="teacherhome.php">Home</a></li>
          <li class="breadcrumb-item active">Student Assignment</li>
        </ol>
      </nav>
    </div>

  <?php
  $staffid=$_SESSION['staffid']; 
 	$query="SELECT ad.*, st.name as studentname, st.studentid as studentid, a.name as assignmentname FROM assignment a, assignmentdetail ad, staff s, student st WHERE a.assignmentid=ad.assignmentid AND a.staffid=s.staffid AND ad.studentid=st.studentid AND s.staffid='$staffid' ORDER BY ad.uploaddate DESC";
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
              <h5 class="card-title">Uploaded Assignments List</h5>

              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>StudentID</th>
                    <th>Student Name</th>
                    <th>Assignment</th>
                    <th>Uploaded File</th>
                    <th>Uploaded Date</th>
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
                  $assignmentdetailid=$rows['assignmentdetailid'];
                  $studentid=$rows['studentid'];
                  $studentname=$rows['studentname'];
        					$assignmentname=$rows['assignmentname'];
                  $uploadfile=$rows['uploadfile'];
                  $uploaddate=$rows['uploaddate'];
                  $date=date("M d, Y",strtotime($uploaddate));
                  $status=$rows['status'];
        				?>
        				<tr>
                    <th><?php echo $a++ ?></th>
                    <td><?php echo $studentid ?></td>
                    <td><?php echo $studentname ?></td>
                    <td><?php echo $assignmentname ?></td>
                    <td><a href="<?php echo $uploadfile ?>">See Uploaded File</a></td>
                    <td><?php echo $date ?></td>
                    <td><?php echo $status ?></td>
                    <?php if ($status=='Graded'){
                      ?>
                      <td><a href="#"class="btn"><i class="bi bi-check-square"></i></a></td>
                      <?php }

                      else{
                        ?>
                      <td><a href="studentassignmentstatus.php?assignmentdetailid=<?=$assignmentdetailid?>"class="btn btn-primary"><i class="bi bi-check-square"></i></a></td>
                      <?php } ?>                 
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
</main>

<?php include 'footer.php' ?>