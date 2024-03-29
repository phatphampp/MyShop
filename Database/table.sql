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

create table Customers (
	CustomerId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	CustomerFullName NVARCHAR(200) NOT NULL,
	CustomerAddress NVARCHAR(1000) NOT NULL,
	CustomerTel NVARCHAR(200),
    CustomerUsername NVARCHAR(200),
    CustomerPassword NVARCHAR(200),
    UNIQUE (CustomerUsername)
);

create table Employees (
	EmployeeId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	EmployeeFullName NVARCHAR(200) NOT NULL,
	EmployeeAddress NVARCHAR(1000) NOT NULL,
	EmployeeTel NVARCHAR(200),
    EmployeeUsername NVARCHAR(200),
    EmployeePassword NVARCHAR(200),
    UNIQUE (EmployeeUsername)
);
create table OrderState (
	StateId int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    StateDescription NVARCHAR(200) NOT NULL
);

create table Orders (
	OrderId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	CustomerId int unsigned,
	StateId int UNSIGNED,
	CreateAt DateTime default current_timestamp,
    TotalPrice int,
    foreign key (CustomerId) references Customers(CustomerId),
    foreign key (StateId) references OrderState(StateId)
);

create table OrderDetails (
	OrderId INT UNSIGNED,
	ProductId int unsigned,
    Quantity int not null,
    UnitPrice int not null,
    SubTotalPrice int as (Quantity * UnitPrice),
    foreign key (OrderId) references Orders(OrderId),
    foreign key (ProductId) references Products(ProductId),
    primary key (OrderId, ProductId)
);