<?php

include "header.php";

?>
<!-- /BREADCRUMB -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event) {
			// event.preventDefault();
			$('html,body').animate({
				scrollTop: $(this.hash).offset().top
			}, 900);
		});
	});
</script>
<script>
	(function(global) {
		if (typeof(global) === "undefined") {
			throw new Error("window is undefined");
		}
		var _hash = "!";
		var noBackPlease = function() {
			global.location.href += "#";
			// making sure we have the fruit available for juice....
			// 50 milliseconds for just once do not cost much (^__^)
			global.setTimeout(function() {
				global.location.href += "!";
			}, 50);
		};
		// Earlier we had setInerval here....
		global.onhashchange = function() {
			if (global.location.hash !== _hash) {
				global.location.hash = _hash;
			}
		};
		global.onload = function() {
			noBackPlease();
			// disables backspace on page except on input fields and textarea..
			document.body.onkeydown = function(e) {
				var elm = e.target.nodeName.toLowerCase();
				if (e.which === 8 && (elm !== 'input' && elm !== 'textarea')) {
					// e.preventDefault();
				}
				// stopping event bubbling up the DOM tree..
				e.stopPropagation();
			};
		};
	})(window);
</script>

<!-- SECTION -->
<div class="section main main-raised">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row" id="product-detail">
			<!-- Product main img -->

			<?php
			include 'db.php';
			$product_id = $_GET['p'];

			$sql = " SELECT * FROM products ";
			$sql = " SELECT * FROM products WHERE product_id = $product_id";
			if (!$con) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo '
									
                                    
                                
                                <div class="col-md-5 col-md-push-2">
                                <div id="product-main-img">
                                    <div class="product-preview">
                                        <img src="product_images/' . $row['product_image'] . '" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="product_images/' . $row['product_image'] . '" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="product_images/' . $row['product_image'] . '" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="product_images/' . $row['product_image'] . '" alt="">
                                    </div>
                                </div>
                            </div>
                                
                                <div class="col-md-2  col-md-pull-5">
                                <div id="product-imgs">
                                    <div class="product-preview">
                                        <img src="product_images/' . $row['product_image'] . '" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="product_images/' . $row['product_image'] . '" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="product_images/' . $row['product_image'] . 'g" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="product_images/' . $row['product_image'] . '" alt="">
                                    </div>
                                </div>
                            </div>

                                 
									';

			?>
					<!-- FlexSlider -->

			<?php
					echo '
									
                                    
                                   
                    <div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name">' . $row['product_title'] . '</h2>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="#review-form">10 Đánh giá | Viết đánh giá</a>
							</div>
							<div>
								<h3 class="product-price">' . $row['product_price'] . ' đ<del class="product-old-price">999.000 đ</del></h3>
								<span class="product-available">Còn hàng</span>
							</div>';
					include 'connect.php';
					$sql1 = "select product_desc from products where product_id='$product_id'";
					$result1 = $conn->query($sql1);
					$row1 = $result1->fetch_row();
					$desc = $row1[0];
					echo "<p>$desc</p>";
					echo '
							
							<div class="product-options">
							</div>

							<div class="add-to-cart">
								<form action="" method="post" id="add-to-cart-form">
								<label>Số lượng:</label><br>
									<input type="number" value="1" name="quantity[' . $row['product_id'] . ']"  min="1" max="99"/>
									<button type="submit" class="add-to-cart-btn" pid="' . $row['product_id'] . '"  id="product" ><i class="fa fa-shopping-cart"></i>Chọn mua</button>
								</form>
								
								
							</div>

							<ul class="product-btns">
								<li><a href="#"><i class="fa fa-heart-o"></i> Yêu thích</a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> So sánh</a></li>
							</ul>

							<ul class="product-links">
								<li>Danh mục:</li>
								<!-- <li><a href="#">Headphones</a></li> -->
								<!-- <li><a href="#">Accessories</a></li> -->
							</ul>

							<ul class="product-links">
								<li>Chia sẻ:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
									
					
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					
					
					
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Mô tả</a></li>
								<li><a data-toggle="tab" href="#tab2">Chi tiết</a></li>
								<li><a data-toggle="tab" href="#tab3">Đánh giá ';
					include 'connect.php';
					$sql1 = "select count(review_id) from reviews where product_id='$product_id'";
					$result1 = $conn->query($sql1);
					$row1 = $result1->fetch_row();
					echo "($row1[0])";
					echo '</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p>' . $desc . '</p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p>' . $desc . '</p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>4.5</span>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 80%;"></div>
														</div>
														<span class="sum">3</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 60%;"></div>
														</div>
														<span class="sum">2</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">';
					include 'connect.php';
					$sql1 = "SELECT * from reviews r, user_info u, products p WHERE r.user_id=u.user_id AND r.product_id=p.product_id AND p.product_id='$product_id'";
					$result1 = $conn->query($sql1);
					if ($result1->num_rows > 0) {
						while ($row1 = $result1->fetch_assoc()) {
							// $name = $row['last_name'];
							// $comment = $row['comment'];
							echo '
																					<li>
																						<div class="review-heading">
																							<h5 class="name">' . $row1['last_name'] . '</h5>
																							<p class="date">27 DEC 2020, 8:0 PM</p>
																							<div class="review-rating">
																								<i class="fa fa-star"></i>
																								<i class="fa fa-star"></i>
																								<i class="fa fa-star"></i>
																								<i class="fa fa-star"></i>
																								<i class="fa fa-star-o empty"></i>
																							</div>
																						</div>
																						<div class="review-body">
																							' . $row1['comment'] . '
																						</div>
																					</li>
																					';
						}
					}

					echo '
													
												</ul>
												<ul class="reviews-pagination">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
												</ul>
											</div>
										</div>
										<!-- /Reviews -->
					';
					$uid = $_SESSION['uid'];
					$sql1 = "select last_name from user_info where user_id='$uid'";
					$result1 = $conn->query($sql1);
					$row1 = $result1->fetch_row();
					echo '
										<!-- Review Form -->
										
										<div class="col-md-3 mainn">
											<div id="review-form">
												<form class="review-form" id="rv-form" method="post">
													<!-- <input class="input" type="text" placeholder="Your Name"> -->
													<!-- <input class="input" type="email" placeholder="Your Email"> -->
													<h4	>Bình luận với tên: ' . $row1[0] . '</h4> 
													<input class="input" type="text" name="user_id" value="' . $_SESSION['uid'] . '" readonly>
													<input class="input" type="text" name="product_id" value="' . $product_id . '" readonly>
													<textarea class="input" name="review" placeholder="Để lại bình luận..."></textarea>
													<div class="input-rating">
														<span>Đánh giá: </span>
														<div class="stars">
															<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
														</div>
													</div>
													<button type="submit" class="primary-btn">Gửi</button>
												</form>
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section main main-raised">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    
					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Sản phẩm liên quan</h3>
							
						</div>
					</div>
                    ';
					$_SESSION['product_id'] = $row['product_id'];
				}
			}
			?>
			<?php
			include 'db.php';
			$product_id = $_GET['p'];

			$product_query = "SELECT * FROM products,categories WHERE product_cat=cat_id AND product_id BETWEEN $product_id AND $product_id+3";
			$run_query = mysqli_query($con, $product_query);
			if (mysqli_num_rows($run_query) > 0) {

				while ($row = mysqli_fetch_array($run_query)) {
					$pro_id    = $row['product_id'];
					$pro_cat   = $row['product_cat'];
					$pro_brand = $row['product_brand'];
					$pro_title = $row['product_title'];
					$pro_price = $row['product_price'];
					$pro_image = $row['product_image'];

					$cat_name = $row["cat_title"];

					echo "
				
                        
                                <div class='col-md-3 col-xs-6'>
								<a href='product.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img src='product_images/$pro_image' style='max-height: 170px;' alt=''>
										<div class='product-label'>
											<span class='sale'>-30%</span>
											<span class='new'>MỚI</span>
										</div>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>$pro_price<del class='product-old-price'>$990.00</del></h4>
										<div class='product-rating'>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
										</div>
										<div class='product-btns'>
											<button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>yêu thích</span></button>
											<button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>so sánh</span></button>
											<button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>xem</span></button>
										</div>
									</div>
								</div>
                                </div>
							
                        
			";
				};
			}
			?>
			<!-- product -->

			<!-- /product -->

		</div>
		<!-- /row -->

	</div>
	<!-- /container -->
</div>
<!-- /Section -->

<!-- NEWSLETTER -->

<!-- /NEWSLETTER -->

<!-- FOOTER -->
<?php
include "newslettter.php";
include "footer.php";

?>

<style>
	input {
		border: 1px solid #E4E7ED;
		height: 40px;
		padding: 0px 15px;
	}
</style>