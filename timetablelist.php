<?php 
	require 'dbconnect.php';
	include 'header.php';

	if (isset($_POST['btnsearch'])) 
	{
		$rdosearchtype=$_POST['rdosearchtype'];

		if ($rdosearchtype == 1) 
		{
			$sltcourse=$_POST['sltcourse'];

			$query="SELECT t.*, c.coursename as coursename, l.languagename as languagename, r.roomname as roomname, s.name as staffname FROM timetable t, course c, language l, room r, staff s WHERE t.courseid=c.courseid AND c.languageid=l.languageid AND c.roomid=r.roomid AND s.staffid=c.staffid AND t.courseid='$sltcourse' AND t.status='Active'";
      $result=mysqli_query($connection,$query);
		}
		else if($rdosearchtype == 2)
		{
			$sltday=$_POST['sltday'];
      $query="SELECT t.*, c.coursename as coursename, l.languagename as languagename, r.roomname as roomname, s.name as staffname FROM timetable t, course c, language l, room r, staff s WHERE t.courseid=c.courseid AND c.languageid=l.languageid AND c.roomid=r.roomid AND s.staffid=c.staffid AND t.day='$sltday' AND t.status='Active'";
      $result=mysqli_query($connection,$query);
		}
	}
	else if (isset($_POST['btnshowall'])) 
	{
    $query="SELECT t.*, c.coursename as coursename, l.languagename as languagename, r.roomname as roomname, s.name as staffname FROM timetable t, course c, language l, room r, staff s WHERE t.courseid=c.courseid AND c.languageid=l.languageid AND c.roomid=r.roomid AND s.staffid=c.staffid AND t.status='Active'";
    $result=mysqli_query($connection,$query);
	}

	else
	{
		$query="SELECT t.*, c.coursename as coursename, l.languagename as languagename, r.roomname as roomname, s.name as staffname FROM timetable t, course c, language l, room r, staff s WHERE t.courseid=c.courseid AND c.languageid=l.languageid AND c.roomid=r.roomid AND s.staffid=c.staffid AND t.status='Active'";
    $result=mysqli_query($connection,$query);
	}
 ?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Timetable Search</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="timetableadd.php">Add Timetable</a></li>
          <li class="breadcrumb-item active">Search Timetable</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title">Search Option:</h5>

            <form class="row g-3" action="timetablelist.php" method="post">
                <div class="col-6">
                <input type="radio" name="rdosearchtype" value="1" checked="">
                  <label for="course" class="form-label">Search by Course</label>
                    <select class="form-select" aria-label="Default select example" id="course" name="sltcourse">
                      <option>-- Choose Course --</option>
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

                <div class="col-6">
                  <input type="radio" name="rdosearchtype" value="2">
                  <label for="day" class="form-label">Search by Day</label>
                    <select class="form-select" aria-label="Default select example" id="day" name="sltday">
                      <option>-- Choose Day --</option>
                      <option value="Sunday">Sunday</option>
                      <option value="Monday">Monday</option>
                      <option value="Tuesday">Tuesday</option>
                      <option value="Wednesday">Wednesday</option>
                      <option value="Thursday">Thursday</option>
                      <option value="Friday">Friday</option>
                      <option value="Saturday">Saturday</option>                                   
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
              <h5 class="card-title">Timetable List</h5>
              <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark text-center">
                    <th>Time</th>
                    <th>Sunday</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                  </tr>
                </thead>
                <tbody>
        				<?php 
        				for($i=0;$i<$count;$i++) 
        				{ 
    					  $rows=mysqli_fetch_array($result);
    					  $timetableid=$rows['id'];
    					  $day=$rows['day'];
    					  $starttime=$rows['starttime'];
                $start=date('h:i A', strtotime($starttime));	
                $endtime=$rows['endtime'];
                $end=date('h:i A', strtotime($endtime));		
                $coursename=$rows['coursename']; 
                $languagename=$rows['languagename'];
                $roomname=$rows['roomname'];
                $staffname=$rows['staffname'];
      				?>
		        		<tr>
                  <td class="table-light" style="width: 100px;"><?php echo $start ." <br> to <br> ". $end ?></td>
                  <td class="table-primary"><?php if ($day=='Sunday'): ?>
                    <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname . "<br>" . $staffname?>
                  <?php endif ?>
                  </td>
                  <td class="table-danger"><?php if ($day=='Monday'): ?>
                    <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname . "<br>" . $staffname?>
                  <?php endif ?>
                  </td>
                  <td class="table-warning"><?php if ($day=='Tuesday'): ?>
                    <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname . "<br>" . $staffname?>
                  <?php endif ?>
                  </td>
                  <td class="table-secondary"><?php if ($day=='Wednesday'): ?>
                   <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname . "<br>" . $staffname?>
                  <?php endif ?>
                  </td>
                  <td class="table-info"><?php if ($day=='Thursday'): ?>
                    <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname . "<br>" . $staffname?>
                  <?php endif ?>
                  </td>
                  <td class="table-danger"><?php if ($day=='Friday'): ?>
                    <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname . "<br>" . $staffname?>
                  <?php endif ?>
                  </td>
                  <td class="table-primary"><?php if ($day=='Saturday'): ?>
                    <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname . "<br>" . $staffname?>
                  <?php endif ?>
                  </td>                  
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