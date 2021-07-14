
<?php
    session_start();
    include('../db/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Bootstrap css -->
    <title>Đơn Hàng</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link" href="xulydonhang.php">Đơn hàng </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulyloaisanpham.php">Loại sản phẩm</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="xulykhachhang.php">Khách Hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulydanhmuctin.php">Danh mục bài viết</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="xulybaiviet.php">Bài viết</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulythanhpho.php">Địa chỉ</a>
        </li>
        </ul>
    </div>
    </nav><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4>Khách hàng</h4>
                <?php
                    $sql_select=mysqli_query($con,"select * from tb_khachhanng,tb_giaodich where tb_khachhanng.khachhang_id=tb_giaodich.khachhang_id
                     order by tb_khachhanng.khachhang_id desc");
                ?>
                <table class="table table-reponsive table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Ngày mua</th>
                        <th>Quản lý</th>
                    </tr>
                    <?php
                        $i=0;
                        while($row_khachhang=mysqli_fetch_array($sql_select)){
                            $i++;
                        
                    ?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td><?php echo $row_khachhang['name'] ?></td>
                        <td><?php echo $row_khachhang['phone'] ?></td>
                        <td><?php echo $row_khachhang['address'] ?></td>
                        <td><?php echo $row_khachhang['email'] ?></td>
                        <td><?php echo $row_khachhang['ngaythang'] ?></td>
                        <td><a href="?quanly=xemgiaodich&khachhang=<?php echo $row_khachhang['magiaodich'] ?>">Xem giao dich</a> </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <div class="col-md-12">

                <h4>Lịch sử mua hàng</h4>
                <?php
                if(isset($_GET['khachhang'])){
                    $magiaodich=$_GET['khachhang'];
                }else{
                    $magiaodich='';
                }
                    $sql_select=mysqli_query($con,"select * from tb_khachhanng, tb_giaodich, tb_sp where
                    tb_khachhanng.khachhang_id=tb_giaodich.khachhang_id and tb_giaodich.sanpham_id=tb_sp.sanpham_id
                    and tb_giaodich.magiaodich='$magiaodich' group by tb_giaodich.magiaodich order by tb_giaodich.giaodich_id desc");
                ?>
                <table class="table table-reponsive table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Mã giao dich</th>
                        <th>Tên Khách hàng</th>
                        <th>Tên sản phẩm</th>
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
                        <td><?php echo $row_donhang['ngaythang'] ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
        </div>
        </div>
    </div>
</body>
</html>