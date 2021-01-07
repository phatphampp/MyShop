DELIMITER $	
CREATE PROCEDURE GetProductDetailById(in ProdId int)
BEGIN
	select * from products as p, categories as c, origins as o, producers as pc
    where p.ProductId = ProdId and p.CategoryId = c.CategoryId and p.OriginId = o.OriginId and p.ProducerId = pc.ProducerID;
END $
DELIMITER ; 

DELIMITER $	
CREATE PROCEDURE GetTopTenLatestProduct()
BEGIN
	select *
    from products
    order by ProductId DESC
    limit 10;
END $
DELIMITER ; 
/*	call GetTopTenLatestProduct();	*/


DELIMITER $	
CREATE PROCEDURE GetTopTenBestSellersProduct()
BEGIN
	select p.*
    from Products as p, (select ProductId, SUM(Quantity) as TotalSold
					from OrderDetails 
					group by ProductId
					Order By TotalSold desc
					Limit 10) as temp
	where p.ProductId = temp.ProductId;
END $
DELIMITER ; 

DELIMITER $	
CREATE PROCEDURE GetEmployeeDetailByUsername(in username nvarchar(200))
BEGIN
	select * from employees
    where EmployeeUsername = username;
END $
DELIMITER ;

DELIMITER $	
CREATE PROCEDURE GetProductByKeyWord(in KeyWord nvarchar(200))
BEGIN
	select * from products as p, categories as c, origins as o, producers as pc
    where p.CategoryId = c.CategoryId and p.OriginId = o.OriginId and p.ProducerId = pc.ProducerID and p.ProductName like KeyWord;
END $
DELIMITER ; 

DELIMITER $	
CREATE PROCEDURE GetCategoryByKeyWord(in KeyWord nvarchar(200))
BEGIN
	select * from categories as c
    where c.CategoryName like KeyWord;
END $
DELIMITER ; 

DELIMITER $	
CREATE PROCEDURE GetCategoryDetailById(in CatId int)
BEGIN
	select * from categories
    where CategoryId = CatId;
END $
DELIMITER ; 

DELIMITER $	
CREATE PROCEDURE GetProducerByKeyWord(in KeyWord nvarchar(200))
BEGIN
	select * from producers
    where ProducerName like KeyWord;
END $
DELIMITER ; 

DELIMITER $	
CREATE PROCEDURE GetProducerDetailById(in PrcId int)
BEGIN
	select * from producers
    where ProducerId = PrcId;
END $
DELIMITER ; 

DELIMITER $	
CREATE PROCEDURE GetCustomerByKeyWord(in KeyWord nvarchar(200))
BEGIN
	select * from customers
    where CustomerFullName like KeyWord;
END $
DELIMITER ; 

DELIMITER $	
CREATE PROCEDURE GetCustomerDetailById(in CusId int)
BEGIN
	select * from customers
    where CustomerId = CusId;
END $
DELIMITER ; 


delimiter |
CREATE TRIGGER tg_UpdateTotalPrice after INSERT ON orderdetails
  FOR EACH ROW
  BEGIN    
    UPDATE orders 
    SET TotalPrice = (select sum(od.SubTotalPrice) from orderdetails as od where od.OrderId = NEW.OrderId)
    WHERE OrderId = NEW.OrderId;
  END;
|
delimiter ;

DELIMITER $	
CREATE PROCEDURE GetOrderByKeyWord(in KeyWord nvarchar(200))
BEGIN
	select * from orders as o, customers as c, orderstate as os
    where o.CustomerId = c.CustomerId and o.StateId = os.StateId and c.CustomerFullName like KeyWord;
END $
DELIMITER ; 

DELIMITER $	
CREATE PROCEDURE GetOrderById(in OdId int)
BEGIN
	select * from orders as o, customers as c, orderstate as os
    where o.CustomerId = c.CustomerId and o.StateId = os.StateId and o.OrderId = OdId;
END $
DELIMITER ; 


DELIMITER $	
CREATE PROCEDURE GetOrderDetailByOrderId(in OdId int)
BEGIN
	select * from orderdetails as od, products as p
    where od.ProductId = p.ProductId and OrderId = OdId;
END $
DELIMITER ; 