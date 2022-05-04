<?php 
 	require 'dbconnect.php';
 	include 'studentheader.php';

  if (isset($_POST['btnupdate'])) {

  $assignmentdetailid=$_POST['txtassignmentdetailid'];
  $tdydate= date("Y-m-d");

  $uploadfile=$_FILES['uploadfile']['name'];
  $FolderName="assignmentfile/"; 
  $FileName=$FolderName.'_'.$uploadfile; 

  $copied=copy($_FILES['uploadfile']['tmp_name'], $FileName);

  if(!$copied) 
  {
    echo "<p>File Cannot Upload!</p>";
    exit();
  }

  $update="UPDATE assignmentdetail SET 
            uploadfile='$FileName',
            uploaddate='$tdydate'        
            WHERE assignmentdetailid='$assignmentdetailid'";
  $result=mysqli_query($connection,$update);

  if($result) 
  {
    echo "<script>window.alert('Updated Successfully!')</script>";
    echo "<script>window.location='assignmenthistory.php'</script>";
  }
  else
  {
    echo "<p>Something went wrong in Assignment Update : " . mysqli_error($connection) . "</p>";
  }

  }

  //----------------------

  if(isset($_GET['assignmentdetailid'])) 
  {
    $assignmentdetailid=$_GET['assignmentdetailid'];

    $query="SELECT ad.*, a.name as assignmentname FROM assignment a, assignmentdetail ad WHERE a.assignmentid=ad.assignmentid AND assignmentdetailid='$assignmentdetailid'";
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
      <h1>Update Assignment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="studenthome.php">Home</a></li>
          <li class="breadcrumb-item"><a href="assignmenthistory.php">Assignment History</a></li>
          <li class="breadcrumb-item active">Update Assingment</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Assingment Update</h5>

              <form class="row g-3" action="studentassignmentupdate.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="txtassignmentdetailid" value="<?php echo $arr['assignmentdetailid'] ?>">
                <div class="col-12">
                  <label for="name" class="form-label">Assignment Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="name" name="txtname" value="<?php echo $arr['assignmentname'] ?>" readonly>
                </div>

                <div class="col-12">
                  <label for="upload" class="form-label">File <span style="color: red;">*</span></label>
                  <input type="file" class="form-control" name="uploadfile" id="upload" required="">
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
</main>

<?php include 'footer.php' ?>