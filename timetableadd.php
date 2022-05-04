<?php 
 	require 'dbconnect.php';
 	include 'header.php';

 	if (isset($_POST['btnsubmit'])) {
 		$sltcourse=$_POST['sltcourse'];
 		$sltday=$_POST['sltday'];
    $txtstarttime=$_POST['txtstarttime'];
    $txtendtime=$_POST['txtendtime'];
    $rdostatus="Active";

 		$check="SELECT * FROM timetable WHERE courseid='$sltcourse' AND day='$sltday'";
 		$result=mysqli_query($connection,$check);
 		$count=mysqli_num_rows($result);

 		if ($count>0) {
 			echo "<script>window.alert('Timetable Already Exist!')</script>";
 			echo "<script>window.location='timetableadd.php'</script>";
 		}

 		else {
 			$insert="INSERT INTO timetable (day,starttime,endtime,courseid,status) VALUES ('$sltday','$txtstarttime','$txtendtime','$sltcourse','$rdostatus')";
 			$result=mysqli_query($connection,$insert);
 		}

 		if ($result) {
 			echo "<script>window.alert('Timetable Added Successfully!')</script>";
 			echo "<script>window.location='timetableadd.php'</script>";
 		}

 		else{
 			echo "<p>Something went wrong in Timetable Add : " . mysqli_error($connection) . "</p>";
 		}
 	}
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Timetable</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Add Timetable</li>
          <li class="breadcrumb-item"><a href="timetablelist.php">Search Timetable</a></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title text-center">Add Timetable</h5>

            <form class="row g-3" action="timetableadd.php" method="post">
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

                <div class="col-12">
                  <label for="day" class="form-label">Day <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="day" name="sltday" required="">
                      <option>-- Select Day --</option>
                      <option value="Sunday">Sunday</option>
                      <option value="Monday">Monday</option>
                      <option value="Tuesday">Tuesday</option>
                      <option value="Wednesday">Wednesday</option>
                      <option value="Thursday">Thursday</option>
                      <option value="Friday">Friday</option>
                      <option value="Saturday">Saturday</option>                                   
                    </select>               
                </div>

                   <div class="col-12">
                  <label for="starttime" class="form-label">Start Time <span style="color: red;">*</span></label>
                  <input type="time" class="form-control" name="txtstarttime" id="endtime" required="">
                </div>

                <div class="col-12">
                  <label for="endtime" class="form-label">End Time <span style="color: red;">*</span></label>
                  <input type="time" class="form-control" name="txtendtime" id="endtime" required="">
                </div>  

              <!--   <div class="col-6">
                  <label for="status" class="form-label">Status <span style="color: red;">*</span></label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdostatus" id="active" value="Active" checked>
                    <label class="form-check-label" for="active">Active</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdostatus" id="inactive" value="Inactive">
                    <label class="form-check-label" for="inactive">Inactive</label>
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
  $query="SELECT t.*, c.coursename as coursename, l.languagename as languagename FROM timetable t, course c, language l WHERE t.courseid=c.courseid AND c.languageid=l.languageid AND t.status='Active'";
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
              <h5 class="card-title">Timetable List</h5>
              <div class="table-responsive">
              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>Course</th>
                    <th>Language</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
        <?php 
        $a=1;
        for($i=0;$i<$count;$i++) 
        { 
          $rows=mysqli_fetch_array($result);
          $timetableid=$rows['id'];
          $coursename=$rows['coursename'];
          $languagename=$rows['languagename'];
          $day=$rows['day'];
          $starttime=$rows['starttime'];
          $start=date('h:i A', strtotime($starttime));
          $endtime=$rows['endtime']; 
          $end=date('h:i A', strtotime($endtime));    
        ?>
              <tr>
                <th><?php echo $a++ ?></th>
                <td><?php echo $coursename ?></td>
                <td><?php echo $languagename; ?></td>
                <td><?php echo $day ?></td>
                <td><?php echo $start ?></td>
                <td><?php echo $end ?></td>
                <td>
                  <a onClick="javascript: return confirm('Are you sure you want to remove?');" href="timetablestatus.php?timetableid=<?=$timetableid?>" class="btn btn-danger">Inactive</a>
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