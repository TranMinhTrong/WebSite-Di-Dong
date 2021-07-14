<?php
    session_start();
    include('../db/connect.php');
?>
<?php
    if(isset($_POST['themdanhmuc'])){
        $tendanhmuc= $_POST['danhmuc'];
        $tendanhmucloaisp= $_POST['danhmucloaisp'];
        $sanpham_active = $_POST['sanpham_active'];
        $sql_insert=mysqli_query($con,"insert into tb_loaisanpham(tenloai_sp,catagory_id,loaisp_active) values('$tendanhmucloaisp',
        '$tendanhmuc','$sanpham_active')");
       
    }elseif(isset($_POST['capnhatdanhmuc'])){
        $id_post=$_POST['id_danhmuc'];
        $tendanhmuc=$_POST['danhmuc'];
        $tendanhmucloaisp= $_POST['danhmucloaisp'];
        $sanpham_active = $_POST['sanpham_active'];
        $sql_update=mysqli_query($con,"update tb_loaisanpham set tenloai_sp='$tendanhmucloaisp',catagory_id='$tendanhmuc',loaisp_active='$sanpham_active' where
         loaisp_id='$id_post'");
        header('Location:xulyloaisanpham.php');
    }if(isset($_GET['xoa'])){
        $id=$_GET['xoa'];
        $sql_xoa=mysqli_query($con,"delete from tb_loaisanpham where loaisp_id='$id'");
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
            <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  active" href="xulyloaisanpham.php">Loại sản phẩm</a>
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
        <li class="nav-item">
            <a class="nav-link" href="xulythanhpho.php">Địa chỉ</a>
        </li>
        </ul>
    </div>
    </nav><br>
    <div class="container">
        <div class="row">
        <?php
            if(isset($_GET['quanly'])=='capnhat'){
                $id_capnhat=$_GET['id'];
                $sql_capnhat=mysqli_query($con,"select * from tb_loaisanpham,tb_catagory where  tb_loaisanpham.catagory_id=tb_catagory.catagory_id 
                and loaisp_id='$id_capnhat'");
                $row_capnhat=mysqli_fetch_array($sql_capnhat);
                $id_catagory_1=$row_capnhat['catagory_id'];
               ?>
                 <div class="col-md-4">
                    <h4>Cập nhật danh mục</h4>
                    <label for="">Tên danh mục</label>
                    <form action="" method="POST">
                        <input type="text" class="form-control" name="danhmucloaisp" value="<?php echo $row_capnhat['tenloai_sp'] ?>"><br>
                        <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['loaisp_id'] ?>"><br>
                        <label for="">Chọn hình thức hoạt động sản phẩm</label><br>
                        <select class="option-w3ls" name="sanpham_active">
							<option value="0">Hiện ở sản phẩm</option>
							<option value="1">Hiện ở trang chủ</option>
						</select><br><br>
                        <label for="">Danh mục</label>
                        <?php
                        $sql_danhmuc=mysqli_query($con,"select * from tb_catagory order by catagory_id desc");
                        ?>
                        <select name="danhmuc" id="" class="form-control">
                        <option value=""><?php echo $row_capnhat['catagory_name'] ?></option>
                        <?php
                        while($row_danhmuc=mysqli_fetch_array($sql_danhmuc)){
                            if($id_catagory_1==$row_danhmuc['catagory_id']){
                        ?>
                        <option selected value="<?php echo $row_danhmuc['catagory_id'] ?>"><?php echo $row_danhmuc['catagory_name'] ?></option>
                        <?php
                        }else{
                        ?>
                        <option value="<?php echo $row_danhmuc['catagory_id'] ?>"><?php echo $row_danhmuc['catagory_name'] ?></option>
                        <?php
                        }
                        }
                        ?>
                        </select><br>
                        <input type="submit" name="capnhatdanhmuc" value="Cập nhật danh mục" class="btn btn-default">
                    </form>

            </div>
            <?php
            }else{
           ?>
           <div class="col-md-4">
                <h4>Thêm danh mục</h4>
                    <label for="">Tên danh mục</label>
                    <form action="" method="POST">
                        <input type="text" class="form-control" name="danhmucloaisp" placehoder="Tên danh mục"><br>
                        <label for="">Chọn hình thức hoạt động sản phẩm</label>
                        <select class="option-w3ls" name="sanpham_active">
							<option value="0">Hiện ở sản phẩm</option>
							<option value="1">Hiện ở trang chủ</option>
						</select><br><br>
                        <label for="">Danh mục</label>                      
                        <?php
                        $sql_danhmuc=mysqli_query($con,"select * from tb_catagory order by catagory_id desc")
                        ?>
                        <select name="danhmuc" id="" class="form-control">
                        <option value="">----Chọn danh mục-----</option>
                        <?php
                        while($row_danhmuc=mysqli_fetch_array($sql_danhmuc)){
                        ?>
                        <option value="<?php echo $row_danhmuc['catagory_id'] ?>"><?php echo $row_danhmuc['catagory_name'] ?></option>
                        <?php
                        }
                        ?>
                        </select><br>
                       
                        <input type="submit" name="themdanhmuc" value="Thêm danh mục" class="btn btn-default">
                    </form>
            </div>
            <?php
            }
            ?>
            <div class="col-md-8">

                <h4>Liệt kê danh mục</h4>
                <?php
                    $sql_select=mysqli_query($con,"select * from tb_loaisanpham order by loaisp_id desc");
                ?>
                <table class="table table-reponsive table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên danh mục</th>
                        <th>Quản Lý</th>
                    </tr>
                    <?php
                        $i=0;
                        while($row_catagory=mysqli_fetch_array($sql_select)){
                            $i++;
                        
                    ?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td><?php echo $row_catagory['tenloai_sp'] ?></td>
                        <td><a href="?xoa=<?php echo $row_catagory['loaisp_id'] ?>">Xóa</a> || 
                        <a href="?quanly=capnhat&id=<?php echo $row_catagory['loaisp_id'] ?>">Cập nhật</a></td>
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