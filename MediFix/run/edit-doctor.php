<?php session_start();
if (!isset($_SESSION['hbUser_Admin'])) {
    echo "<script>window.location='index?please_login=true';</script>";
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ODAIS</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/premium-theme.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index" class="text-nowrap logo-img">
            <img src="../assets/images/logos/masaka-logo.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        
        <?php include('admin-menu.php'); ?>
        
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
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
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

      <?php
      
      include('connector.php');
        $query = mysqli_query($connect, "SELECT * FROM doctors WHERE id = '".$_GET['id']."'");
        $row = mysqli_fetch_array($query);
      
      ?>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Edit Doctor Info</h5>
              
                  <form method="POST" action="server.php">
                      
                    <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Full Name</label>
                      <input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
                      <input type="text" class="form-control" name="fullname" value="<?php echo $row['fullname']; ?>">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Specification</label>
                      <select type="text" class="form-control" name="specification">
                        <option><?php echo $row['specification']; ?></option>
                        <option>General Medecide</option>
                        <option>Surgeon</option>
                        <option>Dentist</option>
                        <option>Pediatrician</option>
                        <option>Phthalmologist</option>
                        <option>Obstetrician </option>
                      </select>
                    </div>
                    
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Phone</label>
                      <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>">
                    </div>
                    
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email Address</label>
                      <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>">
                    </div>
                    
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Password</label>
                      <input type="password" class="form-control" name="password" value="<?php echo $row['password']; ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="editDoctor">Save Changes</button>
                  </form>
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
<script src="../assets/js/theme-toggle.js"></script>
</body>

</html>
