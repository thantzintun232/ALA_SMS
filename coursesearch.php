<?php 
	require 'dbconnect.php';
	include 'header.php';

	if (isset($_POST['btnsearch'])) 
	{
		$rdosearchtype=$_POST['rdosearchtype'];

		if ($rdosearchtype == 1) 
		{
			$sltlanguage=$_POST['sltlanguage'];

			$Query="SELECT c.*,s.name as instructorname,l.languagename as language
					FROM course c,staff s,language l
					WHERE c.languageid='$sltlanguage'
					AND c.languageid=l.languageid
					AND c.staffid=s.staffid
          AND c.status='Active'";
			$result=mysqli_query($connection,$Query);
		}
		else if($rdosearchtype == 2)
		{
			$sltinstructor=$_POST['sltinstructor'];

			$Query="SELECT c.*,s.name as instructorname,l.languagename as language
					FROM course c,staff s,language l
					WHERE c.staffid='$sltinstructor'
					AND c.languageid=l.languageid
					AND c.staffid=s.staffid
          AND c.status='Active'";
			$result=mysqli_query($connection,$Query);
		}
	}
	else if (isset($_POST['btnshowall'])) 
	{
		$query="SELECT c.*,l.languagename as language,s.name as instructorname 
			    FROM course c INNER JOIN language l ON c.languageid=l.languageid 
			    INNER JOIN staff s ON c.staffid=s.staffid WHERE c.status='Active'";
		$result=mysqli_query($connection,$query);
	}

	else
	{
		$query="SELECT c.*,l.languagename as language,s.name as instructorname 
          FROM course c INNER JOIN language l ON c.languageid=l.languageid 
          INNER JOIN staff s ON c.staffid=s.staffid WHERE c.status='Active'";
    $result=mysqli_query($connection,$query);
	}
 ?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Course Search</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="courseadd.php">Add Course</a></li>
          <li class="breadcrumb-item active">Search Course</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          	<div class="card-body">
              <h5 class="card-title">Search Option:</h5>

            <form class="row g-3" action="coursesearch.php" method="post">
                <div class="col-6">
                <input type="radio" name="rdosearchtype" value="1" checked="">
                  <label for="language" class="form-label">Search by Language</label>
                    <select class="form-select" aria-label="Default select example" id="language" name="sltlanguage">
                      <option>-- Choose Language --</option>
                      <?php 
                        $languagedata="SELECT * FROM language";
                        $lresult=mysqli_query($connection,$languagedata);
                        $lcount=mysqli_num_rows($lresult);

                        for ($i=0; $i <$lcount ; $i++) { 
                          $row=mysqli_fetch_array($lresult);
                          $languageid=$row['languageid'];
                          $languagename=$row['languagename'];

                          echo "<option value='$languageid'>$languagename</option>";
                        }
                       ?>                       
                    </select>               
                </div>

                <div class="col-6">
                  <input type="radio" name="rdosearchtype" value="2">
                  <label for="instructor" class="form-label">Search by Instructor</label>
                    <select class="form-select" aria-label="Default select example" id="instructor" name="sltinstructor">
                      <option>-- Choose Instructor --</option>
                      <?php 
                        $instructordata="SELECT * FROM staff s, stafftype sf WHERE s.stafftypeid=sf.stafftypeid AND sf.stafftype='Instructor'";
                        $iresult=mysqli_query($connection,$instructordata);
                        $icount=mysqli_num_rows($iresult);

                        for ($i=0; $i <$icount ; $i++) { 
                          $row=mysqli_fetch_array($iresult);
                          $staffid=$row['staffid'];
                          $name=$row['name'];

                          echo "<option value='$staffid'>$name</option>";
                        }
                       ?>                       
                    </select>               
                </div>           

                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btnsearch">Search</button>
                  <button type="reset" class="btn btn-secondary" name="btnreset">Reset</button>
                  <button type="submit" class="btn btn-success" name="btnshowall">Show All</button>
                </div>                
            </form>
            </div>
          </div>
        </div>
      </div>
    </section>  
    <?php 
	$count=mysqli_num_rows($result);

	if($count<1){
		echo "<p>No Record Found!</p>";
	}
	else{
	?>
	<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Course List</h5>
              <div class="table-responsive">
              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>Course</th>
                    <th>Fee</th>
                    <th>StartDate</th>
                    <th>End Date</th>
                    <th>Language</th>
                    <th>Instructor</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
        				<?php 
        				$a=1; 
        				for($i=0;$i<$count;$i++) 
        				{ 
    					  $rows=mysqli_fetch_array($result);
    					  $courseid=$rows['courseid'];
    					  $coursename=$rows['coursename'];
    					  $fee=$rows['fee'];	
                $startdate=$rows['startdate'];
                $date=date("M d, Y",strtotime($startdate));	
                $enddate=$rows['enddate'];
                $enddate=date("M d, Y",strtotime($enddate));
                $language=$rows['language'];
                $instructor=$rows['instructorname'];
      				?>
		        		<tr>
		                  <th><?php echo $a++ ?></th>
		                  <td><?php echo $coursename ?></td>
		                  <td><?php echo $fee ?></td>
		                  <td><?php echo $date ?></td>
		                  <td><?php echo $enddate ?></td>
		                  <td><?php echo $language ?></td>
		                  <td><?php echo $instructor ?></td>
		                  <td>
		                      <a href="courseedit.php?courseid=<?=$courseid?>"class="btn btn-success">
		                          <i class="bi bi-pencil-square"></i>
		                      </a>

		                      <a onClick="javascript: return confirm('Are you sure you want to delete?');" href="coursedelete.php?courseid=<?=$courseid?>" class="btn btn-danger">
		                          <i class="bi bi-trash"></i>
		                      </a>
		               	</td>
		                </tr>
		                <?php } ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
  <?php } ?>
</main><!-- End #main -->
<?php 
 	include 'footer.php';
?>