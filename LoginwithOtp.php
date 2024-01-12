<?php
// session_start();

    require_once 'connect.php'; // Include your database connection code

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $otp = $_POST['otp'];

        // Check if the user exists and OTP is valid
        $stmt = $conn->prepare("SELECT id,email, Name, Address, otp,SDT,thongtinthanhtoan,imgUS,role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($userId,$email, $Name, $Address, $storedOTP,$phone, $Info_pay, $imgUS, $role);
        $stmt->fetch();
        $stmt->close();

        $response = array();
        $response["success"] = false;

        if ($userId && $otp == $storedOTP) {

            $newOTP = rand(100000, 999999);
            $updateStmt = $conn->prepare("UPDATE users SET otp = ?,is_verified=1 WHERE id = ?");
            $updateStmt->bind_param("si", $newOTP, $userId);
            $updateStmt->execute();
            $updateStmt->close();

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
            echo json_encode($response);
        }

        // Encode the response array to JSON and return
        echo json_encode($response);
    }
?>

