	<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>S</span>ản
				<span>P</span>hẩm
				<span>M</span>ới</h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						<?php
							$sql_cate_home = mysqli_query($con, "select * from tb_loaisanpham where loaisp_active=1 order by loaisp_id desc");
							while($row_cate_home = mysqli_fetch_array($sql_cate_home)){
								$id_catagory = $row_cate_home['loaisp_id'];
						?>
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h3 class="heading-tittle text-center font-italic"><span style="color:#0879c9;"><?php echo $row_cate_home['tenloai_sp'] ?></span></h3>
							<div class="row">
								<?php
								$sql_procduct = mysqli_query($con,"select * from tb_sp order by sanpham_id desc");
								while($row_sanpham = mysqli_fetch_array($sql_procduct)){
									if($row_sanpham['loaisp_id']== $id_catagory){
								?>
								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="images/<?php echo $row_sanpham['sanpham_img'] ?>" alt="" >
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="?quanly=chitietsanpham&id=<?php echo $row_sanpham['sanpham_id']?>" class="link-product-add-cart">
                                                    Xem Sản Phẩm</a>
												</div>
											</div>
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="?quanly=chitietsanpham&id=<?php echo $row_sanpham['sanpham_id'] ?>"><?php echo $row_sanpham['sanpham_name']?></a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price"><?php echo $row_sanpham['sanpham_giakm'] ?></span>
												<del><?php  echo $row_sanpham['sanpham_gia'] ?></del>
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
											<form action="?quanly=giohang" method="post">
												<fieldset>
													<input type="hidden" name="tensanpham" value="<?php echo $row_sanpham['sanpham_name'] ?>" />
													<input type="hidden" name="sanpham_id" value="<?php echo $row_sanpham['sanpham_id'] ?>" />
													<input type="hidden" name="gia" value="<?php echo $row_sanpham['sanpham_giakm'] ?>" />
													<input type="hidden" name="img" value="<?php echo $row_sanpham['sanpham_img'] ?>" />
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
								}
								?>
							</div>
						</div>
						<!-- //first section -->
							<?php 
							}
							?>
					</div>
				</div>
				<!-- //product left -->

				<!-- product right -->
				<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
					<div class="side-bar p-sm-4 p-3">
						<div class="search-hotel border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Tìm Kiếm</h3>
							<form action="#" method="post">
								<input type="search" placeholder="sản phẩm..." name="search" required="">
								<input type="submit" value=" ">
							</form>
						</div>
						<!-- price -->
						<div class="range border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Giá</h3>
							<div class="w3l-range">
								<ul>
									<li>
										<a href="#">Under $1,000</a>
									</li>
									<li class="my-1">
										<a href="#">$1,000 - $5,000</a>
									</li>
									<li>
										<a href="#">$5,000 - $10,000</a>
									</li>
									<li class="my-1">
										<a href="#">$10,000 - $20,000</a>
									</li>
									<li>
										<a href="#">$20,000 $30,000</a>
									</li>
									<li class="mt-1">
										<a href="#">Over $30,000</a>
									</li>
								</ul>
							</div>
						</div>
						<!-- //price -->
						<!-- discounts -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Discount</h3>
							<ul>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">5% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">10% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">20% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">30% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">50% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">60% or More</span>
								</li>
							</ul>
						</div>
						<!-- //discounts -->
						<!-- reviews -->
						<div class="customer-rev border-bottom left-side py-2">
							<h3 class="agileits-sear-head mb-3">Khách hàng đánh giá</h3>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>5.0</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>4.0</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half"></i>
										<span>3.5</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>3.0</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half"></i>
										<span>2.5</span>
									</a>
								</li>
							</ul>
						</div>
						<!-- //reviews -->
						<!-- electronics -->
						<div class="left-side border-bottom py-2">

							<h3 class="agileits-sear-head mb-3">Danh mục sản phẩm</h3>
							<ul>
								<?php
								$sql_catagory_sidebar = mysqli_query($con,"Select * from tb_catagory order by catagory_id DESC");
								while($row_catagory_sidebar= mysqli_fetch_array($sql_catagory_sidebar)){

								
							?>
								<li>
									<input type="checkbox" class="checked">
									<span class="span"><?php echo $row_catagory_sidebar['catagory_name'] ?></span>
								</li>
								<?php
								}
								?>
							</ul>
						</div>
						<!-- //electronics -->
						<!-- best seller -->
						<div class="f-grid py-2">
							<h3 class="agileits-sear-head mb-3">Sản Phẩm Bán Chạy</h3>
							<div class="box-scroll">
								<div class="scroll">
								<?php
									$sql_procduct_sidebar = mysqli_query($con,"select * from tb_sp where sanphamn_hot = '0' order by sanpham_id desc");
									while($row_sanpham_sidebar= mysqli_fetch_array($sql_procduct_sidebar)){							
								?>
									<div class="row">
										<div class="col-lg-3 col-sm-2 col-3 left-mar mt-2">
											<img src="images/<?php echo $row_sanpham_sidebar['sanpham_img'] ?>" alt="" class="img-fluid">
										</div>
										<div class="col-lg-9 col-sm-10 col-9 w3_mvd">
											<a href=""><?php echo $row_sanpham_sidebar['sanpham_name'] ?></a>
											<a href="" class="price-mar mt-2"><?php echo $row_sanpham_sidebar['sanpham_giakm'] ?>
												</a>
										</div>
									</div>
								<?php
								}
								?>
								</div>
							</div>
						</div>
						<!-- //best seller -->
					</div>
					<!-- //product right -->
				</div>
			</div>
		</div>
	</div>
	<!-- //top products -->