<?php
    include "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id=$_POST['id'];

        $checkStmt = $conn->prepare("SELECT status FROM product WHERE id='$id'");
        $checkStmt->execute();
        $checkStmt->bind_result($checkStatus);
        $checkStmt->fetch();
        $checkStmt->close();

        if($checkStatus==1){
            $stmt = $conn->prepare("UPDATE product SET status=0 where id='$id'");
    
            if ($stmt->execute()) {
                try {
                    echo 'success';
                
                } catch (PDOException $e) {
                    echo 'failed';
                }       
            }
                $stmt->close();
            $conn->close();
        }else if($checkStatus==0){
            $stmt = $conn->prepare("UPDATE product SET status=1 where id='$id'");
    
            if ($stmt->execute()) {
                try {
                    echo 'success';
                
                } catch (PDOException $e) {
                    echo 'failed';
                }       
            }
                $stmt->close();
            $conn->close();
        }
    }