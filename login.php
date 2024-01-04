<?php
    include "connect.php";
    
    // if (!$conn) {
    //     die("Connection failed: " . mysqli_connect_error());
    // }
 
    $email = $_POST["email"];
    $password = $_POST["Passwords"];  // Consider renaming this to $password for consistency

 
    $loginStatement = mysqli_prepare($conn, "SELECT id,email,Name,Passwords,is_verified,Address,SDT,thongtinthanhtoan,imgUS,role FROM users WHERE email = '$email' AND Passwords = '$password'");
    mysqli_stmt_execute($loginStatement);
 
    mysqli_stmt_store_result($loginStatement);
 
    $response = array();
    $response["success"] = false;
 
    if (mysqli_stmt_num_rows($loginStatement) > 0) {
        mysqli_stmt_bind_result($loginStatement, $id, $email, $Name, $Passwords, $is_verified, $Address, $phone, $Info_pay, $imgUS, $role);
       
        while (mysqli_stmt_fetch($loginStatement)) {
            $response["success"] = true;
            $response["id"] = $id;
            $response["email"] = $email;
            $response["Name"] = $Name;
            $response["Passwords"] = $Passwords;
            $response["Address"] = $Address;
            $response["is_verified"] = $is_verified;
            $response["phone"] = $phone;
            $response["Info_pay"] = $Info_pay;
            $response["imgUS"] = $imgUS;
            $response["role"] = $role;
        }
    }
 
    echo json_encode($response);
 
    mysqli_close($conn);
?>