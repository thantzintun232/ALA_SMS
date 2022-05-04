<?php   
  require 'dbconnect.php';
  include 'header.php'; 

  if(isset($_GET['staffid'])) 
  {
    $staffid=$_GET['staffid'];

    $query="SELECT s.*,sf.stafftype as stafftype 
            FROM staff s INNER JOIN stafftype sf ON s.stafftypeid=sf.stafftypeid WHERE s.staffid='$staffid'";
    $result=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($result);
  } 
  else
  {
    $staffid="";
    echo "<script>window.location='staffadd.php'</script>";
  }
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Staff Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item"><a href="staffadd.php">Add Staff</a></li>
        <li class="breadcrumb-item"><a href="stafflist.php">Staff List</a></li>
        <li class="breadcrumb-item active">Staff Profile</li>
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
            <h6><?php echo $arr['stafftype'] ?></h6>
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
                  <div class="col-lg-3 col-md-4 label">Gender :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['gender'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['address'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Date of Birth :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['dob'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">NRC :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['nrc'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['phone'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['email'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Entry Date :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['entrydate'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Salary :</div>
                  <div class="col-lg-9 col-md-8"><?php echo $arr['basicsalary'] ?></div>
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