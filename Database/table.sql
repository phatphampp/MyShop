create database Vehicles_Store;

create table Categories (
	CategoryId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	CategoryName NVARCHAR(200) NOT NULL,
	CategoryDescription NVARCHAR(1000) NOT NULL,
	CategoryImage NVARCHAR(200)
);

create table Producers (
	ProducerId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	ProducerName NVARCHAR(200) NOT NULL,
	ProducerDescription NVARCHAR(1000) NOT NULL,
	ProducerImage NVARCHAR(200)
);

create table Origins (
	OriginId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	OriginName NVARCHAR(200) NOT NULL,
	OriginDescription NVARCHAR(1000) NOT NULL
);

create table Products (
	ProductId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	ProductName NVARCHAR(200) NOT NULL,
	ProductDescription NVARCHAR(1000) NOT NULL,
	ProductImage NVARCHAR(200),
    ProductQuantity INT,
    ProductPrice INT,
    ProductView INT DEFAULT 0,
    CategoryId INT unsigned,
    OriginId INT unsigned,
    ProducerId INT unsigned,
    foreign key (CategoryId) references categories(CategoryId),
    foreign key (OriginId) references origins(OriginId),
    foreign key (ProducerId) references Producers(ProducerId)
);