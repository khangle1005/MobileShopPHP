<?php
include 'connect.php';
if (isset($_POST["edit_id"])) {
    $edit_id = $_POST["edit_id"];
}
$sql = "select * from user_info where user_id=$edit_id";
$sql = "select user_id, last_name, first_name, email, password, mobile, address1 from user_info where user_id=$edit_id";
$result = $conn->query($sql);
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_row()) {
//     }
// }
$row = $result->fetch_row();
?>
<form id="save" action="user_actions.php?action=edit" method="post">
    <div class="form-group">
        <label for="name">Mã khách hàng</label>
        <input type="text" class="form-control" name="edit_id" value=" <?php echo $row[0]  ?>" readonly>
    </div>
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
    <button type="submit" class="btn btn-primary" edit_id="<?php echo $row[0] ?>">Lưu</button>
</form>

<script>
    $(document).ready(function() {
        $('#save').submit(function(e) {
            e.preventDefault();

            // if (document.getElementById("new_img").files.length == 0) {
            //     var current_img = $("#current_img").attr("src");
            //     $("#new_img").val(current_img);
            // }

            $.ajax({
                url: 'user_actions.php?action=edit',
                type: 'post',
                data: $('#save').serialize(),
                success: function() {
                    // Whatever you want to do after the form is successfully submitted
                    //alert("Đã lưu");
                }
            });
            alert("Đã lưu");
            window.location.reload();
        });
    });
</script>