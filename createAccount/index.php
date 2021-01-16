<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>PHM Store - Create Account</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../img/logo.png"/>

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<?php
		$username = "root"; // Khai báo username
		$password = "";      // Khai báo password
		$server   = "localhost";   // Khai báo server
		$dbname   = "vehicles_store";      // Khai báo database

		// Kết nối database tintuc
		$connect = new mysqli($server, $username, $password, $dbname);

		//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
		if ($connect->connect_error) {
			die("Không kết nối :" . $conn->connect_error);
			exit();
		}

		//Khai báo giá trị ban đầu, nếu không có thì khi chưa submit câu lệnh insert sẽ báo lỗi
		$CustomerFullName = "";
		$CustomerAddress = "";
		$CustomerTel = "";
		$CustomerUsername = "";
		$CustomerPassword = "";
		
		$cur_captcha = chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90));


		//Lấy giá trị POST từ form vừa submit
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_SESSION["captcha"]))
			{
				if ($_SESSION["captcha"] == $_POST["captcha"]) {
					if(isset($_POST["fullname"])) { $CustomerFullName = $_POST['fullname']; }
					if(isset($_POST["address"])) { $CustomerAddress = $_POST['address']; }
					if(isset($_POST["telephone"])) { $CustomerTel = $_POST['telephone']; }
					if(isset($_POST["username"])) { $CustomerUsername = $_POST['username']; }
					if(isset($_POST["password"])) { $CustomerPassword = $_POST['password']; }
					
					$CustomerPassword = md5($CustomerPassword);
	
					//Code xử lý, insert dữ liệu vào table
					$sql = "INSERT INTO customers (CustomerFullName, CustomerAddress, CustomerTel, CustomerUsername, CustomerPassword)
					VALUES ('$CustomerFullName', '$CustomerAddress', '$CustomerTel', '$CustomerUsername', '$CustomerPassword')";
	
					if ($connect->query($sql) === TRUE) {
						echo '<script language="javascript">';
						echo 'alert("Wellcome '.$CustomerUsername.' To Store!!!")';
						echo '</script>';
					} else {
						echo "Error: " . $sql . "<br>" . $connect->error;
					}
				} else {
					echo '<script language="javascript">';
					echo 'alert("Captcha is invalid!!!")';
					echo '</script>';
				}
			}

			
		}

		$_SESSION["captcha"] = $cur_captcha;
		//Đóng database
		$connect->close();
	?>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" action="" method="post">
					<span class="login100-form-title p-b-33">
						Create Account
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="fullname" placeholder="Fullname">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input">
						<input class="input100" type="text" name="address" placeholder="Address">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input">
						<input class="input100" type="tel" name="telephone" placeholder="Telephone" pattern="[0-9]{10}"> 
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>


					<div class="wrap-input100 rs1 validate-input">
						Captcha: <label for="captcha" class="captcha"><?php echo $cur_captcha?></label>

						<input class="input100" type="text" name="captcha" placeholder="Enter captcha">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn">
							Sign up
						</button>
					</div>
					<div class="text-center">
						<span class="txt1">
							Already signed up?
						</span>

						<a href="../login/login.php" class="txt2 hov1">
							Log in
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>