<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MediFix - Welcome</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  
  <!-- Modern Font and Custom Premium Theme CSS -->
  <link rel="stylesheet" href="../assets/css/premium-theme.css" />
  
  <!-- Keeping Bootstrap ONLY for grid/utilities if needed, but the primary look is driven by premium-theme.css -->
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  
  <!-- Add FontAwesome or similar if needed for icons in inputs, skipping for now -->
</head>

<body>
  <div class="login-wrapper">
    <!-- Decorative Blobs -->
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>

    <div class="login-content">
      <div class="glass-card">
        <a href="./index.php" class="text-nowrap logo-img text-center d-block py-3 w-100 mb-4">
          <img src="../assets/images/logos/dark-logo.svg" width="180" alt="MediFix Logo" class="logo-invert">
        </a>
        
        <h2 class="text-center text-gradient fw-bold mb-3" style="font-size: 1.75rem;">Welcome to MediFix</h2>
        <p class="text-center text-muted-custom mb-4">
          A sleek, seamless platform for maintaining and troubleshooting your medical equipment, ensuring peak performance.
        </p>

        <!-- Alerts are now handled dynamically via premium-interactions.js Toasts based on URL parameters -->

        <form method="POST" action="server.php">
          <div class="mb-4">
            <label for="username" class="form-label">Email / Username</label>
            <input type="text" class="glass-input w-100" id="username" name="username" placeholder="Enter your username" required>
          </div>
          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="glass-input w-100" id="password" name="password" placeholder="Enter your password" required>
          </div>
          
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
              <!-- Using standard Bootstrap form-check but styling could be tweaked -->
              <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" style="border-color: var(--input-border); background-color: var(--input-bg);">
              <label class="form-check-label text-muted-custom" for="flexCheckChecked" style="color: var(--text-muted);">
                Remember me
              </label>
            </div>
            <a class="premium-link" href="forget-password.php">Forgot Password?</a>
          </div>

          <button class="btn-premium" name="userLogin" type="submit">
            Sign In
          </button>
        </form>
      </div>
    </div>
  </div>

  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/premium-interactions.js"></script>
</body>

</html>