<?php
    include "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_name=$_POST['product_name'];
        $product_price=$_POST['product_price'];
        $product_image=$_POST['product_image'];
        $category_id=$_POST['category_id'];
        $product_decs=$_POST['product_decs'];
        $id_shop=$_POST['id_shop'];
        $product_numbersell=$_POST['product_numbersell'];


        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM product WHERE product_name = ? and id_shop=?");
        $checkStmt->bind_param("ss", $product_name,$id_shop);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo "You already have this product in your shop";
        }else{
            if(!empty($product_image)){
                $images=date("d-m-y").'-'.time().'-'.rand(10000,100000).'.jpg';
                if(file_put_contents($images, base64_decode($product_image))){
                    $stmt = $conn->prepare("INSERT INTO product(product_name, product_price, product_image,category_id,product_decs,id_shop,product_numbersell) VALUES (?, ?, ?, ?,?,?,?)");
                    $stmt->bind_param("sssssss", $product_name, $product_price, $images,$category_id,$product_decs,$id_shop,$product_numbersell);
                    if ($stmt->execute()) {
                        try {
                            echo 'success';
                        } catch (PDOException $e) {
                            echo 'failed';
                        }
                    }
                }
            }
            $stmt->close();
        }
        $conn->close();
    }