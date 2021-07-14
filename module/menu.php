	<!-- navigation -->
	<?php
		$sql_catagory = mysqli_query($con,'Select * from tb_catagory order by catagory_id DESC');

		
	?>
	<!-- Lay tat ca trong CSDL bang catagory-->
<div class="navbar-inner">
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="agileits-navi_search">
					<form action="#" method="post">
						<select id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
							<option value="">Danh mục sản phẩm</option>
							<?php
							while($row_catagory = mysqli_fetch_array($sql_catagory)){
							?>
							<option value="<?php echo $row_catagory['catagory_id'] ?>"><?php echo $row_catagory['catagory_name'] ?></option>
							<?php
							}
							?>
						</select>
					</form>
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				    aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto text-center mr-xl-5">
						<li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="index.php">Trang chủ
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<?php
								$sql_catagory_danhmuc = mysqli_query($con,'Select * from tb_catagory order by catagory_id DESC');
								while($row_catagory_danhmuc= mysqli_fetch_array($sql_catagory_danhmuc)){
									$id_catagory = $row_catagory_danhmuc['catagory_id'];
														
						?><!-- Lay tat ca trong CSDL bang catagory-->
						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php echo $row_catagory_danhmuc['catagory_name'] ?>
							</a>
							<div class="dropdown-menu">
								<div class="agile_inner_drop_nav_info p-4">
									<h5 class="mb-3"><?php echo $row_catagory_danhmuc['catagory_name'] ?></h5>
									<div class="row">
									<?php
											$id_loaisp=
											$sql_catagory_danhmucsanpham = mysqli_query($con,'Select * from tb_loaisanpham
											 order by loaisp_id DESC');
											while($row_catagory_danhmucsanpham= mysqli_fetch_array($sql_catagory_danhmucsanpham)){
												if($row_catagory_danhmucsanpham['catagory_id']== $id_catagory){
												
														
									?><!-- Lay tat ca trong CSDL bang catagory-->
										<div class="col-sm-12 multi-gd-img">
											<ul class="multi-column-dropdown">
										
												<li class="nav-item mr-lg-2 mb-lg-0 mb-2">
													<a class="nav-link" href="?quanly=danhmuc&id=<?php echo $row_catagory_danhmucsanpham['loaisp_id'] ?>" role="button" aria-haspopup="true" aria-expanded="false">
														<?php echo $row_catagory_danhmucsanpham['tenloai_sp'] ?>
													</a>
	
												</li>
										
											</ul>
										</div>
										<?php
											}
											?>
											<?php
											}
											?>
								</div>
							</div>
						</li>
						<?php
							}
						?>
						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<?php
							$sql_danhmuc_tin=mysqli_query($con,"select * from tb_tintuc order by tin_id desc");
							?>
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Tin tức
							</a>
							<div class="dropdown-menu">
								<?php
									while($row_danhmuc_tin=mysqli_fetch_array($sql_danhmuc_tin)){
								?>
								<a class="dropdown-item" href="?quanly=tintuc&id_tin=<?php echo $row_danhmuc_tin['tin_id'] ?>">
								<?php echo $row_danhmuc_tin['tendanhmuc'] ?></a>
								<?php
									}
								?>
							</div>
						</li>
						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Trang 
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="product.html">Sản Phẩm mới</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="checkout.html">Kiểm Tra Hàng</a>
								<a class="dropdown-item" href="payment.php">Thanh Toán</a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact.html">Liên Hệ</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<!-- //navigation -->