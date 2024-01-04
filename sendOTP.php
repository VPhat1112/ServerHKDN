<?php
include "connect.php"; // Replace with your database connection code

require 'PHPMailer\class.phpmailer.php';
require 'PHPMailer\class.smtp.php';
require 'PHPMailer\PHPMailerAutoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email is already registered
    $checkStmt = mysqli_prepare($conn,"SELECT otp FROM users WHERE email = ?");
    mysqli_stmt_bind_param($checkStmt, "s", $email);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);
    mysqli_stmt_bind_result($checkStmt, $otp);

    $response = array();
    $response["success"] = false;

    while (mysqli_stmt_fetch($checkStmt)) {

        // Send OTP to the user's email using PHPMailer
        $mail = new PHPMailer(true);
        $checkStmt->bind_result($otp);
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
            $mail->setFrom('vanphattk159@gmail.com', 'Otp for login');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for Login';
            $mail->Body    = "Your OTP is: $otp";

            $mail->send();
            $response["status"] = "success";
            $response["success"] = true;
            $response["otp"] = $otp;
            echo json_encode($response);
        } catch (Exception $e) {
            $response["status"] = "error";
            $response["message"] = $mail->ErrorInfo;
            echo json_encode($response);
        }
    }
    echo json_encode($response);
}
?>
