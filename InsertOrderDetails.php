<?php
include "connect.php";

//Insert of order detail
$id_order = $_POST['id_order'];
$id_product = $_POST['id_product'];
$quantity = $_POST['quantity'];
$product_price = $_POST['product_price'];
$Product_TotalPay = $_POST['Product_TotalPay'];


// $response=array();
// $response['successOrderDetail']=false;

//Insert of order detail mysql

    $query = "INSERT INTO order_detail(id_order, id_product, quantity, product_price, Product_TotalPay) VALUES ('$id_order','$id_product','$quantity','$product_price','$Product_TotalPay')";
    $data = mysqli_query($conn,$query);
    if($data){
        echo "true";
    } else{
        echo "false";
    }
    // $stmtorderDetal = $conn->prepare("INSERT INTO order_detail(id_order, id_product, quantity, product_price, Product_TotalPay) VALUES (?,?,?,?,?)");
    // $stmtorderDetal->bind_param("sssss", $id_order, $id_product, $quantity, $product_price, $Product_TotalPay);
    // $checkrunOrderDetail=$stmtorderDetal->execute();
    // if  ($checkrunOrderDetail){
    //     $response['successOrderDetail']=true;
    //     echo json_encode($response);
    // }else{
    //     echo json_encode($response);
    // }
?>