<?php 
  session_start();
  include 'auto_ID.php';

  $stafftype=$_SESSION['stafftype'];
  $staffid=$_SESSION['staffid'];
  $name=$_SESSION['name'];
  $profile=$_SESSION['profile'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Achieve Language Academy</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="home.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">ALA</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <div class="d-flex align-items-center">
      <span class="d-none d-md-block ps-2 text-primary">Welcome <?php echo $name; ?> !</span>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo $profile; ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $name; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $stafftype; ?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="userprofile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
    <?php 

    if(isset($_SESSION['stafftype']))
    {
      if($_SESSION['stafftype']=='Branch Manager' or $_SESSION['stafftype']=='Finance Staff' or $_SESSION['stafftype']=='Office Staff')
      {

    ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="home.php">
          <i class="ri-apps-2-line"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="branchadd.php">
          <i class="ri-building-3-line"></i>
          <span>Branch</span>
        </a>
      </li><!-- End Branch Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="roomadd.php">
          <i class="ri-registered-line"></i>
          <span>Room</span>
        </a>
      </li><!-- End Room Nav -->   

      <li class="nav-item">
        <a class="nav-link collapsed" href="languageadd.php">
          <i class="ri-book-open-line"></i>
          <span>Language</span>
        </a>
      </li><!-- End Language Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="attendancelist.php">
          <i class="ri-menu-add-line"></i>
          <span>Student Attendance</span>
        </a>
      </li><!-- End Language Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="resultlist.php">
          <i class="ri-file-list-line"></i>
          <span>Student Result</span>
        </a>
      </li><!-- End Language Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#course-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-stack-line"></i><span>Course</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="course-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="courseadd.php">
              <i class="bi bi-circle"></i><span>Add Course</span>
            </a>
          </li>
<!--           <li>
            <a href="courselist.php">
              <i class="bi bi-circle"></i><span>All Course</span>
            </a>
          </li> -->
          <li>
            <a href="coursesearch.php">
              <i class="bi bi-circle"></i><span>Search Course</span>
            </a>
          </li>
        </ul>
      </li><!-- End Course Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#staff-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-contacts-line"></i><span>Staff</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="staff-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="staffadd.php">
              <i class="bi bi-circle"></i><span>Add Staff</span>
            </a>
          </li>
          <li>
            <a href="stafflist.php">
              <i class="bi bi-circle"></i><span>All Staff</span>
            </a>
          </li>
        </ul>
      </li><!-- End Instructor Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#student-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-folder-user-line"></i><span>Student</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="student-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="studentadd.php">
              <i class="bi bi-circle"></i><span>Add Student</span>
            </a>
          </li>
          <li>
            <a href="studentlist.php">
              <i class="bi bi-circle"></i><span>All Student</span>
            </a>
          </li>
        </ul>
      </li><!-- End Student Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#enrollment-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-user-add-line"></i><span>Enrollment</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="enrollment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="enrollmentadd.php">
              <i class="bi bi-circle"></i><span>Add Enrollment</span>
            </a>
          </li>
          <li>
            <a href="enrollmentsearch.php">
              <i class="bi bi-circle"></i><span>All Enrollment</span>
            </a>
          </li>
        </ul>
      </li><!-- End Enrollment Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#timetable-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-calendar-check-fill"></i><span>Timetable</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="timetable-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="timetableadd.php">
              <i class="bi bi-circle"></i><span>Add Timetable</span>
            </a>
          </li>
          <li>
            <a href="timetablelist.php">
              <i class="bi bi-circle"></i><span>All Timetable</span>
            </a>
          </li>
        </ul>
      </li><!-- End Timetable Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#payment-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-product-hunt-line"></i><span>Payment</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="payment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="paymentadd.php">
              <i class="bi bi-circle"></i><span>Add Payment</span>
            </a>
          </li>
          <li>
            <a href="paymentsearch.php">
              <i class="bi bi-circle"></i><span>All Payment</span>
            </a>
          </li>
        </ul>
      </li><!-- End Payment Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="userprofile.php">
          <i class="ri-account-circle-line"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

    <?php 
     }
    }
    ?>

    <?php 

    if(isset($_SESSION['stafftype']))
    {
      if($_SESSION['stafftype']=='Instructor')
      {

    ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="teacherhome.php">
          <i class="ri-apps-2-line"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="teachertimetable.php">
          <i class="ri-calendar-check-fill"></i>
          <span>Timetable</span>
        </a>
      </li><!-- End Timetable Nav --> 

      <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#attendance-nav" data-bs-toggle="collapse" href="#">
            <i class="ri-menu-add-line"></i><span>Attendance</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
        <ul id="attendance-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="attendanceadd.php">
              <i class="bi bi-circle"></i><span>Add Attendance</span>
            </a>
          </li>
          <li>
            <a href="attendancecourse.php">
              <i class="bi bi-circle"></i><span>View Course Attendance</span>
            </a>
          </li>
          <li>
            <a href="attendancestudent.php">
              <i class="bi bi-circle"></i><span>View Student Attendance</span>
            </a>
          </li>
        </ul>
      </li><!-- End Attendance Nav -->

      <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#assignment-nav" data-bs-toggle="collapse" href="#">
            <i class="ri-task-line"></i><span>Assingment</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
        <ul id="assignment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="assignmentadd.php">
              <i class="bi bi-circle"></i><span>Add Assignment</span>
            </a>
          </li>
          <li>
            <a href="studentassignmentlist.php">
              <i class="bi bi-circle"></i><span>Uploaded Assignments</span>
            </a>
          </li>
          <li>
            <a href="notuploadstudentlist.php">
              <i class="bi bi-circle"></i><span>Not Upload Students</span>
            </a>
          </li>
        </ul>
      </li><!-- End Assignment Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="examadd.php">
          <i class="ri-registered-line"></i>
          <span>Exam</span>
        </a>
      </li><!-- End Exam Nav --> 

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#result-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-file-list-line"></i><span>Result</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="result-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="resultadd.php">
              <i class="bi bi-circle"></i><span>Add Result</span>
            </a>
          </li>
          <li>
            <a href="resultsearch.php">
              <i class="bi bi-circle"></i><span>All Result</span>
            </a>
          </li>
        </ul>
      </li><!-- End Result Nav -->


      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="userprofile.php">
          <i class="ri-account-circle-line"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <?php 
       }
      }

      else{
        echo "<script>window.location='stafflogin.php'</script>";
      }
      
      ?>
    </ul>

  </aside><!-- End Sidebar-->


 