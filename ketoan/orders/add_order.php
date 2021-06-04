<?php
include 'connect.php';


?>


<form id="add_order_form" method="post">
    <label>Thêm sản phẩm:</label><br>
    Sản phẩm: <select name="product" id="product" class="form-control select2">
        <?php
        $sql = "select * from products";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_row()) {
                echo "<option value='$row[0]'  product_name='$row[3]' price='$row[4]'>";
                echo $row[0];
                echo " - ";
                echo $row[3];
                echo " - ";
                echo $row[4];
                echo " đ";
                echo "</option>";
            }
        }
        ?>
    </select>
    Số lượng: <input type="number" id="quantity" class="form-control" min="1" max="50" value="1">

    <br>
    <button type="button" class="btn btn-primary" id="add_item">Chọn</button>
    <br>
    <br>

    <table class="table table-bordered table-hover" id="items_table">
        <tr>
            <th>Id</th>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Xóa</th>
        </tr>
    </table>
    <label>Tổng: </label>
    <div class="total">

    </div>
    <div class="form-group">
        <label>Người đặt hàng</label>
        <select class="form-control select2" name="user_id" style="width: 100%;" id="select-items">

            <?php
            $sql = "select * from user_info";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_row()) {
                    echo "<option value='$row[0]'>";
                    echo $row[0];
                    echo " - ";
                    echo $row[1];
                    echo " ";
                    echo $row[2];
                    echo "</option>";
                }
            }
            ?>
        </select>

    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label>Điện thoại</label>
        <input type="text" class="form-control" name="phone">
    </div>
    <div class="form-group">
        <label>Địa chỉ</label>
        <input type="text" class="form-control" name="address">
    </div>

    <div class="form-group">
        <label for="">Ngày đặt</label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="order_date" />
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="">Ghi chú</label>
        <textarea class="form-control" name="note" value=""></textarea>
    </div>
    <div class=" form-group clearfix">
        <label>Thanh toán</label><br>
        <div class="icheck-danger d-inline">
            <input type="radio" name="paid_status" value="0" id="unpaid" checked>
            <label for="unpaid">
                Chưa thanh toán
            </label>
        </div>
        <div class="icheck-success d-inline">
            <input type="radio" name="paid_status" value="1" id="paid">
            <label for="paid">
                Đã thanh toán
            </label>
        </div>
    </div>
    <!-- <div class="form-group clearfix">
            <label>Giao hàng</label><br>
            <div class="icheck-danger d-inline">
                <input type="radio" name="status" value="0" id="undelivered" checked>
                <label for="undelivered">
                    Chưa giao hàng
                </label>
            </div>
            <div class="icheck-success d-inline">
                <input type="radio" name="status" value="1" id="delivered">
                <label for="delivered">
                    Đã giao hàng
                </label>
            </div>
            <br>
            <br>

        </div> -->



    <button type="submit" href="order.php?page=1" class="btn btn-primary" id="add_order">Thêm đơn hàng</button>
</form>
<script>
    $(document).ready(function() {
        $('#add').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'product_actions.php?action=add',
                type: 'post',
                data: $("#add").serialize(),
                success: function() {
                    // Whatever you want to do after the form is successfully submitted
                }
            });
            alert("Đã thêm");
            window.location.reload();
        });
        //Initialize Select2 Elements
        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        // $("#select-items").on('change', function() {
        //     alert(this.value);
        // });

        // $("#add_items").click(function() {
        //     $.post("add_items.php", {},
        //         function(data, status) {
        //             if (status == "success") {
        //                 $("#add_items_form").html(data);
        //             }
        //         });
        // });

        var S = 0;
        $("#add_item").click(function() {
            // var option = $('option:selected', this).attr('mytag');
            var pro = $('option:selected', '#product').attr('product_name');
            var price = $('option:selected', '#product').attr('price');
            var id = $("#product").val();
            var quan = $("#quantity").val();
            $("#items_table").append("<tr><td><input style='border-style: none' type='text' name='product_id[]' value='" + id + "'  size='1' readonly/>" + "</td><td>" + pro + "</td><td><input style='border-style: none' type='text' name='quantity[]' value='" + quan + "'  size='1' readonly/>" + "</td><td class='total1'>" + price * quan + "</td><td>" + "<button type='button' class='btn btn-danger alo'>Xóa</button></td></tr>");
            S += price * quan;

            var text = "<h3>" + S + " đ</h3>";
            $(".total").html(text);
        });

        $("#items_table").on('click', '.alo', function() {

            var pr = $(this).parent().parent().find(".total1").text();
            S -= pr;
            $(this).parent().parent().remove();
            var text = "<h3>" + S + " đ</h3>";
            $(".total").html(text);
        });

        $('#add_order_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'order_actions.php?action=add',
                type: 'post',
                data: $('#add_order_form').serialize(),
                success: function() {}
            });

            var text = "<div class='alert alert-success'>" +
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>" +
                "<b>Đã thêm đơn hàng</b>" +
                "</div>";
            $("#add_order_form").prepend(text);
            setTimeout(reload, 1000);
        });
    });
</script>