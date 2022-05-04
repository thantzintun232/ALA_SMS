<?php 
 	require 'dbconnect.php';
 	include 'header.php';    

 	if (isset($_POST['btnsubmit'])) {
 		$txtstaffid=$_POST['txtstaffid'];    
 		$txtname=$_POST['txtname'];
    $rdogender=$_POST['rdogender'];
    $txtdob=$_POST['txtdob'];
    $txtnrc=$_POST['txtnrc'];
    $txtaddress=$_POST['txtaddress'];
    $txtphone=$_POST['txtphone'];
    $txtemail=$_POST['txtemail'];
    $sltstafftype=$_POST['sltstafftype'];
    $status="Active";
    $txtsalary=$_POST['txtsalary'];
    $txtpassword=$_POST['txtpassword'];

    $profile=$_FILES['profile']['name'];
    $FolderName="image/"; 
    $FileName=$FolderName.'_'.$profile; 

    $copied=copy($_FILES['profile']['tmp_name'], $FileName);

    if(!$copied) 
    {
      echo "<p>Staff Photo Cannot Upload!</p>";
      exit();
    }

 		$check="SELECT * FROM staff WHERE staffid='$txtstaffid' AND email='$txtemail'";
 		$result=mysqli_query($connection,$check);
 		$count=mysqli_num_rows($result);

 		if ($count>0) {
 			echo "<script>window.alert('Staff Already Exist!')</script>";
 			echo "<script>window.location='staffadd.php'</script>";
 		}

 		else {
      $insert="INSERT INTO staff 
              (staffid,name,gender,dob,nrc,address,phone,email,profile,stafftypeid,status,basicsalary,password) VALUES 
              ('$txtstaffid','$txtname','$rdogender','$txtdob','$txtnrc','$txtaddress','$txtphone','$txtemail','$FileName','$sltstafftype','$status','$txtsalary','$txtpassword')";
      $result=mysqli_query($connection,$insert);
 		}

 		if ($result) {
 			echo "<script>window.alert('Staff Added Successfully!')</script>";
 			echo "<script>window.location='staffadd.php'</script>";
 		}

 		else{
 			echo "<p>Something went wrong in Staff Entry : " . mysqli_error($connection) . "</p>";
 		}
 	}
?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Staff</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="staffadd.php">Add Staff</a></li>
          <li class="breadcrumb-item"><a href="stafflist.php">Staff List</a></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title text-center">Staff Register</h5>

            <form class="row g-3" action="staffadd.php" method="post" enctype="multipart/form-data">

                <div class="col-6">
                  <label for="id" class="form-label">Staff ID <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtstaffid" id="id" value="<?php echo AutoID('staff','staffid','S-',3)?>" readonly>
                </div>

                <div class="col-6">
                  <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtname" id="name" placeholder="Enter Staff Name" required="">
                </div>

                <div class="col-6">
                  <label for="address" class="form-label">Address <span style="color: red;">*</span></label>
                  <textarea class="form-control" name="txtaddress" id="address" placeholder="Enter Address" required=""></textarea>
                </div>

                <div class="col-6">
                  <label for="gender" class="form-label">Gender <span style="color: red;">*</span></label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdogender" id="male" value="Male" checked>
                    <label class="form-check-label" for="male">Male</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdogender" id="female" value="Female">
                    <label class="form-check-label" for="female">Female</label>
                  </div>
                </div>

                <div class="col-6">
                  <label for="dob" class="form-label">Date of Birth <span style="color: red;">*</span></label>
                  <input type="date" class="form-control" name="txtdob" id="dob" required="">
                </div>

                <div class="col-6">
                  <label for="nrc" class="form-label">NRC <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtnrc" id="nrc" placeholder="Enter NRC" required="">
                </div>

                <div class="col-6">
                  <label for="phone" class="form-label">Phone <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" name="txtphone" id="phone" placeholder="Enter Phone Number" required="">
                </div>

                <div class="col-6">
                  <label for="email" class="form-label">Email <span style="color: red;">*</span></label>
                  <input type="email" class="form-control" name="txtemail" id="email" placeholder="Enter Email" required="">
                </div>

                <div class="col-6">
                  <label for="pic" class="form-label">Profile <span style="color: red;">*</span></label>
                  <input type="file" class="form-control" name="profile" id="pic" required="">
                </div>

                <div class="col-6">
                  <label for="role" class="form-label">Staff Type<span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="role" name="sltstafftype">
                      <option>-- Select Staff Type --</option>
                      <?php 
                        $stafftypedata="SELECT * FROM stafftype";
                        $result=mysqli_query($connection,$stafftypedata);
                        $count=mysqli_num_rows($result);

                        for ($i=0; $i <$count ; $i++) { 
                          $row=mysqli_fetch_array($result);
                          $stafftypeid=$row['stafftypeid'];
                          $stafftype=$row['stafftype'];

                          echo "<option value='$stafftypeid'>$stafftypeid - $stafftype</option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="col-6">
                  <label for="salary" class="form-label">Salary <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" name="txtsalary" id="salary" placeholder="Enter Basic Salary" required="">
                </div>

                <div class="col-6">
                  <label for="password" class="form-label">Password <span style="color: red;">*</span></label>
                  <input type="password" class="form-control" name="txtpassword" id="password" placeholder="Enter Password" required="">
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