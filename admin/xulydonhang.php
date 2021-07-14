<?php
    session_start();
    include('../db/connect.php');
?>
<?php
    if(isset($_POST['capnhatdonhang'])){
        $xuly=$_POST['xuly'];
        $mahang=$_POST['mahang_xuly'];
        $mysql_update_donhang=mysqli_query($con,"update tb_ttdonhang set tinhtrang='$xuly' where mahang='$mahang'");
        $mysql_update_giaodich=mysqli_query($con,"update tb_giaodich set tinhtrangdonhang='$xuly' where magiaodich='$mahang'");
    }
    
       
?>
<?php
    if(isset($_GET['xoadonhang'])){
        $mahang=$_GET['xoadonhang'];
        $sql_delete=mysqli_query($con,"delete from tb_ttdonhang where mahang='$mahang'");
        header('Location:xulydonhang.php');
    }
    if(isset($_GET['xacnhanhuy'])&& isset($_GET['mahang'])){
        $huydon=$_GET['huydon'];
        $magiaodich=$_GET['mahang'];
    }else {
        $huydon=' ';
        $magiaodich=' ';
    }
    $sql_update_donhang=mysqli_query($con,"update tb_ttdonhang set huydon='$huydon' where mahang='$magiaodich'" );
    $sql_update_giaodich=mysqli_query($con,"update tb_giaodich set huydon='$huydon' where magiaodich='$magiaodich'" );
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
<nav class="navbar navbar-expand-lg navbar-light bg-light text-center">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="xulydonhang.php">Đơn hàng </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulysanpham.php">Loại sản phẩm</a>
        </li>
        <li class="nav-item">
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
        <?php
            if(isset($_GET['quanly'])=='xemdonhang'){
                $mahang=$_GET['mahang'];
                $sql_chitiet=mysqli_query($con,"select * from tb_ttdonhang, tb_sp where
                tb_ttdonhang.sanpham_id=tb_sp.sanpham_id and tb_ttdonhang.mahang='$mahang' ");
               ?>
            <div class="col-md-6">
            <h2 style="color:red">Xem Chi tiết đơn hàng</h2>
            <form action="" method="post">
            <table class="table table-reponsive table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Mã Hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Tổng Tiền</th>
                        <th>Ngày đặt</th>
                    </tr>
                    <?php
                        $i=0;
                        while($row_donhang=mysqli_fetch_array($sql_chitiet)){
                            $i++;
                            $total = (float)$row_donhang['soluong'] * (float)$row_donhang['sanpham_giakm'];
                        
                    ?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td><?php echo $row_donhang['mahang'] ?></td>
                        <td><?php echo $row_donhang['sanpham_name'] ?></td>
                        <td><?php echo $row_donhang['soluong'] ?></td>
                        <td><?php echo $row_donhang['sanpham_giakm'] ?></td>
                        <td><?php echo $total?> đ</td>
                        <td><?php echo $row_donhang['ngaythang'] ?></td>
                        <input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['mahang'] ?>">
                      
                    <?php
                        }
                    ?>
                </table>
                <select class="form-control" name="xuly" id="">
                        <option value="0">Chưa xử lý</option>
                        <option value="1">Đã xử lý</option>
                </select><br>
                <input type="submit" value="Cập nhật đơn hàng" name="capnhatdonhang" class="btn btn-succes"> 
                </form>
                </div>
            <?php  
            }else{
           ?>
           <div class="col-md-6">
            <p>Đơn Hàng</p>
            </div>
            <?php
            }
            ?>
            <div class="col-md-6">

                <h4>Liệt kê Đơn Hàng</h4>
                <?php
                    $sql_select=mysqli_query($con,"select * from tb_khachhanng, tb_ttdonhang, tb_sp where
                    tb_khachhanng.khachhang_id=tb_ttdonhang.khachhang_id and tb_ttdonhang.sanpham_id=tb_sp.sanpham_id 
                    group by tb_ttdonhang.mahang desc");
                ?>
                <table class="table table-reponsive table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Mã Hàng</th>
                        <th>Tên Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Ghi chú</th>
                        <th>tình trạng</th>
                        <th>Hủy đơn</th>
                        <th>Quản lý</th>
                    </tr>
                    <?php
                        $i=0;
                        while($row_donhang=mysqli_fetch_array($sql_select)){
                            $i++;
                        
                    ?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td><?php echo $row_donhang['mahang'] ?></td>
                        <td><?php echo $row_donhang['name'] ?></td>
                        <td><?php echo $row_donhang['ngaythang'] ?></td>
                        <td><?php echo $row_donhang['note'] ?></td>
                        <td><?php 
                            if($row_donhang['tinhtrang']==0){
                                echo 'Chưa xử lý';
                            }else{
                                echo 'Đã xử lý';
                            }
                        ?></td>
                        <td>
                        <?php if($row_donhang['huydon']==0){ }elseif($row_donhang['huydon']==1) {
                            echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang='. $row_donhang['mahang'].'&xacnhanhuy=2">
                             xác nhận hủy đơn</a>';
                         } else{
                             echo'Đã hủy';
                         }
                         ?>
                        </td>
                        <td><a href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xóa</a> || 
                        <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem đơn hàng</a></td>
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