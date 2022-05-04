<?php 
 	require 'dbconnect.php';
 	include 'studentheader.php';
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>My Assignment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="studenthome.php">Home</a></li>
          <li class="breadcrumb-item active">Assingments</li>
        </ol>
      </nav>
    </div>

 	<?php 
  $studentid=$_SESSION['studentid'];
 	$query="SELECT a.*, c.coursename as coursename FROM assignment a, course c, student s, enrollment e WHERE a.courseid=c.courseid AND c.courseid=e.courseid AND e.studentid=s.studentid AND s.studentid='$studentid' AND a.status='Active'";
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
              <h5 class="card-title">Assignment List</h5>

              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>Assignment Name</th>
                    <th>Description</th>
                    <th>Due Date</th>
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
        					$assignmentid=$rows['assignmentid'];
        					$name=$rows['name'];
                  $description=$rows['description'];
                  $due=$rows['due_date'];
                  $duedate=date("M d, Y",strtotime($due));
                  $course=$rows['coursename'];
                  $status=$rows['status'];
        				?>
        				<tr>
                    <th><?php echo $a++ ?></th>
                    <td><?php echo $name ?></td>
                    <td><?php echo $description ?></td>
                    <td><?php echo $duedate ?></td>
                    <td><?php echo $course ?></td>
                    <td><?php echo $status ?></td>
                    <td>
                        <a href="uploadassignment.php?assignmentid=<?=$assignmentid?>" class="btn btn-primary">Upload</a>
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

<?php include 'footer.php' ?>