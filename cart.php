<!-- style cho thong bao dat hang -->
<style>
    .success {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
    }

    .success-card h1 {
        color: #88B04B;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
    }

    .success-card p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size: 20px;
        margin: 0;
    }

    .success-card i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left: -15px;
    }

    .success .success-card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
    }

    .bordered-box {
        background: rgb(255, 255, 255);
        color: rgb(51, 51, 51);
        padding: 15px 25px 10px 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        margin-right: 20px;

        border: 1px solid rgb(221, 221, 221);
    }
</style>
<!--  -->

<?php
include "header.php";
include "connect.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "add":
            if (!isset($_SESSION["cart"])) {
                $_SESSION["cart"] = array();
            }

            if (isset($_POST['quantity']) && isset($_SESSION["cart"])) {
                foreach ($_POST['quantity'] as $id => $quantiy) {
                    $_SESSION["cart"][$id] = $quantiy;
                }
            }
            // var_dump($_SESSION['cart']);
            // exit;
            break;
        case "remove":
            $removeid = $_GET["removeId"];
            if (isset($_SESSION["cart"])) {
                unset($_SESSION["cart"][$removeid]);
            }
            break;
        case "submit":
            if (isset($_POST["update"])) {
                if (isset($_POST['quantity']) && isset($_SESSION["cart"])) {
                    foreach ($_POST['quantity'] as $id => $quantiy) {
                        $_SESSION["cart"][$id] = $quantiy;
                    }
                }
            } elseif (isset($_POST["submit"])) {
                // if (isset($_SESSION["cart"])) {
                //     foreach ($_SESSION["cart"] as $id => $quantity) {
                //         $sql = "SELECT * FROM products,categories WHERE product_cat=cat_id and product_id=$id";
                //         $result = $conn->query($sql);
                //         if (!$result) {
                //             trigger_error('Invalid query: ' . $conn->error);
                //         }
                //         if ($result->num_rows > 0) {

                //             while ($row = $result->fetch_row()) {

                //             }
                //         }
                //     }
                // }
                $user_id = $_POST['user_id'];
                $name = $_POST['name'];
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

                if (isset($_SESSION["cart"])) {
                    foreach ($_SESSION["cart"] as $id => $quantity) {
                        $sql = "SELECT product_price FROM products WHERE product_id='$id'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_row();
                        $pro_price = $row[0];

                        $unit_price = $pro_price * $quantity;

                        $sql = "INSERT INTO order_items VALUES (NULL, '$order_id', '$id', '$quantity', '$unit_price')";
                        $result = $conn->query($sql);

                        $sql = "UPDATE products SET stock=stock-$quantity WHERE product_id='$id'";
                        $result = $conn->query($sql);
                    }
                }

                //gui email
                include 'library.php'; // include the library file
                require 'vendor/autoload.php';
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    //Server settings
                    $mail->CharSet = "UTF-8";
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = SMTP_HOST;  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = SMTP_UNAME;                 // SMTP username
                    $mail->Password = SMTP_PWORD;                           // SMTP password
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = SMTP_PORT;                                    // TCP port to connect to
                    //Recipients
                    $mail->setFrom(SMTP_UNAME, "Cửa hàng");
                    $mail->addAddress($email, 'Người nhận');     // Add a recipient | name is option
                    $mail->addReplyTo(SMTP_UNAME, 'Information');
                    //                    $mail->addCC('CCemail@gmail.com');
                    //                    $mail->addBCC('BCCemail@gmail.com');
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = "Xác nhận đơn hàng";
                    $mail->Body = "Bạn vừa đặt mua hàng tại cửa hàng";
                    $mail->AltBody = "Bạn vừa đặt mua hàng tại cửa hàng"; //None HTML
                    $result = $mail->send();
                    if (!$result) {
                        $error = "Có lỗi xảy ra trong quá trình gửi mail";
                    }
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    echo  $mail->Username;
                    echo "-" . $mail->Password;
                    echo "-" . $email;
                }

                echo '
                    <div class="success">
                                <div class="success-card">
                    <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                        <i class="checkmark">✓</i>
                    </div>
                        <h1>Đặt hàng thành công</h1> 
                        <p>Hệ thống đã ghi nhận đơn hàng của bạn<br/> Cảm ơn bạn đã sử dụng hệ thống!</p>
                    </div>
                    </div>
                ';

                exit;
            } elseif (isset($_POST["delete-all"])) {
                if (isset($_POST['quantity']) && isset($_SESSION["cart"])) {
                    unset($_SESSION["cart"]);
                }
            }
            break;
    }
}

?>

<section class="section">
    <div class="container-fluid">
        <div id="cart_checkout">
            <div class="table-responsive">
                <form id="cart-form" action="cart.php?action=submit" method="POST">
                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:40%">Sản phẩm</th>
                                <th style="width:10%">Hình ảnh</th>
                                <th style="width:10%">Giá</th>
                                <th style="width:8%">Số lượng</th>
                                <th style="width:7%" class="text-center">Tổng</th>
                                <th style="width:10%">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $tong = 0;
                            if (isset($_SESSION["cart"])) {
                                foreach ($_SESSION["cart"] as $id => $quantity) {
                                    // echo $id."=>".$quantity;
                                    $sql = "SELECT * FROM products,categories WHERE product_cat=cat_id and product_id=$id";
                                    $result = $conn->query($sql);
                                    if (!$result) {
                                        trigger_error('Invalid query: ' . $conn->error);
                                    }
                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_row()) {
                                            // $_POST['quantity'][row[0]] = $quantity;
                                            echo "<tr><td>";
                                            echo "<a href=product.php?p=" . $id . ">" . $row[3] . "</a>";
                                            echo "</td><td>";
                                            echo "<img src='product_images/$row[6]' style='max-height: 80px;' alt=''>";
                                            echo "</td><td>";
                                            echo $row[4];
                                            echo " đ</td><td>";
                                            echo '<input type="text" class="form-control qty" name="quantity[' . $row[0] . ']" value="' . $quantity . '" price=' . $row[4] . '>';
                                            echo "</td><td id='price-cell'>";
                                            echo $quantity * $row[4];
                                            $tong += $quantity * $row[4];
                                            echo " đ</td><td>";
                                            echo '<a href="#" class="btn btn-danger btn-sm remove" remove_id="' . $id . '"><i class="fa fa-trash-o"></i></a>';
                                            echo "</td></tr>";
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                    <input style="float:right;margin-right: 16px;" type="submit" name="update" form="cart-form" class="btn btn-success" value="Cập nhật" />
                    <div class="row" style="margin: auto;">
                        <?php
                        if (isset($_SESSION['uid'])) {
                            $uid = $_SESSION['uid'];
                            $sql = "SELECT * FROM user_info WHERE user_id=$uid";
                            $result = $conn->query($sql);
                            if (!$result) {
                                trigger_error('Invalid query: ' . $conn->error);
                            }
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_row()) {
                                    $user_id = $row[0];
                                    $name = $row[1] . " " . $row[2];
                                    $email = $row[3];
                                    $mobile = $row[5];
                                    $address = $row[6];
                                }
                            }
                        }

                        if (isset($_SESSION['uid'])) {
                            echo '
                            <div class="col-md-4 bordered-box">
                            <p class="text-center">
                                <strong>Thông tin đơn hàng</strong>
                            </p>
                    <div>
                        <input class="form-control" type="hidden" name="user_id" value="' . $user_id . '" required readonly><br>
                        Người nhận: <input class="form-control" type="text" name="name" value="' . $name . '" required><br>
                        Email: <input class="form-control" type="text" name="email" value="' . $email . '" required><br>
                        Số điện thoại: <input class="form-control" type="text" name="phone" value="' . $mobile . '" required><br>
                        Địa chỉ: <input class="form-control" type="text" name="address" value="' . $address . '" required><br>
                        Ghi chú: <textarea class="form-control" name="note" value=""></textarea>
                    </div>
                    <b class="net_total">Thành tiền : ' . $tong . ' đ</b>
                    <div>
                        <input style="margin-right: 16px;" type="submit" name="submit" form="cart-form" class="btn btn-success" value="Xác nhận" />
                        <input style="margin-right: 16px" type="submit" name="delete-all" form="cart-form" class="btn btn-danger" value="Xóa giỏ hàng" />
                    </div>
                    </div>
                    ';
                        } else {
                            echo "
                    <h3>Bạn chưa đăng nhập</h3>";
                        }

                        ?>
                        <div class="col-md-6 bordered-box">

                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text-center">
                                            <strong>Phương thức thanh toán</strong>
                                        </p>

                                        <div class="row" style="margin-bottom: 15px;">
                                            <div class="col-md-12">
                                                <input class="form-check-input" type="radio" name="payment" id="shipcod" value="shipcod" checked>
                                                <img class="method-icon" width="32" src="https://cdn.iconscout.com/icon/premium/png-256-thumb/cash-on-delivery-1448072-1223817.png" alt="shipcod">

                                                <label class="form-check-label" for="shipcod">
                                                    Thanh toán tiền mặt khi nhận hàng
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 15px;">
                                            <div class="col-md-12">
                                                <input class="form-check-input" type="radio" name="payment" id="momo" value="momo">
                                                <img class="method-icon" width="32" src="https://frontend.tikicdn.com/_desktop-next/static/img/icons/checkout/icon-payment-method-mo-mo.svg" alt="momo">
                                                <label class="form-check-label" for="momo">
                                                    Thanh toán bằng ví MoMo
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 15px;">
                                            <div class="col-md-12">
                                                <input class="form-check-input" type="radio" name="payment" id="qrpay" value="qrpay">
                                                <img class="method-icon" width="32" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAbFBMVEX///8AAADv7++CgoJgYGDs7Ox7e3u+vr7c3Nx3d3cTExMWFhYoKCiTk5Ovr6/S0tIjIyPAwMDLy8u2trZaWlpSUlKLi4v19fWZmZmgoKDIyMinp6ewsLAbGxve3t47OztqamovLy9LS0tDQ0NxF+GnAAAEkklEQVR4nO3d6XqiMBiGYcUFcKxsCgpubc//HEedNpnypSEJYX+fn5IB7nauGYgss7mk1WwYrWSIGYRDCEII+x+EEPY/RaGfJO6jKMrzPI6DIPC8rvdcOc977G8cP/Y8ip6IJPEFwqTr3bRaMkmh2/VOWc2FcPBNUxh1vVNWiyYpzNlSx1qZ0t5k9jbI1pnLhM7cWmsl4dreBhmxLeFCSbiwt0GpMG5UeL+EP7vcGxXG7KO2hEuybNm6MBiVMGAfQVivfgm9UQk99tEEhKvvZlToOSuTMjaFoCn0M6PtOZzDD2qoi+cIxuvFDlI0hWqHQPX3mI83nWtrW8jn2iD8F4TVQQihbhCWEwgdtzge356l6Rvr+Or0rCiK3c6iMNid6Pb+2+Bze8XVovBE9k+URaHS9gqLwqPKBjcy4Z4M39cWsr80vRDKgrAN4RuEEM5O63KnkQn7/m9pfWET/x9CCCGEEEIIIYQQQgjh2IT1z/EhhBBCCCFUmtWHEEIIGxUWEEIIYefC3eiF5/mfyjahRWG4qd7g/GxRqNkArzbRDEIIdYOwHITVCYQHIjywZeMQCi6xZ8s6FKrdIElbUKHF4bTMWOiTi2CUWtwMhbeF2QZ9Y2HturvDEkJbQQihdhBCqF13TxyQlq0XllqrPbcosbdB06MwhBBCCI25+7IcnyBL92QZO2Q6kWW0fTr7ffid7sv1UL3O5UH3mGZDD/zYMjoByqfmfLqMJrgriBXOSJ5gFabHpbw/hkKlQ2nZs022EEIIIYQQQgghhBBCCCGEQxI2en4oE7Z2fmh8jn/YHw4fn5+32+19G4aXy0bws+LCDs/xLUaJy+o/NKjGL7xAOPhCCAffdvTCdwjbrJFrMW4SIb0WI6V7tSKD1js6Sq1GrqeRCemB+oXuleC41O+BkF8T9SkRmp5bQNiu8APCwQvp/RZjE9InQ45NSH+Hsm+5WxNavN/iWF6Xf+yDsO17ZtoXWrzvSRaEryDUCcLqICw1RaHge4trW8JM5f9IgZC+G4t/iZJetj8Lb/TVVvFmWx7l05UaC106oUvjJ+aadzoLfo507Xs6KqKjevo0M5rgdfCC4S4dBeGEhc0+vxRCCCGEEEIIIYQQQgghtCWUfTNjKrR5BlxfmJIrJddXrxx/Kyi91HJBhl/P9AJQte8hWnp3XkDXIJtaangmqiWh7FEoDc8mjl/YxFs6IYQQQgh/Cuu/OQBCCCGEsEpY/90IEEIIYStCfn/pAM+ArzuF2As1RMLYLRUVPqn4Hp2VR7vRmQ5PIzLMWKiZ5tvjaYKZqIavxdBsgLOJmkEIIYRfQfhrjuZ4Wr+Ezlf898WFHr28UaWMPRejQ+HqG8bfcOZRYe26E/LD2CkJg1EJ+XE9hPXqlzAelTBmH01JmI9KmLOPmhXyiRe9uxEEQsFwYyE7zKkfvzQikywTJFuVbBRbJBJGsi0OrmiSQsV5qoHkQjj4pilUezfTUEomKfST5PUFQZTneRwHQeB51SvqSZ732N84fux59PouI0l8gVCQ6Vxb2wkO8ngQDiIIIex/EELY/6TCvzIlqPMkgRIQAAAAAElFTkSuQmCC" alt="airpay">

                                                <label class="form-check-label" for="qrpay">
                                                    Thanh toán bằng QRPay
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-center">
                                            <strong>Quét mã</strong>
                                        </p>
                                        <div class="row" id="qr-code" style="text-align: center;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>


        </div>
    </div>

</section>

<script>
    $("#reset-cart").click(function() {});


    $(".qty").blur(function() {
        var price = $(this).attr("price");
        var quantity = $(this).val();
        var re_price = price * quantity;
        $(this).parent().parent().find("#price-cell").text(re_price + " đ");

        var S = 0;
        var num_of_rows = document.getElementById("cart").rows.length;
        for (var i = 1; i < num_of_rows; i++) {
            var cell = document.getElementById("cart").rows[i].cells;
            S += parseFloat(cell[4].innerHTML.replace(' đ', ''));
        }

        $(".net_total").text("Thành tiền : " + S + " đ");

        // sessionStorage.setItem("cart[]", quantity);
    });
</script>

<?php
// include "newslettter.php";
include "footer.php";
?>