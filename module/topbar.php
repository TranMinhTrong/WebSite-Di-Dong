	<?php
	 if(isset($_POST['dangnhap_home'])){
        $taikhoan=$_POST['email_login'];
        $matkhau=md5($_POST['password_login']);
        if($taikhoan=='' || $matkhau==''){
            echo '<script> alert("Mời bạn hãy nhập đủ thông tin!")</script>';
        }else{
                $sql_select_admin = mysqli_query($con,"select * from tb_khachhanng where email='$taikhoan' and password='$matkhau' limit 1");
                $count= mysqli_num_rows($sql_select_admin);
                $row_dangnhap_home=mysqli_fetch_array($sql_select_admin);
                if($count>0){
                    $_SESSION['dangnhap_home']=$row_dangnhap_home['name'];
                    $_SESSION['khachhang_id']=$row_dangnhap_home['khachhang_id'];

					header('Location: index.php?quanly=giohang');
                }else{
                    echo  '<script> alert("Tài Khoản mật khẩu Không chính xác")</script>';
                }
            }
        }elseif(isset($_POST['dangky'])){
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$address = $_POST['address'];			
			$note = $_POST['note'];			
			$giaohang = $_POST['giaohang'];
			$sql_khachhang= mysqli_query($con,"insert into tb_khachhanng(name,phone,address,email,note,giaohang,password) values('$name','$phone',
			'$email','$address','$note','$giaohang','$password')");
			$sql_select_khachhang=mysqli_query($con,'select * from tb_khachhanng order by khachhang_id desc limit 1');
			$row_khachhang=mysqli_fetch_array($sql_select_khachhang);
			$_SESSION['dangnhap_home']=$name;
            $_SESSION['khachhang_id']=$row_khachhang['khachhang_id'];
		
			header('Location:index.php?quanly=giohang');
		}
	?>
	<!-- top-header -->
	<div class="agile-main-top">
		<div class="container-fluid">
			<div class="row main-top-w3l py-2">
				<div class="col-lg-4 header-most-top">
					<p class="text-white text-lg-left text-center">Offer Zone Top Deals & Discounts
						<i class="fas fa-shopping-cart ml-1"></i>
					</p>
				</div>
				<div class="col-lg-8 header-right mt-lg-0 mt-2">
					<!-- header lists -->
					<ul>
				
						<li class="text-center border-right text-white">
							<a class="play-icon popup-with-zoom-anim text-white" href="#small-dialog1">
								<i class="fas fa-map-marker mr-2"></i>Khu vực</a>
						</li>
						<?php
							if(isset($_SESSION['dangnhap_home'])){
						?>
						<li class="text-center border-right text-white">
							<a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id']?>"  class="text-white">
								<i class="fas fa-truck mr-2"></i>Xem đơn hàng: <?php echo $_SESSION['dangnhap_home'] ?></a>
						</li>
						<?php
							}
							?>
						<li class="text-center border-right text-white">
							<i class="fas fa-phone mr-2"></i> 078 777 9216
						</li>
						<li class="text-center border-right text-white">
							<a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> Đăng Nhập </a>
						</li>
						<li class="text-center text-white">
							<a href="#" data-toggle="modal" data-target="#exampleModal2" class="text-white">
								<i class="fas fa-sign-out-alt mr-2"></i>Đăng Ký </a>
						</li>
					</ul>
					<!-- //header lists -->
				</div>
			</div>
		</div>
	</div>
	<!-- Button trigger modal(select-location) -->
	<div id="small-dialog1" class="mfp-hide">
		<div class="select-city">
			<h3>
				<i class="fas fa-map-marker"></i>Mời bạn chọn khu vực</h3>
				<?php
                    $sql_select=mysqli_query($con,"select * from tb_thanhpho order by thanhpho_id desc");
                ?>
			<select class="list_of_cities">
			<?php
                $i=0;
                while($row_catagory=mysqli_fetch_array($sql_select)){
                 $i++;
                        
            ?>
				<optgroup label="">
					<option selected style="display:none;color:#eee;">Chọn Tỉnh Thành </option>
					<option><?php echo $row_catagory['thanhpho'] ?></option>
				</optgroup>
				<?php
				}
				?>
				
			</select>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- //shop locator (popup) -->
    	<!-- modals -->
	<!-- log in -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Đăng Nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="text" class="form-control" placeholder=" " name="email_login" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="password_login" required="">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Đăng nhập" name="dangnhap_home">
						</div>
						<div class="sub-w3l">
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
								<label class="custom-control-label" for="customControlAutosizing">nhớ tài khoản?</label>
							</div>
						</div>
						<p class="text-center dont-do mt-3">chưa có tài khoản
							<a href="#" data-toggle="modal" data-target="#exampleModal2">
								Đăng Ký</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
    <!-- register -->
	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Đăng Ký</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="col-form-label">Tên khách hàng</label>
							<input type="text" class="form-control" placeholder=" " name="name" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="email" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Phone</label>
							<input type="text" class="form-control" placeholder=" " name="phone" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Địa chỉ</label>
							<input type="text" class="form-control" placeholder=" " name="address" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="password" required="">
							<input type="hidden" class="form-control" placeholder=" " name="giaohang" value="2">
						</div>
						<div class="form-group">
							<label class="col-form-label">Ghi chú</label>
							<textarea class="form-control" name="note" id=""></textarea>
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Đăng Ký" name="dangky">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->
	<!-- //top-header -->

	<!-- header-bottom-->
	<div class="header-bot">
		<div class="container">
			<div class="row header-bot_inner_wthreeinfo_header_mid">
				<!-- logo -->
				<div class="col-md-3 logo_agile">
					<h1 class="text-center">
						<a href="index.php" class="font-weight-bold font-italic">
							<img src="images/logo2.png" alt=" " class="img-fluid">Electronic store
						</a>
					</h1>
				</div>
				<!-- //logo -->
				<!-- header-bot -->
				<div class="col-md-9 header mt-4 mb-md-0 mb-4">
					<div class="row">
						<!-- search -->
						<div class="col-10 agileits_search">
							<form class="form-inline" action="index.php?quanly=timkiem" method="post">
								<input class="form-control mr-sm-2" type="search" name="search_product" placeholder="tìm kiếm sản phẩm" aria-label="Search" required>
								<button class="btn my-2 my-sm-0" name="search_button" type="submit">Tìm kiếm</button>
							</form>
						</div>
						<!-- //search -->
						<!-- cart details -->
						<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
							<div class="wthreecartaits wthreecartaits2 cart cart box_1">
								<form action="#" method="post" class="last">
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="display" value="1">
									<button class="btn w3view-cart" type="submit" name="submit" value="">
										<i class="fas fa-cart-arrow-down"></i>
									</button>
								</form>
							</div>
						</div>
						<!-- //cart details -->
					</div>
				</div>
			</div>
		</div>
	</div>
	