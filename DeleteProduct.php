<?php
    include "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id=$_POST['id'];

        $stmt = $conn->prepare("DELETE FROM product where id=$id");
        if ($stmt->execute()) {
            try {
                $response["success"] = true;
                $response['id']= $id;
                echo json_encode($response);
            } catch (PDOException $e) {
                $response["success"] = false;
                echo json_encode($response);
            }       
        }
            $stmt->close();
        $conn->close();
    }