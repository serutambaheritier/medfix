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
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <p class="text-center">A user-friendly and simplified way of troubleshooting and maintain of medical equipment, ensuring optimal performance and reliability.</p>

                <?php
                  if(isset($_GET['invalid_email'])){
                    echo"<div class='alert alert-danger' role='alert'>
                      The email provided does not belong to any active registered account.
                    </div>";
                  }
                  if(isset($_GET['pass_reset'])){
                    echo"<div class='alert alert-info' role='alert'>
                      We have sent a reset code to your phone, use it to login and change password accordingly.
                    </div>";
                  }
                ?>

                <form method="POST" action="server.php">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Enter your email to recover the password</label>
                    <input type="email" class="form-control" name="email" required aria-describedby="emailHelp">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <a class="text-primary fw-bold" href="index">Back to login</a>
                  </div>

                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="recoverPassword">Recover My Password</button>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>