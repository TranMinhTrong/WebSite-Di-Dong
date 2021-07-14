<?php
    session_start();
    include('../db/connect.php');
?>
<?php
    if(isset($_POST['thembaiviet'])){
        $tenbaiviet= $_POST['tenbaiviet'];
        $hinhanh= $_FILES['hinhanh']['name'];
        $hinhanh_tmp= $_FILES['hinhanh']['tmp_name'];
        $danhmuc= $_POST['danhmuc'];
        $noidung= $_POST['noidung'];
        $tomtat= $_POST['tomtat'];
        $path="../uploads/";
        $sql_insert_baiviet = mysqli_query($con,"insert into tb_baiviet(tenbaiviet,baiviet_img,noidung,tomtat,tintuc_id) 
        values('$tenbaiviet','$hinhanh','$noidung','$tomtat','$danhmuc')");
        move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
    }
    elseif(isset($_POST['capnhatbaiviet'])){
        $id_update=$_POST['id_baiviet'];
        $tenbaiviet= $_POST['tenbaiviet'];
        $hinhanh= $_FILES['hinhanh']['name'];
        $hinhanh_tmp= $_FILES['hinhanh']['tmp_name'];
        $danhmuc= $_POST['danhmuc'];
        $noidung= $_POST['noidung'];
        $tomtat= $_POST['tomtat'];
        $path="../uploads/";
        if($hinhanh==''){
            $sql_update_baiviet="update tb_baiviet set tenbaiviet='$tenbaiviet',noidung='$noidung',tomtat='$tomtat', tintuc_id='$danhmuc' where baiviet_id='$id_update'";
        }else{
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
            $sql_update_baiviet="update tb_baiviet set tenbaiviet='$tenbaiviet',noidung='$noidung',tomtat='$tomtat',
            tintuc_id='$danhmuc',baiviet_img='$hinhanh' where baiviet_id='$id_update'";
        }
        mysqli_query($con,$sql_update_baiviet);
    }if(isset($_GET['xoa'])){
        $id=$_GET['xoa'];
        $sql_xoa=mysqli_query($con,"delete from tb_baiviet where baiviet_id='$id'");
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
    <title>Sản Phẩm</title>
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
            <a class="nav-link" href="xulysanpham.php">Loại sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulykhachhang.php">Khách Hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulydanhmuctin.php">Danh mục bài viết</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active " href="xulybaiviet.php">Bài viết</a>
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
            if(isset($_GET['quanly'])=='capnhat'){
                $id_capnhat=$_GET['capnhat_id'];
                $sql_capnhat_baiviet=mysqli_query($con,"select * from tb_tintuc,tb_baiviet where tb_tintuc.tin_id=tb_baiviet.tintuc_id 
                and baiviet_id='$id_capnhat'");
                $row_capnhat_baiviet=mysqli_fetch_array($sql_capnhat_baiviet);
                $id_tin=$row_capnhat_baiviet['tin_id'];
               ?>
                 <div class="col-md-3">
                <h4>Cập nhật bài viết</h4>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="">Tên bài viết</label>
                        <input type="text" class="form-control" name="tenbaiviet" value="<?php echo $row_capnhat_baiviet['tenbaiviet'] ?>"><br>
                        <input type="hidden" class="form-control" name="id_baiviet" value="<?php echo $row_capnhat_baiviet['baiviet_id'] ?>">
                        <label for="">Hình ảnh</label>
                        <input type="file" class="form-control" name="hinhanh"><br>
                        <img src="../images/<?php echo $row_capnhat_baiviet['baiviet_img'] ?>" alt="" height="80" width="80"><br>
                        <label for="">Nội dung chính</label>
                        <textarea name="noidung" cols="30" rows="10" class="form-control"><?php echo $row_capnhat_baiviet['noidung'] ?></textarea><br>
                        <label for="">Nội dung tóm tắt</label>
                        <textarea name="tomtat" cols="30" rows="10" class="form-control"><?php echo $row_capnhat_baiviet['tomtat'] ?></textarea><br>
                        
                        <label for="">Danh mục bài viết</label>
                        <?php
                        $sql_danhmuc=mysqli_query($con,"select * from tb_tintuc order by tin_id desc");
                        ?>
                        <select name="danhmuc" id="" class="form-control">
                        <option value=""><?php echo $row_capnhat['tendanhmuc'] ?></option>
                        <?php
                        while($row_danhmuc=mysqli_fetch_array($sql_danhmuc)){
                            if($id_tin==$row_danhmuc['tin_id']){
                        ?>
                        <option selected value="<?php echo $row_danhmuc['tin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                        <?php
                        }else{
                        ?>
                        <option value="<?php echo $row_danhmuc['tin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                        <?php
                        }
                    }
                        ?>
                        </select><br>
                     
                        <input type="submit" name="capnhatbaiviet" value="Cập nhật bài viết" class="btn btn-default">
                    </form>
            </div>
            <?php
            }else{
           ?>
            <div class="col-md-3">
                <h4>Thêm bài viết</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                        <label for="">Tên bài viết</label>
                        <input type="text" class="form-control" name="tenbaiviet" placehoder="Tên bài viết"><br>
                
                        <label for="">Hình ảnh</label>
                        <input type="file" class="form-control" name="hinhanh"><br>
                        <label for="">Nội dung chính</label>
                        <textarea name="noidung" cols="30" rows="10" class="form-control"></textarea><br>
                        <label for="">Nội dung tóm tắt</label>
                        <textarea name="tomtat" cols="30" rows="10" class="form-control"></textarea><br>
                        
                        <label for="">Danh mục bài viết</label>
                        <?php
                        $sql_danhmuc_tin=mysqli_query($con,"select * from tb_tintuc order by tin_id desc");
                        ?>
                        <select name="danhmuc" id="" class="form-control">
                        
                        <?php
                        while($row_danhmuc_tin=mysqli_fetch_array($sql_danhmuc_tin)){
                        ?>
                        <option value="<?php echo $row_danhmuc_tin['tin_id'] ?>"><?php echo $row_danhmuc_tin['tendanhmuc'] ?></option>
                        <?php
                        }
                        ?>
                        </select><br>
                     
                        <input type="submit" name="thembaiviet" value="Thêm nội dung bài viết" class="btn btn-default">
                    </form>
            </div>
            <?php
            }
            ?>
    
            <div class="col-md-9">

                <h4>Thông tin các bài viết</h4>
                <?php
                 $sql_select_baiviet = mysqli_query($con,"select * from tb_tintuc,tb_baiviet where tb_tintuc.tin_id=tb_baiviet.tintuc_id 
                 order by tb_baiviet.tintuc_id desc");
                ?>
                <table class="table table-reponsive table-bordered">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tiêu đề bài viết</th>
                        <th>Tiêu đề nội dung</th>
                        <th>Nội dung chính</th>
                        <th>Nội dung tóm tắt</th>
                        <th>Hình ảnh</th>
                        <th>Quản lý</th>
                    </tr>
                    <?php
                        $i=0;
                        while($row_baiviet = mysqli_fetch_array($sql_select_baiviet)){
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row_baiviet['tenbaiviet'] ?></td>  
                        <td><?php echo $row_baiviet['tendanhmuc'] ?></td>                    
                        <td><?php echo $row_baiviet['noidung'] ?></td>
                        <td><?php echo $row_baiviet['tomtat'] ?></td>
                        <td> <img src="../uploads/<?php echo $row_baiviet['baiviet_img'] ?>" alt="" height="80" width="80"></td>
                        <td><a href="?xoa=<?php echo $row_baiviet['baiviet_id'] ?>">Xóa</a> ||
                         <a href="xulybaiviet.php?quanly=capnhat&capnhat_id=<?php echo $row_baiviet['baiviet_id'] ?>">Cập nhật</a></td>
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