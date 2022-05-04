<?php 
 	require 'dbconnect.php';
 	include 'studentheader.php';
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>My Assignment History</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="studenthome.php">Home</a></li>
          <li class="breadcrumb-item active">Assingment History</li>
        </ol>
      </nav>
    </div>

  <?php
  $studentid=$_SESSION['studentid']; 
 	$query="SELECT ad.*, a.name as assignmentname FROM assignment a, assignmentdetail ad, student s WHERE a.assignmentid=ad.assignmentid AND ad.studentid=s.studentid AND s.studentid='$studentid'";
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
              <h5 class="card-title">Assignment History</h5>

              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>Assignment Name</th>
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
        					$assignmentname=$rows['assignmentname'];
                  $uploadfile=$rows['uploadfile'];
                  $uploaddate=$rows['uploaddate'];
                  $date=date("M d, Y",strtotime($uploaddate));
                  $status=$rows['status'];
        				?>
        				<tr>
                    <th><?php echo $a++ ?></th>
                    <td><?php echo $assignmentname ?></td>
                    <td><a href="<?php echo $uploadfile ?>"><u>See Uploaded File</u></a></td>
                    <td><?php echo $date ?></td>
                    <td><?php echo $status ?></td>
                    <?php if ($status=='Graded'){
                      ?>
                      <td><a href="#" class="btn btn-success"><i class="bi bi-check2"></i></a></td>
                      <?php }

                      else{
                        ?>
                      <td><a href="studentassignmentupdate.php?assignmentdetailid=<?=$assignmentdetailid?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>
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