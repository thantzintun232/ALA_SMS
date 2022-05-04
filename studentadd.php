<?php 
 	require 'dbconnect.php';
 	include 'header.php';

 	if (isset($_POST['btnsubmit'])) {
 		$txtstudentid=$_POST['txtstudentid'];
 		$txtname=$_POST['txtname'];
    $rdogender=$_POST['rdogender'];
    $txtdob=$_POST['txtdob'];
    $txtaddress=$_POST['txtaddress'];
    $txtphone=$_POST['txtphone'];
    $txtemail=$_POST['txtemail'];
    $txtpassword=$_POST['txtpassword'];

    $profile=$_FILES['profile']['name'];
    $FolderName="image/"; 
    $FileName=$FolderName.'_'.$profile; 

    $copied=copy($_FILES['profile']['tmp_name'], $FileName);

    if(!$copied) 
    {
      echo "<p>Student Photo Cannot Upload!</p>";
      exit();
    }

 		$check="SELECT * FROM student WHERE studentid='$txtstudentid' AND email='$txtemail'";
 		$result=mysqli_query($connection,$check);
 		$count=mysqli_num_rows($result);

 		if ($count>0) {
 			echo "<script>window.alert('Student Already Exist!')</script>";
 			echo "<script>window.location='studentadd.php'</script>";
 		}

 		else {
 			$insert="INSERT INTO student 
              (studentid,name,dob,gender,address,phone,email,profile,password) VALUES 
              ('$txtstudentid','$txtname','$txtdob','$rdogender','$txtaddress','$txtphone','$txtemail','$FileName','$txtpassword')";
 			$result=mysqli_query($connection,$insert);
 		}

 		if ($result) {
 			echo "<script>window.alert('Student Added Successfully!')</script>";
 			echo "<script>window.location='studentadd.php'</script>";
 		}

 		else{
 			echo "<p>Something went wrong in Student Entry : " . mysqli_error($connection) . "</p>";
 		}
 	}
?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Student</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Add Student</li>
          <li class="breadcrumb-item"><a href="studentlist.php">Student List</a></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title text-center">Student Register</h5>

            <form class="row g-3" action="studentadd.php" method="post" enctype="multipart/form-data">

                <div class="col-6">
                  <label for="id" class="form-label">Student ID <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtstudentid" id="id" value="<?php echo AutoID('student','studentid','ST-',6)?>" readonly>
                </div>

                <div class="col-6">
                  <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtname" id="name" placeholder="Enter Student Name" required="">
                </div>

                <div class="col-6">
                  <label for="dob" class="form-label">Date of Birth </label>
                  <input type="date" class="form-control" name="txtdob" id="dob">
                </div>

                <div class="col-6">
                  <label for="gender" class="form-label">Gender</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdogender" id="male" value="Male" checked>
                    <label class="form-check-label" for="male">Male</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdogender" id="female" value="Female">
                    <label class="form-check-label" for="female">Female</label>
                  </div>
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Address <span style="color: red;">*</span></label>
                  <textarea class="form-control" name="txtaddress" id="address" placeholder="Enter Address" required=""></textarea>
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