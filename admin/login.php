<?php
include('../db/connect.php');

?>

<?php
	if(isset($_POST['dangnhap'])){
		$taikhoan=$_POST['taikhoan'];
		$password=md5($_POST['adminpass']);
		if($taikhoan=='' || $password==''){
			echo '<p> Xin nhập đủ </p>';
		}else{
			$sql_select_admin=mysqli_query($con,"select * from tb_dmin where adminemail='$taikhoan' and
			adminpass='$password' limit 1");
			$count=mysqli_num_rows($sql_select_admin);
			if($count > 0){
				header('Location: xulydanhmuc.php');
			}else {
				echo '<p> Tài khoản hoặc mật khẩu sai </p>';
			}
			
		}

	}

?>

<!DOCTYPE html>
<html>

<!-- Head -->
<head>

<title>ADMIN</title>

<!-- Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- //Meta-Tags -->

	<link href="../css/pop-box.css" rel="stylesheet" type="text/css" media="all" />

	 <link rel="stylesheet" href="../css/styles.css" type="text/css" media="all">

 	<link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
<!-- //Fonts -->

</head>

<body>

	<h1>ĐĂNG NHẬP ADMIN</h1>
	<div class="w3layoutscontaineragileits">
	<h2>Login here</h2>
		<form action="login.php" method="post">
			<input type="email" name="taikhoan" placeholder="EMAIL" required="" class="form-control">
			<input type="password" name="adminpass" placeholder="PASSWORD" required=""  class="form-control">
			<ul class="agileinfotickwthree">
				<li>
					<input type="checkbox" id="brand1" value="">
					<label for="brand1"><span></span>Remember me</label>
					<a href="#">Forgot password?</a>
				</li>
			</ul>
			<div class="aitssendbuttonw3ls">
				<input type="submit" value="LOGIN" name="dangnhap">
			</div>
		</form>
</div>



</body>
<!-- //Body -->

</html>