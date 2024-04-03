# GJCLIBRARY

To use this repo.
1. First install https://getcomposer.org/download/
2. verify install via cmd using: composer --version
3. then open in vscode
4. open terminal (cmd)
5. enter command: composer install
6. manage database

open shell sa xampp
mysql -u root -p
DROP DATABASE gjc_library;
CREATE DATABASE gjc_library;
USE gjc_library;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    emailaddress VARCHAR(100) UNIQUE,
    phonenumber VARCHAR(20) UNIQUE,
    role VARCHAR(50),
    token VARCHAR(255),
    password VARCHAR(100) -- Passwords should be stored securely, ideally hashed.
);

CREATE TABLE user_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    time_in DATETIME,
    time_out DATETIME,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);


7. load localhost/GJCLIBRARY via xampp