<?php 
 	require 'dbconnect.php';
 	include 'header.php';

 	if (isset($_POST['btnsubmit'])) {
 		$txtcourename=$_POST['txtcourename'];
 		$numfee=$_POST['numfee'];
    $numdiscount=$_POST['numdiscount'];
    $txtstartdate=$_POST['txtstartdate'];
    $txtenddate=$_POST['txtenddate'];
    $sltlanguage=$_POST['sltlanguage'];
    $sltroom=$_POST['sltroom'];
    $sltinstructor=$_POST['sltinstructor'];
    $status="Active";

 		$check="SELECT * FROM course WHERE coursename='$txtcourename' AND startdate='$txtstartdate' AND languageid='$sltlanguage'";
 		$result=mysqli_query($connection,$check);
 		$count=mysqli_num_rows($result);

 		if ($count>0) {
 			echo "<script>window.alert('Course Already Exist!')</script>";
 			echo "<script>window.location='courseadd.php'</script>";
 		}

 		else {
 			$insert="INSERT INTO course (coursename,fee,discount,startdate,enddate,languageid,roomid,staffid,status) VALUES ('$txtcourename','$numfee','$numdiscount','$txtstartdate','$txtenddate','$sltlanguage','$sltroom','$sltinstructor','$status')";
 			$result=mysqli_query($connection,$insert);
 		}

 		if ($result) {
 			echo "<script>window.alert('Course Added Successfully!')</script>";
 			echo "<script>window.location='courseadd.php'</script>";
 		}

 		else{
 			echo "<p>Something went wrong in Course Entry : " . mysqli_error($connection) . "</p>";
 		}
 	}
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Course</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Add Course</li>
          <li class="breadcrumb-item"><a href="coursesearch.php">Search Course</a></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title text-center">Course Register</h5>

            <form class="row g-3" action="courseadd.php" method="post">
                <div class="col-12">
                  <label for="coursename" class="form-label">Course Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtcourename" id="coursename"  placeholder="Enter Course Name" required="">
                </div>

                <div class="col-12">
                  <label for="fee" class="form-label">Fee <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" name="numfee" id="fee" placeholder="Enter Price" required="">
                </div>

                <div class="col-12">
                  <label for="discount" class="form-label">Discount </label>
                  <input type="number" class="form-control" name="numdiscount" placeholder="Enter Discount Amount" id="discount">
                </div>

                <div class="col-12">
                  <label for="startdate" class="form-label">Start Date <span style="color: red;">*</span></label>
                  <input type="date" class="form-control" name="txtstartdate" id="startdate" required="">
                </div>

                <div class="col-12">
                  <label for="enddate" class="form-label">End Date <span style="color: red;">*</span></label>
                  <input type="date" class="form-control" name="txtenddate" id="enddate" required="">
                </div>

                <div class="col-12">
                  <label for="language" class="form-label">Language <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="language" name="sltlanguage">
                      <option>-- Select Language --</option>
                      <?php 
                        $languagedata="SELECT * FROM language";
                        $result=mysqli_query($connection,$languagedata);
                        $count=mysqli_num_rows($result);

                        for ($i=0; $i <$count ; $i++) { 
                          $row=mysqli_fetch_array($result);
                          $languageid=$row['languageid'];
                          $languagename=$row['languagename'];

                          echo "<option value='$languageid'>$languagename</option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="col-12">
                  <label for="room" class="form-label">Room <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="room" name="sltroom">
                      <option>-- Select Room --</option>
                      <?php 
                        $roomdata="SELECT * FROM room";
                        $result=mysqli_query($connection,$roomdata);
                        $count=mysqli_num_rows($result);

                        for ($i=0; $i <$count ; $i++) { 
                          $row=mysqli_fetch_array($result);
                          $roomid=$row['roomid'];
                          $roomname=$row['roomname'];

                          echo "<option value='$roomid'>$roomname</option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="col-12">
                  <label for="instructor" class="form-label">Instructor <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="instructor" name="sltinstructor">
                      <option>-- Select Instructor --</option>
                      <?php 
                        $instructordata="SELECT * FROM staff s, stafftype sf WHERE s.stafftypeid=sf.stafftypeid AND sf.stafftype='Instructor'";
                        $result=mysqli_query($connection,$instructordata);
                        $count=mysqli_num_rows($result);

                        for ($i=0; $i <$count ; $i++) { 
                          $row=mysqli_fetch_array($result);
                          $staffid=$row['staffid'];
                          $name=$row['name'];

                          echo "<option value='$staffid'>$name</option>";
                        }
                       ?>                       
                    </select>               
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