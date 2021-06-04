<?php

if (isset($_POST["email"]) && isset($_POST["password"])) {
    if ($_POST["password"] != "admin") {
        exit;
    }
}
include 'nav.php';
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            include 'connect.php';
                            $sql = "select count(order_id) from orders where status=0";
                            $result = $conn->query($sql);
                            $row = $result->fetch_row();
                            echo  "
                                <h3>$row[0]</h3>
                            ";
                            ?>
                            <!-- <h3>150</h3> -->

                            <p>Đơn hàng mới</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="./orders/order.php?page=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            include 'connect.php';
                            $sql = "select count(product_id) from products p, categories c, brands b where p.product_cat=c.cat_id and p.product_brand=b.brand_id";
                            $result = $conn->query($sql);
                            $row = $result->fetch_row();
                            echo  "
                                <h3>$row[0]</h3>
                            ";
                            ?>
                            <p>Sản phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="./products/product.php?page=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            include 'connect.php';
                            $sql = "select count(product_id) from products p, categories c, brands b where p.product_cat=c.cat_id and p.product_brand=b.brand_id and stock <= 5";
                            $result = $conn->query($sql);
                            $row = $result->fetch_row();
                            echo  "
                                <h3>$row[0]</h3>
                            ";
                            ?>

                            <p>Sắp hết hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="./products/product.php?page=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php
                            include 'connect.php';
                            $sql = "select count(product_id) from products p, categories c, brands b where p.product_cat=c.cat_id and p.product_brand=b.brand_id and stock<=0";
                            $result = $conn->query($sql);
                            $row = $result->fetch_row();
                            echo  "
                                <h3>$row[0]</h3>
                            ";
                            ?>

                            <p>Hết hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="./products/product.php?page=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Thống kê báo cáo</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-wrench"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a href="#" class="dropdown-item">Action</a>
                                        <a href="#" class="dropdown-item">Another action</a>
                                        <a href="#" class="dropdown-item">Something else here</a>
                                        <a class="dropdown-divider"></a>
                                        <a href="#" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <p class="text-center">
                                        <strong>Mục tiêu trong tháng</strong>
                                    </p>

                                    <div class="progress-group">
                                        Tổng số đơn hàng ghi nhận
                                        <span class="float-right"><b>
                                                <?php
                                                include 'connect.php';
                                                $sql = "select count(order_id) from orders";
                                                $result = $conn->query($sql);
                                                $row = $result->fetch_row();
                                                echo  "
                                                    $row[0]
                                                    ";
                                                $percent = $row[0] * 100 / 200;
                                                ?>
                                            </b>/200</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-primary" style="width: <?php echo $percent; ?>%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->

                                    <div class="progress-group">
                                        Đơn hàng đã hoàn thành
                                        <span class="float-right"><b>
                                                <?php
                                                include 'connect.php';
                                                $sql = "select count(order_id) from orders where status=1";
                                                $result = $conn->query($sql);
                                                $row = $result->fetch_row();
                                                echo  "
                                                    $row[0]
                                                    ";
                                                $percent = $row[0] * 100 / 200;
                                                ?>
                                            </b>/200</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-danger" style="width: <?php echo $percent; ?>%"></div>
                                        </div>
                                    </div>

                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">Tổng số sản phẩm bán ra</span>
                                        <span class="float-right"><b>
                                                <?php
                                                include 'connect.php';
                                                $sql = "select sum(quantity) from order_items";
                                                $result = $conn->query($sql);
                                                $row = $result->fetch_row();
                                                echo  "
                                                    $row[0]
                                                    ";
                                                $percent = $row[0] * 100 / 500;
                                                ?>
                                            </b>/500</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" style="width: <?php echo $percent; ?>%"></div>
                                        </div>
                                    </div>

                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        Số lượng feedback sản phẩm
                                        <span class="float-right"><b>
                                                <?php
                                                include 'connect.php';
                                                $sql = "select count(review_id) from reviews";
                                                $result = $conn->query($sql);
                                                $row = $result->fetch_row();
                                                echo  "
                                                    $row[0]
                                                    ";
                                                $percent = $row[0] * 100 / 500;
                                                ?>
                                            </b>/500</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-warning" style="width: <?php echo $percent; ?>%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <p class="text-center">
                                        <strong>Top 3 khách hàng mua nhiều nhất</strong>
                                    </p>
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <th>TOP</th>
                                            <th>Người dùng</th>
                                            <th>Số đơn hàng</th>
                                        </tr>
                                        <?php
                                        include 'connect.php';
                                        $sql = "SELECT ui.email, COUNT(o.order_id) as sl FROM user_info ui, orders o WHERE ui.user_id = o.user_id GROUP BY o.user_id ORDER BY COUNT(o.order_id) DESC LIMIT 3";
                                        $result = $conn->query($sql);
                                        $i = 1;
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_row()) {
                                                echo "<tr><td>";
                                                echo $i . " <i class='fas fa-crown'></i>";
                                                $i += 1;
                                                echo "</td><td>";
                                                echo $row[0];
                                                echo "</td><td>";
                                                echo $row[1];
                                                echo "</td></tr>";
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                                        <h5 class="description-header">
                                            <?php
                                            include 'connect.php';
                                            $sql = "select sum(total) from orders";
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_row();
                                            echo  "
                                                    $row[0] đ
                                                    ";
                                            ?>
                                        </h5>
                                        <span class="description-text">Tổng doanh thu</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                                        <h5 class="description-header">
                                            <?php
                                            include 'connect.php';
                                            $sql = "select count(user_id) from user_info";
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_row();
                                            echo  "
                                                    $row[0]
                                                    ";
                                            ?>
                                        </h5>
                                        <span class="description-text">Số lượng người dùng</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>

                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                                        <h5 class="description-header">
                                            <?php
                                            include 'connect.php';
                                            $sql = "select count(product_id) from products";
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_row();
                                            echo  "
                                                    $row[0]
                                                    ";
                                            ?>
                                        </h5>
                                        <span class="description-text">Tổng số sản phẩm</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>

                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                                        <h5 class="description-header">
                                            <?php
                                            include 'connect.php';
                                            $sql = "select count(brand_id) from brands";
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_row();
                                            echo  "
                                                    $row[0]
                                                    ";
                                            ?>
                                        </h5>
                                        <span class="description-text">Thương hiệu</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>