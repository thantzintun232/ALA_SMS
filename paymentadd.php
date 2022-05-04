<?php 
 	require 'dbconnect.php';
 	include 'header.php';

 	if (isset($_POST['btnsubmit'])) {
 		$txtpaymentid=$_POST['txtpaymentid'];
 		$txtfee=$_POST['txtfee'];
    $txtpaidamount=$_POST['txtpaidamount'];
    $txtdate=$_POST['txtdate'];
    $txtinstallment=$_POST['txtinstallment'];
    $rdostatus=$_POST['rdostatus'];
    $sltstudent=$_POST['sltstudent'];
    $sltcourse=$_POST['sltcourse'];

 		$insert="INSERT INTO payment (paymentid,Fee,paidamount,paymentdate,installmentnumber,status,studentid,courseid) VALUES ('$txtpaymentid','$txtfee','$txtpaidamount','$txtdate','$txtinstallment','$rdostatus','$sltstudent','$sltcourse')";
 		$result=mysqli_query($connection,$insert);

 		if ($result) {
 			echo "<script>window.alert('Payment Added Successfully!')</script>";
 			echo "<script>window.location='paymentadd.php'</script>";
 		}

 		else{
 			echo "<p>Something went wrong in Payment Add : " . mysqli_error($connection) . "</p>";
 		}
 	}
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Student Payment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Add Payment</li>
          <li class="breadcrumb-item"><a href="paymentsearch.php">Search Payment</a></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title text-center">Add Payment</h5>

            <form class="row g-3" action="paymentadd.php" method="post">
                <div class="col-12">
                  <label for="payment" class="form-label">Payment ID <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtpaymentid" value="<?php echo AutoID('payment','paymentid','P-',6)?>" readonly>
                </div>

                <div class="col-12">
                  <label for="student" class="form-label">Student <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="student" name="sltstudent">
                      <option>-- Select Student --</option>
                      <?php 
                        $studentdata="SELECT * FROM student";
                        $result=mysqli_query($connection,$studentdata);
                        $count=mysqli_num_rows($result);

                        for ($i=0; $i <$count ; $i++) { 
                          $row=mysqli_fetch_array($result);
                          $studentid=$row['studentid'];
                          $name=$row['name'];
                          $email=$row['email'];

                          echo "<option value='$studentid'>$name ($email) </option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="col-12">
                  <label for="course" class="form-label">Course <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="course" name="sltcourse">
                      <option>-- Select Course --</option>
                      <?php 
                        $coursedata="SELECT c.*, l.languagename as languagename FROM course c, language l WHERE c.languageid=l.languageid";
                        $result=mysqli_query($connection,$coursedata);
                        $count=mysqli_num_rows($result);

                        for ($i=0; $i <$count ; $i++) { 
                          $row=mysqli_fetch_array($result);
                          $courseid=$row['courseid'];
                          $coursename=$row['coursename'];
                          $languagename=$row['languagename'];

                          echo "<option value='$courseid'>$coursename - $languagename </option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="col-12">
                  <label for="fee" class="form-label">Fee <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" name="txtfee" id="fee" placeholder="Enter Price" required="">
                </div>

                <div class="col-12">
                  <label for="paidamount" class="form-label">Paid Amount <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" id="paidamount" name="txtpaidamount" placeholder="Enter Discount Amount" id="discount">
                </div>

                <div class="col-12">
                  <label for="date" class="form-label">Date <span style="color: red;">*</span></label>
                  <input type="date" class="form-control" name="txtdate" id="date" required="">
                </div>

                <div class="col-12">
                  <label for="installment" class="form-label">Installment Number</label>
                  <input type="number" class="form-control" name="txtinstallment" id="installment" placeholder="Enter Number of Month">
                </div>

                <div class="col-12">
                  <label for="status" class="form-label">Status <span style="color: red;">*</span></label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdostatus" id="full" value="Full Paid" checked>
                    <label class="form-check-label" for="male">Full Paid</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdostatus" id="half" value="Half Paid">
                    <label class="form-check-label" for="half">Half Paid</label>
                  </div>
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
</main><!-- End #main -->
<?php 
 	include 'footer.php';
?>