<?php 
	require 'dbconnect.php';
	include 'header.php';

	if (isset($_POST['btnsearch'])) 
	{
		$rdosearchtype=$_POST['rdosearchtype'];

		if ($rdosearchtype == 1) 
		{
			$sltstudent=$_POST['sltstudent'];

      $query="SELECT p.*, s.name as studentname, c.coursename as coursename
              FROM payment p, student s, course c
              WHERE p.studentid=s.studentid
              AND p.courseid=c.courseid
              AND p.studentid='$sltstudent'";
      $result=mysqli_query($connection,$query);
		}
		else if($rdosearchtype == 2)
		{
			$txtdate=$_POST['txtdate'];

      $query="SELECT p.*, s.name as studentname, c.coursename as coursename
              FROM payment p, student s, course c
              WHERE p.studentid=s.studentid
              AND p.courseid=c.courseid
              AND p.paymentdate='$txtdate'";
      $result=mysqli_query($connection,$query);
		}
	}
	else if (isset($_POST['btnshowall'])) 
	{
    $query="SELECT p.*, s.name as studentname, c.coursename as coursename
            FROM payment p, student s, course c
            WHERE p.studentid=s.studentid
            AND p.courseid=c.courseid";
    $result=mysqli_query($connection,$query);
	}

	else
	{
		$query="SELECT p.*, s.name as studentname, c.coursename as coursename
            FROM payment p, student s, course c
            WHERE p.studentid=s.studentid
            AND p.courseid=c.courseid";
    $result=mysqli_query($connection,$query);
	}
 ?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Payment Search</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="paymentadd.php">Add Payment</a></li>
          <li class="breadcrumb-item active">Search Payment</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title">Search Option:</h5>

            <form class="row g-3" action="paymentsearch.php" method="post">
                <div class="col-6">
                 <input type="radio" name="rdosearchtype" value="1" checked="">
                  <label for="name" class="form-label">Search by Student Name</label>
                    <select class="form-select" aria-label="Default select example" id="name" name="sltstudent">
                      <option>-- Choose Student --</option>
                      <?php 
                        $studentdata="SELECT * FROM student";
                        $sresult=mysqli_query($connection,$studentdata);
                        $scount=mysqli_num_rows($sresult);

                        for ($i=0; $i <$scount ; $i++) { 
                          $row=mysqli_fetch_array($sresult);
                          $studentid=$row['studentid'];
                          $name=$row['name'];
                          $email=$row['email'];

                          echo "<option value='$studentid'>$name ($email)</option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="col-6">
                  <input type="radio" name="rdosearchtype" value="2">
                  <label for="date" class="form-label">Search by Date</label>
                  <input type="date" class="form-control" id="date" name="txtdate">              
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
              <h5 class="card-title">Payment List</h5>
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