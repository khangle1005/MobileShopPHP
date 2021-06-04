<?php
include 'connect.php';
if (isset($_POST["order_id"])) {
    $order_id = $_POST["order_id"];
}
$sql = "SELECT * FROM order_items oi, products p WHERE oi.product_id=p.product_id and order_id=$order_id";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
?>
<label>Đơn hàng: </label> <input type="text" id="order_id" value="<?php echo $row['order_id'] ?>" size="1" style="border-style:none" readonly>
<div id="approval">
    <button type="button" class="btn btn-success" id="accept">Duyệt</button>
    <button type="button" class="btn btn-warning" id="decline">Hủy</button>
</div>
<br>
<table class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Tình trạng</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>";
                echo $row['product_title'];
                echo "</td><td>";
                echo $row['product_price'];
                echo "</td><td>";
                echo $row['quantity'];
                echo "</td><td>";
                echo $row['unit_price'];
                $id = $row['product_id'];
                $sql1 = "SELECT stock FROM products WHERE product_id=$id";
                $result1 = $conn->query($sql1);
                $row1 = $result1->fetch_row();
                if ($row1[0] > $row['quantity']) {
                    echo "</td><td>";
                    echo "<span class='badge bg-success'>Đủ hàng</span>";
                } else {
                    echo "</td><td>";
                    echo "<span class='badge bg-warning'>Không đủ hàng</span>";
                    echo "(Thiếu ";
                    echo $row['quantity'] - $row1[0];
                    echo " cái)";
                }
                echo "</td></tr>";
            }
        }
        ?>
    </tbody>
</table>

<script>
    function reload() {
        window.location.reload();
    }
    $(document).ready(function() {
        $("#accept").click(function() {
            var order_id = $("#order_id").val();
            $.ajax({
                url: 'order_actions.php?action=accept',
                type: 'post',
                data: {
                    order_id: order_id
                },
                success: function() {}
            });
            var text = "<div class='alert alert-success'>" +
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>" +
                "<b>Duyệt đơn hàng</b>" +
                "</div>";
            $("#approval").prepend(text);
            setTimeout(reload, 1000);

        });

        $("#decline").click(function() {
            var order_id = $("#order_id").val();
            $.ajax({
                url: 'order_actions.php?action=decline',
                type: 'post',
                data: {
                    order_id: order_id
                },
                success: function() {}
            });
            var text = "<div class='alert alert-warning'>" +
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>" +
                "<b>Hủy đơn hàng</b>" +
                "</div>";
            $("#approval").prepend(text);
            setTimeout(reload, 1000);
        });
    });
</script>