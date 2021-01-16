<?php
    session_start();
?>
<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHM Store</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <link rel="icon" type="image/png" href="img/logo.png"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

  </head>
  <body>
    <!-- Lấy thông tin 10 sản phẩm mới nhất -->
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

    $sql = "call GetTopTenBestSellersProduct();";
    $result = $connect->query($sql);
    
    $BestSellingProducts = $result->fetch_all(MYSQLI_BOTH);
    $result->close();
    //Đóng database
	$connect->close();                 
  ?>
  <?php

    // Kết nối database tintuc
    $connect = new mysqli($server, $username, $password, $dbname);

    //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
    if ($connect->connect_error) {
        die("Không kết nối :" . $connect->connect_error);
        exit();
    }

    $sql = "call GetTopTenLatestProduct();";
    $result = $connect->query($sql);
    
    $LatestProducts= $result->fetch_all(MYSQLI_BOTH);
    $result->close();
    //Đóng database
	$connect->close();                        
  ?> 
  <?php 
    if(isset($_SESSION["cart_item"]))
    {
        $item_price = $_SESSION["item_price"];
        $item_quantity = $_SESSION["item_quantity"];
    }else{
        $item_price = 0;
        $item_quantity = 0;
    }
  ?>          
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            
                            <?php 
                                if(isset($_SESSION["userId"]))
                                {
                                    ?>
                                    <li>
                                        <a href="customer-account/profile.php">
                                            <i class="fa fa-user"></i> 
                                            <?php 
                                                $tmp = $_SESSION["CustomerUserName"];
                                                echo $tmp;
                                            ?>
                                        </a>
                                    </li>
                                <?php
                                }
                                else{
                                    
                                    ?>
                                    <li><a href="./login/login.php"><i class="fa fa-user"></i> Login</a></li>
                                    <li><a href="./createAccount/index.php"><i class="fa fa-user"></i> Create Account</a></li>
                                    <?php
                                }
                            ?>                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="./"><img src="img/logo.png" ></a></h1>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="cart.php">Cart - <span class="cart-amunt">$<?php echo $item_price?></span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php echo $item_quantity?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="shop.php">Shop</a></li>
                        <li><a href="follow-producer.php?ProducerId=1">Adidas</a></li>
                        <li><a href="follow-producer.php?ProducerId=2">Nike</a></li>
                        <li><a href="follow-producer.php?ProducerId=3">Vans</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    
    <!-- <div class="slider-area">
			<div class="block-slider block-slider4">
				<ul class="" id="bxslider-home4">
					<li>
						<img src="img/Products/adidas01.jpg" alt="Slide">
						
					</li>
					<li>
                        <img src="img" alt="Slide">
						
					</li>
					<li>
                        <img src="img" alt="Slide">
						
					</li>
				</ul>
			</div>
    </div> -->
    
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        <div class="product-carousel">
                        <?php
     
                            for ($x = 0; $x < 5; $x++)
                            {
                                $row = $LatestProducts[$x];

                        ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="./img/Products/<?php echo $row["ProductImage"]?>" alt="">
                                    <div class="product-hover">
                                        <a href="carthandler.php?action=add&ProductId=<?php echo $row["ProductId"]; ?>&quantity=1" class="add-to-cart-link"><i class="fa fa-shopping-cart" ></i> Add to cart</a>
                                        <a href="single-product.php?ProductId=<?php echo $row["ProductId"]?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>
                                
                                <h2><a href="single-product.php?ProductId=<?php echo $row["ProductId"]?>"><?php echo $row["ProductName"]?></a></h2>
                                
                                <div class="product-carousel-price">
                                    <ins>$<?php echo $row["ProductPrice"]?></ins>
                                </div> 
                            </div>
                        <?php
                            }
                        ?>
                        </div>
                        <div class="product-carousel">
                            <?php
                                for ($x = 5; $x < 10; $x++)
                                {
                                $row = $LatestProducts[$x];
                            ?>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="./img/Products/<?php echo $row["ProductImage"]?>" alt="">
                                        <div class="product-hover">
                                            <a href="carthandler.php?action=add&ProductId=<?php echo $row["ProductId"]; ?>&quantity=1" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="single-product.php?ProductId=<?php echo $row["ProductId"]?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>
                                    
                                    <h2><a href="single-product.php?ProductId=<?php echo $row["ProductId"]?>"><?php echo $row["ProductName"]?></a></h2>
                                    
                                    <div class="product-carousel-price">
                                        <ins>$<?php echo $row["ProductPrice"]?></ins>
                                    </div> 
                                </div>
                            <?php }?>
                        </div>
                        <h2 class="section-title">Best Selling Products</h2>
                        <div class="product-carousel">
                        <?php 
                            for($x = 0; $x < 5; $x++)
                            {
                                $row = $BestSellingProducts[$x];
                            
                        ?>
                            <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="./img/Products/<?php echo $row["ProductImage"]?>" alt="">
                                        <div class="product-hover">
                                            <a href="carthandler.php?action=add&ProductId=<?php echo $row["ProductId"]; ?>&quantity=1" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="single-product.php?ProductId=<?php echo $row["ProductId"]?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>
                                    
                                    <h2><a href="single-product.php?ProductId=<?php echo $row["ProductId"]?>"><?php echo $row["ProductName"]?></a></h2>
                                    
                                    <div class="product-carousel-price">
                                        <ins>$<?php echo $row["ProductPrice"]?></ins>
                                    </div> 
                                </div>
                                <?php }?>
                        </div>
                        <div class="product-carousel">
                        <?php
                                for ($x = 5; $x < 10; $x++)
                                {
                                    $row = $BestSellingProducts[$x];
                                ?>
                            <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="./img/Products/<?php echo $row["ProductImage"]?>" alt="">
                                        <div class="product-hover">
                                            <a href="carthandler.php?action=add&ProductId=<?php echo $row["ProductId"]; ?>&quantity=1" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="single-product.php?ProductId=<?php echo $row["ProductId"]?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>
                                    
                                    <h2><a href="single-product.php?ProductId=<?php echo $row["ProductId"]?>"><?php echo $row["ProductName"]?></a></h2>
                                    
                                    <div class="product-carousel-price">
                                        <ins>$<?php echo $row["ProductPrice"]?></ins>
                                    </div> 
                                </div>
                                <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
    
    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2><span>PHM</span></h2>
                        <p>Website information: This is a project for web1 programming subject to practice with the guidance of teacher Tran Van Quy </p>
                        <p>Address: 227 Nguyen Van Cu, Ward 4, District 5, HCMC</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">User Navigation </h2>
                        <ul>
                            <li><a href="my-account.php">My account</a></li>
                            <li>
                                <p> Producer: Pham Thanh Phat</p>
                                <p> ID: 18600204 </p>
                            </li>
                            <li>
                                <p> Producer: Huynh Long Hai</p>
                                <p> ID: 18600005 </p>
                            </li>
                            <li>
                                <p> Producer: Nguyen Nhat Minh</p>
                                <p> ID: 18600168 </p>
                            </li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
                            <li><a href="shop.php">All products</a></li>
                            <li><a href="follow-producer.php?ProducerId=1">Adias</a></li>
                            <li><a href="follow-producer.php?ProducerId=2">Nike</a></li>
                            <li><a href="follow-producer.php?ProducerId=3">Vans</a></li>
                        </ul>                       
                    </div>
                </div>
                
                
                <div class="col-md-3 col-sm-6">
                <img src="./img/logohcmus.png" style="height: 70px; wight: 70px" >
                <p> Website HCMUS: <a href="https://www.hcmus.edu.vn/" target="_blank">hcmus.edu.vn </a></p>
                <p> Subject website: <a href ="https://courses.fit.hcmus.edu.vn/login/index.php" target="_blank">fit.hcmus.edu.vn</a> </p>
                </div>
                          
        </div>
    </div> <!-- End footer top area -->
    
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2020 Ustora Vietnam Company Limited <a href="http://www.freshdesignweb.com" target="_blank">freshDesignweb.com</a></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->
   
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="js/main.js"></script>
    
    <!-- Slider -->
    <script type="text/javascript" src="js/bxslider.min.js"></script>
	<script type="text/javascript" src="js/script.slider.js"></script>
  </body>
</html>
