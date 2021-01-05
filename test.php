<html>
    <head>
        <title>Demo Search Basic by freetuts.net</title>
    </head>
    <body>
        <div align="center">
            <form action="" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
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
        // Nếu người dùng submit form thì thực hiện
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
                $query = "select * from products where ProductName like '%$search%'";
 
                // Kết nối sql
                // PHẦN XỬ LÝ PHP
                        // BƯỚC 1: KẾT NỐI CSDL
                         
                // Thực thi câu truy vấn
                $sql = mysql_query($query);
 
                // Đếm số đong trả về trong sql.
                $num = mysql_num_rows($sql);
 
                // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
                if ($num > 0 && $search != "") 
                {
                    // Dùng $num để đếm số dòng trả về.
                    echo "$num ket qua tra ve voi tu khoa <b>$search</b>";
 
                    // Vòng lặp while & mysql_fetch_assoc dùng để lấy toàn bộ dữ liệu có trong table và trả về dữ liệu ở dạng array.
                    echo '<table border="1" cellspacing="0" cellpadding="10">';
                    while ($row = mysql_fetch_assoc($sql)) {
                        ?>
                        <div class="col-md-3 col-sm-6" style="height: 500px; width: 292px">
                                            <div class="single-shop-product">
                                                <div class="product-upper">
                                                    <img src="./img/Products/<?php echo $row["ProductImage"]?>" alt="">
                                                </div>
                                                <h2><a href=""><?php echo $row["ProductName"]?></a></h2>
                                                <div class="product-carousel-price">
                                                    <ins>$<?php echo $row["ProductPrice"]?></ins>
                                                </div>  
                                                
                                                <div class="product-option-shop">
                                                    <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
                                                </div>                       
                                            </div>
                                        </div>
                    <?php }
                    echo '</table>';
                } 
                else {
                    echo "Khong tim thay ket qua!";
                }
            }
        }
        ?>   
    </body>
</html>

if ($num > 0 && $search != "") 
                            {
                                // Dùng $num để đếm số dòng trả về.
                                
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    ?>
                                    <div class="col-md-3 col-sm-6" style="height: 500px; width: 292px">
                                                        <div class="single-shop-product">
                                                            <div class="product-upper">
                                                                <img src="./img/Products/<?php echo $row["ProductImage"]?>" alt="">
                                                            </div>
                                                            <h2><a href=""><?php echo $row["ProductName"]?></a></h2>
                                                            <div class="product-carousel-price">
                                                                <ins>$<?php echo $row["ProductPrice"]?></ins>
                                                            </div>  
                                                            
                                                            <div class="product-option-shop">
                                                                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
                                                            </div>                       
                                                        </div>
                                                    </div>
                                <?php }
                            } 
                            else {
                                echo "Khong tim thay ket qua!";
                            }