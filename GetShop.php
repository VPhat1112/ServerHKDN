<?php
    include "connect.php";

    $id_shop = $_POST["id_shop"];

    $GetshopStatement = mysqli_prepare($conn, "SELECT * from shops where id='$id_shop'");
    mysqli_stmt_execute($GetshopStatement);
 
    mysqli_stmt_store_result($GetshopStatement);
 
    $response = array();
    $response["success"] = false;
    
    if (mysqli_stmt_num_rows($GetshopStatement) > 0) {
        mysqli_stmt_bind_result($GetshopStatement, $idShops, $shop_name, $kind_phone, $shop_rate, $Image_shop, $id_user, $Address, $status, $createdAt, $updatedAt);
        while (mysqli_stmt_fetch($GetshopStatement)) {
            $response["success"] =true;
            $response["id"] = $idShops;
            $response["shop_name"] = $shop_name;
            $response["shop_phone"] = $kind_phone;
            $response["shop_rate"] = $shop_rate;
            $response["Image_shop"] = $Image_shop;
            $response["id_user"] = $id_user;
            $response["Address"] = $Address;
            $response["status"] = $status;
            $response["createdAt"] = $createdAt;
            $response["updatedAt"] = $updatedAt;
        }
    }
    echo json_encode($response);
 


?>