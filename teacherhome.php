<?php 
  require 'dbconnect.php';
  include 'header.php';

  $staffid=$_SESSION['staffid'];
  
  $query="SELECT c.* FROM staff s, course c WHERE s.staffid=c.staffid AND s.staffid='$staffid'";
  $result=mysqli_query($connection,$query);
?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="teacherhome.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <?php 
            $count=mysqli_num_rows($result);

            if($count<1){
              echo "<p>No Record Found!</p>";
            }
            else{
              for($i=0;$i<$count;$i++){ 

              $rows=mysqli_fetch_array($result); 
              $coursename=$rows['coursename']; 
            ?>
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total Students</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <?php 

                      $query2="SELECT c.* FROM staff s, course c, enrollment e, student st WHERE s.staffid=c.staffid AND c.courseid=e.courseid AND st.studentid=e.studentid AND s.staffid='$staffid' AND c.coursename='$coursename'";
                      $result2=mysqli_query($connection,$query2);
                      $count2=mysqli_num_rows($result2); ?>

                      <h6><?php echo $coursename ?></h6>
                      <span class="text-success small pt-1 fw-bold"><?php echo $count2 ?></span> <span class="text-muted small pt-2 ps-1">Students</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

          <?php } 
          } 

          $staffid=$_SESSION['staffid']; 
          $query="SELECT ad.*, st.name as studentname, st.studentid as studentid, a.name as assignmentname FROM assignment a, assignmentdetail ad, staff s, student st WHERE a.assignmentid=ad.assignmentid AND a.staffid=s.staffid AND ad.studentid=st.studentid AND s.staffid='$staffid' ORDER BY ad.uploaddate DESC";
          $result=mysqli_query($connection,$query);
          $count=mysqli_num_rows($result);

          if($count<1){
            echo "<p>No Record Found!</p>";
          }
          else { ?>

            <!-- Recent Uploaded Assignments -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

<!--                 <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div> -->

                <div class="card-body">
                  <h5 class="card-title">Recent Uploaded Assignments</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">StudentID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Assignment</th>
                        <th scope="col">Date</th>
                        <th scope="col">Detail</th>
                      </tr>
                    </thead>
                    <?php 
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
                    <tbody>
                      <tr>
                        <th scope="row"><?php echo $studentid ?></th>
                        <td><?php echo $studentname ?></td>
                        <td><a href="assignmentadd.php" class="text-primary"><?php echo $assignmentname ?></a></td>
                        <td><?php echo $date ?></td>
                        <td><a href="studentassignmentlist.php"><span class="badge bg-success">View Detail</span></a></td>
                      </tr>
                    </tbody>
                    <?php } ?>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

          <?php } ?>

      </div>
    </section>
</main><!-- End #main -->
<?php 
 	include 'footer.php';
?>