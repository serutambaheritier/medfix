<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ODAIS</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
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

        <?php include('nurse-menu.php'); ?>

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
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <p class="mb-0 fs-4" style="margin-right: 10px;"><b><?php echo $_SESSION['hbUser_Name']; ?> - <?php echo $_SESSION['hbUser_Type']; ?></b></p>
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
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

              <?php
              if (isset($_GET['search_key'])) {
                $search_key = $_GET['search_key'];
              } else {
                $search_key = null;
              }
              ?>

              <div style="float: right; position: relative; top: -10px;">
                <button style="float: right" type="button" onclick="window.location='add-user-n-p';" class="btn btn-outline-dark m-1">Add New</button>
                <button style="float: right" type="button" onclick="window.location='users-n-p';" class="btn btn-outline-success m-1">Refresh</button>
                <form style="width: 600px;" method="GET">
                  <input placeholder="Search ..." type="text" class="form-control" value="<?php echo $search_key; ?>" required name="search_key" style="width: 270px; float: left; position: relative; top: 3px;">
                  <input style="position: relative;" type="submit" class="btn btn-outline-primary m-1" name="action" value="Search">
                </form>
              </div>

              <h5 class="card-title fw-semibold mb-4">Tehcnicians List</h5>
              <?php
              if (isset($_GET['new_user_added'])) {
                echo "<div class='alert alert-success' role='alert'>
                      A Patient User Account Created Successfully.
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
                        <h6 class="fw-semibold mb-0">Full name</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">ID Card</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Phone</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Email</h6>
                      </th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include('connector.php');
                    if (isset($_GET['search_key'])) {
                      $search_key = $_GET['search_key'];
                      $query = mysqli_query($connect, "SELECT * FROM users WHERE fullname LIKE '%$search_key%' OR idcard LIKE '%$search_key%' OR phone LIKE '%$search_key%' OR email LIKE '%$search_key%' AND deleted = 0 ORDER BY id DESC");
                    } else {
                      $query = mysqli_query($connect, "SELECT * FROM users WHERE deleted = 0 ORDER BY id DESC");
                    }
                    $rowCount = 0;
                    while ($row = mysqli_fetch_array($query)) {
                      $rowCount++;
                      echo "<tr>
                          <td class='border-bottom-0'>
                            <h6 class='fw-semibold mb-0'>" . $rowCount . "</h6>
                          </td>
                          <td class='border-bottom-0'>
                            <h6 class='fw-semibold mb-1'>" . $row['fullname'] . "</h6>
                          </td>
                          <td class='border-bottom-0'>
                            <p class='mb-0 fw-normal'>" . $row['idcard'] . "</p>
                          </td>
                          <td class='border-bottom-0'>
                            <p class='mb-0 fw-normal'>" . $row['phone'] . "</p>
                          </td>
                          <td class='border-bottom-0'>
                            <p class='mb-0 fw-normal'>" . $row['email'] . "</p>
                          </td>
                          <td>
                            <a href='edit-user-n-p?id=" . $row['id'] . "'><button type='button' class='btn btn-primary'>Edit</button></a>
                            <a href='server.php?deleteUserNP=" . $row['id'] . "'><button type='button' class='btn btn-danger'>Delete</button></a>
                          </td>
                        </tr>";
                    }

                    if ($rowCount == 0) {
                      echo "<center><br><br><br><br><br>
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
</body>

</html>