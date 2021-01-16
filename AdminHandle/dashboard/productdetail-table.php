<?php
session_start();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, Ample lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Ample admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>PHM Store - Dashboard</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="../../img/logo.png"/>

    <!-- Custom CSS -->
   <link href="css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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
            die("Không kết nối :" . $connect->connect_error);
            exit();
        }
        $ProductId = $_REQUEST["ProductId"];
        if (isset($_POST['update'])){
            $name = $_POST['prodname'];
            $quantity = $_POST['prodquantity'];
            $price = $_POST['prodprice'];
            $discription = $_POST['proddiscription'];
            $category = $_POST['prodcategory'];
            $origin = $_POST['prodorigin'];
            $producer = $_POST['prodproducer'];

            $sql = "UPDATE products
                    SET ProductName = '$name', ProductQuantity =$quantity, ProductPrice=$price, ProductDescription='$discription',
                        CategoryId = $category, OriginId = $origin, ProducerId = $producer
                    where ProductId = $ProductId;";

			if ($connect->query($sql) === TRUE) {
				echo "Successful";
			} else {
				echo "Error: " . $sql . "<br>" . $connect->error;
			}
            header("Location: product-table.php");
        } elseif (isset($_POST['delete'])) {   
            $id = $_POST['prodid'];                    
            $sql = "DELETE from products where ProductId = $ProductId;";
            if ($connect->query($sql) === TRUE) {
                echo "Successful";
            } else {
                echo "Error: " . $sql . "<br>" . $connect->error;
            }

            header("Location: product-table.php");
        } elseif (isset($_POST['cancel'])) { 
            header("Location: product-table.php");
        }
        
        //Upload image file
        if (isset($_POST['confirmfile'])){
            $target_dir = "../../img/Products/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image            
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $img = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
                    $sql = "UPDATE products
                            SET ProductImage = '$img'
                            where ProductId = $ProductId;";

                    if ($connect->query($sql) === TRUE) {
                        //echo "Successful";
                    } else {
                        echo "Error: " . $sql . "<br>" . $connect->error;
                    }
                } else {
                echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        
        
        
        $sql = "call GetProductDetailById($ProductId);";
        $result = $connect->query($sql);
        $prodRow = mysqli_fetch_array($result);
        $result->close();

	    //Đóng database
	    $connect->close();
    ?>
    <!-- Lấy thông tin đăng nhập-->
    <?php
        
        // Kết nối database tintuc
        $connect = new mysqli($server, $username, $password, $dbname);
        
        //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
        if ($connect->connect_error) {
            die("Không kết nối :" . $connect->connect_error);
            exit();
        }

        $curr_user = $_SESSION['login_user'];

        $sql = "call GetEmployeeDetailByUsername('$curr_user');";
        $result = $connect->query($sql);            
        $row = mysqli_fetch_array($result);
        $result->close();
	    //Đóng database
	    $connect->close();
    ?>
    <!-- Lấy thông tin categories-->
    <?php        
        // Kết nối database tintuc
        $connect = new mysqli($server, $username, $password, $dbname);
        
        //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
        if ($connect->connect_error) {
            die("Không kết nối :" . $connect->connect_error);
            exit();
        }
        $curr_user = $_SESSION['login_user'];

        $sql = "select * from categories;";
        $result = $connect->query($sql);
        $categories = $result->fetch_all(MYSQLI_BOTH);
        $result->close();
	    //Đóng database
	    $connect->close();
    ?>
    <!-- Lấy thông tin origins-->
    <?php        
        // Kết nối database tintuc
        $connect = new mysqli($server, $username, $password, $dbname);
        
        //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
        if ($connect->connect_error) {
            die("Không kết nối :" . $connect->connect_error);
            exit();
        }
        $curr_user = $_SESSION['login_user'];

        $sql = "select * from origins;";
        $result = $connect->query($sql);
        $origins = $result->fetch_all(MYSQLI_BOTH);
        $result->close();
	    //Đóng database
	    $connect->close();
    ?>
    <!-- Lấy thông tin producers-->
    <?php        
        // Kết nối database tintuc
        $connect = new mysqli($server, $username, $password, $dbname);
        
        //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
        if ($connect->connect_error) {
            die("Không kết nối :" . $connect->connect_error);
            exit();
        }
        $curr_user = $_SESSION['login_user'];

        $sql = "select * from producers;";
        $result = $connect->query($sql);
        $producers = $result->fetch_all(MYSQLI_BOTH);
        $result->close();
	    //Đóng database
	    $connect->close();
    ?>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="plugins/images/logo-icon.png" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="plugins/images/logo-text.png" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ml-auto d-flex align-items-center">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="#"><span class="text-white font-medium"><?php  echo $row["EmployeeUsername"]?></span></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="profile.php" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                        </li>
                        <li class="sidebar-item  selected"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="product-table.php" aria-expanded="false"><i class="fa fa-table"
                                    aria-hidden="true"></i><span class="hide-menu">Products</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="category-table.php" aria-expanded="false"><i class="fa fa-table"
                                    aria-hidden="true"></i><span class="hide-menu">Categories</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="producer-table.php" aria-expanded="false"><i class="fa fa-table"
                                    aria-hidden="true"></i><span class="hide-menu">Producers</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="customer-table.php" aria-expanded="false"><i class="fa fa-font"
                                    aria-hidden="true"></i><span class="hide-menu">Customer</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="orders-table.php" aria-expanded="false"><i class="fa fa-globe"
                                    aria-hidden="true"></i><span class="hide-menu">Orders</span></a></li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Edit product</h4>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="white-box">
                            <div class="user-bg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <img src="../../img/Products/<?php  echo $prodRow["ProductImage"]?>"
                                                class="thumb-lg img-circle" alt="img">
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box mt-5 d-md-flex text-center">
                                <form action="" method="post" enctype="multipart/form-data">
                                    Select image to upload:
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                    <input class="btn btn-success" type="submit" value="Confirm Image" name="confirmfile">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="" method="post">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">ID</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input disabled type="text" name="prodid" value ="<?php  echo $prodRow["ProductId"]?>"
                                                class="form-control p-0 border-0"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="prodname" value ="<?php  echo $prodRow["ProductName"]?>"
                                                class="form-control p-0 border-0"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">View</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="prodview" type="text" disabled value ="<?php  echo $prodRow["ProductView"]?>" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Quantity</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="prodquantity" type="text" value ="<?php  echo $prodRow["ProductQuantity"]?>" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Price</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="prodprice" type="text" value ="<?php  echo $prodRow["ProductPrice"]?>" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Description</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input name="proddiscription" type="text" value ="<?php  echo $prodRow["ProductDescription"]?>" class="form-control p-0 border-0">
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Categoty</label>
                                        <div class="col-md-12 border-bottom">
                                            <select name="prodcategory" class="form-control p-0 border-0">
                                                <?php foreach($categories as $cat) 
                                                {
                                                    if ($prodRow["CategoryId"] == $cat["CategoryId"])
                                                    {
                                                        echo "<option selected value='".$cat["CategoryId"]."'>".$cat["CategoryName"]."</option>";
                                                    } else {
                                                        echo "<option value='".$cat["CategoryId"]."'>".$cat["CategoryName"]."</option>";
                                                    }                                                    
                                                }?>                                                    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Origin</label>
                                        <div class="col-md-12 border-bottom">
                                            <select name="prodorigin" class="form-control p-0 border-0">
                                                <?php foreach($origins as $ori) 
                                                {
                                                    if ($prodRow["OriginId"] == $ori["OriginId"])
                                                    {
                                                        echo "<option selected value='".$ori["OriginId"]."'>".$ori["OriginName"]."</option>";
                                                    } else {
                                                        echo "<option value='".$ori["OriginId"]."'>".$ori["OriginName"]."</option>";
                                                    }                                                    
                                                }?>                                                    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Producer</label>
                                        <div class="col-md-12 border-bottom">
                                            <select name="prodproducer" class="form-control p-0 border-0">
                                                <?php foreach($producers as $prc)
                                                {
                                                    if ($prodRow["ProducerId"] == $prc["ProducerId"])
                                                    {
                                                        echo "<option selected value='".$prc["ProducerId"]."'>".$prc["ProducerName"]."</option>";
                                                    } else {
                                                        echo "<option value='".$prc["ProducerId"]."'>".$prc["ProducerName"]."</option>";
                                                    }                                                    
                                                }?>                                                    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-6 col-md-12 col-lg-3">
                                            <input type="submit" name="cancel" class="btn btn-success" value="Cancel"></input>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-3">
                                            <input type="submit" name="delete" class="btn btn-success" value="Delete"></input>
                                        </div>
                                        <div class="col-sm-6 col-md-12 col-lg-3">
                                            <input type="submit" name="update" class="btn btn-success" value="Update"></input>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2020 © Ample Admin brought to you by <a
                    href="https://www.wrappixel.com/">wrappixel.com</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="plugins/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
</body>

</html>