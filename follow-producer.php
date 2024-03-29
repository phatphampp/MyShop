<?php
    session_start();
?>
<?php 
    $ProducerId = $_REQUEST["ProducerId"];
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
    <?php 
        // PHẦN XỬ LÝ PHP
        // BƯỚC 1: KẾT NỐI CSDL
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
                <div class="col-sm-3">
                    <div class="logo">
                        <h1><a href="./"><img src="img/logo.png"></a></h1>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div>
                        <form action="" method="get">
                            <input type="text" value=<?php echo $ProducerId;?> name="ProducerId" hidden/>
                            <input type="text" name="search" placeholder="Search products..."/>
                            <input type="submit" name="ok" value="search" />
                        </form>
                    </div> 
                    

                </div>
                <div class="col-sm-3">
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
                        <?php 
                            if($ProducerId == 1)
                            {
                                echo '<li class="active"><a href="follow-producer.php?ProducerId=1">Adidas</a></li>';
                                echo '<li><a href="follow-producer.php?ProducerId=2">Nike</a></li>';
                                echo '<li><a href="follow-producer.php?ProducerId=3">Vans</a></li>';
                            }
                            elseif ($ProducerId == 2) {
                                echo '<li><a href="follow-producer.php?ProducerId=1">Adidas</a></li>';
                                echo '<li class="active"><a href="follow-producer.php?ProducerId=2">Nike</a></li>';
                                echo '<li><a href="follow-producer.php?ProducerId=3">Vans</a></li>';
                            }
                            else{
                                echo '<li><a href="follow-producer.php?ProducerId=1">Adidas</a></li>';
                                echo '<li><a href="follow-producer.php?ProducerId=2">Nike</a></li>';
                                echo '<li class="active"><a href="follow-producer.php?ProducerId=3">Vans</a></li>';
                            }
                        ?>
                        
                        
                        
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
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <?php 
                // BƯỚC 2: TÌM TỔNG SỐ RECORDS
                $result = mysqli_query($connect, "select count(ProductId) as total from products where ProducerId=$ProducerId");
                $row = mysqli_fetch_assoc($result);
                $total_records = $row['total'];
        
                // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $limit = 8;
        
                // BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
                // tổng số trang
                $total_page = ceil($total_records / $limit);
        
                // Giới hạn current_page trong khoảng 1 đến total_page
                if ($current_page > $total_page){
                    $current_page = $total_page;
                }
                else if ($current_page < 1){
                    $current_page = 1;
                }
        
                // Tìm Start
                $start = ($current_page - 1) * $limit;
        
                // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
                // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
                $result = mysqli_query($connect, "SELECT * FROM products Where ProducerId=$ProducerId LIMIT $start, $limit");
            ?>
            <div class="row">
            
            <?php 
            if (isset($_REQUEST['ok'])) 
            {
                // Gán hàm addslashes để chống sql injection
                $search = addslashes($_GET['search']);
     
                // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
                if (empty($search)) {
                    echo "Yeu cau nhap du lieu vao o trong";
                } 
                else
                {
                    // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
                    // $query = "select * from products where ProductName like '%$search%'";
                             
                    // Thực thi câu truy vấn
                    // $sql = mysql_query($query);
                    $sql = $connect -> query("select * from products where ProducerId = $ProducerId and ProductName like '%$search%'");
                    // Đếm số đong trả về trong sql.
                    $num = mysqli_num_rows($sql);
     
                    // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
                    if ($num > 0 && $search != "") 
                    {?>
                        <h3>Search results</h3>
                    <?php    // Dùng $num để đếm số dòng trả về.
                        
                        while ($row = mysqli_fetch_assoc($sql)) {
                            ?>
                            <div class="col-md-3 col-sm-6" style="height: 500px; width: 292px">
                                <div class="single-shop-product">
                                    <div class="product-upper">
                                        <img src="./img/Products/<?php echo $row["ProductImage"]?>" alt="">
                                    </div>
                                    <h2><a href="single-product.php?ProductId=<?php echo $row["ProductId"]?>"><?php echo $row["ProductName"]?></a></h2>
                                    <div class="product-carousel-price">
                                        <ins>$<?php echo $row["ProductPrice"]?></ins>
                                    </div>                                              
                                    <div class="product-option-shop">
                                        <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="carthandler.php?action=add&ProductId=<?php echo $row["ProductId"]; ?>&quantity=1">Add to cart</a>
                                    </div>                       
                                </div>
                            </div>
                        <?php }
                    } 
                    else {
                        echo "Khong tim thay ket qua!";
                    }
                }
            }  
            ?>
            </div>
            <div class="row">
            <h3>Products</h3>
            <?php    
                while ($row = mysqli_fetch_array($result))
                {
            ?>
                <div class="col-md-3 col-sm-6" style="height: 500px; width: 292px">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="./img/Products/<?php echo $row["ProductImage"]?>" alt="">
                        </div>
                        <h2><a href="single-product.php?ProductId=<?php echo $row["ProductId"]?>"><?php echo $row["ProductName"]?></a></h2>
                        <div class="product-carousel-price">
                            <ins>$<?php echo $row["ProductPrice"]?></ins>
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="carthandler.php?action=add&ProductId=<?php echo $row["ProductId"]; ?>&quantity=1">Add to cart</a>
                        </div>                       
                    </div>
                </div>
                <?php }?>
        </div>
        <div class="pagination">
           <?php 
            // PHẦN HIỂN THỊ PHÂN TRANG
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG
 
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($current_page > 1 && $total_page > 1){
                echo '<a href="follow-producer.php?ProducerId='.$ProducerId.'&page='.($current_page-1).'">Prev</a> | ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page){
                    echo '<span>'.$i.'</span> | ';
                }
                else{
                    echo '<a href="follow-producer.php?ProducerId='.$ProducerId.'&page='.$i.'">'.$i.'</a> | ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="follow-producer.php?ProducerId='.$ProducerId.'&page='.($current_page+1).'">Next</a> | ';
            }
           ?>
        </div>
           
        <!-- </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        <nav>
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>                        
                    </div>
                </div>
            </div>
        </div> -->
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
