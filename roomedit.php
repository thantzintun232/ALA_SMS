<?php 
 	require 'dbconnect.php';
 	include 'header.php';

  if (isset($_POST['btnupdate'])) 
  {
    $txtroomid=$_POST['txtroomid'];
    $txtroomname=$_POST['txtroomname'];
    $sltbranchid=$_POST['sltbranchid'];

    $update="UPDATE room SET roomname='$txtroomname',branchid='$sltbranchid' WHERE roomid='$txtroomid'";
    $result=mysqli_query($connection,$update);

    if($result) 
    {
      echo "<script>window.alert('Room Updated Successfully!')</script>";
      echo "<script>window.location='roomadd.php'</script>";
    }
    else
    {
      echo "<p>Something went wrong in Branch Update : " . mysqli_error($connection) . "</p>";
    }
  }

  //------------------------------

  if(isset($_GET['roomid'])) 
  {
    $roomid=$_GET['roomid'];

    $query="SELECT * FROM room WHERE roomid='$roomid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
  } 
  else
  {
    $roomid="";
    echo "<script>window.location='roomadd.php'</script>";
  }
?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Room</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item"><a href="roomadd.php">Add Room</a></li>
          <li class="breadcrumb-item active">Update Room</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
          	<div class="card-body">
              <h5 class="card-title text-center">Room Update</h5>

            <form class="row g-3" action="roomedit.php" method="post">

                <input type="hidden" name="txtroomid" value="<?php echo $arr['roomid'] ?>">

                <div class="col-12">
                  <label for="roomname" class="form-label">Room Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="txtroomname" id="roomname" value="<?php echo $arr['roomname'] ?>" required="">
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

                          ?>
                          <option value="<?= $branchid ?>"

                        <?php 
                          if ($arr['branchid']==$branchid) {
                            echo "selected";
                          }
                          ?>
                          >
                          <?= $branchname ?>
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
<?php 
 	include 'footer.php';
?>