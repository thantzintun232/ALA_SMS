<?php 
	require 'dbconnect.php';
	include 'studentheader.php';
 ?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>My Payment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="studenthome.php">Home</a></li>
          <li class="breadcrumb-item active">My Payment</li>
        </ol>
      </nav>
    </div>


  <?php 
  $studentid=$_SESSION['studentid'];
  $query="SELECT p.*, s.name as studentname, c.coursename as coursename
          FROM payment p, student s, course c
          WHERE p.studentid=s.studentid
          AND p.courseid=c.courseid
          AND s.studentid='$studentid'";
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
              <h5 class="card-title">Payment History</h5>
              <div class="table-responsive">
              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>ID</th>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Fee</th>
                    <th>Paid Amount</th>
                    <th>Status</th>
                    <th>Date</th> 
                  </tr>
                </thead>
                <tbody>
        				<?php 
        				for($i=0;$i<$count;$i++) 
        				{ 
    					  $rows=mysqli_fetch_array($result);
    					  $paymentid=$rows['paymentid'];
    					  $studentname=$rows['studentname'];
    					  $coursename=$rows['coursename'];	
                $fee=$rows['fee'];		
                $paidamount=$rows['paidamount'];  
                $status=$rows['status'];
                $date=$rows['paymentdate'];
                $paydate=date("M d, Y",strtotime($date)); 
      				?>
		        		<tr>
		                  <th><?php echo $paymentid ?></th>
		                  <td><?php echo $studentname ?></td>
		                  <td><?php echo $coursename ?></td>
		                  <td><?php echo $fee ?></td>
		                  <td><?php echo $paidamount ?></td>
		                  <td><?php echo $status ?></td>
		                  <td><?php echo $paydate ?></td>
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