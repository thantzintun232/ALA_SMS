<?php 
 	require 'dbconnect.php';
 	include 'header.php';

 	if (isset($_POST['btnsubmit'])) {
 	$txtlanguage=$_POST['txtlanguage'];
	$check="SELECT * FROM language WHERE languagename='$txtlanguage'";
	$result=mysqli_query($connection,$check);
	$count=mysqli_num_rows($result);

	if ($count>0) {
		echo "<script>window.alert('Lanague Already Exist!')</script>";
		echo "<script>window.location='languageadd.php'</script>";
	}

	else {
		$insert="INSERT INTO language (languagename) VALUES ('$txtlanguage')";
		$result=mysqli_query($connection,$insert);
	}

	if ($result) {
		echo "<script>window.alert('Language Added Successfully!')</script>";
		echo "<script>window.location='languageadd.php'</script>";
	}

	else{
		echo "<p>Something went wrong in Language Entry : " . mysqli_error($connection) . "</p>";
	}
}
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Language</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Add Language</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Language Register</h5>

              <form class="row g-3" action="languageadd.php" method="post">
                <div class="col-12">
                  <label for="language" class="form-label">Language <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="language" name="txtlanguage" placeholder="Enter Language Name">
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
 	$query="SELECT * FROM language";
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
              <h5 class="card-title">Language List</h5>

              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>Language</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
				<?php 
				$a=1; 
				for($i=0;$i<$count;$i++) 
				{ 
					$rows=mysqli_fetch_array($result);
					$languageid=$rows['languageid'];
					$languagename=$rows['languagename'];
				?>
				<tr>
                    <th><?php echo $a++ ?></th>
                    <td><?php echo $languagename ?></td>
                    <td>
                        <a onClick="javascript: return confirm('Are you sure you want to delete?');" href="languagedelete.php?languageid=<?=$languageid?>" class="btn btn-danger">
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

<?php include 'footer.php' ?>