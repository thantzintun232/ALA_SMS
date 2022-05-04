<?php 
  require 'dbconnect.php';
  include 'header.php';

  $staffid=$_SESSION['staffid'];
  if (isset($_POST['btnupdate'])) 
  {
    $txtassignmentid=$_POST['txtassignmentid'];
    $txtname=$_POST['txtname'];
    $txtdescription=$_POST['txtdescription'];
    $txtduedate=$_POST['txtduedate'];
    $sltcourse=$_POST['sltcourse'];

    $update="UPDATE assignment SET 
            name='$txtname',
            description='$txtdescription',
            due_date='$txtduedate',
            courseid='$sltcourse'
            WHERE assignmentid='$txtassignmentid'";
    $result=mysqli_query($connection,$update);

    if($result) 
    {
      echo "<script>window.alert('Assignment Updated Successfully!')</script>";
      echo "<script>window.location='assignmentadd.php'</script>";
    }
    else
    {
      echo "<p>Something went wrong in Assignment Update : " . mysqli_error($connection) . "</p>";
    }
  }

  //------------------------------

  if(isset($_GET['assignmentid'])) 
  {
    $assignmentid=$_GET['assignmentid'];

    $query="SELECT * FROM assignment WHERE assignmentid='$assignmentid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
  } 
  else
  {
    $courseid="";
    echo "<script>window.location='assignmentadd.php'</script>";
  }
 ?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Assignment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="assignmentadd.php">Add Assingment</a></li>
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

              <form class="row g-3" action="assignmentedit.php" method="post">

                <input type="hidden" name="txtassignmentid" value="<?php echo $arr['assignmentid'] ?>">

                <div class="col-12">
                  <label for="name" class="form-label">Assignment Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="name" name="txtname"value="<?php echo $arr['name'] ?>">
                </div>

                <div class="col-12">
                  <label for="description" class="form-label">Description <span style="color: red;">*</span></label>
                  <textarea class="form-control" id="description" name="txtdescription" placeholder="Enter Description" required=""><?php echo $arr['description'] ?></textarea>
                </div>

                <div class="col-12">
                  <label for="duedate" class="form-label">Due Date <span style="color: red;">*</span></label>
                  <input type="date" class="form-control" id="duedate" name="txtduedate" value="<?php echo $arr['due_date'] ?>">
                </div>

                <div class="col-12">
                  <label for="course" class="form-label">Course <span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="course" name="sltcourse">
                      <option>-- Select Course --</option>
                       <?php 
                        $coursedata="SELECT c.*,l.languagename as languagename FROM course c, language l, staff s WHERE c.languageid=l.languageid AND s.staffid=c.staffid AND s.staffid='$staffid'";
                        $result=mysqli_query($connection,$coursedata);
                        $count=mysqli_num_rows($result);

                        for ($i=0; $i <$count ; $i++) { 
                          $row=mysqli_fetch_array($result);
                          $courseid=$row['courseid'];
                          $languagename=$row['languagename'];
                          $coursename=$row['coursename'];

                          ?>
                          <option value="<?= $courseid ?>"

                        <?php 
                          if ($arr['courseid']==$courseid) {
                            echo "selected";
                          }
                          ?>
                          >
                          <?= $languagename .' - '.$coursename ?>
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

<?php include 'footer.php' ?>