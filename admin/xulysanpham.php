<?php
    session_start();
    include('../db/connect.php');
?>
<?php
    if(isset($_POST['themsanpham'])){
        $tensanpham= $_POST['tensanpham'];
        $hinhanh= $_FILES['hinhanh']['name'];
        $hinhanh_tmp= $_FILES['hinhanh']['tmp_name'];
        $hinhanhzoom1= $_FILES['hinhanhzoom1']['name'];
        $hinhanh_tmp1= $_FILES['hinhanhzoom1']['tmp_name'];
        $hinhanhzoom2= $_FILES['hinhanhzoom2']['name'];
        $hinhanh_tmp2= $_FILES['hinhanhzoom2']['tmp_name'];
        $soluong= $_POST['soluong'];
        $gia= $_POST['gia'];
        $giakhuyenmai= $_POST['giakhuyenmai'];
        $danhmuc= $_POST['danhmuc'];
        $chitet= $_POST['chitiet'];
        $mota= $_POST['mota'];
        $path="../uploads/";
        $sql_insert_procduct = mysqli_query($con,"insert into tb_sp(sanpham_name,sanpham_motachitiet,sanpham_motangan,sanpham_gia,sanpham_giakm,
        sanpham_img,sanpham_soluong,loaisp_id,sanpham_img1,sanpham_img2) values('$tensanpham','$mota','$chitet','$gia','$giakhuyenmai',
        '$hinhanh','$soluong','$danhmuc','$hinhanhzoom1','$hinhanhzoom2')");
        move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
    }
    elseif(isset($_POST['capnhatsanpham'])){
        $id_update=$_POST['id_sanpham'];
        $tensanpham= $_POST['tensanpham'];
        $hinhanh= $_FILES['hinhanh']['name'];
        $hinhanh_tmp= $_FILES['hinhanh']['tmp_name'];
        $hinhanhzoom1= $_FILES['hinhanhzoom1']['name'];
        $hinhanh_tmp1= $_FILES['hinhanhzoom1']['tmp_name'];
        $hinhanhzoom2= $_FILES['hinhanhzoom2']['name'];
        $hinhanh_tmp2= $_FILES['hinhanhzoom2']['tmp_name'];
        $soluong= $_POST['soluong'];
        $gia= $_POST['gia'];
        $giakhuyenmai= $_POST['giakhuyenmai'];
        $danhmuc= $_POST['danhmuc'];
        $chitet= $_POST['chitiet'];
        $mota= $_POST['mota'];
        $path="../uploads/";
        if($hinhanh=='' || $hinhanhzoom1=='' || $hinhanhzoom2=''){
            $sql_update_image="update tb_sp set sanpham_name='$tensanpham',sanpham_motachitiet='$chitet',sanpham_motangan='$mota',
            sanpham_gia='$gia', sanpham_giakm='$giakhuyenmai',sanpham_soluong='$soluong',loaisp_id='$danhmuc' where sanpham_id='$id_update'";
        }else{
            move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
            $sql_update_image="update tb_sp set sanpham_name='$tensanpham',sanpham_motachitiet='$chitet',sanpham_motangan='$mota',
            sanpham_gia='$gia', sanpham_giakm='$giakhuyenmai',sanpham_img='$hinhanh',sanpham_soluong='$soluong',loaisp_id='$danhmuc'
            sanpham_img1='$hinhanhzoom1',sanpham_img2='$hinhanhzoom2' where sanpham_id='$id_update'";
        }
        mysqli_query($con,$sql_update_image);
    }if(isset($_GET['xoa'])){
        $id=$_GET['xoa'];
        $sql_xoa=mysqli_query($con,"delete from tb_sp where sanpham_id='$id'");
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
    <title>S???n Ph???m</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="xulydonhang.php">????n h??ng </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulydanhmuc.php">Danh m???c</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="xulysanpham.php">S???n ph???m</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulyloaisanpham.php">Lo???i s???n ph???m</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulykhachhang.php">Kh??ch H??ng</a>
        </li>
      
        <li class="nav-item">
            <a class="nav-link" href="xulydanhmuctin.php">Danh m???c b??i vi???t</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="xulybaiviet.php">B??i vi???t</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="xulythanhpho.php">?????a ch???</a>
        </li>

        </ul>
    </div>
    </nav><br>
    <div class="container-fluid">
        <div class="row">
        <?php
            if(isset($_GET['quanly'])=='capnhat'){
                $id_capnhat=$_GET['capnhat_id'];
                $sql_capnhat=mysqli_query($con,"select * from tb_sp,tb_loaisanpham where tb_sp.loaisp_id=tb_loaisanpham.loaisp_id 
                and sanpham_id='$id_capnhat'");
                $row_capnhat=mysqli_fetch_array($sql_capnhat);
                $id_catagory_1=$row_capnhat['loaisp_id'];
               ?>
                 <div class="col-md-3">
                <h4>C???p nh???t s???n ph???m</h4>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="">T??n s???n ph???m</label>
                        <input type="text" class="form-control" name="tensanpham" value="<?php echo $row_capnhat['sanpham_name'] ?>"><br>
                        <input type="hidden" class="form-control" name="id_sanpham" value="<?php echo $row_capnhat['sanpham_id'] ?>">
                        <label for="">H??nh ???nh</label>
                        <input type="file" class="form-control" name="hinhanh"><br>
                        <img src="../uploads/<?php echo $row_capnhat['sanpham_img'] ?>" alt="" height="80" width="80"><br>
                        <label for="">H??nh ???nh Zoom 1</label>
                        <input type="file" class="form-control" name="hinhanhzoom1"><br>
                        <label for="">H??nh ???nh Zoom 2</label>
                        <input type="file" class="form-control" name="hinhanhzoom2"><br>
                        <label for="">Gi??</label>
                        <input type="text" class="form-control" name="gia"  value="<?php echo $row_capnhat['sanpham_gia'] ?>"><br>
                        <label for="">Gi?? khuy???n m??i</label>
                        <input type="text" class="form-control" name="giakhuyenmai" value="<?php echo $row_capnhat['sanpham_giakm'] ?>"><br>
                        <label for="">S??? l?????ng</label>
                        <input type="text" class="form-control" name="soluong" value="<?php echo $row_capnhat['sanpham_soluong'] ?>"><br>
                        <label for="">M?? t???</label>
                        <textarea name="mota" cols="30" rows="10" class="form-control"><?php echo $row_capnhat['sanpham_motachitiet'] ?></textarea><br>
                        <label for="">Chi ti???t</label>
                        <textarea name="chitiet" cols="30" rows="10" class="form-control" ><?php echo $row_capnhat['sanpham_motangan'] ?></textarea><br>
                        
                        <label for="">Danh m???c</label>
                        <?php
                        $sql_danhmuc=mysqli_query($con,"select * from tb_loaisanpham order by loaisp_id desc");
                        ?>
                        <select name="danhmuc" id="" class="form-control">
                        <option value=""><?php echo $row_capnhat['tenloai_sp'] ?></option>
                        <?php
                        while($row_danhmuc=mysqli_fetch_array($sql_danhmuc)){
                            if($id_catagory_1==$row_danhmuc['loaisp_id']){
                        ?>
                        <option selected value="<?php echo $row_danhmuc['loaisp_id'] ?>"><?php echo $row_danhmuc['tenloai_sp'] ?></option>
                        <?php
                        }else{
                        ?>
                        <option value="<?php echo $row_danhmuc['loaisp_id'] ?>"><?php echo $row_danhmuc['tenloai_sp'] ?></option>
                        <?php
                        }
                        }
                        ?>
                        </select><br>
                     
                        <input type="submit" name="capnhatsanpham" value="C???p nh???t s???n ph???m" class="btn btn-default">
                    </form>
            </div>
            <?php
            }else{
           ?>
            <div class="col-md-3">
                <h4>Th??m s???n ph???m</h4>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="">T??n s???n ph???m</label>
                        <input type="text" class="form-control" name="tensanpham" placehoder="T??n s???n ph???m"><br>
                        <label for="">???nh ch??nh</label>
                        <input type="file" class="form-control" name="hinhanh"><br>
                        <label for="">H??nh ???nh Zoom 1</label>
                        <input type="file" class="form-control" name="hinhanhzoom1"><br>
                        <label for="">H??nh ???nh Zoom 2</label>
                        <input type="file" class="form-control" name="hinhanhzoom2"><br>
                        <label for="">Gi??</label>
                        <input type="text" class="form-control" name="gia" placehoder="Gi?? s???n ph???m"><br>
                        <label for="">Gi?? khuy???n m??i</label>
                        <input type="text" class="form-control" name="giakhuyenmai" placehoder="T??n s???n ph???m"><br>
                        <label for="">S??? l?????ng</label>
                        <input type="text" class="form-control" name="soluong" placehoder="s??? l?????ng"><br>
                        <label for="">M?? t???</label>
                        <textarea name="mota" cols="30" rows="10" class="form-control"></textarea><br>
                        <label for="">Chi ti???t</label>
                        <textarea name="chitiet" cols="30" rows="10" class="form-control"></textarea><br>
                        <label for="">Danh m???c</label>
                        <?php
                        $sql_danhmuc=mysqli_query($con,"select * from tb_loaisanpham order by loaisp_id desc")
                        ?>
                        <select name="danhmuc" id="" class="form-control">
                        <option value="">----Ch???n danh m???c-----</option>
                        <?php
                        while($row_danhmuc=mysqli_fetch_array($sql_danhmuc)){
                        ?>
                        <option value="<?php echo $row_danhmuc['loaisp_id'] ?>"><?php echo $row_danhmuc['tenloai_sp'] ?></option>
                        <?php
                        }
                        ?>
                        </select><br>
                        <input type="submit" name="themsanpham" value="Th??m s???n ph???m" class="btn btn-default">
                    </form>
            </div>
            <?php
            }
            ?>
    
            <div class="col-md-9">

                <h4>Li???t k?? s???n ph???m</h4>
                <?php
                 $sql_select_sp = mysqli_query($con,"select * from tb_sp,tb_loaisanpham where tb_sp.loaisp_id=tb_loaisanpham.loaisp_id 
                 order by tb_sp.sanpham_id desc");
                ?>
                <table class="table table-reponsive table-bordered">
                    <tr>
                        <th>Th??? t???</th>
                        <th>T??n s???n ph???m</th>
                        <th>H??nh ???nh</th>
                        <th>danh m???c</th>
                        <th>Gi?? s???n ph???m</th>
                        <th>Gi?? Khuy???n m??i</th>
                        <th>s??? l?????ng</th>
                        <th>Qu???n l??</th>
                    </tr>
                    <?php
                        $i=0;
                        while($row_sanpham = mysqli_fetch_array($sql_select_sp)){
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row_sanpham['sanpham_name'] ?></td>
                        <td> <img src="../uploads/<?php echo $row_sanpham['sanpham_img'] ?>" alt="" height="80" width="80"></td>
                        <td><?php echo $row_sanpham['tenloai_sp'] ?></td>
                        <td><?php echo $row_sanpham['sanpham_gia'] ?>??</td>
                        <td><?php echo $row_sanpham['sanpham_giakm'] ?>??</td>
                        <td><?php echo $row_sanpham['sanpham_soluong'] ?></td>
                        <td><a href="?xoa=<?php echo $row_sanpham['sanpham_id'] ?>">X??a</a> ||
                         <a href="xulysanpham.php?quanly=capnhat&capnhat_id=<?php echo $row_sanpham['sanpham_id'] ?>">C???p nh???t</a></td>
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