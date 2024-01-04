<?php
    include("connect.php");
    $response = array();
    $target_dir = "image/";
    $uploadOk = 1;
    
    $response["success"] = false;

    foreach ($_FILES["fileToUpload"]["name"] as $key => $value) {
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$key]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$key]);
        if($check !== false) {
            $response["check"]= "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $response["check"]= "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $response["error"] = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"][$key] > 500000) {
            $response["error"] =  "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $response["error"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $response["error"] = "Sorry, your file was not uploaded.";
            echo json_encode($response);
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
                $stmt=$conn->prepare("INSERT INTO images(path) values(?);");
                $stmt->bind_param("s",$target_file);
                if ($stmt->execute()) {
                    $response["success"] = true;
                    $response["image"] = getBaseUrl().$target_file;
                } else {
                    $response["error"] = "Sorry, there was an error uploading your file.";
                }
            } else {
                $response["error"] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    echo json_encode($response);

    function getBaseUrl(){
        $url=isset($_SERVER["HTTPS"]) ? "https://" :"http://";
        $url .=$_SERVER['SERVER_NAME'];
        $url .= $_SERVER['REQUEST_URI'];
        return dirname($url).'/';
    }
?>
