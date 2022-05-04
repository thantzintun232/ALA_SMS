<?php 
	require 'dbconnect.php';
	include 'header.php';

	if (isset($_POST['btnupdate'])) 
	{
		$txtbranchid=$_POST['txtbranchid'];
		$txtbranchname=$_POST['txtbranchname'];
 		$txtaddress=$_POST['txtaddress'];

 		$update="UPDATE branch SET branchname='$txtbranchname',address='$txtaddress' WHERE branchid='$txtbranchid'";
 		$result=mysqli_query($connection,$update);

		if($result) 
		{
			echo "<script>window.alert('Branch Updated Successfully!')</script>";
			echo "<script>window.location='branchadd.php'</script>";
		}
		else
		{
			echo "<p>Something went wrong in Branch Update : " . mysqli_error($connection) . "</p>";
		}
	}

	//------------------------------

	if(isset($_GET['branchid'])) 
	{
		$branchid=$_GET['branchid'];

		$query="SELECT * FROM branch WHERE branchid='$branchid'";
		$result=mysqli_query($connection,$query);
		$arr=mysqli_fetch_array($result);
	}	
	else
	{
		$branchid="";
		echo "<script>window.location='branchadd.php'</script>";
	}
 ?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Branch</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="branchadd.php">Add Branch</a></li>
          <li class="breadcrumb-item active">Update Branch</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
          	<div class="card-body">
              <h5 class="card-title text-center">Branch Update</h5>

            <form class="row g-3" action="branchedit.php" method="post">

            	<input type="hidden" name="txtbranchid" value="<?php echo $arr['branchid'] ?>">

                <div class="col-12">
                  <label for="name" class="form-label">Branch Name<span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtbranchname" id="branchname" value="<?php echo $arr['branchname'] ?>" required>
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Address<span style="color: red;">*</span></label>
                  <textarea class="form-control" name="txtaddress" id="address" required><?php echo $arr['address'] ?></textarea>
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