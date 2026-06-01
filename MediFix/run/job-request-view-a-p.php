<?php session_start();
date_default_timezone_set("Africa/Kigali");
if (!isset($_SESSION['hbUser_Admin'])) {
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
                
                <input type="button" value="out paper This Report" style="font-weight: bold; background: #0fab8e; color: #fff; padding: 5px 15px; margin-bottom: 50px; float: right; border: none; border-radius: 15px;" onclick="javascript:printDiv('mydiv')" />

                <div class="col-lg-12 d-flex align-items-stretch" id="mydiv">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" style='float: left; margin-right: 20px;'>
                            <br><h6>
                                REPUBLIC OF RWANDA<br>
                                MINISTRY OF HEALTH<br>
                               KIZIGURO HOSPITAL<br>
                                B.P 254 Gatsibo / Tel/Fax 530545<br>
                            </h6>
                            <br><br><br>
                            <h5 class="card-title fw-semibold mb-4">Job Request View for <?php echo $_GET['code']; ?></h5>
                            <?php
                            if (isset($_GET['new_record_added'])) {
                                echo "<div class='alert alert-success' role='alert'>
                      A New Record Saved Successfully.
                    </div>";
                            }
                            ?>
                            <div class="table-responsive">

                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
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
                                                <h6 class="fw-semibold mb-0">Given By</sup></h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include('connector.php');
                                        $query = mysqli_query($connect, "SELECT * FROM jobs WHERE code ='" . $_GET['code'] . "'");
                                        $row = mysqli_fetch_array($query);

                                        $queryp = mysqli_query($connect, "SELECT * FROM doctors WHERE id ='" . $row['givenby'] . "'");
                                        $rowp = mysqli_fetch_array($queryp);


                                        echo "<tr>
                                            <td class='border-bottom-0'>
                                                <h6 class='mb-0 fw-normal'>" . date('d/m/Y - H:i', $row['recdt']) . "</h6>
                                            </td>
                                            <td class='border-bottom-0'>
                                                <h6 class='mb-0 fw-normal'>" . $row['code'] . "</h6>
                                            </td>
                                            <td class='border-bottom-0'>
                                                <p class='mb-0 fw-normal'>" . $row['equipment'] . "</p>
                                            </td>
                                            <td class='border-bottom-0'>
                                                <p class='mb-0 fw-normal'>" . $rowp['fullname'] . "</p>
                                            </td>
                                            </tr>";
                                        ?>
                                    </tbody>
                                </table>

                                <div>
                                    <h5 class="fw-semibold mb-2 mt-5">Description of the Job to be Done</h5>
                                    <?php
                                    echo "<p class='mb-0 fw-normal'>" . $row['info'] . "</p>";
                                    ?>
                                </div>
                                
                                <?php
                                    echo "<div><br><br>
                                        <p class='mb-3 fw-normal'>
                                            <b>Doctor Name: </b>" . $rowp['fullname'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <b>Signature: ..................................</b>
                                        </p>
                                    </div>";
                                ?>

                                <?php
                                    if ($row['tech'] != NULL) {

                                        $querytech = mysqli_query($connect, "SELECT * FROM jobsdone WHERE id ='" . $row['tech'] . "'");
                                        $rowtech = mysqli_fetch_array($querytech);

                                        $queryt = mysqli_query($connect, "SELECT * FROM users WHERE id ='" . $rowtech['tech'] . "'");
                                        $rowt = mysqli_fetch_array($queryt);

                                        echo "<div>
                                                <h4 class='fw-semibold mb-4 mt-5'>Technician's Note</h4>
                                                <p class='mb-3 fw-normal'><b>Nature of the Problem: </b>" . $rowtech['problem'] . "</p>
                                                <p class='mb-3 fw-normal'>
                                                    <b>Date of Attendance: </b>" . date('d/m/Y', $rowtech['recdt']) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <b>Time: </b>" . date('H:i', $rowtech['recdt']) . "
                                                </p>
                                                <p class='mb-3 fw-normal'><b>Nature of Action Taken: </b>" . $rowtech['action'] . "</p>
                                                <p class='mb-3 fw-normal'><b>Spare Parts Used: </b>" . $rowtech['spare'] . "</p>
                                                <p class='mb-3 fw-normal'>
                                                    <b>Technicaian Name: </b>" . $rowt['fullname'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <b>Signature: ..................................</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <b>Time Spent: </b> " . $rowtech['timespent'] . "
                                                </p>
                                            </div>";
                                    }
                                ?>

                                <br><br>

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
    
    <script>
        function printDiv(divID) {
            var divElements = document.getElementById(divID).innerHTML;
            var oldPage = document.body.innerHTML;
            document.body.innerHTML =
                "<html><head><title>Print</title></head><body>" +
                divElements + "</body>";
            window.print();
            document.body.innerHTML = oldPage;
        }
    </script>
    
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>