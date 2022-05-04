  <?php 
  require 'dbconnect.php';
  include 'header.php';

  $query="SELECT * FROM student";
	$result=mysqli_query($connection,$query);
	$count=mysqli_num_rows($result);

	if($count<1){
		echo "<p>No Record Found!</p>";
	}
	else{
	?>
  <main id="main" class="main">
      <div class="pagetitle">
        <h1>Student</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item"><a href="studentadd.php">Add Student</a></li>
            <li class="breadcrumb-item active">Student List</li>
          </ol>
        </nav>
      </div>
    	<section class="section">
          <div class="row">
            <div class="col-lg-12">

              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Student List</h5>
                  <div class="table-responsive">
                  <table class="table datatable table-hover table-bordered table-striped">
                    <thead>
                      <tr class="table-dark">
                        <th>ID</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

            				<?php 
            				for($i=0;$i<$count;$i++) 
            				{ 
            					$rows=mysqli_fetch_array($result);
            					$studentid=$rows['studentid'];
            					$name=$rows['name'];
                      $dob=$rows['dob'];
                      $DOB=date("M d, Y",strtotime($dob)); 
            					$phone=$rows['phone'];                  			
                      $email=$rows['email'];
                      $address=$rows['address'];
            				?>
            				<tr>
                        <th><?php echo $studentid ?></th>
                        <td><?php echo $name ?></td>
                        <td><?php echo $DOB ?></td>                        
                        <td><?php echo $phone ?></td>
                        <td><?php echo $email ?></td>
                        <td><?php echo $address ?></td>
                        <td>
                            <a href="studentprofile.php?studentid=<?=$studentid?>"class="btn btn-info">
                                <i class="bi bi-info-circle"></i>
                            </a>
                            <a href="studentedit.php?studentid=<?=$studentid?>"class="btn btn-success">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <a onClick="javascript: return confirm('Are you sure you want to delete?');" href="studentdelete.php?studentid=<?=$studentid?>" class="btn btn-danger">
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
  </main>
  <?php } include 'footer.php' ?>