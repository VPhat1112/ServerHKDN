<?php
    include "connect.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $order_id = $_POST['order_id'];
        $request=$_POST['request'];
    


        $response=array();
        $response["success"] = false;
        

        // Check request from seller
        if($request==1){
            //Set Accept order
            $stmt = $conn->prepare("UPDATE tbl_order SET Order_status='1' where id='$order_id'");
            if ($stmt->execute()) {
                echo 'success';
            } else {
                echo 'failed';
            }
        }else if($request==2){
            //Set Complete order
            $stmt = $conn->prepare("UPDATE tbl_order SET Order_status='2' where id='$order_id'");

            if ($stmt->execute()) {
                echo 'success';
            } else {
                echo 'failed';
            }
        }else if($request==3){
            //Set Cancel Order
            $stmt = $conn->prepare("UPDATE tbl_order SET Order_status='3' where id='$order_id'");
            if ($stmt->execute()) {
                echo 'success';
            } else {
                echo 'failed';
            }
        }
        $conn->close();
    }
?>

