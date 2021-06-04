<?php
include 'connect.php';
if (isset($_POST["order_id"])) {
    $order_id = $_POST["order_id"];
}
if (isset($_GET["order_id"])) {
    $order_id = $_GET["order_id"];
}
$sql = "SELECT * FROM orders o, order_info oi WHERE o.order_id = oi.order_id and o.order_id=$order_id";
$result = $conn->query($sql);
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_row()) {
//     }
// }
$row = $result->fetch_assoc();
?>
<a href="order_actions.php?action=pdf&order_id=<?php $row['order_id'] ?>" class="btn btn-default">Xuất hóa đơn</a>

<form id="save" action="product_actions.php?action=edit" method="post">
    <div class="form-group">
        <label for="">Mã đơn hàng</label>
        <input type="text" class="form-control" name="order_id" id="order_id" value="<?php echo $row['order_id']  ?>" readonly>
    </div>
    <div class="form-group">
        <label for="">Người đặt</label>
        <input type="text" class="form-control" name="name" value="<?php echo $row['name']  ?>" readonly>
    </div>
    <div class="form-group">
        <label for="">Điện thoại</label>
        <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']  ?>" readonly>
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="text" class="form-control" name="email" value="<?php echo $row['email']  ?>" readonly>
    </div>
    <div class="form-group">
        <label for="">Ghi chú</label>
        <!-- <input type="text" class="form-control" name="note" value="<?php echo $row['note']  ?>" readonly> -->
        <textarea class="form-control" name="note" value="" readonly><?php echo $row['note']  ?></textarea>
    </div>
    <!-- <div class="form-group">
        <label for="">Ngày đặt</label>
        <input type="text" class="form-control" name="name" value="<?php echo $row['order_date']  ?>"readonly>
    </div> -->
    <div class="form-group">
        <label for="">Ngày đặt</label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="order_date" value="<?php echo $row['order_date']  ?>" />
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="">Số lượng</label>
        <input type="text" class="form-control" name="quantity" value="<?php echo $row['quantity']  ?>">
    </div>
    <div class="form-group">
        <label for="">Thành tiền</label>
        <input type="text" class="form-control" name="total" value="<?php echo $row['total']  ?>">
    </div>
    <div class="form-group">
        <label for="">Địa chỉ</label>
        <input type="text" class="form-control" name="address" value="<?php echo $row['address']  ?>">
    </div>
    <div class="form-group clearfix">
        <label>Thanh toán</label><br>
        <div class="icheck-danger d-inline">
            <input type="radio" name="paid_status" <?php if ($row['paid_status'] == 0) {
                                                        echo 'checked';
                                                    } ?> value="0" id="unpaid">
            <label for="unpaid">
                Chưa thanh toán
            </label>
        </div>
        <div class="icheck-success d-inline">
            <input type="radio" name="paid_status" <?php if ($row['paid_status'] == 1) {
                                                        echo 'checked';
                                                    } ?> value="1" id="paid">
            <label for="paid">
                Đã thanh toán
            </label>
        </div>
    </div>
    <div class="form-group clearfix">
        <label>Trạng thái</label><br>
        <div class="icheck-danger d-inline">
            <input type="radio" name="status" <?php if ($row['status'] == 0) {
                                                    echo 'checked';
                                                } ?> value="0" id="undelivered">
            <label for="undelivered">
                Chưa xử lí
            </label>
        </div>
        <div class="icheck-success d-inline">
            <input type="radio" name="status" <?php if ($row['status'] == 1) {
                                                    echo 'checked';
                                                } ?> value="1" id="delivered">
            <label for="delivered">
                Đã xử lí
            </label>
        </div>
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
                url: 'order_actions.php?action=edit',
                type: 'post',
                data: $('#save').serialize(),
                success: function() {
                    // Whatever you want to do after the form is successfully submitted
                    // alert("Đã lưu");
                }
            });

            var text = "<div class='alert alert-success'>" +
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>" +
                "<b>Lưu thành công</b>" +
                "</div>";
            $("#save").prepend(text);
            setTimeout(reload, 1000);
        });
        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });

    });
</script>