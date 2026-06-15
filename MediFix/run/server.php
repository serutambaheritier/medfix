<?php session_start();
include('connector.php');

if (isset($_POST['userLogin'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = mysqli_query($connect, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $row = mysqli_fetch_array($query);

    if ($username == $row['username'] and $password == $row['password']) {
        $_SESSION['hbUser_Admin'] = $row['id'];
        $_SESSION['hbUser_Type'] = 'Admin';
        $_SESSION['hbUser_Name'] = $row['fullname'];
        echo "<script>window.location='admin-home';</script>";
    } else {
        $query = mysqli_query($connect, "SELECT * FROM doctors WHERE email='$username' AND password='$password'");
        $row = mysqli_fetch_array($query);

        if ($username == $row['email'] and $password == $row['password']) {
            $_SESSION['hbUser_Doctor'] = $row['id'];
            $_SESSION['hbUser_Type'] = 'Doctor';
            $_SESSION['hbUser_Name'] = $row['fullname'];
            echo "<script>window.location='doctor-home';</script>";
        } else {
            $query = mysqli_query($connect, "SELECT * FROM users WHERE email='$username' AND password='$password'");
            $row = mysqli_fetch_array($query);

            if ($username == $row['email'] and $password == $row['password']) {
                $_SESSION['hbUser_Tech'] = $row['id'];
                $_SESSION['hbUser_Type'] = 'Technician';
                $_SESSION['hbUser_Name'] = $row['fullname'];
                echo "<script>window.location='user-home';</script>";
            } else {
                echo "<script>window.location='index?invalid_login=true';</script>";
            }
        }
    }
}

if (isset($_POST['usersignup'])) {
    $idcard = $_POST['idcard'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $query = mysqli_query($connect, "INSERT INTO users(idcard, fullname, email, phone, password) VALUES ('$idcard', '$fullname', '$email', '$phone', '$password')");

    echo "<script>window.location='register?reg_success=true';</script>";
}

if (isset($_POST['addNewDoctor'])) {
    $fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
    $specification = mysqli_real_escape_string($connect, $_POST['specification']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = mysqli_query($connect, "INSERT INTO doctors (fullname, specification, phone, email, password) VALUES ('$fullname', '$specification', '$phone', '$email', '$password')");
    echo "<script>window.location='doctors?new_doctor_added=true';</script>";
}

if (isset($_POST['addNewNurse'])) {
    $fullname = $_POST['fullname'];
    $specification = $_POST['specification'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($connect, "INSERT INTO nurses (fullname, specification, phone, email, password) VALUES ('$fullname', '$specification', '$phone', '$email', '$password')");
    echo "<script>window.location='nurses?new_nurse_added=true';</script>";
}

if (isset($_POST['addNewUser'])) {
    $idcard = mysqli_real_escape_string($connect, $_POST['idcard']);
    $fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = mysqli_query($connect, "INSERT INTO users (idcard, fullname, phone, email, password) VALUES ('$idcard', '$fullname', '$phone', '$email', '$password')");
    echo "<script>window.location='users?new_user_added=true';</script>";
}

if (isset($_POST['addNewHC'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];

    $query = mysqli_query($connect, "INSERT INTO healthcenters (name, address) VALUES ('$name', '$address')");
    echo "<script>window.location='health-centers?new_hc_added=true';</script>";
}

if (isset($_GET['approveApp'])) {
    $id = $_GET['approveApp'];

    $query = mysqli_query($connect, "UPDATE applications SET status = 1 WHERE id = '$id'");
    echo "<script>window.location='apps?app_approved=true';</script>";
}

if (isset($_GET['rejectApp'])) {
    $id = $_GET['rejectApp'];

    $query = mysqli_query($connect, "UPDATE applications SET status = 2 WHERE id = '$id'");
    echo "<script>window.location='apps?app_rejected=true';</script>";
}

if (isset($_POST['addNewCandidate'])) {
    $idcard = $_POST['idcard'];

    $query = mysqli_query($connect, "UPDATE applications SET candidate = 1 WHERE idcard = '$idcard'");
    echo "<script>window.location='candidates?new_cand_added=true';</script>";
}

if (isset($_GET['deleteCand'])) {
    $id = $_GET['deleteCand'];

    $query = mysqli_query($connect, "UPDATE applications SET candidate = 0 WHERE id = '$id'");
    echo "<script>window.location='candidates?cand_removed=true';</script>";
}

if (isset($_POST['addNewJB'])) {
    $code = "MediFix-" . time();
    $equipment = mysqli_real_escape_string($connect, $_POST['equipment']);
    $givenby = $_SESSION['hbUser_Doctor'];
    $info = mysqli_real_escape_string($connect, $_POST['info']);
    $airef = 0;
    $recdt = time();

    $query = mysqli_query($connect, "INSERT INTO jobs (code, equipment, givenby, airef, info, recdt) VALUES ('$code', '$equipment', '$givenby', '$airef', '$info', '$recdt')");
    echo "<script>window.location='ask-ai?code=$code&new_record_added=true';</script>";
}

if (isset($_GET['resolveJobAI'])) {
    $code = $_GET['resolveJobAI'];
    $query = mysqli_query($connect, "UPDATE jobs SET status = 2 WHERE code = '$code'");
    echo "<script>window.location='job-requests?case_resolved=true';</script>";
}

if (isset($_GET['confirmSubmitToTech'])) {
    $code = $_GET['confirmSubmitToTech'];
    // Setting status to 0 ensures it shows up in Admin's pending list for manual assignment
    $query = mysqli_query($connect, "UPDATE jobs SET status = 0 WHERE code = '$code'");
    echo "<script>window.location='job-requests?submitted_to_admin=true';</script>";
}

if (isset($_GET['deleteNurse'])) {
    $id = $_GET['deleteNurse'];

    $query = mysqli_query($connect, "UPDATE nurses SET deleted = 1 WHERE id = '$id'");
    echo "<script>window.location='nurses?nurse_deleted=true';</script>";
}

if (isset($_GET['deleteDoc'])) {
    $id = $_GET['deleteDoc'];

    $query = mysqli_query($connect, "UPDATE doctors SET deleted = 1 WHERE id = '$id'");
    echo "<script>window.location='doctors?doctor_deleted=true';</script>";
}

if (isset($_POST['editDoctor'])) {
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
    $specification = mysqli_real_escape_string($connect, $_POST['specification']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = mysqli_query($connect, "UPDATE doctors SET fullname = '$fullname', specification = '$specification', phone = '$phone', email = '$email', password = '$password' WHERE id = '$id' ");
    echo "<script>window.location='doctors?doctor_updated=true';</script>";
}

if (isset($_POST['editNurse'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $specification = $_POST['specification'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($connect, "UPDATE nurses SET fullname = '$fullname', specification = '$specification', phone = '$phone', email = '$email', password = '$password' WHERE id = '$id' ");
    echo "<script>window.location='nurses?nurse_updated=true';</script>";
}

if (isset($_GET['deleteUser'])) {
    $id = $_GET['deleteUser'];

    $query = mysqli_query($connect, "UPDATE users SET deleted = 1 WHERE id = '$id'");
    echo "<script>window.location='users?user_deleted=true';</script>";
}

if (isset($_GET['deleteUserNP'])) {
    $id = $_GET['deleteUserNP'];

    $query = mysqli_query($connect, "UPDATE users SET deleted = 1 WHERE id = '$id'");
    echo "<script>window.location='users-n-p?user_deleted=true';</script>";
}

if (isset($_POST['editUser'])) {
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $idcard = mysqli_real_escape_string($connect, $_POST['idcard']);
    $fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = mysqli_query($connect, "UPDATE users SET fullname = '$fullname', idcard = '$idcard', phone = '$phone', email = '$email', password = '$password' WHERE id = '$id' ");
    echo "<script>window.location='users?user_updated=true';</script>";
}

if (isset($_POST['editUserNP'])) {
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $idcard = mysqli_real_escape_string($connect, $_POST['idcard']);
    $fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = mysqli_query($connect, "UPDATE users SET fullname = '$fullname', idcard = '$idcard', phone = '$phone', email = '$email', password = '$password' WHERE id = '$id' ");
    echo "<script>window.location='users-n-p?user_updated=true';</script>";
}

if (isset($_GET['deleteHC'])) {
    $id = $_GET['deleteHC'];

    $query = mysqli_query($connect, "UPDATE healthcenters SET deleted = 1 WHERE id = '$id'");
    echo "<script>window.location='health-centers?hc_deleted=true';</script>";
}

if (isset($_POST['editHC'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];

    $query = mysqli_query($connect, "UPDATE healthcenters SET name = '$name', address = '$address' WHERE id = '$id' ");
    echo "<script>window.location='health-centers?user_updated=true';</script>";
}

if (isset($_POST['submitToTechAdmin'])) {
    $code = $_POST['code'];
    $tech_id = $_POST['tech_id'];

    $query = mysqli_query($connect, "SELECT * FROM users WHERE id = '$tech_id'");
    $row = mysqli_fetch_array($query);
        
    $tech_phone = $row['phone'];
    $tech_name = $row['fullname'];
    $tech_email = $row['email'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mista.io/sms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('to' => "+25".$tech_phone,'from' => 'E-Notifier','unicode' => '0','sms' => "Hello ".$tech_name."! Kindly be informed that there is a new job request pending for your review. Thanks!",'action' => 'send-sms'),
        CURLOPT_HTTPHEADER => array(
        'x-api-key: a02c7aaa-48a7-974d-901d-d6476d221271-152d9ab3'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    
    $emailBody = "<!DOCTYPE html>
    <html>
        <head></head>
        <body>
            <div style='font-family: arial;'>
                <div style='width: 100%; padding: 3px 10px; box-sizing: border-box; color: #fff; background: #000; text-align: center;'><h3>Assistance Request</h3></div>
                <div style='padding: 20px 10px; text-align: center;'>
                    Dear " . $tech_name . ",
                    <br><br>
                    Hope this email finds you in good health.
                    <br><br>
                    Kindly be informed that there is a new job request pending for your review.
                    <br><br>
                    Please log into your account by clicking the button below and assist accordingly.
                    <br><br>
                    <center><a href='https://www.dotaflex.ca/MediFix/run/'><button style='background: #000; color: #fff; padding: 10px 25px; border: none; border-radius: 10px;'>Login To My Account</button></a></center>
                    <br><br>
                    Thank you for your service.
                </div>
            </div>
        </body>
    </html>";

    $to = $tech_email;
    $subject = "Assistance Request";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: MediFix <info@medi-fix.rw>' . "\r\n";

    mail($to, $subject, $emailBody, $headers);

    $query = mysqli_query($connect, "UPDATE jobs SET status = 1, tech = '$tech_id' WHERE code = '$code'");
    echo "<script>window.location='troubleshooting?admited=true';</script>";
}

if (isset($_GET['closeCase'])) {
    $code = $_GET['closeCase'];

    $query = mysqli_query($connect, "UPDATE jobs SET status = 2 WHERE code = '$code'");
    echo "<script>window.location='maintained?admited=true';</script>";
}

if (isset($_GET['closeCaseTech'])) {
    $code = $_GET['closeCaseTech'];

    $query = mysqli_query($connect, "UPDATE jobs SET status = 2 WHERE code = '$code'");
    echo "<script>window.location='maintained-u-p?admited=true';</script>";
}

if (isset($_POST['addNewDocNote'])) {
    $code = $_POST['code'];
    $info = $_POST['info'];

    $query = mysqli_query($connect, "UPDATE consult SET doc = '$info' WHERE code = '$code' ");
    echo "<script>window.location='consult-view-d-p?code=" . $code . "';</script>";
}

if (isset($_POST['addNewJBD'])) {
    $code = mysqli_real_escape_string($connect, $_POST['code']);
    $problem = mysqli_real_escape_string($connect, $_POST['problem']);
    $action = mysqli_real_escape_string($connect, $_POST['action']);
    $spare = mysqli_real_escape_string($connect, $_POST['spare']);
    $timespent = mysqli_real_escape_string($connect, $_POST['timespent']);
    $tech = $_SESSION['hbUser_Tech'];
    $recdt = time();

    $query = mysqli_query($connect, "INSERT INTO jobsdone (id, problem, action, spare, timespent, tech, recdt) VALUES ('$recdt', '$problem', '$action', '$spare', '$timespent', '$tech', '$recdt')");
    $query = mysqli_query($connect, "UPDATE jobs SET tech = '$recdt' WHERE code = '$code' ");
    echo "<script>window.location='job-request-view-u-p?code=".$code."';</script>";
}

if (isset($_POST['recoverPassword'])) {
    $email = $_POST['email'];

    $query = mysqli_query($connect, "SELECT * FROM admin WHERE username='$email'");
    if (!$query) {
        die("Database Query Failed: " . mysqli_error($connect) . ". <br><br><b>Tip:</b> Make sure you have created the database named 'medifix' and imported the 'medifix.sql' file into phpMyAdmin.");
    }
    $row = mysqli_fetch_array($query);

    if ($email == $row['username']) {
        $userid =  $row['id'];
        $username = $row['fullname'];
        $userphone = $row['phone'];
        $newpassword = rand(100000, 999999);
        $query = mysqli_query($connect, "UPDATE admin SET password = '$newpassword' WHERE id = '$userid' ");

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => "+25" . $userphone, 'from' => 'E-Notifier', 'unicode' => '0', 'sms' => "Hello " . $username . "! Your password have been reset successfully. Code: " . $newpassword . " Thanks!", 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key: a02c7aaa-48a7-974d-901d-d6476d221271-152d9ab3'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        echo "<script>window.location='forget-password?pass_reset=true';</script>";
    } else {
        $query = mysqli_query($connect, "SELECT * FROM doctors WHERE email='$email'");
        $row = mysqli_fetch_array($query);

        if ($email == $row['email']) {
            $userid =  $row['id'];
            $username = $row['fullname'];
            $userphone = $row['phone'];
            $newpassword = rand(100000, 999999);
            $query = mysqli_query($connect, "UPDATE doctors SET password = '$newpassword' WHERE id = '$userid' ");

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mista.io/sms',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('to' => "+25" . $userphone, 'from' => 'E-Notifier', 'unicode' => '0', 'sms' => "Hello " . $username . "! Your password have been reset successfully. Code: " . $newpassword . " Thanks!", 'action' => 'send-sms'),
                CURLOPT_HTTPHEADER => array(
                    'x-api-key: a02c7aaa-48a7-974d-901d-d6476d221271-152d9ab3'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            echo "<script>window.location='forget-password?pass_reset=true';</script>";
        } else {
            $query = mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");
            $row = mysqli_fetch_array($query);
    
            if ($email == $row['email']) {
                $userid =  $row['id'];
                $username = $row['fullname'];
                $userphone = $row['phone'];
                $newpassword = rand(100000, 999999);
                $query = mysqli_query($connect, "UPDATE users SET password = '$newpassword' WHERE id = '$userid' ");
    
                $curl = curl_init();
    
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.mista.io/sms',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('to' => "+25" . $userphone, 'from' => 'E-Notifier', 'unicode' => '0', 'sms' => "Hello " . $username . "! Your password have been reset successfully. Code: " . $newpassword . " Thanks!", 'action' => 'send-sms'),
                    CURLOPT_HTTPHEADER => array(
                        'x-api-key: a02c7aaa-48a7-974d-901d-d6476d221271-152d9ab3'
                    ),
                ));
    
                $response = curl_exec($curl);
    
                curl_close($curl);
    
                echo "<script>window.location='forget-password?pass_reset=true';</script>";
            } else {
                echo "<script>window.location='forget-password?invalid_email=true';</script>";
            }
        }
    }
}

if (isset($_POST['changePasswordAdmin'])) {
    $id = $_SESSION['hbUser_Admin'];
    $newpassword = $_POST['newpassword'];

    $query = mysqli_query($connect, "UPDATE admin SET password = '$newpassword' WHERE id = '$id'");
    echo "<script>window.location='change-password?pass_changed=true';</script>";
}

if (isset($_POST['changePasswordDoctor'])) {
    $id = $_SESSION['hbUser_Doctor'];
    $newpassword = $_POST['newpassword'];

    $query = mysqli_query($connect, "UPDATE doctors SET password = '$newpassword' WHERE id = '$id'");
    echo "<script>window.location='change-password-d-p?pass_changed=true';</script>";
}

if (isset($_POST['changePasswordTech'])) {
    $id = $_SESSION['hbUser_Tech'];
    $newpassword = $_POST['newpassword'];

    $query = mysqli_query($connect, "UPDATE users SET password = '$newpassword' WHERE id = '$id'");
    echo "<script>window.location='change-password-u-p?pass_changed=true';</script>";
}

if (isset($_POST['editAskAI'])) {
    $code = mysqli_real_escape_string($connect, $_POST['code']);
    $info = mysqli_real_escape_string($connect, $_POST['info']);

    $query = mysqli_query($connect, "UPDATE jobs SET info = '$info' WHERE code = '$code'");
    echo "<script>window.location='job-request-view?code=".$code."';</script>";
}

if (isset($_GET['getDoctorStats'])) {
    $doctor_id = $_SESSION['hbUser_Doctor'];
    $pending = 0; $troubleshoot = 0; $maintained = 0;
    $q = mysqli_query($connect, "SELECT status, COUNT(*) as cnt FROM jobs WHERE givenby = '$doctor_id' GROUP BY status");
    while ($r = mysqli_fetch_array($q)) {
        if ($r['status'] == 0) $pending = $r['cnt'];
        elseif ($r['status'] == 1) $troubleshoot = $r['cnt'];
        elseif ($r['status'] == 2) $maintained = $r['cnt'];
    }
    header('Content-Type: application/json');
    echo json_encode(['pending' => $pending, 'troubleshoot' => $troubleshoot, 'maintained' => $maintained]);
    exit;
}

if (isset($_POST['editAskAITech'])) {
    $code = mysqli_real_escape_string($connect, $_POST['code']);
    $info = mysqli_real_escape_string($connect, $_POST['info']);

    $query = mysqli_query($connect, "UPDATE jobs SET info = '$info' WHERE code = '$code'");
    echo "<script>window.location='job-request-view-u-p?code=".$code."';</script>";
}