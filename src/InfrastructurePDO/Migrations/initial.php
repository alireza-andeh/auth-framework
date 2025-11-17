<?php 


include "../DbContext.php";
$query = <<<MySQL_QUERY
    CREATE DATABASE IF NOT EXISTS automation_tickets CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    USE automation_tickets;

    -- جدول کاربران
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        full_name VARCHAR(100) NOT NULL,
        role ENUM('admin', 'support', 'user') DEFAULT 'user',
        department VARCHAR(50) DEFAULT 'کاربر',
        phone VARCHAR(20),
        avatar VARCHAR(255),
        is_active BOOLEAN DEFAULT TRUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    -- کاربران تستی  password is  "password"
    INSERT INTO users (username, email, password, full_name, role, department, phone) VALUES
    ('admin', 'admin@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'مدیر سیستم', 'admin', 'IT', '09123456789'),
    ('support1', 'support1@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'پشتیبان اول', 'support', 'پشتیبانی', '09123456788'),
    ('support2', 'support2@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'پشتیبان دوم', 'support', 'پشتیبانی', '09123456787'),
    ('user1', 'user1@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'کاربر اول', 'user', 'فروش', '09123456786'),
    ('user2', 'user2@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'کاربر دوم', 'user', 'بازاریابی', '09123456785'),
    ('user3', 'user3@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'کاربر سوم', 'user', 'مالی', '09123456784');
MySQL_QUERY;


$stmt = $this->conn->prepare($query);
$stmt->exec();
