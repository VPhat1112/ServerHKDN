<?php
include "connect.php"; // Replace with your database connection code

require 'PHPMailer\class.phpmailer.php';
require 'PHPMailer\class.smtp.php';
require 'PHPMailer\PHPMailerAutoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $Name = $_POST['Name'];
    $Address = $_POST['Address'];
    $Passwords = $_POST['Passwords'];
    $Confirm = $_POST['Confirm'];

    $response = array();
    $response["success"] = false;
    
    

    // Check if the email is already registered
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        $response["check"] = "email already exists";
        echo json_encode($response);
    } else {
        // Check if passwords match
        
        if ($Passwords !== $Confirm) {
            $response["status"] = "password_mismatch";
            
            echo json_encode($response);
        } else {
            $otp = rand(100000, 999999); // Generate a 6-digit OTP

            $stmt = $conn->prepare("INSERT INTO users (email, Name, Address, Passwords, otp) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $email, $Name, $Address, $Passwords, $otp);

            if ($stmt->execute()) {
                // Send OTP to the user's email using PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'vanphattk159@gmail.com'; // Replace with your Gmail address
                    $mail->Password   = 'wbquewsdsewurcsi'; // Replace with your Gmail password
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;

                    // Recipient
                    $mail->setFrom('vanphattk159@gmail.com', 'Your Name');
                    $mail->addAddress($email, $Name);

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Your OTP for Registration';
                    $mail->Body    = "Your OTP is: $otp";

                    $mail->send();
                    $response["status"] = "success";
                    $response["success"] = true;
                    $response['email']= $email;
                    $response['Name']= $Name;
                    $response['Address']= $Address;
                    $response['Passwords']= $Passwords;
                    $response['Confirm']= $Confirm;
                    echo json_encode($response);
                } catch (Exception $e) {
                    $response["status"] = "error";
                    $response["message"] = $mail->ErrorInfo;
                    echo json_encode($response);
                }
            } else {
                $response["status"] = "error";
                echo json_encode($response);
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>
