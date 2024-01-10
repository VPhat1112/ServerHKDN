<?php
    include "connect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Insert of order
        $id = $_POST['id'];
        $idUser = $_POST['idUser'];
        $idShop = $_POST['idShop'];
        $BillTotal=$_POST['BillTotal'];
        $Address_ship=$_POST['Address_ship'];
        $Phone=$_POST['Phone'];

        $response=array();
        $response['successOrder']=false;

        //Insert of order mysql
        $stmtorder = $conn->prepare("INSERT INTO tbl_order(id, id_user, id_shop, FinalTotal, Address_ship, Phone) VALUES (?, ?, ?, ?, ?, ?)");
        $stmtorder->bind_param("ssssss", $id, $idUser, $idShop, $BillTotal, $Address_ship, $Phone);
        if  ($stmtorder->execute()){
            $response['successOrder']=true;
            echo json_encode($response);
        }else{
            echo json_encode($response);
        }
    }