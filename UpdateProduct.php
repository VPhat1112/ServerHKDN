<?php
    include "connect.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id_product'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $category_id = $_POST['category_id'];
        $product_decs = $_POST['product_decs'];
        $product_numbersell = $_POST['product_numbersell'];


        $response=array();
        $response["success"] = false;
        // Check if a new image is provided
        if ($product_image!="none") {
            // New image provided, update the image
            $images =date("d-m-y") . '-' . time() . '-' . rand(10000, 100000) . '.jpg';

            if (file_put_contents($images, base64_decode($product_image))) {
                $stmt = $conn->prepare("UPDATE product SET product_name=?, product_price=?, product_decs=?, product_image=?, product_numbersell=?, category_id=? WHERE id='$id'");
                $stmt->bind_param("ssssss", $product_name, $product_price, $product_decs, $images, $product_numbersell, $category_id);

                if ($stmt->execute()) {
                    echo 'success';
                    // $response["success"] = true;
                } else {
                    echo 'success';
                    // $response["success"] = false;
                }
            } else {
                echo 'failed';
                // $response["success"] = false;
            }
            // echo json_encode($response);
        } else {
            // No new image provided, update other fields
            $stmt = $conn->prepare("UPDATE product SET product_name=?, product_price=?, product_decs=?, product_numbersell=?, category_id=? WHERE id='$id'");
            $stmt->bind_param("sssss", $product_name, $product_price, $product_decs, $product_numbersell, $category_id);

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
    }
?>


