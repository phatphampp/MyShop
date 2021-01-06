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