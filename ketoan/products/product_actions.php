<?php
include 'connect.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "add":
            $name = $_POST["name"];
            $desc = $_POST["description"];
            $cate = $_POST["category"];
            $brand = $_POST["brand"];
            $price = $_POST["price"];
            $key = $_POST["keywords"];
            $img = $_POST["image"];
            $stock = $_POST["stock"];

            $sql = "select * from categories where cat_title='$cate'";
            $result = $conn->query($sql);
            $row = $result->fetch_row();
            $cate = $row[0];

            $sql = "select * from brands where brand_title='$brand'";
            $result = $conn->query($sql);
            $row = $result->fetch_row();
            $brand = $row[0];

            $sql = "INSERT INTO PRODUCTS VALUES (NULL, '$cate', '$brand', '$name', '$price', '$desc', '$img', '$key', '$stock')";
            $result = $conn->query($sql);

            header("Location: product.php?page=1");

            break;
        case "remove":
            if (isset($_GET["remove_id"])) {
                $remove_id = $_GET["remove_id"];
                $sql = "delete from products where product_id=$remove_id";
                $result = $conn->query($sql);
            }
            break;
        case "edit":
            if (isset($_POST["edit_id"])) {
                $edit_id = $_POST["edit_id"];
            }

            $name = $_POST["name"];
            $desc = $_POST["description"];
            $cate = $_POST["category"];
            $brand = $_POST["brand"];
            $price = $_POST["price"];
            $key = $_POST["keywords"];
            $img = $_POST["img"];
            $stock = $_POST["stock"];

            if (strlen($img) > 0) {
                $sql = "select * from brands where brand_title='$brand'";
                $result = $conn->query($sql);
                $row = $result->fetch_row();
                $brand = $row[0];

                $sql = "select * from categories where cat_title='$cate'";
                $result = $conn->query($sql);
                $row = $result->fetch_row();
                $cate = $row1[0];

                $sql = "UPDATE products SET product_title='$name', product_desc='$desc', product_cat='$cate', product_brand='$brand', product_price='$price', product_keywords='$key', product_image='$img', stock='$stock' where product_id=$edit_id";
            } else {
                $sql = "select * from brands where brand_title='$brand'";
                $result = $conn->query($sql);
                $row = $result->fetch_row();
                $brand = $row[0];

                $sql1 = "select * from categories where cat_title='$cate'";
                $result = $conn->query($sql);
                $row = $result->fetch_row();
                $cate = $row[0];

                $sql = "UPDATE products SET product_title='$name', product_desc='$desc', product_cat='$cate', product_brand='$brand', product_price='$price', product_keywords='$key', stock='$stock' where product_id=$edit_id";
            }

            $result = $conn->query($sql);

            break;
        case "pdf":
            require '../pdfcrowd.php';

            // create an API client instance
            $client = new Pdfcrowd("username", "apikey");

            // convert a web page and store the generated PDF into a variable
            $pdf = $client->convertURI('http://www.google.com/');

            // set HTTP response headers
            header("Content-Type: application/pdf");
            header("Cache-Control: max-age=0");
            header("Accept-Ranges: none");
            header("Content-Disposition: attachment; filename=\"report.pdf\"");

            // send the generated PDF 
            echo $pdf;
            break;
    }
}
