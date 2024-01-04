<?php
session_start();

require_once 'db_connection.php'; // Include your database connection code
require 'PHPMailer\class.phpmailer.php';
require 'PHPMailer\class.smtp.php';
require 'PHPMailer\PHPMailerAutoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the user exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId);
    $stmt->fetch();
    $stmt->close();

    if ($userId) {
        // Generate a unique verification code
        $verificationCode = uniqid();

        // Update the database with the verification code
        $updateStmt = $conn->prepare("UPDATE users SET verification_code = ? WHERE id = ?");
        $updateStmt->bind_param("si", $verificationCode, $userId);
        $updateStmt->execute();
        $updateStmt->close();

        // Send an activation email with a link containing the verification code
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your_gmail@gmail.com'; // Replace with your Gmail address
            $mail->Password   = 'your_gmail_password'; // Replace with your Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipient
            $mail->setFrom('your_gmail@gmail.com', 'Your Name');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Activate Your Account';
            $mail->Body    = "Click the following link to activate your account: <a href='http://yourwebsite.com/activate.php?code=$verificationCode'>Activate</a>";

            $mail->send();
            echo json_encode(['status' => 'activation_email_sent']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $mail->ErrorInfo]);
        }
    } else {
        // User not found
        echo json_encode(['status' => 'user_not_found']);
    }
}
?>
