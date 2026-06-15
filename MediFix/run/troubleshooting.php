<?php session_start();
date_default_timezone_set("Africa/Kigali");
if (!isset($_SESSION['hbUser_Doctor'])) {
    echo "<script>window.location='index?please_login=true';</script>";
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MediFix</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/premium-theme.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index" class="text-nowrap logo-img">
            <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->

        <?php include('doctor-menu.php'); ?>

        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item"><button class="theme-toggle-btn" title="Toggle Theme"><i class="ti ti-sun"></i></button></li>
              
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <div class="px-4 py-3 border-bottom mb-2">
                      <h6 class="mb-0 fs-4 fw-semibold"><?php echo $_SESSION['hbUser_Name']; ?></h6>
                      <span class="text-muted fs-3"><?php echo $_SESSION['hbUser_Type']; ?></span>
                    </div>
                    <a href="index" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">

        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body p-4">
              <h5 class="card-title fw-semibold mb-4">Troubleshooting Job Requets</h5>
              <?php
              if (isset($_GET['new_record_added'])) {
                echo "<div class='alert alert-info' role='alert'>
                      A New Record Saved Successfully.
                    </div>";
              }
              ?>
              <div class="table-responsive">

                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">#</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Date / Time</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">CODE</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Equipment and Model / SL N<sup>O</sup></h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Given By</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Status</h6>
                      </th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include('connector.php');
                    $doctor_id = $_SESSION['hbUser_Doctor'];
                                        $query = mysqli_query($connect, "SELECT * FROM jobs WHERE status = 1 AND givenby = '$doctor_id' ORDER BY id DESC");
                    $rowCount = 0;
                    while ($row = mysqli_fetch_array($query)) {
                      $rowCount ++;
                      $queryp = mysqli_query($connect, "SELECT * FROM doctors WHERE id ='".$row['givenby']."'");
                      $rowp = mysqli_fetch_array($queryp);

                      echo "<tr>
                          <td class='border-bottom-0'>
                            <h6 class='fw-semibold mb-0'>".$rowCount."</h6>
                          </td>
                          <td class='border-bottom-0'>
                            <h6 class='fw-semibold mb-1'>" . date('d/m/Y - H:i', $row['recdt']) . "</h6>
                          </td>
                          <td class='border-bottom-0'>
                            <h6 class='fw-semibold mb-1'>" . $row['code'] . "</h6>
                          </td>
                          <td class='border-bottom-0'>
                            <p class='mb-0 fw-normal'>" . $row['equipment'] . "</p>
                          </td>
                          <td class='border-bottom-0'>
                            <p class='mb-0 fw-normal'>" . $rowp['fullname'] . "</p>
                          </td>
                          <td class='border-bottom-0'>";
                            if($row['status'] == 0){
                              echo"<button type='button' class='btn btn-outline-warning'>Pending</button>";
                            }elseif($row['status'] == 1){
                              echo"<button type='button' class='btn btn-outline-primary'>Troubleshooting</button>";
                            }elseif($row['status'] == 2){
                              echo"<button type='button' class='btn btn-outline-danger'>Maintained</button>";
                            }
                          echo"</td>
                          <td>
                            <a href='job-request-view?code=".$row['code']."'><button type='button' class='btn btn-success'>View</button></a>
                          </td>
                        </tr>";
                    }

                    if($rowCount == 0){
                      echo"<center><br><br><br><br><br>
                        <img src='empty.png'><br><br>
                        <p class='mb-0 fs-4'>No records found.</p>
                      <br><br></center>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">Designed and Developed by Jemima</p>
      </div>
    </div>
  </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/theme-toggle.js"></script>
</body>

</html>