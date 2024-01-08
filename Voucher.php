<?php
    include "connect.php";
    $Request=$_POST['Request'];
    $voucher_name=$_POST['voucher_name'];
    $PR=$_POST['PR'];
    $DateStart=$_POST['DateStart'];
    $DateEnd=$_POST['DateEnd'];
    $id_shop=$_POST['id_shop'];
    
    if($Request=="1"){
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
    }else if($Request=="2"){
        $stmt = $conn->prepare("UPDATE tbl_voucher SET voucher_name=?, PR=?, DateStart=?, DateEnd=? WHERE id_shop='$id_shop'");
        $stmt->bind_param("ssss", $voucher_name, $PR, $DateStart, $DateEnd);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'failed';
        }
    }else if($Request=="3"){
        $stmt = $conn->prepare("DELETE FROM tbl_voucher WHERE id_shop='$id_shop'");
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'failed';
        }
    }

    
