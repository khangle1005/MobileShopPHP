<?php
include 'connect.php';
?>

<form id="add" action="product_actions.php?action=add" method="post">
    <!-- <div class="form-group">
        <label for="name">Mã khách hàng</label>
        <input type="text" class="form-control" name="edit_id" value="" disabled>
    </div> -->
    <div class="form-group">
        <label for="firstname">Tên khách hàng</label>
        <input type="text" class="form-control" name="firstname" value="" required>
    </div>
	<div class="form-group">
        <label for="lastname">Họ khách hàng</label>
        <input type="text" class="form-control" name="lastname" value="" required>
    </div>
	<div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" value="" required>
    </div>
	<div class="form-group">
        <label for="password">Mật khẩu</label>
        <input type="text" class="form-control" name="password" value="" required>
    </div>
	<div class="form-group">
        <label for="number">Số điện thoại</label>
        <input type="text" class="form-control" name="number" value="" required>
    </div>
    <div class="form-group">
        <label for="address">Địa chỉ</label>
        <input type="text" class="form-control" name="address" value="" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Thêm</button>
</form>

<script>
    $(document).ready(function() {
        $('#add').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'user_actions.php?action=add',
                type: 'post',
                data: $("#add").serialize(),
                success: function() {
                    // Whatever you want to do after the form is successfully submitted
                    alert("Đã thêm");

                }
            });
        });

    });
</script>