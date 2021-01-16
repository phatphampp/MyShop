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
    <title>Cart Page - Ustora Demo</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
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
                            <li><a href="#"><i class="fa fa-user"></i> My Account</a></li>
                            <li><a href="./login/login.php"><i class="fa fa-user"></i> Login</a></li>
                            <li><a href="./createAccount/index.php"><i class="fa fa-user"></i> Create Account</a></li>                            
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
                        <li class="active"><a href="">Cart</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="createorder.php">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(!empty($_SESSION["cart_item"])) {
        
                                                foreach ($_SESSION["cart_item"] as $item){
                                                    ?>
                                                    <tr class="cart_item">
                                            <td class="product-remove">
                                                <a title="Remove this item" class="remove" href="carthandler.php?action=remove&ProductId=<?php echo $item["ProductId"]; ?>">×</a> 
                                            </td>

                                            <td class="product-thumbnail">
                                                <img src="img/Products/<?php  echo $item["ProductImage"]?>" alt="">
                                            </td>

                                            <td class="product-name">
                                                <a href="single-product.html"><?php  echo $item["ProductName"]?></a> 
                                            </td>

                                            <td class="product-price">
                                                <span class="amount"><?php  echo $item["ProductPrice"]?></span> 
                                            </td>

                                            <td class="product-quantity">
                                                <span class="amount"><?php  echo $item["Quantity"]?></span>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount"><?php  echo $item["Quantity"] * $item["ProductPrice"]?></span> 
                                            </td>
                                        </tr>
                                        <?php 
                                                }}
                                        ?>
                                        
                                        <tr>
                                            <td class="actions" colspan="6">
                                                <input type="submit" value="Buy" name="proceed" class="checkout-button button alt wc-forward" >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>

                                <div class="cart-collaterals">
                                <div class="cart_totals ">
                                    <h2>Cart Totals</h2>

                                    <table cellspacing="0">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">$<?php echo $item_price?></span></td>
                                            </tr>

                                            <tr class="shipping">
                                                <th>Shipping and Handling</th>
                                                <td>Free Shipping</td>
                                            </tr>

                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount">$<?php echo $item_price?></span></strong> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
                        <h2>u<span>Stora</span></h2>
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
