<?php 
 	require 'dbconnect.php';
 	include 'header.php';

 	if (isset($_POST['btnupdate'])) {
 		$txtstudentid=$_POST['txtstudentid'];
 		$txtname=$_POST['txtname'];
    $txtdob=$_POST['txtdob'];
    $rdogender=$_POST['rdogender'];
    $txtaddress=$_POST['txtaddress'];
    $txtphone=$_POST['txtphone'];
    $txtemail=$_POST['txtemail'];
    $txtpassword=$_POST['txtpassword'];
    $oldprofile=$_POST['oldprofile'];
    

    if ($_FILES['newprofile']['name']){
      $newprofile =$_FILES['newprofile']['name'];
      $FolderName="image/"; 
      $FileName=$FolderName.'_'.$newprofile;

      $copied=copy($_FILES['newprofile']['tmp_name'], $FileName);
    }

    else{
      $FileName=$oldprofile;
    }

    $update="UPDATE student SET 
            studentid='$txtstudentid',
            name='$txtname',
            dob='$txtdob',
            gender='$rdogender',
            address='$txtaddress',            
            phone='$txtphone',
            email='$txtemail',
            profile='$FileName',
            password='$txtpassword'         
            WHERE studentid='$txtstudentid'";
    $result=mysqli_query($connection,$update);

    if($result) 
    {
      echo "<script>window.alert('Student Updated Successfully!')</script>";
      echo "<script>window.location='studentlist.php'</script>";
    }
    else
    {
      echo "<p>Something went wrong in Student Update : " . mysqli_error($connection) . "</p>";
    }
 	}

  //-------------------------------

  if(isset($_GET['studentid'])) 
  {
    $studentid=$_GET['studentid'];

    $query="SELECT * FROM student WHERE studentid='$studentid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
  } 
  else
  {
    $studentid="";
    echo "<script>window.location='studentlist.php'</script>";
  }
?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Student</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="studentlist.php">Student List</a></li>
          <li class="breadcrumb-item active">Update Student</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title text-center">Student Update  </h5>

              <form class="row g-3" action="studentedit.php" method="post" enctype="multipart/form-data">

               <input type="hidden" name="oldprofile" value="<?= $arr['profile']?>">

                <div class="col-6">
                  <label for="id" class="form-label">Student ID <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtstudentid" id="id" value="<?php echo $arr['studentid'] ?>" readonly>
                </div>

                <div class="col-6">
                  <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtname" id="name" value="<?php echo $arr['name'] ?>" required="">
                </div>

                <div class="col-6">
                  <label for="dob" class="form-label">Date of Birth </label>
                  <input type="date" class="form-control" name="txtdob" id="dob" value="<?php echo $arr['dob'] ?>">
                </div>

                <div class="col-6">
                  <label for="gender" class="form-label">Gender</label>
                  <?php 
                      $studentid=$_GET['studentid'];
                      $studentgender="SELECT * FROM student WHERE studentid='$studentid'";
                      $result=mysqli_query($connection,$studentgender);
                      $row=mysqli_fetch_array($result);
                      $gender=$row['gender'];
                    ?>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdogender" id="male" value="Male" <?php echo ($gender=='Male')?'checked':'' ?>>
                    <label class="form-check-label" for="male">Male</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdogender" id="female" value="Female" <?php echo ($gender=='Female')?'checked':'' ?>>
                    <label class="form-check-label" for="female">Female</label>
                  </div>
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Address <span style="color: red;">*</span></label>
                  <textarea class="form-control" name="txtaddress" id="address" required=""><?php echo $arr['address'] ?></textarea>
                </div>

                <div class="col-6">
                  <label for="phone" class="form-label">Phone <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" name="txtphone" id="phone" value="<?php echo $arr['phone'] ?>" required="">
                </div>

                <div class="col-6">
                  <label for="email" class="form-label">Email <span style="color: red;">*</span></label>
                  <input type="email" class="form-control" name="txtemail" id="email" value="<?php echo $arr['email'] ?>" required="">
                </div>

                <div class="col-6">
                  <label for="password" class="form-label">Password <span style="color: red;">*</span></label>
                  <input type="password" class="form-control" name="txtpassword" id="password" value="<?php echo $arr['password'] ?>" required="">
                </div>

                <div class="col-6">
                  <label>Old Profile</label><br>
                  <img src="<?=$arr['profile']?>" width=100px; heigt=100px;>
                </div>

                <div class="col-6">
                  <label for="pic" class="form-label">New Profile</label>
                  <input type="file" class="form-control" name="newprofile" id="pic">
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btnupdate">Update</button>
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