<?php
session_start();
include 'connect.php';


if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "send_review":
            if (isset($_POST['review'])) {
                $user_id = $_POST['user_id'];
                $product_id = $_POST['product_id'];
                $review = $_POST['review'];

                $sql = "insert into reviews values (NULL, '$product_id', '$user_id', '$review')";
                $result = $conn->query($sql);
            }
            break;
        case "save_profile":
            if (isset($_POST['user_id'])) {
                $id = $_POST['user_id'];
                $email = $_POST['email'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $mobile = $_POST['mobile'];
                $address1 = $_POST['address1'];
                $address2 = $_POST['address2'];

                $sql = "UPDATE user_info SET first_name='$first_name', last_name='$last_name', email='$email', mobile='$mobile', address1='$address1', address2='$address2' WHERE user_id=$id";

                $result = $conn->query($sql);
            }
            break;
        case "change_password":
            if (isset($_SESSION['uid'])) {
                $id = $_SESSION['uid'];
                $cur_password = $_POST['cur_password'];
                $new_password = $_POST['new_password'];
                $re_password = $_POST['re_password'];

                $sql = "select password from user_info where user_id=$id";
                $result = $conn->query($sql);
                $row = $result->fetch_row();

                if ($row[0] == $cur_password) {
                    if ($re_password == $new_password) {
                        $sql = "update user_info set password='$new_password' where user_id=$id";
                        $result = $conn->query($sql);
                        if ($result > 0) {
                            // echo "Đổi mật khẩu thành công";
                            header('Location: change_password.php');
                        }
                    }
                }
            }
            break;
    }
}
