DELIMITER $	
CREATE PROCEDURE GetProductDetailById(in ProdId int)
BEGIN
	select * from products as p, categories as c, origins as o, producers as pc
    where p.ProductId = ProdId and p.CategoryId = c.CategoryId and p.OriginId = o.OriginId and p.ProducerId = pc.ProducerID;
END $
DELIMITER ; 

