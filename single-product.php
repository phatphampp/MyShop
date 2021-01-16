<?php
    session_start();
?>
<!-- Thông tin giỏ hàng -->
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
<!-- Tăng lược xem -->
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
    $ProductId = $_REQUEST["ProductId"];

    $sql = "call IncreaseProductView($ProductId);";
    $result = $connect->query($sql);

    //Lấy giá trị POST từ form vừa submit
    $sql = "call GetProductDetailById($ProductId);";
    $result = $connect->query($sql);
    $row = mysqli_fetch_array($result);  
    $connect->close();
    
?>                        
<!-- Lấy thông tin sản phẩm cùng hãng-->
<?php 

    // Kết nối database tintuc
    $connect = new mysqli($server, $username, $password, $dbname);

    //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
    if ($connect->connect_error) {
        die("Không kết nối :" . $connect->connect_error);
        exit();
    }
    $sql = "call GetProductByProducerId($row[ProducerId]);";
    $result = $connect->query($sql);
    
    $ProducerProduct = $result->fetch_all(MYSQLI_BOTH);
    $result->close();
    //Đóng database
	$connect->close(); 
?>
<!-- Lấy thông tin sản phẩm liên quan-->
<?php 
    // Kết nối database tintuc
    $connect = new mysqli($server, $username, $password, $dbname);

    //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
    if ($connect->connect_error) {
        die("Không kết nối :" . $connect->connect_error);
        exit();
    }
    $sql = "call GetRelatedProduct($row[CategoryId], $row[ProducerId]);";
    $result = $connect->query($sql);
    
    $RelatedProduct = $result->fetch_all(MYSQLI_BOTH);
    $result->close();
    //Đóng database
	$connect->close(); 
?>
<!-- Lấy thông tin sản phẩm cùng loại-->
<?php 
    // Kết nối database tintuc
    $connect = new mysqli($server, $username, $password, $dbname);

    //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
    if ($connect->connect_error) {
        die("Không kết nối :" . $connect->connect_error);
        exit();
    }
    $sql = "call GetProductByCategoryId($row[CategoryId]);";
    $result = $connect->query($sql);
    
    $CateProduct = $result->fetch_all(MYSQLI_BOTH);
    $result->close();
    //Đóng database
	$connect->close(); 
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
    <title>PHM Store - Detail</title>
    
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
                        <h1><a href="./"><img src="img/logo.png"></a></h1>
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="shop.php">Shop</a></li>
                        <li><a href="follow-producer.php?ProducerId=1">Adidas</a></li>
                        <li><a href="follow-producer.php?ProducerId=2">Nike</a></li>
                        <li><a href="follow-producer.php?ProducerId=3">Vans</a></li>
                        <li class="active"><a href="">Detail</a></li>
                    </ul>
                </div>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Product Detail</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    
                    
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Same Producer</h2>
                        <?php 
                            foreach($ProducerProduct as $item)
                            {
                                ?>
                                     <div class="thubmnail-recent">
                                        <img src="img/Products/<?php echo $item["ProductImage"]; ?>" class="recent-thumb" alt="">
                                        <h2><a href="single-product.php?ProductId=<?php echo $item["ProductId"]?>"><?php echo $item["ProductName"]; ?></a></h2>
                                        <div class="product-sidebar-price">
                                            <ins>$<?php echo $item["ProductPrice"]?></ins>
                                        </div>                             
                                    </div>
                                <?php
                            }
                        ?>

                    </div>
                    
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Same Category</h2>
                        <ul>
                            <?php 
                                foreach($CateProduct as $item)
                                {
                                    ?>
                                        <li><a href="single-product.php?ProductId=<?php echo $item["ProductId"]?>"><?php echo $item["ProductName"]?></a></li>
                                    <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="img/Products/<?php  echo $row["ProductImage"]?>" alt="">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name"><?php  echo $row["ProductName"]?></h2>
                                    <div class="product-inner-price">
                                        <ins>$<?php  echo $row["ProductPrice"]?></ins>
                                    </div>    
                                    
                                    <form action="carthandler.php" class="cart" method="GET">
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1" >
                                            <input type="text" value="add" name="action" hidden>
                                            <input type="text" value="<?php echo $row["ProductId"]; ?>" name="ProductId" hidden>
                                        </div>
                                        <button class="add_to_cart_button" type="submit">Add to cart</button>
                                    </form>   
                                    
                                    <div class="product-inner-category">
                                        <p>Category: <a><?php echo $row["CategoryName"]; ?></a> | 
                                            View: <a><?php echo $row["ProductView"]; ?></a> </p>
                                    </div> 
                                    
                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>  
                                                <p><?php  echo $row["ProductDescription"]?></p>
                                                </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                    <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                    <div class="rating-chooser">
                                                        <p>Your rating</p>

                                                        <div class="rating-wrap-post">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Related Products</h2>
                            <div class="related-products-carousel">
                                <?php 
                                    foreach($RelatedProduct as $item)
                                    {
                                        ?>
                                        <div class="single-product">
                                            <div class="product-f-image">
                                                <img src="img/Products/<?php echo $item["ProductImage"]?>" alt="">
                                                <div class="product-hover">
                                                    <a href="carthandler.php?action=add&ProductId=<?php echo $item["ProductId"]; ?>&quantity=1" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                                    <a href="single-product.php?ProductId=<?php echo $item["ProductId"]?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                                </div>
                                            </div>

                                            <h2><a href="single-product.php?ProductId=<?php echo $item["ProductId"]?>"><?php echo $item["ProductName"]; ?></a></h2>

                                            <div class="product-carousel-price">
                                                <ins>$<?php echo $item["ProductPrice"]?></ins>
                                            </div> 
                                        </div>                                        
                                        <?php
                                    }
                                ?>
                                                                    
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>


   
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
