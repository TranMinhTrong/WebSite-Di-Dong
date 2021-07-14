<?php
    if(isset($_GET['huydon'])&& isset($_GET['magiaodich'])){
        $huydon=$_GET['huydon'];
        $magiaodich=$_GET['magiaodich'];
    }else {
        $huydon=' ';
        $magiaodich=' ';
    }
    $sql_update_donhang=mysqli_query($con,"update tb_ttdonhang set huydon='$huydon' where mahang='$magiaodich'" );
    $sql_update_giaodich=mysqli_query($con,"update tb_giaodich set huydon='$huydon' where magiaodich='$magiaodich'" );
?>
	<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>
					Xem Đơn Hàng
				</span>
			</h3>
			<!-- //tittle heading -->
			<div class="row">

				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-12">
					<div class="wrapper">
						<!-- first section -->
						
							<div class="row">
                                <?php
								if(isset($_SESSION['dangnhap_home'])){
                                    echo 'đơn hàng :' .$_SESSION['dangnhap_home'];
                                }
                                ?>
                                 <div class="col-md-12">

                                <h4>Lịch sử mua hàng</h4>
                                <?php
                                if(isset($_GET['khachhang'])){
                                    $id_khachhang=$_GET['khachhang'];
                                }else{
                                    $id_khachhang='';
                                }
                                    $sql_select=mysqli_query($con,"select * from  tb_giaodich,tb_sp where tb_giaodich.sanpham_id=tb_sp.sanpham_id and
                                     khachhang_id='$id_khachhang' group by tb_giaodich.magiaodich desc");
                                ?>
                                <table class="table table-reponsive table-bordered">
                                    <tr>
                                        <th>Thứ tự</th>
                                        <th>Mã giao dich</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ngày đặt</th>
                                        <th>Quản lý</th>
                                        <th>Tình Trạng</th>
                                        <th>Yêu cầu</th>
                                    </tr>
                                    <?php
                                        $i=0;
                                        while($row_donhang=mysqli_fetch_array($sql_select)){
                                            $i++;
                                        
                                    ?>
                                    <tr>
                                        <td> <?php echo $i; ?></td>
                                        <td><?php echo $row_donhang['magiaodich'] ?></td>
                                        <td><?php echo $row_donhang['sanpham_name'] ?></td>
                                        <td><?php echo $row_donhang['ngaythang'] ?></td>
                                        <td><a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>
                                        &magiaodich=<?php echo $row_donhang['magiaodich'] ?>">Xem chi tiết</a></td>
                                        <td>
                                            <?php
                                            if($row_donhang['tinhtrangdonhang']==0){
                                                echo 'Đang chờ xử lý';
                                            }else
                                            {
                                                echo 'Đang giao hàng';
                                            }
                                            ?>
                                           
                                        </td>
                                        <td>
                                            <?php
                                                if($row_donhang['huydon']==0){
                                            ?>    
                                                <a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>
                                                &magiaodich=<?php echo $row_donhang['magiaodich'] ?>&huydon=1">Hủy đơn hàng</a>
                                            <?php
                                                }elseif($row_donhang['huydon']==1){
                                            ?>
                                            <p>Yêu cầu hủy...</p>
                                            <?php
                                                }else {
                                                    echo 'Hủy đơn thành công';
                                                }
                                            ?>
                                        </td>
                                    </tr> 
                                    <?php
                                        }
                                    ?>
                                </table>
                                </div>
                                <div class="col-md-12">

                                <p>Chi tiết đơn hàng</p>
                                <?php
                                if(isset($_GET['magiaodich'])){
                                    $magiaodich=$_GET['magiaodich'];
                                }else{
                                    $magiaodich='';
                                }
                                    $sql_select=mysqli_query($con,"select * from tb_khachhanng, tb_giaodich, tb_sp where
                                    tb_khachhanng.khachhang_id=tb_giaodich.khachhang_id and tb_giaodich.sanpham_id=tb_sp.sanpham_id
                                    and tb_giaodich.magiaodich='$magiaodich'  order by tb_giaodich.giaodich_id desc");
                                ?>
                                <table class="table table-reponsive table-bordered">
                                    <tr>
                                        <th>Thứ tự</th>
                                        <th>Mã giao dich</th>
                                        <th>Tên Khách hàng</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số Lượng</th>
                                        <th>Ngày đặt</th>
                                        
                                    </tr>
                                    <?php
                                        $i=0;
                                        while($row_donhang=mysqli_fetch_array($sql_select)){
                                            $i++;
                                        
                                    ?>
                                    <tr>
                                        <td> <?php echo $i; ?></td>
                                        <td><?php echo $row_donhang['magiaodich'] ?></td>
                                        <td><?php echo $row_donhang['name'] ?></td>
                                        <td><?php echo $row_donhang['sanpham_name'] ?></td>
                                        <td><?php echo $row_donhang['soluong'] ?></td>
                                        <td><?php echo $row_donhang['ngaythang'] ?></td>
                                       
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </table>
                                </div>
							</div>
						<!-- //first section -->
						
					</div>
				</div>
				<!-- //product left -->
			</div>
		</div>
	</div>
	<!-- //top products -->