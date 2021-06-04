<?php
include 'connect.php';

if (isset($_POST["user_id"])) {
    $user_id = $_POST["user_id"];
}
$sql = "select count(order_id) from orders where user_id='$user_id'";
$result = $conn->query($sql);
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_row()) {
//     }
// }
$row = $result->fetch_row();

$number_of_orders = $row[0];

$sql = "select sum(total) from orders where user_id='$user_id'";
$result = $conn->query($sql);
$row = $result->fetch_row();
$total = $row[0];

$sql = "select * from orders where user_id='$user_id'";
$result = $conn->query($sql);

?>

<Label>Tổng đơn hàng đã mua: </Label> <?php echo $number_of_orders ?> đơn hàng
<br>
<Label>Tổng số tiền thanh toán: </Label> <?php echo $total ?> đ
<br>
<label>Danh sách đơn hàng:</label><br>
<table class="table table-bordered table-hover dataTable dtr-inline">
    <tr>
        <th>
            Ngày đặt
        </th>
        <th>
            Số lượng
        </th>
        <th>
            Tổng tiền
        </th>
        <th>
            Thanh toán
        </th>
        <th>
            Trạng thái
        </th>
        <th>
            Sản phẩm
        </th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            echo "<tr><td>";
            echo $row["order_date"];
            echo "</td><td>";
            echo $row["quantity"];
            echo "</td><td>";
            echo $row["total"];
            echo "</td><td>";
            if ($row["paid_status"] == 1) {
                echo "<span class='badge bg-success'>Đã thanh toán</span>";
            } else {
                echo "<span class='badge bg-warning'>Chưa thanh toán</span>";
            }
            echo "</td><td>";
            if ($row["status"] == 1) {
                echo "<span class='badge bg-success'>Đã xử lí</span>";
            } else {
                echo "<span class='badge bg-warning'>Chưa xử lí</span>";
            }
            echo "</td><td>";
            echo '<a class="btn btn-user-item" data-toggle="modal" data-target="#modal-user-item" id="' . $row['order_id'] . '">
                                                                <button type="button" class="btn btn-primary">Sản phẩm</button>
                                                              </a>';
            echo "</td></tr>";
        }
    }

    ?>
</table>

<script>
    $(".btn-user-item").click(function() {
        var id = $(this).attr("id");
        $.post("items.php", {
                order_id: id
            },
            function(data, status) {
                if (status == "success") {
                    $("#user_item_form").html(data);
                }
            });
    });
</script>