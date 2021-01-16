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
    if (!isset($_SESSION["userId"]))
    {
        header("Location: login/login.php");
        exit();
    } elseif (!empty($_SESSION["cart_item"])) {  
        $sql = "INSERT INTO Orders (CustomerId, StateId)
                VALUES (".$_SESSION["userId"].", 1);";

        
        if ($connect->query($sql) === TRUE) {
            echo "Successful";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
            exit;
        }
        $sql = "call GetNewOrder();";
        $result = $connect->query($sql);
        $row = mysqli_fetch_array($result);
        $orderid = $row["OrderId"]; 
        $sql ="";
        foreach ($_SESSION["cart_item"] as $item){
            $sql .= "INSERT INTO OrderDetails (OrderId, ProductId, Quantity, UnitPrice)
                    VALUES (".$orderid.", ".$item["ProductId"].", ".$item["Quantity"].", ".$item["ProductPrice"].");";
        }
        for(; mysqli_next_result($connect) == 0;) 
        /* do nothing */;

        if ($connect->multi_query($sql) === TRUE) {
            unset($_SESSION["cart_item"]);
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
            exit;
        }
    }
    else {
        exit();
    }
    
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ustora Demo</title>
        
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
        <div class="jumbotron text-center">
            <h1 class="display-3">Thank You!</h1>
            <p class="lead"><strong>Please check your email</strong> for further instructions on how to complete your account setup.</p>
            <hr>
            <p class="lead">
                <a class="btn btn-primary btn-sm" href="index.php" role="button">Continue to homepage</a>
            </p>
        </div>
    </body>
</html>
