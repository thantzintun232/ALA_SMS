<?php 
 	require 'dbconnect.php';
 	include 'header.php';

 	if (isset($_POST['btnupdate'])) {
    $txtstaffid=$_POST['txtstaffid'];    
    $txtname=$_POST['txtname'];
    $rdogender=$_POST['rdogender'];
    $txtdob=$_POST['txtdob'];
    $txtnrc=$_POST['txtnrc'];
    $txtaddress=$_POST['txtaddress'];
    $txtphone=$_POST['txtphone'];
    $txtemail=$_POST['txtemail'];
    $sltstafftype=$_POST['sltstafftype'];
    $txtsalary=$_POST['txtsalary'];
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

    $update="UPDATE staff SET 
            staffid='$txtstaffid',
            name='$txtname',
            gender='$rdogender',
            dob='$txtdob',
            address='$txtaddress',
            nrc='$txtnrc',
            phone='$txtphone',
            email='$txtemail',
            profile='$FileName',
            stafftypeid='$sltstafftype',
            basicsalary='$txtsalary',  
            password='$txtpassword'         
            WHERE staffid='$txtstaffid'";
    $result=mysqli_query($connection,$update);

    if($result) 
    {
      echo "<script>window.alert('Staff Updated Successfully!')</script>";
      echo "<script>window.location='stafflist.php'</script>";
    }
    else
    {
      echo "<p>Something went wrong in Staff Update : " . mysqli_error($connection) . "</p>";
    }
 	}

  //-------------------------------

  if(isset($_GET['staffid'])) 
  {
    $staffid=$_GET['staffid'];

    $query="SELECT * FROM staff WHERE staffid='$staffid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
  } 
  else
  {
    $staffid="";
    echo "<script>window.location='stafflist.php'</script>";
  }
?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Staff</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="stafflist.php">Staff List</a></li>
          <li class="breadcrumb-item active">Update Staff</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title text-center">Staff Update  </h5>

              <form class="row g-3" action="staffedit.php" method="post" enctype="multipart/form-data">

               <input type="hidden" name="oldprofile" value="<?= $arr['profile']?>">

                <div class="col-6">
                  <label for="id" class="form-label">Staff ID <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtstaffid" id="id" value="<?php echo $arr['staffid'] ?>" required="">
                </div>

                   <div class="col-6">
                  <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtname" id="name" value="<?php echo $arr['name'] ?>" required="">
                </div>

                <div class="col-6">
                  <label for="address" class="form-label">Address <span style="color: red;">*</span></label>
                  <textarea class="form-control" name="txtaddress" id="address" required=""><?php echo $arr['address'] ?></textarea>
                </div>

                <div class="col-6">
                  <label for="gender" class="form-label">Gender <span style="color: red;">*</span></label>
                    <?php 
                        $staffid=$_GET['staffid'];
                        $staffgender="SELECT * FROM staff WHERE staffid='$staffid'";
                        $result=mysqli_query($connection,$staffgender);
                        $row=mysqli_fetch_array($result);
                    ?>
 
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdogender" id="male" value="Male" <?php echo ($row['gender']=='Male')?'checked':'' ?>>
                    <label class="form-check-label" for="male">Male</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdogender" id="female" value="Female" <?php echo ($row['gender']=='Female')?'checked':'' ?>>
                    <label class="form-check-label" for="female">Female</label>
                  </div>
                </div>

                <div class="col-12">
                  <label for="dob" class="form-label">Date of Birth <span style="color: red;">*</span></label>
                  <input type="date" class="form-control" name="txtdob" id="dob" value="<?php echo $arr['dob'] ?>" required="">
                </div>

                <div class="col-6">
                  <label for="nrc" class="form-label">NRC <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtnrc" id="nrc" value="<?php echo $arr['nrc'] ?>" required="">
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

                          ?>
                          <option value="<?= $stafftypeid ?>"

                        <?php 
                          if ($arr['stafftypeid']==$stafftypeid) {
                            echo "selected";
                          }
                          ?>
                          >
                          <?= $stafftypeid.' - '.$stafftype ?>
                          </option>
                      <?php } ?>                      
                    </select>               
                </div>

                <div class="col-6">
                  <label for="salary" class="form-label">Salary <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" name="txtsalary" id="salary" value="<?php echo $arr['basicsalary'] ?>" required="">
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