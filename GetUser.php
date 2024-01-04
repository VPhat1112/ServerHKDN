<?php
// session_start();

    require_once 'connect.php'; // Include your database connection code
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $stmt = $conn->prepare("SELECT id,email, Name, Address, otp,SDT,thongtinthanhtoan,imgUS,role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($userId,$email, $Name, $Address, $storedOTP,$phone, $Info_pay, $imgUS, $role);
        $stmt->fetch();
        $stmt->close();
        if ($userId) {
            $response["success"] = true;

            // Add user information to the response
            $response['id']= $userId;
            $response['email']= $email;
            $response['phone']=$phone;
            $response['Name']= $Name;
            $response['Address']= $Address;
            $response['Info_pay']= $Info_pay;
            $response['imgUS']= $imgUS;
            $response['role']= $role;
        } else {
            // Invalid OTP or user not found
            $response["message"] = "Invalid OTP or user not found";
        }
        echo json_encode($response);
    }