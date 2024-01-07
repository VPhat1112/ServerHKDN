<?php
    include "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Insert of order
        $BillTotal=$_POST['BillTotal'];
        $Address_ship=$_POST['Address_ship'];
        $Phone=$_POST['Phone'];
        //Insert of contact_buy

        $Shop_id=$_POST['Shop_id'];
        $Buyer_id=$_POST['buyer_id'];

        //Insert of order detail
        $product_id=$_POST['Product_id'];
        $Number_pay=$_POST['Number_pay'];
        $product_price=$_POST['product_price'];
        $Product_TotalPay=$_POST['Product_TotalPay'];

        
        $response=array();
        $response['successOrder']=false;
        $response['successContact']=false;
        $response['successOrderDetail']=false;

        do{
            $order_id = rand(100000, 999999);
            $stmtIDorder = $conn->prepare("SELECT Count(*) FROM tbl_order where id ='$order_id'");
            $stmtIDorder->execute();
            $stmtIDorder->bind_result($count);
        }while($count>0);

        //Insert of order mysql
        $stmtorder = $conn->prepare("INSERT INTO tbl_order(id,FinalTotal,Address_ship,Phone) VALUES ('$order_id','$BillTotal','$Address_ship','$Phone')");
        $checkrunOrder=$stmtorder->execute();
        if  ($checkrunOrder){
            $response['successOrder']=true;
            $inserted_id_order = $stmtorder->insert_id;
        }else{
            echo json_encode($response);
        }
        //Insert of contact mysql
        $stmtContact = $conn->prepare("INSERT INTO contact_buy(shop_id,buyer_id) VALUES (?,?)");
        $stmtContact->bind_param("ss", $Shop_id,$Buyer_id);
        $checkrunContact=$stmtContact->execute();
        if  ($checkrunContact){
            $response['successContact']=true;
            $inserted_id_contact = $stmtContact->insert_id;
        }else{
            $stmtContactDrop = $conn->prepare("DELETE FROM tbl_order WHERE id='$inserted_id_order'");
            $stmtContactDrop->execute();
            echo json_encode($response);
        }
        //Insert of detail mysql
        $stmtorderDetal = $conn->prepare("INSERT INTO order_detail(id,contact_id,product_id,Number_pay,product_price,Product_TotalPay) VALUES ('$inserted_id_order','$inserted_id_contact',?,?,?,?)");
        $stmtorderDetal->bind_param("ssss",$product_id,$Number_pay,$product_price,$Product_TotalPay);
        $checkrunOrderDetail=$stmtorderDetal->execute();
        if  ($checkrunOrderDetail){
            $response['successOrderDetail']=true;
        }else{
            $stmtContactDrop = $conn->prepare("DELETE FROM tbl_order WHERE id='$inserted_id_order'");
            $stmtContactDrop->execute();
            $stmtorderDetalDrop = $conn->prepare("DELETE FROM contact_buy WHERE id='$inserted_id_contact'");
            $stmtorderDetalDrop->execute();
            echo json_encode($response);
        }

        echo json_encode($response);
    }