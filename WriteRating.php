<?php
    include "connect.php";
    
    $rating_star=$_POST['rating_star'];
    $comment=$_POST['comment'];
    $product_id=$_POST['product_id'];
    $user_id=$_POST['user_id'];

    $response=array();
    $response['success']=false;
    do {
        $rating_id = rand(100000, 999999);
        $stmtIDorder = $conn->prepare("SELECT Count(*) FROM tbl_product_evaluate where id = ?");
        $stmtIDorder->bind_param("s", $rating_id);
        $stmtIDorder->execute();
        $stmtIDorder->bind_result($count);
        $stmtIDorder->fetch();
        $stmtIDorder->close();
    } while ($count > 0);

    $stmt = $conn->prepare("INSERT INTO tbl_product_evaluate(id,id_product, id_user, Comment,Rating) VALUES (?,?, ?, ?, ?)");
    $stmt->bind_param("sssss",$rating_id, $product_id, $user_id,$comment,$rating_star);
    if ($stmt->execute()) {
        try {
            $response['success']=true;
            echo json_encode($response);
        } catch (PDOException $e) {
            echo json_encode($response);
        }
    }
        
    