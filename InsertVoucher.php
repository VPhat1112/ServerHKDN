<?php
    include "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $voucher_name=$_POST['voucher_name'];
        $PR=$_POST['PR'];
        $DateStart=$_POST['DateStart'];
        $DateEnd=$_POST['DateEnd'];
        $id_shop=$_POST['id_shop'];


        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM tbl_voucher WHERE Voucher_name = ? and id_shop=?");
        $checkStmt->bind_param("ss", $voucher_name,$id_shop);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo "You already have this voucher in your shop";
        }else{
            
            $stmt = $conn->prepare("INSERT INTO tbl_voucher(id_shop,voucher_name,PR,DateStart,DateEnd) VALUES (?, ?, ?,?,?)");
            $stmt->bind_param("sssss", $id_shop, $voucher_name, $PR,$DateStart,$DateEnd);
            if ($stmt->execute()) {
                try {
                    echo 'success';
                } catch (PDOException $e) {
                    echo 'failed';
                }
            }
            $stmt->close();
        }
        $conn->close();
    }