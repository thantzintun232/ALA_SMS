<?php 
 	require 'dbconnect.php';
 	include 'studentheader.php';

  if (isset($_POST['btnsubmit'])) {

  $studentid=$_SESSION['studentid'];
  $txtassignmentid=$_POST['txtassignmentid'];
  $status="Not Graded";
  $tdydate= strtotime(date("Y-m-d"));

  $uploadfile=$_FILES['uploadfile']['name'];
  $FolderName="assignmentfile/"; 
  $FileName=$FolderName.'_'.$uploadfile; 

  $copied=copy($_FILES['uploadfile']['tmp_name'], $FileName);

  if(!$copied) 
  {
    echo "<p>File Cannot Upload!</p>";
    exit();
  }

  $check="SELECT * FROM assignment WHERE assignmentid='$txtassignmentid'";
  $result=mysqli_query($connection,$check);
  $arr=mysqli_fetch_array($result);
  $duedate=strtotime($arr['due_date']);

  if ($tdydate>$duedate) {
    echo "<script>window.alert('The assignment submission is over due date!')</script>";
    echo "<script>window.location='studentassignmentupload.php'</script>";
  }

  else
  {

  $check="SELECT * FROM assignmentdetail WHERE studentid='$studentid' AND assignmentid='$txtassignmentid'";
  $result=mysqli_query($connection,$check);
  $count=mysqli_num_rows($result);

  if ($count>0) {
      echo "<script>window.alert('You have already submitted!')</script>";
      echo "<script>window.location='studentassignmentupload.php'</script>";
  }

  else {
    $insert="INSERT INTO assignmentdetail (uploadfile,status,assignmentid,studentid) VALUES ('$FileName','$status','$txtassignmentid','$studentid')";
    $result=mysqli_query($connection,$insert);
  }  

  if ($result) {
      echo "<script>window.alert('Assignment Submitted Successfully!')</script>";
      echo "<script>window.location='studentassignmentupload.php'</script>";
    }

    else{
      echo "<p>Something went wrong in Assignment Upload : " . mysqli_error($connection) . "</p>";
    }
  }
  }

  //----------------------

  if(isset($_GET['assignmentid'])) 
  {
    $assignmentid=$_GET['assignmentid'];

    $query="SELECT * FROM assignment WHERE assignmentid='$assignmentid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
  } 
  else
  {
    $assignmentid="";
    echo "<script>window.location='studentassignmentupload.php'</script>";
  }
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Upload Assignment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="studenthome.php">Home</a></li>
          <li class="breadcrumb-item"><a href="studentassignmentupload.php">My Assignment</a></li>
          <li class="breadcrumb-item active">Upload Assingment</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Assingment Upload</h5>

              <form class="row g-3" action="uploadassignment.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="txtassignmentid" value="<?php echo $arr['assignmentid'] ?>">
                <div class="col-12">
                  <label for="name" class="form-label">Assignment Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="name" name="txtname" value="<?php echo $arr['name'] ?>" readonly>
                </div>

                <div class="col-12">
                  <label for="upload" class="form-label">File <span style="color: red;">*</span></label>
                  <input type="file" class="form-control" name="uploadfile" id="upload" required="">
                </div>

                <div>
                  <i><span style="color: red;">Note: You can submit only once, make sure to check your file before submitted</span></i>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btnsubmit">Upload</button>
                  <button type="reset" class="btn btn-secondary" name="btnreset">Reset</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>
</main>

<?php include 'footer.php' ?>