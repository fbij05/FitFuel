CREATE DATABASE fitfuel_db;
USE fitfuel_db;

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL
);

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    rating DECIMAL(2,1) DEFAULT 0.0,
    image VARCHAR(255) NOT NULL,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    status VARCHAR(50) DEFAULT 'Pending'
);

CREATE TABLE order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    item_total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

INSERT INTO categories (category_name) VALUES
('Protein'),
('Supplements');

INSERT INTO products (name, description, price, stock, rating, image, category_id) VALUES
('Whey Protein Powder', 'High quality whey protein for muscle growth', 250.00, 15, 4.5, 'whey protein powder.jpg', 1),
('ISO100 Hydrolyzed', 'Fast absorbing protein isolate', 260.00, 10, 4.7, 'Proteína.jpg', 1);

INSERT INTO admins (username, password) VALUES
('admin', 'admin123');

INSERT INTO orders (total_amount, status) VALUES
(510.00, 'Pending');

INSERT INTO order_items (order_id, product_id, quantity, unit_price, item_total) VALUES
(1, 1, 1, 250.00, 250.00),
(1, 2, 1, 260.00, 260.00);