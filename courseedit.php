<?php 
	require 'dbconnect.php';
	include 'header.php';

	if (isset($_POST['btnupdate'])) 
	{
		$txtcourseid=$_POST['txtcourseid'];
		$txtcourename=$_POST['txtcourename'];
 		$numfee=$_POST['numfee'];
    $numdiscount=$_POST['numdiscount'];
    $txtstartdate=$_POST['txtstartdate'];
    $txtenddate=$_POST['txtenddate'];
    $sltlanguage=$_POST['sltlanguage'];
    $sltroom=$_POST['sltroom'];
    $sltinstructor=$_POST['sltinstructor'];

 		$update="UPDATE course SET 
            coursename='$txtcourename',
            fee='$numfee',
            discount='$numdiscount',
            startdate='$txtstartdate',
            enddate='$txtenddate',
            languageid='$sltlanguage',
            roomid='$sltroom',
            staffid='$sltinstructor'
            WHERE courseid='$txtcourseid'";
 		$result=mysqli_query($connection,$update);

		if($result) 
		{
			echo "<script>window.alert('Course Updated Successfully!')</script>";
			echo "<script>window.location='coursesearch.php'</script>";
		}
		else
		{
			echo "<p>Something went wrong in Course Update : " . mysqli_error($connection) . "</p>";
		}
	}

	//------------------------------

	if(isset($_GET['courseid'])) 
	{
		$courseid=$_GET['courseid'];

		$query="SELECT * FROM course WHERE courseid='$courseid'";
		$result=mysqli_query($connection,$query);
		$arr=mysqli_fetch_array($result);
	}	
	else
	{
		$courseid="";
		echo "<script>window.location='courselist.php'</script>";
	}
 ?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Course</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="courseadd.php">Add Course</a></li>
          <li class="breadcrumb-item active">Update Course</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Course Update</h5>

            <form class="row g-3" action="courseedit.php" method="post">

              <input type="hidden" name="txtcourseid" value="<?php echo $arr['courseid'] ?>">

                <div class="col-12">
                  <label for="coursename" class="form-label">Course Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtcourename" id="coursename" value="<?php echo $arr['coursename'] ?>" required="">
                </div>

                <div class="col-12">
                  <label for="fee" class="form-label">Fee <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" name="numfee" id="fee" value="<?php echo $arr['fee'] ?>" required="">
                </div>

                <div class="col-12">
                  <label for="discount" class="form-label">Discount </label>
                  <input type="number" class="form-control" name="numdiscount" id="discount" value="<?php echo $arr['discount'] ?>">
                </div>

                <div class="col-12">
                  <label for="startdate" class="form-label">Start Date <span style="color: red;">*</span></label>
                  <input type="date" class="form-control" name="txtstartdate" id="startdate" value="<?php echo $arr['startdate'] ?>"required="">
                </div>

                <div class="col-12">
                  <label for="enddate" class="form-label">End Date <span style="color: red;">*</span></label>
                  <input type="date" class="form-control" name="txtenddate" id="enddate" value="<?php echo $arr['enddate'] ?>"required="">
                </div>

                <div class="col-12">
                  <label for="language" class="form-label">Language <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="language" name="sltlanguage">
                      <option>-- Select Language --</option>
                       <?php 
                        $languagedata="SELECT * FROM language";
                        $lresult=mysqli_query($connection,$languagedata);
                        $lcount=mysqli_num_rows($lresult);

                        for ($i=0; $i <$lcount ; $i++) { 
                          $row=mysqli_fetch_array($lresult);
                          $languageid=$row['languageid'];
                          $languagename=$row['languagename'];

                          ?>
                          <option value="<?= $languageid ?>"

                        <?php 
                          if ($arr['languageid']==$languageid) {
                            echo "selected";
                          }
                          ?>
                          >
                          <?= $languagename ?>
                          </option>
                      <?php } ?>               
                    </select>               
                </div>

                <div class="col-12">
                  <label for="room" class="form-label">Room <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="room" name="sltroom">
                      <option>-- Select Room --</option>
                      <?php 
                        $roomdata="SELECT * FROM room";
                        $rresult=mysqli_query($connection,$roomdata);
                        $rcount=mysqli_num_rows($rresult);

                        for ($i=0; $i <$rcount ; $i++) { 
                          $row=mysqli_fetch_array($rresult);
                          $roomid=$row['roomid'];
                          $roomname=$row['roomname'];

                          ?>
                          <option value="<?= $roomid ?>"

                        <?php 
                          if ($arr['roomid']==$roomid) {
                            echo "selected";
                          }
                          ?>
                          >
                          <?= $roomname ?>
                          </option>
                      <?php } ?>                   
                    </select>               
                </div>

                <div class="col-12">
                  <label for="instructor" class="form-label">Instructor <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="instructor" name="sltinstructor">
                      <option>-- Select Instructor --</option>
                      <?php 
                        $instructordata="SELECT * FROM staff s, stafftype sf WHERE s.stafftypeid=sf.stafftypeid AND sf.stafftype='Instructor'";
                        $iresult=mysqli_query($connection,$instructordata);
                        $icount=mysqli_num_rows($iresult);

                        for ($i=0; $i <$icount ; $i++) { 
                          $row=mysqli_fetch_array($iresult);
                          $staffid=$row['staffid'];
                          $name=$row['name'];

                          ?>
                          <option value="<?= $staffid ?>"

                        <?php 
                          if ($arr['staffid']==$staffid) {
                            echo "selected";
                          }
                          ?>
                          >
                          <?= $name ?>
                          </option>
                      <?php } ?>                    
                    </select>               
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