drop database api_titosburgers;
CREATE DATABASE api_titosburgers;
use api_titosburgers;

CREATE TABLE IF NOT EXISTS tbl_cart (
    id_cart INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    expired_at DATETIME NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS tbl_addressUser (
    id_address INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    address VARCHAR(20) NOT NULL,
    address1 VARCHAR(20) NOT NULL,
    city VARCHAR(20) NOT NULL,
    state VARCHAR(20) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS tbl_status (
    id_status INT PRIMARY KEY AUTO_INCREMENT,
    status VARCHAR(20) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS tbl_users (
    id_users INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(15) NOT NULL,
    lastname VARCHAR(10) NOT NULL,
    username VARCHAR(15) NOT NULL,
    pass_user VARCHAR(120) NOT NULL,
    birthday DATE NOT NULL,
    cpf INT NOT NULL,
    mail VARCHAR(30) NOT NULL,
    id_status INT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (id_status) REFERENCES tbl_status(id_status)
);

CREATE TABLE IF NOT EXISTS tbl_categories (
    id_category INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(20) NOT NULL,
    image VARCHAR(50),
    id_status INT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (id_status) REFERENCES tbl_status(id_status)
);

CREATE TABLE IF NOT EXISTS tbl_product (
    id_product INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(10) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description VARCHAR(50) NOT NULL,
    id_category INT NOT NULL,
    id_status INT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (id_category) REFERENCES tbl_categories(id_category),
    FOREIGN KEY (id_status) REFERENCES tbl_status(id_status)
);

CREATE TABLE IF NOT EXISTS tbl_itensCart (
    id_iten_cart INT PRIMARY KEY AUTO_INCREMENT,
    id_cart INT NOT NULL,
    id_product INT NOT NULL,
    price_product DECIMAL(10,2) NOT NULL,
    qtd INT,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (id_cart) REFERENCES tbl_cart(id_cart),
    FOREIGN KEY (id_product) REFERENCES tbl_product(id_product)
);

CREATE TABLE IF NOT EXISTS tbl_orders (
    id_order INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    id_status INT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (id_user) REFERENCES tbl_users(id_users),
    FOREIGN KEY (id_status) REFERENCES tbl_status(id_status)
);

CREATE TABLE IF NOT EXISTS tbl_itensOrders (
    id_item_order INT PRIMARY KEY AUTO_INCREMENT,
    id_order INT NOT NULL,
    id_product INT NOT NULL,
    price_product DECIMAL(10,2) NOT NULL,
    qtd INT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (id_order) REFERENCES tbl_orders(id_order),
    FOREIGN KEY (id_product) REFERENCES tbl_product(id_product)
);

ALTER TABLE tbl_product
	ADD image VARCHAR(50) NULL AFTER `product_name`;
    
insert into tbl_status (status, created_at) VALUES
	(1, NOW());

insert into tbl_categories(category_name, image, id_status) VALUES 
	("Lanches", "", 1);
    
insert into tbl_product (product_name, image, price, description, id_category, id_status, created_at) VALUES
	("X-egg", "", 15, "Pão com hambúrger e ovo", 1, 1, NOW());