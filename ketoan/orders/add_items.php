<?php
include 'connect.php';

?>
<form>
    <div class="form-group">
        Sản phẩm: <select name="product_id" id="" class="form-control select2">
            <?php
            $sql = "select * from products";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_row()) {
                    echo "<option value='$row[0]'>";
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
    </div>
    <div class="form-group">
        Số lượng: <input type="number" name="quantity" class="form-control" name="stock" min="1" max="50" value="1">
    </div>
    <button type="submit" class="btn btn-primary" id="addorder" edit_id="<?php echo $row[0] ?>">Thêm</button>
</form>
<script>
    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    });

    $("#addorder").click(function() {
        var order_id = $("#order_id").val();
        $.ajax({
            url: 'order_actions.php?action=decline',
            type: 'post',
            data: {
                order_id: order_id
            },
            success: function() {}
        });
    });
</script>