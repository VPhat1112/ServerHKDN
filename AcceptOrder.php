<?php
    include "connect.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $order_id = $_POST['order_id'];
    


        $response=array();
        $response["success"] = false;
        // Check if a new image is provided
        
            // No new image provided, update other fields
            $stmt = $conn->prepare("UPDATE tbl_order SET Order_status='1' where id='$order_id'");

            if ($stmt->execute()) {
                echo 'success';
                // $response["success"] = true;
                // echo json_encode($response);
            } else {
                echo 'failed';
                // $response["success"] = false;
                // echo json_encode($response);
            }
        }
        $conn->close();
    
?>

