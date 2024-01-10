<?php
    include "connect.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $order_id = $_POST['order_id'];
        $FinalTotal = $_POST['FinalTotal'];

        $stmtOrder = $conn->prepare("UPDATE tbl_order SET FinalTotal=? where id=?");
        $stmtOrder->bind_param("ss",$FinalTotal,$order_id);

        if ($stmtOrder->execute()) {
            echo 'success';
        } else {
            echo 'failed';
        }
    }
?>