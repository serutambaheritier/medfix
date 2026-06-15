<?php
include('connector.php');

echo "<h2>Database Connection Test</h2>";

if ($connect) {
    echo "<p style='color:green;'>Successfully connected to MySQL.</p>";
} else {
    echo "<p style='color:red;'>Failed to connect to MySQL.</p>";
    exit;
}

$tables = ['admin', 'doctors', 'users'];
foreach ($tables as $table) {
    $result = mysqli_query($connect, "SHOW TABLES LIKE '$table'");
    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color:green;'>Table '$table' exists.</p>";
        
        // Check credentials
        if ($table == 'admin') {
            $check = mysqli_query($connect, "SELECT * FROM admin WHERE username='admin@gmail.com' AND password='123'");
        } elseif ($table == 'doctors') {
            $check = mysqli_query($connect, "SELECT * FROM doctors WHERE email='ihumuriza@gmail.com' AND password='456'");
        } else {
            $check = mysqli_query($connect, "SELECT * FROM users WHERE email='melchiroger@gmail.com' AND password='123'");
        }
        
        if (mysqli_num_rows($check) > 0) {
            echo "<p style='color:green;'>Credentials for $table found and correct.</p>";
        } else {
            echo "<p style='color:orange;'>Credentials for $table NOT found in DB.</p>";
            
            // List some users to see what's there
            $list = mysqli_query($connect, "SELECT * FROM $table LIMIT 5");
            echo "Existing users in $table: <br>";
            while ($row = mysqli_fetch_assoc($list)) {
                echo "- " . ($row['username'] ?? $row['email']) . " (Pass: " . $row['password'] . ")<br>";
            }
        }
    } else {
        echo "<p style='color:red;'>Table '$table' does NOT exist.</p>";
    }
}
?>
