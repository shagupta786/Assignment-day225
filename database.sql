CREATE DATABASE internship_portal;
USE internship_portal;

CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    resume VARCHAR(255) NOT NULL,
    status ENUM('Pending', 'Selected', 'Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert default admin
INSERT INTO admin (username, password) 
VALUES ('admin', SHA1('admin123'));
