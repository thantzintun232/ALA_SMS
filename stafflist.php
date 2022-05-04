  <?php 
  require 'dbconnect.php';
  include 'header.php';

  $query="SELECT s.*, sf.stafftype as stafftype FROM staff s, stafftype sf WHERE s.stafftypeid=sf.stafftypeid";
	$result=mysqli_query($connection,$query);
	$count=mysqli_num_rows($result);

	if($count<1){
		echo "<p>No Record Found!</p>";
	}
	else{
	?>
  <main id="main" class="main">
      <div class="pagetitle">
        <h1>Staff</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item"><a href="staffadd.php">Add Staff</a></li>
            <li class="breadcrumb-item active">Staff List</li>
          </ol>
        </nav>
      </div>
    	<section class="section">
          <div class="row">
            <div class="col-lg-12">

              <div class="card">
                <div class="card-body">
                  <form action="staffexport.php" method="post">
                  <h5 class="card-title">Staff List | <button class="btn btn-primary" name="csvexport">CSV Export</button></h5>
                  </form>
                  <div class="table-responsive">
                  <table class="table datatable table-hover table-bordered table-striped">
                    <thead>
                      <tr class="table-dark">
                        <th>ID</th>
                        <th>Name</th>                        
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Salary</th>
                        <th>Position</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

            				<?php 
            				for($i=0;$i<$count;$i++) 
            				{ 
            					$rows=mysqli_fetch_array($result);
            					$staffid=$rows['staffid'];
            					$name=$rows['name'];
                      $phone=$rows['phone'];				
                      $email=$rows['email'];
                      $salary=$rows['basicsalary'];
                      $stafftype=$rows['stafftype'];
            				?>
            				<tr>
                        <th><?php echo $staffid ?></th>
                        <td><?php echo $name ?></td>                        
                        <td><?php echo $phone ?></td>
                        <td><?php echo $email ?></td>
                        <td><?php echo $salary ?></td>
                        <td><?php echo $stafftype ?></td>
                        <td>
                            <a href="staffprofile.php?staffid=<?=$staffid?>"class="btn btn-info">
                                <i class="bi bi-info-circle"></i>
                            </a>
                            <a href="staffedit.php?staffid=<?=$staffid?>"class="btn btn-success">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <a onClick="javascript: return confirm('Are you sure you want to delete?');" href="staffdelete.php?staffid=<?=$staffid?>" class="btn btn-danger">
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