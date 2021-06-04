<?php
include 'header.php';
include 'connect.php';

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
}

// $sql = "select * from user_info where user_id='$uid'";
// $result = $conn->query($sql);
// $row = $result->fetch_assoc();
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
    <?php

    if (isset($_SESSION['uid'])) {
        echo '
<div  class="box bordered-box">
<div class="block">
    <h3 class="title">Đổi mật khẩu</h3>
</div>
<form id="change_password" method="POST" action="action.php?action=change_password">
    <div class="block">
        <label>Mật khẩu hiện tại</label>
        <input type="password" name="cur_password" required/>
    </div>
    <div class="block">
        <label>Mặt khẩu mới</label>
        <input type="password" name="new_password"  required/>
    </div>
    <div class="block">
        <label>Nhập lại</label>
        <input type="password" name="re_password"  required/>
    </div>
    <button type="submit" class="primary-btn cta-btn">Thay đổi</button>
</form>
</div>
';
    }

    ?>