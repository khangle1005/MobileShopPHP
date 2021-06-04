<?php
include 'connect.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "add":
            if (isset($_POST['user_id']) && isset($_POST['product_id'][0])) {
                $user_id = $_POST['user_id'];

                $sql = "select * from user_info where user_id='$user_id'";
                $result = $conn->query($sql);
                $row = $result->fetch_row();
                $name = $row[2] . " " . $row[1];

                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $note = $_POST['note'];

                $sql = "INSERT INTO orders VALUES (NULL, '$user_id', NULL, 0, 0, 0, 0)";
                $result = $conn->query($sql);

                $sql = "SELECT max(order_id) FROM orders WHERE user_id='$user_id'";
                $result = $conn->query($sql);
                $row = $result->fetch_row();
                $order_id = $row[0];

                $sql = "INSERT INTO order_info VALUES (NULL, '$order_id', '$user_id', '$name', '$phone', '$email', '$address', '$note')";
                $result = $conn->query($sql);

                for ($i = 0; $i <= count($_POST['product_id']); $i++) {
                    $product_id = $_POST['product_id'][$i];
                    $quantity = $_POST['quantity'][$i];

                    $sql = "SELECT product_price FROM products WHERE product_id='$product_id'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_row();
                    $pro_price = $row[0];

                    $unit_price = $pro_price * $quantity;

                    $sql = "INSERT INTO order_items VALUES (NULL, '$order_id', '$product_id', '$quantity', '$unit_price')";
                    $result = $conn->query($sql);

                    $sql = "UPDATE products SET stock=stock-$quantity WHERE product_id='$product_id'";
                    $result = $conn->query($sql);
                }
            }
            break;
        case "remove":
            if (isset($_GET["remove_id"])) {
                $remove_id = $_GET["remove_id"];
                $sql = "delete from orders where order_id=$remove_id";
                $result = $conn->query($sql);
            }
            break;
        case "edit":
            if (isset($_POST["order_id"])) {
                $order_id = $_POST['order_id'];
            }

            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $note = $_POST['note'];
            $order_date = $_POST['order_date'];
            $quantity = $_POST['quantity'];
            $total = $_POST['total'];
            $paid_status = $_POST['paid_status'];
            $status = $_POST['status'];

            $sql = "UPDATE orders set paid_status=$paid_status, order_date='$order_date', quantity='$quantity', total='$total', status='$status' WHERE order_id=$order_id";
            $result = $conn->query($sql);

            break;
        case "accept":
            if (isset($_POST["order_id"])) {
                $order_id = $_POST['order_id'];

                $sql = "UPDATE orders set status=1 WHERE order_id=$order_id";
                $result = $conn->query($sql);
            }


            break;
        case "decline":
            if (isset($_POST["order_id"])) {
                $order_id = $_POST['order_id'];

                $sql = "DELETE FROM orders WHERE order_id=$order_id";
                $result = $conn->query($sql);
            }
            break;

        case "pdf":

            $order_id = $_GET["order_id"];

            require '../pdfcrowd.php';

            // create an API client instance
            $client = new Pdfcrowd("username", "apikey");

            // convert a web page and store the generated PDF into a variable
            $url = "http://localhost/php/onlineshop/admin/orders/order_detail.php?order_id=$order_id";
            $pdf = $client->convertURI($url);

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
