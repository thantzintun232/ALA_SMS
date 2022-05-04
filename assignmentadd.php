<?php 
 	require 'dbconnect.php';
 	include 'header.php';

  $staffid=$_SESSION['staffid'];
 	if (isset($_POST['btnsubmit'])) {

  $staffid=$_SESSION['staffid'];

 	$txtname=$_POST['txtname'];
  $txtdescription=$_POST['txtdescription'];
  $txtduedate=$_POST['txtduedate'];
  $txtcourse=$_POST['sltcourse'];
  $status='Active';
	$insert="INSERT INTO assignment (name,description,due_date,staffid,courseid,status) VALUES ('$txtname','$txtdescription','$txtduedate','$staffid','$txtcourse','$status')";
	$result=mysqli_query($connection,$insert);

	if ($result) {
		echo "<script>window.alert('Assignment Added Successfully!')</script>";
		echo "<script>window.location='assignmentadd.php'</script>";
	}

	else{
		echo "<p>Something went wrong in Assignment Entry : " . mysqli_error($connection) . "</p>";
	}
}
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Assignment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="teacherhome.php">Home</a></li>
          <li class="breadcrumb-item active">Add Assingment</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Assingment Register</h5>

              <form class="row g-3" action="assignmentadd.php" method="post">

                <div class="col-12">
                  <label for="name" class="form-label">Assignment Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="name" name="txtname" placeholder="Enter Assignment Name" required="">
                </div>

                <div class="col-12">
                  <label for="description" class="form-label">Description <span style="color: red;">*</span></label>
                  <textarea class="form-control" id="description" name="txtdescription" placeholder="Enter Description" required=""></textarea>
                </div>

                <div class="col-12">
                  <label for="duedate" class="form-label">Due Date <span style="color: red;">*</span></label>
                  <input type="date" class="form-control" id="duedate" name="txtduedate" required="">
                </div>

                <div class="col-12">
                  <label for="course" class="form-label">Course <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="course" name="sltcourse">
                      <option>-- Select Course --</option>
                      <?php 
                        $coursedata="SELECT c.*, l.languagename as languagename FROM course c, language l, staff s WHERE c.languageid=l.languageid AND c.staffid=s.staffid AND s.staffid='$staffid'";
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
      </div>
    </section>


 	<?php 
 	$query="SELECT a.*, c.coursename as coursename FROM assignment a, course c, staff s WHERE a.courseid=c.courseid AND c.staffid=s.staffid AND s.staffid='$staffid'";
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
                        <a href="assignmentedit.php?assignmentid=<?=$assignmentid?>"class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                        <a href="assignmentstatus.php?assignmentid=<?=$assignmentid?>" class="btn btn-danger">Over</a>
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