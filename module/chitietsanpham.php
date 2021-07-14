	<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }else{
        $id='';
    }
     $sql_chitietsanpham = mysqli_query($con,"select * from tb_sp where sanpham_id = '$id'");
    ?>
    <!-- page -->

	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Trang Chủ</a>
						<i>|</i>
					</li>
					<li>Single Product 1</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
    

    <!-- Single Page -->
	<div class="banner-bootom-w3-agileits py-5">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>M</span>ô
				<span>T</span>ả</h3>
			<!-- //tittle heading -->
            <?php
                while($row_chitietsp = mysqli_fetch_array($sql_chitietsanpham)){
            ?>
			<div class="row">
				<div class="col-lg-5 col-md-8 single-right-left ">
					<div class="grid images_3_of_2">
						<div class="flexslider">
							<ul class="slides">
							<li data-thumb="images/<?php echo $row_chitietsp['sanpham_img'] ?>">
									<div class="thumb-image">
										<img src="images/<?php echo $row_chitietsp['sanpham_img'] ?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
								</li>
								<li data-thumb="images/<?php echo $row_chitietsp['sanpham_img1'] ?>">
									<div class="thumb-image">
										<img src="images/<?php echo $row_chitietsp['sanpham_img1'] ?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
								</li>
								<li data-thumb="images/<?php echo $row_chitietsp['sanpham_img2'] ?>">
									<div class="thumb-image">
										<img src="images/<?php echo $row_chitietsp['sanpham_img2'] ?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
								</li>
							
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="col-lg-7 single-right-left simpleCart_shelfItem">
					<h3 class="mb-3"><?php echo $row_chitietsp['sanpham_name'] ?></h3>
					<p class="mb-3">
						<span class="item_price"><?php echo $row_chitietsp['sanpham_giakm'] ?></span>
						<del class="mx-2 font-weight-light"><?php echo $row_chitietsp['sanpham_gia'] ?></del>
						<label>Free delivery</label>
					</p>
					<div class="single-infoagile">
						<ul>
							<li class="mb-3">
                            <?php echo $row_chitietsp['sanpham_motachitiet'] ?>
							</li>
						</ul>
					</div>
					<div class="product-single-w3l">
						<p class="my-3">
							<i class="far fa-hand-point-right mr-2"></i>
							<label>1 Year</label>Manufacturer Warranty</p>
						<ul>
							<li class="mb-1">
                            <?php echo $row_chitietsp['sanpham_motangan'] ?>
							</li>
				
						</ul>
						<p class="my-sm-4 my-3">
							<i class="fas fa-retweet mr-3"></i>Net banking & Credit/ Debit/ ATM card
						</p>
					</div>
					<div class="occasion-cart">
						<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
							<form action="?quanly=giohang" method="post">
								<fieldset>
									<input type="hidden" name="tensanpham" value="<?php echo $row_chitietsp['sanpham_name'] ?>" />
                                    <input type="hidden" name="sanpham_id" value="<?php echo $row_chitietsp['sanpham_id'] ?>" />
                                    <input type="hidden" name="gia" value="<?php echo $row_chitietsp['sanpham_giakm'] ?>" />
                                    <input type="hidden" name="img" value="<?php echo $row_chitietsp['sanpham_img'] ?>" />
                                    <input type="hidden" name="soluong" value="1" />								
									<input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="button" />
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
            <?php
                }
                ?>
		</div>
	</div>
	<!-- //Single Page -->
   