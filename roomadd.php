<?php 
 	require 'dbconnect.php';
 	include 'header.php';

 	if (isset($_POST['btnsubmit'])) {
 		$txtroomname=$_POST['txtroomname'];
 		$sltbranchid=$_POST['sltbranchid'];

    $check="SELECT * FROM room WHERE roomname='$txtroomname' AND branchid='$sltbranchid'";
    $result=mysqli_query($connection,$check);
    $count=mysqli_num_rows($result);

    if ($count>0) {
      echo "<script>window.alert('Room Already Exist!')</script>";
      echo "<script>window.location='roomadd.php'</script>";
    }

    else {
      $insert="INSERT INTO room (roomname,branchid) VALUES ('$txtroomname','$sltbranchid')";
      $result=mysqli_query($connection,$insert);
    } 		

 		if ($result) {
 			echo "<script>window.alert('Room Added Successfully!')</script>";
 			echo "<script>window.location='roomadd.php'</script>";
 		}

 		else{
 			echo "<p>Something went wrong in Branch Entry : " . mysqli_error($connection) . "</p>";
 		}
 	}
?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Room</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Add Room</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
          	<div class="card-body">
              <h5 class="card-title text-center">Room Register</h5>

            <form class="row g-3" action="roomadd.php" method="post">

                <div class="col-12">
                  <label for="roomname" class="form-label">Room Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtroomname" id="roomname" placeholder="Enter Room Name" required="">
                </div>

                <div class="col-12">
                  <label for="branchname" class="form-label">Branch Name<span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="branchname" name="sltbranchid">
                      <option >-- Select Branch --</option>
                      <?php 
                        $branchdata="SELECT * FROM branch";
                        $result=mysqli_query($connection,$branchdata);
                        $count=mysqli_num_rows($result);

                        for ($i=0; $i <$count ; $i++) { 
                          $row=mysqli_fetch_array($result);
                          $branchid=$row['branchid'];
                          $branchname=$row['branchname'];

                          echo "<option value='$branchid'>$branchname</option>";
                        }
                       ?>                      
                    </select>               
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
  $query="SELECT r.*, b.branchname as branchname FROM room r INNER JOIN branch b ON r.branchid=b.branchid";
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
              <h5 class="card-title">Room List</h5>

              <table class="table datatable table-hover table-bordered table-striped">
                <thead>
                  <tr class="table-dark">
                    <th>#</th>
                    <th>Room Name</th>
                    <th>BranchName</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
				<?php 
				$a=1; 
				for($i=0;$i<$count;$i++) 
				{ 
					$rows=mysqli_fetch_array($result);
					$roomid=$rows['roomid'];
					$roomname=$rows['roomname'];
					$branchid=$rows['branchid'];
          $branchname=$rows['branchname'];			
				?>
				<tr>
                    <th><?php echo $a++ ?></th>
                    <td><?php echo $roomname ?></td>
                    <td><?php echo $branchname ?></td>
                    <td>
                        <a href="roomedit.php?roomid=<?=$roomid?>"class="btn btn-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <a onClick="javascript: return confirm('Are you sure you want to delete?');" href="roomdelete.php?roomid=<?=$roomid?>" class="btn btn-danger">
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