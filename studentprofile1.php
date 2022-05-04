<?php   
  require 'dbconnect.php';
  include 'studentheader.php'; 

  $studentid=$_SESSION['studentid'];
  if(isset($studentid)) 
  {
    $query="SELECT * FROM student WHERE studentid='$studentid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
  } 
  else
  {
    $studentid="";
    echo "<script>window.location='studenthome.php'</script>";
  }
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>My Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item active">My Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="<?php echo $arr['profile'] ?>" alt="Profile" class="rounded-circle">
            <h2><?php echo $arr['name'] ?></h2>
            <h6>Student</h6>
          </div>
        </div>

      </div>

      <div class="col-xl-8 alin">

        <div class="card">
          <div class="card-body pt-3">
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Full Name :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['name'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Date of Birth :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['dob'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Gender :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['gender'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['address'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['phone'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['email'] ?></div>
                </div>

              </div>
            </div><!-- End Bordered Tabs -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->
<?php 
 include 'footer.php';
 ?>