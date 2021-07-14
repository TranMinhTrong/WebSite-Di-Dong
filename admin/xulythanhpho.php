<?php
    session_start();
    include('../db/connect.php');
?>
<?php
    if(isset($_POST['themdanhmuc'])){
        $tendanhmuc= $_POST['danhmuc'];
        $sql_insert=mysqli_query($con,"insert into tb_thanhpho(thanhpho) values('$tendanhmuc')");
       
    }elseif(isset($_POST['capnhatdanhmuc'])){
        $id_post=$_POST['id_danhmuc'];
        $tendanhmuc=$_POST['danhmuc'];
        $sql_update=mysqli_query($con,"update tb_thanhpho set thanhpho='$tendanhmuc' where thanhpho_id='$id_post'");
        header('Location:xulydanhmuc.php');
    }if(isset($_GET['xoa'])){
        $id=$_GET['xoa'];
        $sql_xoa=mysqli_query($con,"delete from tb_thanhpho where thanhpho_id='$id'");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Bootstrap css -->
    <title>Welcome Admin</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="xulydonhang.php">Đơn hàng </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="xulydanhmuc.php">Danh mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulyloaisanpham.php">Loại sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulykhachhang.php">Khách Hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="xulydanhmuctin.php">Danh mục bài viết</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="xulybaiviet.php">Bài viết</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="xulydanhmuctin.php">Địa chỉ</a>
        </li>

        </ul>
    </div>
    </nav><br>
    <div class="container">
        <div class="row">
        <?php
            if(isset($_GET['quanly'])=='capnhat'){
                $id_capnhat=$_GET['id'];
                $sql_capnhat=mysqli_query($con,"select * from tb_thanhpho where thanhpho_id='$id_capnhat'");
                $row_capnhat=mysqli_fetch_array($sql_capnhat);
               ?>
                 <div class="col-md-4">
                    <h4>Cập nhật</h4>
                    <label for="">Tên Tỉnh/Thành Phố</label>
                    <form action="" method="POST">
                        <input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['thanhpho'] ?>"><br>
                        <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['thanhpho_id'] ?>">
                        <input type="submit" name="capnhatdanhmuc" value="Cập nhật " class="btn btn-default">
                    </form>

            </div>
            <?php
            }else{
           ?>
           <div class="col-md-4">
                <h4>Thêm Tỉnh/Thành Phố</h4>
                    <label for="">Tên danh mục</label>
                    <form action="" method="POST">
                        <input type="text" class="form-control" name="danhmuc" placehoder="Tên danh mục"><br>
                       
                        <input type="submit" name="themdanhmuc" value="Thêm " class="btn btn-default">
                    </form>
            </div>
            <?php
            }
            ?>
            <div class="col-md-8">

                <h4>Tỉnh/Thành Phố</h4>
                <?php
                    $sql_select=mysqli_query($con,"select * from tb_thanhpho order by thanhpho_id desc");
                ?>
                <table class="table table-reponsive table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên Thành Phố</th>
                        <th>Quản Lý</th>
                    </tr>
                    <?php
                        $i=0;
                        while($row_catagory=mysqli_fetch_array($sql_select)){
                            $i++;
                        
                    ?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td><?php echo $row_catagory['thanhpho'] ?></td>
                        <td><a href="?xoa=<?php echo $row_catagory['thanhpho_id'] ?>">Xóa</a> || 
                        <a href="?quanly=capnhat&id=<?php echo $row_catagory['thanhpho_id'] ?>">Cập nhật</a></td>
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