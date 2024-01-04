<?php
    include "connect.php";
    require 'PHPMailer\class.phpmailer.php';
    require 'PHPMailer\class.smtp.php';
    require 'PHPMailer\PHPMailerAutoload.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $shop_name=$_POST['shop_name'];
        $shop_kind=$_POST['shop_kind'];
        $ImageShop=$_POST['ImageShop'];
        $idUser=$_POST['idUser'];
        $Address=$_POST['Address'];
        $email=$_POST['email'];
        
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM registor_sellers WHERE id_user = ?");
        $checkStmt->bind_param("s", $idUser);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo"You already register seller! \n Please wait for admin accept";
        } else {
            if(!empty($ImageShop)){
                $images=date("d-m-y").'-'.time().'-'.rand(10000,100000).'.jpg';
                if(file_put_contents($images, base64_decode($ImageShop))){
                    $query = "INSERT INTO registor_sellers(shop_name,kind_shop,Image_shop,id_user,Address) VALUES('$shop_name','$shop_kind','$images',$idUser,'$Address')";
                    if(mysqli_query($conn, $query)){
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
                            $mail->setFrom('vanphattk159@gmail.com', 'Otp for login');
                            $mail->addAddress($email);
                
                            // Content
                            $mail->isHTML(true);
                            $mail->Subject = 'Register seller';
                            $mail->Body    = "You have registor seller please wait ADMIN response";
                
                            $mail->send();
                            echo 'success';
                        } catch (Exception $e) {
                            echo 'success';
                        }
                        echo 'success';
                    }
                    else{echo 'Faild to upload images to database';}
                }else echo 'Faild to upload images';
            }else echo 'NO IMAGE FOUND';
        }
    }
?>