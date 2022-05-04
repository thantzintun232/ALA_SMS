<?php 
  require 'dbconnect.php';
  include 'header.php';

  $staffid=$_SESSION['staffid'];
  
  $query="SELECT t.*, c.coursename as coursename, l.languagename as languagename, r.roomname as roomname FROM timetable t, course c, language l, room r, staff s WHERE t.courseid=c.courseid AND c.languageid=l.languageid AND c.roomid=r.roomid AND c.staffid=s.staffid AND s.staffid='$staffid' AND t.status='Active'";
  $result=mysqli_query($connection,$query);
 ?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Timetable</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="teacherhome.php">Home</a></li>
          <li class="breadcrumb-item active">My Timetable</li>
        </ol>
      </nav>
    </div>

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
              ?>
                <tr>
                  <td class="table-light" style="width: 150px;"><?php echo $start ." <br> to <br> ". $end ?></td>
                  <td class="table-primary"><?php if ($day=='Sunday'): ?>
                    <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname?>
                  <?php endif ?>
                  </td>
                  <td class="table-danger"><?php if ($day=='Monday'): ?>
                    <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname?>
                  <?php endif ?>
                  </td>
                  <td class="table-warning"><?php if ($day=='Tuesday'): ?>
                    <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname?>
                  <?php endif ?>
                  </td>
                  <td class="table-secondary"><?php if ($day=='Wednesday'): ?>
                   <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname?>
                  <?php endif ?>
                  </td>
                  <td class="table-info"><?php if ($day=='Thursday'): ?>
                    <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname?>
                  <?php endif ?>
                  </td>
                  <td class="table-danger"><?php if ($day=='Friday'): ?>
                    <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname?>
                  <?php endif ?>
                  </td>
                  <td class="table-primary"><?php if ($day=='Saturday'): ?>
                    <?php echo "<b>". $coursename." (". $languagename .") </b><br> Room - ". $roomname?>
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