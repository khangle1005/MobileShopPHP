<?php
include 'connect.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "add":
            $firstname = $_POST["firstname"];
			$lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $number = $_POST["number"];
			$address = $_POST["address"];

            $sql = "INSERT INTO user_info VALUES (NULL, '$firstname', '$lastname', '$email', '$password', '$number', '$address', '')";
            $result = $conn->query($sql);

            header("Location: user.php?page=1");

            break;
        case "remove":
            if (isset($_GET["remove_id"])) {
                $remove_id = $_GET["remove_id"];
                $sql = "delete from user_info where user_id=$remove_id";
                $result = $conn->query($sql);
            }
            break;
        case "edit":
            if (isset($_POST["edit_id"])) {
                $edit_id = $_POST["edit_id"];
            }
			//$name = $_POST["name"];
            $firstname = $_POST["firstname"];
			$lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $number = $_POST["number"];
			$address = $_POST["address"];
			
			$sql = "UPDATE user_info SET first_name='$firstname', last_name='$lastname', email='$email', password='$password', address='$address' where user_id=$edit_id";
            
			// if (strlen($img) > 0) {
                // $sql = "select * from brands where brand_title='$brand'";
                // $result = $conn->query($sql);
                // $row = $result->fetch_row();
                // $brand = $row[0];

                // $sql = "select * from categories where cat_title='$cate'";
                // $result = $conn->query($sql);
                // $row = $result->fetch_row();
                // $cate = $row[0];

                //$sql = "UPDATE products SET product_title='$name', product_desc='$desc', product_cat='$cate', product_brand='$brand', product_price='$price', product_keywords='$key', product_image='$img' where product_id=$edit_id";
            // } else {
                // $sql = "select * from brands where brand_title='$brand'";
                // $result = $conn->query($sql);
                // $row = $result->fetch_row();
                // $brand = $row[0];

                // $sql = "select * from categories where cat_title='$cate'";
                // $result = $conn->query($sql);
                // $row = $result->fetch_row();
                // $cate = $row[0];

                //$sql = "UPDATE products SET product_title='$name', product_desc='$desc', product_cat='$cate', product_brand='$brand', product_price='$price', product_keywords='$key' where product_id=$edit_id";
            // }

            $result = $conn->query($sql);

            break;
    }
}
