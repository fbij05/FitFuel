CREATE DATABASE fitfuel_db;
USE fitfuel_db;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT
);

CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    username VARCHAR(100) NOT NULL UNIQUE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

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
    category_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    status VARCHAR(50) DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES users(user_id)
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

CREATE VIEW admin_login_view AS
SELECT 
    admins.admin_id,
    admins.username,
    users.password,
    users.full_name,
    users.email,
    users.phone
FROM admins
JOIN users ON admins.user_id = users.user_id;

INSERT INTO users (full_name, email, password, phone, address) VALUES
('System Admin', 'admin@fitfuel.com', 'admin123', '0500000000', 'Riyadh'),
('Ahmed Ali', 'ahmed@gmail.com', 'user123', '0555555555', 'Jeddah'),
('Sara Mohammed', 'sara@gmail.com', 'user123', '0566666666', 'Dammam'),
('Khalid Saleh', 'khalid@gmail.com', 'user123', '0577777777', 'Makkah'),
('Noor Hassan', 'noor@gmail.com', 'user123', '0588888888', 'Madinah');

INSERT INTO admins (user_id, username) VALUES
(1, 'admin');


INSERT INTO categories (category_name) VALUES
('Protein'),
('Supplements'),
('Vitamins'),
('Accessories');



INSERT INTO products (name, description, price, stock, rating, image, category_id) VALUES
('Whey Protein Powder', 'High quality whey protein for muscle growth', 250.00, 15, 4.5, 'whey.jpg', 1),
('ISO100 Hydrolyzed', 'Fast absorbing protein isolate', 260.00, 10, 4.7, 'iso100.jpg', 1),
('Mass Gainer', 'Helps in weight gain and muscle mass', 300.00, 8, 4.3, 'gainer.jpg', 1),

('Creatine Monohydrate', 'Increased strength and energy', 120.00, 20, 4.6, 'creatine.jpg', 2),
('BCAA Amino Acids', 'Recovery support supplement', 150.00, 18, 4.4, 'bcaa.jpg', 2),

('Vitamin D3', 'Supports bone health', 80.00, 25, 4.2, 'vitd.jpg', 3),
('Multivitamin', 'Daily essential vitamins', 90.00, 30, 4.3, 'multi.jpg', 3),

('Shaker Bottle', 'Mix your protein easily', 25.00, 50, 4.1, 'shaker.jpg', 4),
('Gym Gloves', 'Protect your hands while lifting', 40.00, 35, 4.2, 'gloves.jpg', 4);



INSERT INTO orders (user_id, total_amount, status) VALUES
(2, 510.00, 'Pending'),
(3, 300.00, 'Completed'),
(4, 120.00, 'Shipped'),
(5, 170.00, 'Pending');



INSERT INTO order_items (order_id, product_id, quantity, unit_price, item_total) VALUES
-- Order 1
(1, 1, 1, 250.00, 250.00),
(1, 2, 1, 260.00, 260.00),

-- Order 2
(2, 3, 1, 300.00, 300.00),

-- Order 3
(3, 4, 1, 120.00, 120.00),

-- Order 4
(4, 5, 1, 150.00, 150.00),
(4, 8, 1, 25.00, 25.00);
