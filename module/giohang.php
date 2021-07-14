<?php
    if(isset($_POST['themgiohang'])){
        $tensanpham = $_POST['tensanpham'];
        $sanpham_id = $_POST['sanpham_id'];
        $gia = $_POST['gia'];
        $img = $_POST['img'];
        $soluong = $_POST['soluong'];
		$sql_select_giohang=mysqli_query($con,"select * from tb_giohang where sanpham_id='$sanpham_id'");
		$count = mysqli_num_rows($sql_select_giohang);
		if($count>0){
			$row_sanpham= mysqli_fetch_array($sql_select_giohang);
			$soluong=$row_sanpham['soluong'] + 1;
			$sql_giohang= "update tb_giohang set soluong='$soluong' where sanpham_id='$sanpham_id'";
		}else{
			$soluong = $soluong;
			$sql_giohang= "insert into tb_giohang(tensanpham,sanpham_id,gia,img,soluong) values('$tensanpham','$sanpham_id',
			'$gia','$img','$soluong')";
		}
		$insert_row=mysqli_query($con,$sql_giohang);
        if($insert_row==0){
            header('Location:index.php?quanly=chitietsanpham&id='.$sanpham_id);
        }
    } elseif (isset($_POST['capnhatsoluong'])) {
	
			for($i=0;$i<count($_POST['product_id']);$i++){
				$sanpham_id=$_POST['product_id'][$i];
				$soluong=$_POST['soluong'][$i];
				if($soluong<=0){
					$sql_update= mysqli_query($con,"delete from tb_giohang where sanpham_id='$sanpham_id'");
				}else{
					$sql_update= mysqli_query($con,"update tb_giohang set soluong='$soluong' where sanpham_id='$sanpham_id'");
				}
				
			}
		}elseif (isset($_GET['xoa']) ){
			$id=$_GET['xoa'];
			$sql_delete=mysqli_query($con,"delete from tb_giohang where giohang_id='$id'");
		}elseif(isset($_GET['dangxuat']) ){
			$id=$_GET['dangxuat'];
			if($id==1){
				unset($_SESSION['dangnhap_home']);
			}
			
		}
		elseif (isset($_POST['thanhtoan'])){
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$address = $_POST['address'];			
			$note = $_POST['note'];			
			$giaohang = $_POST['giaohang'];
			$sql_khachhang= mysqli_query($con,"insert into tb_khachhanng(name,phone,address,email,note,giaohang,password) values('$name','$phone',
			'$address','$email','$note','$giaohang','$password')");
			if($sql_khachhang){
				$sql_select_khachhang=mysqli_query($con,"select * from tb_khachhanng order by khachhang_id desc limit 1");
				$mahang=rand(0,9999);
				$row_khachhang=mysqli_fetch_array($sql_select_khachhang);
				$khachang_id=$row_khachhang['khachhang_id'];
				$_SESSION['dangnhap_home']=$row_khachhang['name'];
				$_SESSION['khachhang_id']=$khachang_id;
				for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){				
					$sanpham_id=$_POST['thanhtoan_product_id'][$i];
					$soluong=$_POST['thanhtoan_soluong'][$i];
					$sql_ttdonhang= mysqli_query($con,"insert into tb_ttdonhang(sanpham_id,khachhang_id,soluong,mahang) values('$sanpham_id',
					'$khachang_id','$soluong','$mahang')");
					$sql_giaodich= mysqli_query($con,"insert into tb_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values('$sanpham_id',
					'$soluong','$mahang','$khachang_id')");
					 $sql_delete_thanhtoan=mysqli_query($con,"delete from tb_giohang where sanpham_id='$sanpham_id'");
					
				}
				
			}

		}elseif(isset($_POST['thanhtoandangnhap'])){
			$khachhang_id=$_SESSION['khachhang_id'];
			$mahang=rand(0,9999);		
			for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){				
				$sanpham_id=$_POST['thanhtoan_product_id'][$i];
					$soluong=$_POST['thanhtoan_soluong'][$i];
					$sql_ttdonhang= mysqli_query($con,"insert into tb_ttdonhang(sanpham_id,khachhang_id,soluong,mahang) values('$sanpham_id',
					'$khachhang_id','$soluong','$mahang')");
					$sql_giaodich= mysqli_query($con,"insert into tb_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values('$sanpham_id',
					'$soluong','$mahang','$khachhang_id')");
					 $sql_delete_thanhtoan=mysqli_query($con,"delete from tb_giohang where sanpham_id='$sanpham_id'");
					
				}

		}
    ?>
    <!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>G</span>iỏ
				<span>H</span>àng
				<span>C</span>ủa
				<span>B</span>ạn
			</h3>
			<?php
					if(isset($_SESSION['dangnhap_home'])){
						echo '<span style="color:black;">Xin chào: '.$_SESSION['dangnhap_home'].'
						|| <a href="index.php?quanly=giohang&dangxuat=1">Đăng Xuất</a></span>';
					}else{
						echo '';
					}
				?>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<?php
				$lay_gio_hang= mysqli_query($con, "select * from tb_giohang order by giohang_id desc");

				?>

				
				<div class="table-responsive">
					<form action="" method="POST">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Thứ tự</th>
								<th>Sản Phẩm</th>
								<th>Số lượng</th>
								<th>Tên sản phẩm</th>

								<th>Giá</th>
								<th>Tổng tiền</th>
								<th>Quản lý</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$i=0;
								$subtotal=0;
							while($row_fetch_giohang = mysqli_fetch_array($lay_gio_hang)){
								$total = (float)$row_fetch_giohang['soluong'] * (float)$row_fetch_giohang['gia'];
								$subtotal+=$total;
								$i++;
							?>
							<tr class="rem1">
								<td class="invert"><?php echo $i ?></td>
								<td class="invert-image">
									<a href="#">
										<img src="images/<?php echo $row_fetch_giohang['img']?>" alt=" " class="img-responsive">
									</a>
								</td>
								<td class="invert">
								<input type="hidden"  name="product_id[]" value="<?php echo $row_fetch_giohang['sanpham_id'] ?>">
								 <input type="number" min="0" name="soluong[]" value="<?php echo $row_fetch_giohang['soluong'] ?>">
								
								</td>
								<td class="invert"><?php echo $row_fetch_giohang['tensanpham'] ?></td>
								<td class="invert"><?php echo $row_fetch_giohang['gia']?>đ</td>
								<td class="invert"><?php echo $total?>đ</td>
								<td class="invert">
									<a href="?quanly=giohang&xoa=<?php echo $row_fetch_giohang['giohang_id'] ?>">Xóa</a>
								</td>
							</tr>
							<?php
							}
							?>
							<tr>
								<td colspan="7"><span>Tổng tiền cần thanh toán </span> : <?php echo $subtotal ?> đ</td>
								
							</tr>
							<tr>
							<td colspan="7"><input type="submit" class="btn btn-success" value="Cập nhật giỏ hàng" name="capnhatsoluong"> 
							<?php
							$sql_giohang_select=mysqli_query($con,"select * from tb_giohang");
							$count_giohang=mysqli_num_rows($sql_giohang_select);

							if(isset($_SESSION['dangnhap_home']) && $count_giohang>0){
								while($row_1=mysqli_fetch_array($sql_giohang_select)){
							?>
						
							<input type="hidden"  name="thanhtoan_product_id[]" value="<?php echo $row_1['sanpham_id'] ?>">
							<input type="hidden"  name="thanhtoan_soluong[]" value="<?php echo $row_1['soluong'] ?>">
							<?php
							}
							?>	
							<input type="submit" class="btn btn-primary" value="Thanh toán" name="thanhtoandangnhap">
							<?php
							}
							?>
							</td>
							</tr>
						</tbody>
					</table>
					</form>
				</div>
			</div>
			<?php
			if(!isset($_SESSION['dangnhap_home'])){

			?>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="họ & tên" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="số điện thoại" name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="địa chỉ" name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="email" name="email" required="">
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="password" name="password" required="">
									</div>
									<div class="controls form-group">
										<textarea style="resize:none;" class="form-control" placeholder="ghi chú" name="note" require=""> </textarea>
									</div>
									<div class="controls form-group">
										<select class="option-w3ls" name="giaohang">
											<option>Hình thức thanh toán</option>
											<option value="0">Thanh toán qua ATM</option>
											<option value="1">Thanh Toán qua MoMo</option>
											<option value="2">Thanh toán khi nhận hàng</option>

										</select>
									</div>
									
								</div>
								<?php
								$sql_lay_giohang=mysqli_query($con,"select * from tb_giohang order by giohang_id desc");
								while($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)){
								?>
									<input type="hidden"  name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
									<input type="hidden"  name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">
								<?php
								}
								?>
								<input type="submit"  name="thanhtoan" class="btn btn-primary" value="Thanh Toán" style="width:20%">
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php
			}
			?>
		</div>
	</div>
	<!-- //checkout page -->