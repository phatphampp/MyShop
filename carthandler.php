<?php
    session_start();
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
        
    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "add":
                if(!empty($_GET["quantity"])) {
                    $sql = "SELECT * FROM Products WHERE ProductId=".$_GET["ProductId"].";";
                    $result = $connect->query($sql);
                    while($row=mysqli_fetch_assoc($result)) {
                        $resultset[] = $row;
                    }
                    $productByCode = $resultset;
                    $itemArray = array($productByCode[0]["ProductId"]=>array('ProductName'=>$productByCode[0]["ProductName"], 
                                                                                'ProductId'=>$productByCode[0]["ProductId"], 
                                                                                'Quantity'=>$_GET["quantity"], 
                                                                                'ProductPrice'=>$productByCode[0]["ProductPrice"], 
                                                                                'ProductImage'=>$productByCode[0]["ProductImage"]));
                    
                    if(!empty($_SESSION["cart_item"])) {
                        $flag = TRUE;
                        foreach($_SESSION["cart_item"] as $k => $v) {
                                if($productByCode[0]["ProductId"] == $v["ProductId"]) {
                                    if(empty($_SESSION["cart_item"][$k]["Quantity"])) {
                                        $_SESSION["cart_item"][$k]["Quantity"] = 0;
                                    }
                                    $_SESSION["cart_item"][$k]["Quantity"] += $_GET["quantity"];

                                    $flag = FALSE;
                                }
                        }
                        if ($flag == TRUE) {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
            break;
            case "remove":
                if(!empty($_SESSION["cart_item"])) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_GET["ProductId"] == $v["ProductId"])
                                unset($_SESSION["cart_item"][$k]);				
                            if(empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);
                    }
                }
            break;
            case "empty":
                unset($_SESSION["cart_item"]);
            break;	
        }
    }
    $item_price = 0;
    $item_quantity = 0;
    if(!empty($_SESSION["cart_item"])) {    
        foreach ($_SESSION["cart_item"] as $item){
            $item_price += $item["Quantity"]*$item["ProductPrice"];
            $item_quantity = $item_quantity + $item["Quantity"];
        }
    }
    $_SESSION["item_price"] = $item_price;
    $_SESSION["item_quantity"] = $item_quantity;

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
?>