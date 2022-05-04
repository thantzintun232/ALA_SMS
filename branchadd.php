<?php 
 	require 'dbconnect.php';
 	include 'header.php';

 	if (isset($_POST['btnsubmit'])) {
 		$txtbranchname=$_POST['txtbranchname'];
 		$txtaddress=$_POST['txtaddress'];

 		//Check Validation
 		$check="SELECT * FROM branch WHERE branchname='$txtbranchname'";
 		$result=mysqli_query($connection,$check);
 		$count=mysqli_num_rows($result);

 		if ($count>0) {
 			echo "<script>window.alert('Branch Name Already Exist!')</script>";
 			echo "<script>window.location='branchadd.php'</script>";
 		}

 		else {
 			$insert="INSERT INTO branch (branchname,address) VALUES ('$txtbranchname','$txtaddress')";
 			$result=mysqli_query($connection,$insert);
 		}

 		if ($result) {
 			echo "<script>window.alert('Branch Added Successfully!')</script>";
 			echo "<script>window.location='branchadd.php'</script>";
 		}

 		else{
 			echo "<p>Something went wrong in Branch Entry : " . mysqli_error($connection) . "</p>";
 		}
 	}
?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Branch</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Add Branch</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
          	<div class="card-body">
              <h5 class="card-title text-center">Branch Register</h5>

            <form class="row g-3" action="branchadd.php" method="post">

                <div class="col-12">
                  <label for="branchname" class="form-label">Branch Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtbranchname" id="branchname" placeholder="Enter Branch Name" required="">
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Address <span style="color: red;">*</span></label>
                  <textarea class="form-control" name="txtaddress" id="address" placeholder="Enter Address" required=""></textarea>
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

  <?php 
  $query="SELECT * FROM branch";
	$result=mysqli_query($connection,$query);
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
              <h5 class="card-title">Branch List</h5>

              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>Branch Name</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
        				<?php 
        				$a=1; 
        				for($i=0;$i<$count;$i++) 
        				{ 
        					$rows=mysqli_fetch_array($result);
        					$branchid=$rows['branchid'];
        					$branchname=$rows['branchname'];
        					$address=$rows['address'];				
        				?>
        				<tr>
                    <th><?php echo $a++ ?></th>
                    <td><?php echo $branchname ?></td>
                    <td><?php echo $address ?></td>
                    <td>
                        <a href="branchedit.php?branchid=<?=$branchid?>"class="btn btn-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <a onClick="javascript: return confirm('Are you sure you want to delete?');"href="branchdelete.php?branchid=<?=$branchid?>" class="btn btn-danger">
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
    </section>
  <?php } ?>
</main><!-- End #main -->
<?php 
 	include 'footer.php';
?>