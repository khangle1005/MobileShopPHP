<?php
include 'header.php';
include 'connect.php';

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
}

$sql = "select * from user_info where user_id='$uid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>


<style>
    .contain {
        /* display: inline-block; */
        padding: 25px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .box {
        /* flex: 0 1 150px; */
        margin: 25px;
    }

    label {
        display: inline-block;
        width: 200px;
        text-align: right;
        padding: 15px;
    }


    input {
        border: 1px solid #E4E7ED;
        height: 40px;
        width: 280px;
        padding: 0px 15px;
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
<div class="contain">
    <h3 class="title">Hồ sơ</h3>
    <?php

    if (isset($_SESSION['uid'])) {
        echo '
<div  class="box bordered-box">
    <form id="profile" method="POST">
        <div class="block">
            <label>Id người dùng</label>
            <input type="text" name="user_id" value="' . $row['user_id'] . '" readonly/>
        </div>
        <div class="block">
            <label>Email</label>
            <input type="text" name="email" value="' . $row['email'] . '"/>
        </div>
        <div class="block">
            <label>Họ</label>
            <input type="text" name="first_name"  value="' . $row['first_name'] . '"/>
        </div>
        <div class="block">
            <label>Tên</label>
            <input type="text" name="last_name"  value="' . $row['last_name'] . '"/>
        </div>
        <div class="block">
            <label>Điện thoại</label>
            <input type="text" name="mobile"  value="' . $row['mobile'] . '"/>
        </div>
        <div class="block">
            <label>Địa chỉ 1</label>
            <input type="text" name="address1"  value="' . $row['address1'] . '"/>
        </div>
        <div class="block">
            <label>Địa chỉ 2</label>
            <input type="text" name="address2"  value="' . $row['address2'] . '"/>
        </div>
        <button type="submit" class="primary-btn cta-btn">Lưu</button>
    </form>
</div>
';
    }

    ?>

    <div class="box bordered-box">
        <h3 class="title">Đơn hàng</h3>

        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>Ngày đặt hàng</th>
                    <th>Số lượng</th>
                    <th>Giá tiền</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $S = 0;
                $sql = "select * from orders where user_id=$uid";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>";
                        echo $row['order_date'];
                        echo "</td><td>";
                        echo $row['quantity'];
                        echo "</td><td>";
                        echo $row['total'];
                        $S += $row['total'];
                        echo "</td><td>";
                        if ($row['status'] == 1) {
                            echo "Hoàn thành";
                        } else {
                            echo "Chờ duyệt";
                        }
                        echo "</td></tr>";
                    }
                }

                ?>
            </tbody>
        </table>

        <h4 class="title">Tất cả: <?php echo $S; ?> đ</h4>
    </div>
</div>
<?php
include "newslettter.php";
include "footer.php";
?>