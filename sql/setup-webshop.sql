-- ------------------------------------------------------------------------
--
-- For kmom05 in OOPHP v3
--
-- CREATE DATABASE oophp;
-- GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
-- USE oophp;

-- USE melogin;
USE mafd16;

SET NAMES utf8;



-- ------------------------------------------------------------------------
--
-- Setup tables
--
DROP TABLE IF EXISTS `Prod2Cat`;
DROP TABLE IF EXISTS `ProdCategory`;
DROP TABLE IF EXISTS `Inventory`;
DROP TABLE IF EXISTS `InvenShelf`;
DROP TABLE IF EXISTS `ShopCartRow`;
DROP TABLE IF EXISTS `OrderRow`;
DROP TABLE IF EXISTS `InvoiceRow`;
DROP TABLE IF EXISTS `FillUpInventory`;
DROP TABLE IF EXISTS `ShopCart`;
DROP TABLE IF EXISTS `Invoice`;
DROP TABLE IF EXISTS `Order`;
DROP TABLE IF EXISTS `Product`;
DROP TABLE IF EXISTS `Customer`;



-- ------------------------------------------------------------------------
--
-- Product and product category
--
CREATE TABLE `ProdCategory` (
	`id` INT AUTO_INCREMENT,
	`category` CHAR(10),

	PRIMARY KEY (`id`)
);

CREATE TABLE `Product` (
	`id` INT AUTO_INCREMENT,
    `description` VARCHAR(20),
    `image` VARCHAR(20),
    `price` DECIMAL(4, 2),
    `deleted` DATETIME DEFAULT NULL,

	PRIMARY KEY (`id`)
);

CREATE TABLE `Prod2Cat` (
	`id` INT AUTO_INCREMENT,
	`prod_id` INT,
	`cat_id` INT,

	PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
    FOREIGN KEY (`cat_id`) REFERENCES `ProdCategory` (`id`)
);



-- ------------------------------------------------------------------------
--
-- Inventory and shelfs
--
CREATE TABLE `InvenShelf` (
    `shelf` CHAR(6),
    `description` VARCHAR(40),

	PRIMARY KEY (`shelf`)
);

CREATE TABLE `Inventory` (
	`id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `shelf_id` CHAR(6),
    `items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
	FOREIGN KEY (`shelf_id`) REFERENCES `InvenShelf` (`shelf`)
);




-- ------------------------------------------------------------------------
--
-- Customer
--
CREATE TABLE `Customer` (
	`id` INT AUTO_INCREMENT,
    `firstName` VARCHAR(20),
    `lastName` VARCHAR(20),

	PRIMARY KEY (`id`)
);



-- ------------------------------------------------------------------------
--
-- Shopping Cart
--
CREATE TABLE `ShopCart` (
	`id` INT AUTO_INCREMENT,
    `customer` INT,
	-- `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
	-- `updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	-- `deleted` DATETIME DEFAULT NULL,
	-- `delivery` DATETIME DEFAULT NULL,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`customer`) REFERENCES `Customer` (`id`)
);

CREATE TABLE `ShopCartRow` (
	`id` INT AUTO_INCREMENT,
    `shopcart` INT,
    `product` INT,
	`items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`shopcart`) REFERENCES `ShopCart` (`id`),
	FOREIGN KEY (`product`) REFERENCES `Product` (`id`)
);



-- ------------------------------------------------------------------------
--
-- Order
--
CREATE TABLE `Order` (
	`id` INT AUTO_INCREMENT,
    `customer` INT,
	-- `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `cart` INT,
	-- `updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	`deleted` DATETIME DEFAULT NULL,
	-- `delivery` DATETIME DEFAULT NULL,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`customer`) REFERENCES `Customer` (`id`)
    -- FOREIGN KEY (`cart`) REFERENCES `ShopCart` (`id`)
);

CREATE TABLE `OrderRow` (
	`id` INT AUTO_INCREMENT,
    `order` INT,
    `product` INT,
    `price` DECIMAL(4, 2),
	`items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`order`) REFERENCES `Order` (`id`),
	FOREIGN KEY (`product`) REFERENCES `Product` (`id`)
    -- FOREIGN KEY (`price`) REFERENCES `Product` (`price`),
);



-- ------------------------------------------------------------------------
--
-- Invoice
--
CREATE TABLE `Invoice` (
	`id` INT AUTO_INCREMENT,
    `order` INT,
    `customer` INT,
	-- `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`order`) REFERENCES `Order` (`id`),
	FOREIGN KEY (`customer`) REFERENCES `Customer` (`id`)
);

CREATE TABLE `InvoiceRow` (
	`id` INT AUTO_INCREMENT,
    `invoice` INT,
    `product` INT,
	`items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`invoice`) REFERENCES `Invoice` (`id`),
	FOREIGN KEY (`product`) REFERENCES `Product` (`id`)
);



-- ------------------------------------------------------------------------
--
-- Function for knowing how much to order when low on inventory.
-- Return value depends on the month of year.
--
DELIMITER //

DROP FUNCTION IF EXISTS penQuantity //
CREATE FUNCTION penQuantity(
    dateWhenLow DATETIME
)
RETURNS INT
BEGIN
    DECLARE monthOfYear INT;
    SET monthOfYear = MONTH(dateWhenLow);

    IF monthOfYear <= 3 THEN
        RETURN 5000;
    ELSEIF monthOfYear <= 6 THEN
        RETURN 12000;
    ELSEIF monthOfYear <= 9 THEN
        RETURN 7000;
    ELSEIF monthOfYear <= 12 THEN
        RETURN 11000;
    END IF;
END
//

DELIMITER ;



-- ------------------------------------------------------------------------
--
-- Table of when to fill up inventory. Also how much to order!
--
CREATE TABLE `FillUpInventory` (
	`id` INT AUTO_INCREMENT,
	-- `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `prod_id` INT,
    `quantity` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`)
);



-- ------------------------------------------------------------------------
--
-- By some stuff to get it up and running,
-- the first truck has arrived and you need to
-- insert the details into you database.
--

-- ------------------------------------------------------------------------
--
-- Start with the product catalogue
--
INSERT INTO `ProdCategory` (`category`) VALUES
("choose.."), ("pencils"), ("pens")
;

INSERT INTO `Product` (`description`, `image`, `price`) VALUES
("Red inc pen", "rod_black.jpg", 25),
("Silver inc pen", "silver_black.jpg", 45),
("White pencil", "vit_blyerts.jpg", 12),
("Red pencil", "rod_blyerts.jpg", 15),
("Wooden pencil", "tra_blyerts.jpg", 5)
;

INSERT INTO `Prod2Cat` (`prod_id`, `cat_id`) VALUES
(1, 3),
(2, 3),
(3, 2),
(4, 2),
(5, 2)
;
/*
SELECT
	P.id,
    P.description,
    GROUP_CONCAT(category) AS category
FROM Product AS P
	INNER JOIN Prod2Cat AS P2C
		ON P.id = P2C.prod_id
	INNER JOIN ProdCategory AS PC
		ON PC.id = P2C.cat_id
GROUP BY P.id
ORDER BY P.description
;
*/


-- ------------------------------------------------------------------------
--
-- The truck has arrived, put the stuff into shelfs and update the database
--
INSERT INTO `InvenShelf` (`shelf`, `description`) VALUES
("AAA101", "House A, aisle A, part A, shelf 101"),
("AAA102", "House A, aisle A, part A, shelf 102"),
("AAA103", "House A, aisle A, part A, shelf 103"),
("AAA104", "House A, aisle A, part A, shelf 104"),
("AAA105", "House A, aisle A, part A, shelf 105")
;

INSERT INTO `Inventory` (`prod_id`, `shelf_id`, `items`) VALUES
(1, "AAA101", 5500),
(2, "AAA102", 2500),
(3, "AAA103", 12750),
(4, "AAA104", 9000),
(5, "AAA105", 18200)
;

-- SELECT * FROM InvenShelf;

-- ------------------------------------------------------------------------
--
-- View connecting products with their place in the inventory
-- and offering reports for inventory and sales personal.
--
DROP VIEW IF EXISTS VInventory;
CREATE VIEW VInventory AS
SELECT
    I.id,
	S.shelf,
    S.description AS location,
    I.items,
    P.description
FROM Inventory AS I
	INNER JOIN InvenShelf AS S
		ON I.shelf_id = S.shelf
	INNER JOIN Product AS P
		ON P.id = I.prod_id
ORDER BY S.shelf
;

-- SELECT * FROM VInventory;
-- SELECT description, items, shelf, description FROM VInventory;


-- ------------------------------------------------------------------------
--
-- View products with their category and the
-- number of items in inventory.
--
DROP VIEW IF EXISTS VProducts;
CREATE VIEW VProducts AS
SELECT
	P.id,
    P.description,
    P.image,
    P.price,
    P.deleted,
    GROUP_CONCAT(category) AS category-- ,
    -- PC.category,
    -- I.items
FROM Product AS P
	INNER JOIN Prod2Cat AS P2C
		ON P.id = P2C.prod_id
	INNER JOIN ProdCategory AS PC
		ON PC.id = P2C.cat_id
    -- INNER JOIN Inventory AS I
    --     ON I.prod_id = P.id
GROUP BY P.id
-- ORDER BY P.description
;

-- SELECT * FROM VProducts;

-- SELECT * FROM Product;

-- SELECT * FROM ProdCategory;

-- SELECT * FROM Prod2Cat;

-- SELECT * FROM FillUpInventory;



-- ------------------------------------------------------------------------
--
-- Trigger for create row in FillUpInventory, when number of
-- items in inventory drops below 5.
--
DELIMITER //
DROP TRIGGER IF EXISTS lowInv//

CREATE TRIGGER lowInv
AFTER UPDATE
ON `Inventory` FOR EACH ROW
    IF (NEW.items<5) THEN
	INSERT INTO `FillUpInventory` (`prod_id`)
    VALUES (NEW.prod_id);
    END IF;
//

DELIMITER ;



-- ------------------------------------------------------------------------
--
-- Report showing products to be ordered.
-- That is, products with less than 5 items in inventory.
--
DROP VIEW IF EXISTS VOrderToInventory;

CREATE VIEW VOrderToInventory AS
SELECT
    FUI.id,
    FUI.created AS DateOnLow,
    FUI.prod_id AS ProductId,
    P.description AS ProductDesc,
    penQuantity(FUI.created) AS Quantity
    -- FUI.quantity AS Quantity
FROM `FillUpInventory` AS FUI
	INNER JOIN Product AS P
		ON FUI.prod_id = P.id
ORDER BY ProductId
;

-- SELECT * FROM VOrderToInventory;



-- ------------------------------------------------------------------------
--
-- Procedure for adding a product (just one) to the shopping cart.
--
DROP PROCEDURE IF EXISTS addProdToCart;

DELIMITER //

CREATE PROCEDURE addProdToCart(
    shopCartId INT,
    productId INT
    -- quantity INT
)
BEGIN
    DECLARE numOfItems INT;

    START TRANSACTION;

    SET numOfItems = (SELECT items FROM Inventory WHERE prod_id = productId);
    -- SELECT numOfItems;

    IF numOfItems - 1 < 0 THEN
        ROLLBACK;
        SELECT "Items in inventory is too low.";
    -- Decrement inventory by one, if not equal to zero.
    ELSE
        UPDATE Inventory
        SET
            items = items - 1-- quantity
        WHERE
            prod_id = productId;

        -- Increment shopping cart by one.
        INSERT INTO ShopCartRow (`shopcart`, `product`, `items`)
        VALUES (shopCartId, productId, 1);-- quantity);

        COMMIT;
    END IF;
END
//

DELIMITER ;



-- ------------------------------------------------------------------------
--
-- Procedure for deleting a product (just one) from the shopping cart.
--
DROP PROCEDURE IF EXISTS dropProdFromCart;

DELIMITER //

CREATE PROCEDURE dropProdFromCart(
    shopCartRowId INT
)
BEGIN
    DECLARE productId INT;

    START TRANSACTION;

    SET productId = (SELECT product FROM ShopCartRow WHERE id = shopCartRowId);

    UPDATE Inventory
    SET
        items = items + 1-- - quantity
    WHERE
        prod_id = productId;

    DELETE FROM ShopCartRow WHERE id = shopCartRowId;

    COMMIT;
END
//

DELIMITER ;



-- ------------------------------------------------------------------------
--
-- View for showing what is in the shopping carts.
--
DROP VIEW IF EXISTS showCarts;

CREATE VIEW showCarts AS
SELECT
    SC.id AS CartId,
    C.firstName AS Fname,
    C.lastName AS Lname,
    -- SCR.id AS ProductNo,
    SCR.product AS ProductNo,
    P.description AS ProductName,
    P.price AS ProductPrice
FROM `ShopCart` AS SC
    INNER JOIN Customer AS C
        ON SC.customer = C.id
    INNER JOIN ShopCartRow AS SCR
        ON SCR.shopcart = SC.id
    INNER JOIN Product AS P
        ON SCR.product = P.id
ORDER BY ProductNo
;



-- ------------------------------------------------------------------------
--
-- Procedure for showing what is in a shopping cart.
--
DROP PROCEDURE IF EXISTS showCart;

DELIMITER //

CREATE PROCEDURE showCart(
    shopCartId INT
)
BEGIN
    SELECT * FROM showCarts WHERE CartId=shopCartId;
END
//

DELIMITER ;



-- ------------------------------------------------------------------------
--
-- Procedure for creating an order from a shopping cart.
--
DROP PROCEDURE IF EXISTS createOrderFromCart;

DELIMITER //

CREATE PROCEDURE createOrderFromCart(
    shopCartId INT
)
BEGIN
    START TRANSACTION;

    -- Create order
    INSERT INTO `Order` (`customer`, `cart`)
    SELECT
        `customer`,
        `id`
    FROM ShopCart
    WHERE id = shopCartId
    ;

    -- move shopcartrows to orderrows
    INSERT INTO OrderRow (`order`, `product`, `price`, `items`)
    SELECT
        O.id AS OrderId,
        SCR.product AS ProductId,
        P.price AS ProductPrice,
        SCR.items AS ProductItems
    FROM `Order` AS O
        INNER JOIN ShopCartRow AS SCR
            ON SCR.shopcart = O.cart
        INNER JOIN Product AS P
            ON P.id = SCR.product
    WHERE O.cart = shopCartId
    ;

    COMMIT;
END
//

DELIMITER ;



-- ------------------------------------------------------------------------
--
-- View for showing what is in the order.
--
DROP VIEW IF EXISTS showOrders;

CREATE VIEW showOrders AS
SELECT
    -- OROW.order AS OrderId,
    O.id AS OrderId,
    O.created AS OrderDate,
    O.deleted AS OrderDeleted,
    O.customer AS CustomerNo,
    C.firstName AS FirstName,
    C.lastName AS LastName,
    OROW.id AS RowId,
    OROW.product AS ProductNo,
    P.description AS ProductName,
    OROW.price AS ProductPrice,
    OROW.items AS ProductItems
FROM `OrderRow` AS OROW
    INNER JOIN `Order` AS O
        ON OROW.order = O.id
    INNER JOIN Customer AS C
        ON C.id = O.customer
    INNER JOIN Product AS P
        ON OROW.product = P.id
ORDER BY RowId
;



-- ------------------------------------------------------------------------
--
-- Procedure for showing what is in an order.
--
DROP PROCEDURE IF EXISTS showOrder;

DELIMITER //

CREATE PROCEDURE showOrder(
    idOfOrder INT
)
BEGIN
    SELECT * FROM showOrders WHERE OrderId=idOfOrder;
END
//

DELIMITER ;



-- ------------------------------------------------------------------------
--
-- Procedure for deleting an order.
--
DROP PROCEDURE IF EXISTS deleteOrder;

DELIMITER //

CREATE PROCEDURE deleteOrder(
    idOfOrder INT
)
BEGIN
    UPDATE `Order` SET deleted=NOW() WHERE id=idOfOrder;
END
//

DELIMITER ;



-- ------------------------------------------------------------------------
--
-- We are simulating a customer in the webshop.
-- Frontend creates a customer id for the customer to start buying.
-- Maybe this is made possible making the customer register/login to be
-- able to start shopping. I think so!
--

-- Customer register and start buying:
INSERT INTO `Customer` (`firstName`, `lastName`) VALUES
("Mumin", "Trollet"),
("Mamma", "Mumin"),
("Pappa", "Mumin")
;

-- SELECT * FROM Customer;

-- Customers getting a shopping cart:
INSERT INTO ShopCart (`customer`) Values
(1), (2), (1), (3);

-- SELECT * FROM ShopCart;

-- Customer starts adding products to shopping cart:
-- CALL addProdToCart(shopCartId, productId);-- , quantity);
CALL addProdToCart(1, 1);
CALL addProdToCart(1, 2);
CALL addProdToCart(1, 4);

CALL addProdToCart(2, 5);

CALL addProdToCart(3, 3);
CALL addProdToCart(3, 5);

CALL addProdToCart(4, 5);
CALL addProdToCart(4, 4);
CALL addProdToCart(4, 3);

-- Customer are looking in the shopping cart:
-- SELECT * FROM ShopCartRow;-- WHERE shopcart=1;

-- Customer delets product from shopping cart
-- CALL dropProdFromCart(2);

-- Customer looking into the enhanced shopping cart!
-- SELECT * FROM showCart WHERE Cartid=1;
-- SELECT * FROM showCart WHERE Cartid=2;
-- SELECT * FROM showCart WHERE Cartid=3;
-- CALL showCart(1);
-- CALL showCart(2);
-- CALL showCart(3);


-- Customer paying
-- System creating order from shopping cart
CALL createOrderFromCart(1);
CALL createOrderFromCart(2);
CALL createOrderFromCart(3);
CALL createOrderFromCart(4);

-- Look into order:
-- SELECT * FROM `Order`;-- WHERE id=1;

-- Look into orderRow
-- SELECT * FROM `OrderRow`;

-- Look at orderRows via view:
-- SELECT * FROM showOrders;

-- Look at specifik order:
-- CALL showOrder(1);
-- CALL showOrder(2);
-- CALL showOrder(3);
-- CALL showOrder(4);

-- CALL deleteOrder(4);

-- SELECT * FROM VOrderToInventory;
