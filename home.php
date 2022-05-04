<?php 
  require 'dbconnect.php';
 	include 'header.php';

  $year = date("Y");

  $query="SELECT c.* FROM staff s, course c WHERE s.staffid=c.staffid AND s.staffid='$staffid'";
  $result=mysqli_query($connection,$query);

  $query1="SELECT SUM(paidamount) as paidamount FROM payment";
  $result1=mysqli_query($connection,$query1);
  $row1=mysqli_fetch_array($result1);

  $query2="SELECT SUM(basicsalary) as salary FROM staff";
  $result2=mysqli_query($connection,$query2);
  $row2=mysqli_fetch_array($result2);

  $query3="SELECT * FROM student";
  $result3=mysqli_query($connection,$query3);
  $count3=mysqli_num_rows($result3);

  $query4="SELECT * FROM staff s, stafftype st WHERE s.stafftypeid=st.stafftypeid AND st.stafftype!='Instructor' AND st.stafftype!='Assistant Instructor'";
  $result4=mysqli_query($connection,$query4);
  $count4=mysqli_num_rows($result4);

  $query5="SELECT * FROM staff s, stafftype st WHERE s.stafftypeid=st.stafftypeid AND st.stafftype='Instructor'";
  $result5=mysqli_query($connection,$query5);
  $count5=mysqli_num_rows($result5);

  $query6="SELECT * FROM language";
  $result6=mysqli_query($connection,$query6);

  //----------------------------------

  $dataPoints=array();
  $languagequery="SELECT * FROM language";
  $languageresult=mysqli_query($connection,$languagequery);
  $languagecount=mysqli_num_rows($languageresult);

  for ($i=0; $i < $languagecount; $i++) {
  $languagearr=mysqli_fetch_array($languageresult);
  $languageid=$languagearr['languageid'];
  $languagename=$languagearr['languagename'];

  $chart="SELECT COUNT(e.enrollmentid) as enrollmentcount FROM language l, course c, enrollment e WHERE l.languageid=c.languageid AND c.courseid=e.courseid AND l.languageid='$languageid'";
  $chartresult=mysqli_query($connection,$chart);
  $chartcount=mysqli_num_rows($chartresult);

  for ($j=0; $j < $chartcount ; $j++) {
  $chartarr=mysqli_fetch_array($chartresult);
  $enrollmentcount=$chartarr['enrollmentcount'];

  array_push($dataPoints, array("label"=>$languagename,"y"=>$enrollmentcount));
  }
  }

  //--------------------------------

  $dataPoints1=array();
  $coursequery="SELECT * FROM language l, course c WHERE l.languageid=c.languageid";
  $courseresult=mysqli_query($connection,$coursequery);
  $coursecount=mysqli_num_rows($courseresult);

  // echo "<script>window.alert('$coursecount')</script>";

  for ($i=0; $i < $coursecount; $i++) {
  $coursearr=mysqli_fetch_array($courseresult);
  $courseid=$coursearr['courseid'];
  $coursename=$coursearr['coursename'];

  $chart1="SELECT COUNT(e.enrollmentid) as enrollmentcount FROM language l, course c, enrollment e WHERE l.languageid=c.languageid AND c.courseid=e.courseid AND c.courseid='$courseid'";
  $chartresult1=mysqli_query($connection,$chart1);
  $chartcount1=mysqli_num_rows($chartresult1);

  for ($j=0; $j < $chartcount1 ; $j++) {
  $chartarr1=mysqli_fetch_array($chartresult1);
  $enrollmentcount=$chartarr1['enrollmentcount'];

  array_push($dataPoints1, array("label"=>$coursename,"y"=>$enrollmentcount));
  }
  }

  //--------------------------------

?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total Incomes for <span>| <?php echo $year ?></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $row1['paidamount'] ?></h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Total Outcomes for <span>| <?php echo $year ?></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $row2['salary'] ?></h6>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-4">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Students<!--  <span>| This Year</span> --></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $count3 ?> <span style="font-size: 20px;color: gray;"> Students</span></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-xxl-4 col-xl-4">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Staffs</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $count4 ?><span style="font-size: 20px;color: gray;"> Staffs</span></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-xxl-4 col-xl-4">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Instructors</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $count5 ?><span style="font-size: 20px;color: gray;"> Instructors</span></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

          <!-- Website Traffic -->
          <div class="col-xxl-12 col-xl-12">
          <div class="card">
            <div class="card-body pt-5 pb-5">
              <div id="chartContainer" style="height: 370px; width: 100%;"></div>

              <script type="text/javascript">
                window.onload = function () {
                  var chart = new CanvasJS.Chart("chartContainer", {
                  animationEnabled: true,
                  // exportEnabled: true,
                  theme: "light2", // "light1", "light2", "dark1", "dark2"
                  title:{
                  text: "Total students per language"
                  },
                  data: [{
                  type: "pie", //change type to bar, line, area, pie, etc
                  yValueFormatString: "#,##0.00\"%\"",
                  indexLabel: "{label} ({y})",
                  showInLegend: true,
                  legendText: "{label}",
                  dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                  }]
                  });
                  chart.render();


                  var chart1 = new CanvasJS.Chart("chartContainer1", {
                  animationEnabled: true,
                  // exportEnabled: true,
                  theme: "light2", // "light1", "light2", "dark1", "dark2"
                  title:{
                  text: "Total students per course"
                  },
                  axisY: {
                  title: "Numbers of Student",
                  includeZero: true,
                  },
                  data: [{
                  type: "column", //change type to bar, line, area, pie, etc
                  yValueFormatString: "#",
                  indexLabel: "{y}",
                  indexLabelPlacement: "inside",
                  indexLabelFontWeight: "bolder",
                  indexLabelFontColor: "white",
                  dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                  }]
                  });
                  chart1.render();
                }
                
              </script>

            </div>
          </div>
          </div><!-- End Website Traffic -->

                      <?php 
            $count6=mysqli_num_rows($result6);

            if($count6<1){
              echo "<p>No Record Found!</p>";
            }
            else{
              for($i=0;$i<$count6;$i++){ 

              $rows=mysqli_fetch_array($result6); 
              $language=$rows['languagename']; 
            ?>

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total Students</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book"></i>
                    </div>
                    <div class="ps-3">
                      <?php 

                      $query7="SELECT * FROM language l, course c, enrollment e WHERE l.languageid=c.languageid AND c.courseid=e.courseid AND l.languagename='$language'";
                      $result7=mysqli_query($connection,$query7);
                      $count7=mysqli_num_rows($result7); ?>

                      <h6><?php echo $language ?></h6>
                      <span class="text-success small pt-1 fw-bold"><?php echo $count7 ?></span> <span class="text-muted small pt-2 ps-1">Students</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->
            <?php 
              }
            } ?>

          <div class="col-xxl-12 col-xl-12">
          <div class="card">
            <div class="card-body pt-5 pb-5">
              <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
            </div>
          </div>
          </div>     

          <?php 

            $paymentquery="SELECT p.*, s.name as studentname, c.coursename as coursename
            FROM payment p, student s, course c
            WHERE p.studentid=s.studentid
            AND p.courseid=c.courseid
            ORDER BY p.paymentdate DESC LIMIT 5";
            $paymentresult=mysqli_query($connection,$paymentquery); 
            $paymentcount=mysqli_num_rows($paymentresult);

            if($paymentcount<1){
              echo "<p>No Record Found!</p>";
            }
            else{
            ?>

          <!-- Recent Payments -->
          <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Payments</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Course</th>
                        <th scope="col">Date</th>
                        <th scope="col">Paid Amount</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    for($i=0;$i<$paymentcount;$i++) 
                    { 
                    $rows=mysqli_fetch_array($paymentresult);
                    $paymentid=$rows['paymentid'];
                    $studentname=$rows['studentname'];
                    $coursename=$rows['coursename'];  
                    $fee=$rows['fee'];    
                    $paidamount=$rows['paidamount'];  
                    $status=$rows['status'];
                    $date=$rows['paymentdate'];
                    $paydate=date("M d, Y",strtotime($date)); 
                  ?>
                      <tr>
                        <th scope="row"><a href="#"><?php echo $paymentid ?></a></th>
                        <td><?php echo $studentname ?></td>
                        <td><?php echo $coursename ?></td> 
                        <td><?php echo $paydate ?></td>
                        <td><?php echo $paidamount ?></td> 
                        <?php if ($status=='Full Paid') {
                        ?>
                          <td><span class="badge bg-success">Full Paid</span></td>
                        <?php }
                        else {
                         ?>                  
                          <td><span class="badge bg-warning">Half Paid</span></td>
                        <?php } ?>
                      </tr>
                  <?php } ?>
                    </tbody>
                  </table>

                </div>

              </div>
          </div><!-- End Recent Sales -->
          <?php } ?>

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->
<?php 
 	include 'footer.php';
?>