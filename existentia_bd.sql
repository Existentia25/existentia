CREATE DATABASE existentia_db;

USE existentia_db;

CREATE TABLE admin(
                      id_admin INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                      mail VARCHAR(255) UNIQUE NOT NULL,
                      password VARCHAR(255) NOT NULL
);

CREATE TABLE users(
                      id_user INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                      firstname VARCHAR(255) NOT NULL,
                      lastname VARCHAR(255) NOT NULL,
                      mail VARCHAR(255) UNIQUE NOT NULL,
                      tel VARCHAR(255) NOT NULL,
                      password VARCHAR(255) NOT NULL,
                      address VARCHAR(255) NOT NULL
);

CREATE TABLE products(
                      id_product INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                      name_en VARCHAR(255) NOT NULL,
                      name_pt VARCHAR(255) NOT NULL,
                      category_en VARCHAR(255) NOT NULL,
                      category_pt VARCHAR(255) NOT NULL,
                      price DECIMAL(10,2) NOT NULL,
                      photo VARCHAR(255) NOT NULL,
                      alt_en VARCHAR(255) NOT NULL,
                      alt_pt VARCHAR(255) NOT NULL
);

CREATE TABLE carts(
                      id_cart INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                      user_id INT NOT NULL,
                      name_en VARCHAR(255) NOT NULL,
                      name_pt VARCHAR(255) NOT NULL,
                      price DECIMAL(10,2) NOT NULL,
                      quantity INT NOT NULL,
                      image VARCHAR(255) NOT NULL,
                      alt_en VARCHAR(255) NOT NULL,
                      alt_pt VARCHAR(255) NOT NULL,
                      CONSTRAINT FK_USER FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE orders(
                    id_order INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    user_id INT NOT NULL,
                    firstname VARCHAR(255) NOT NULL,
                    lastname VARCHAR(255) NOT NULL,
                    tel VARCHAR(255) NOT NULL,
                    mail VARCHAR(255) NOT NULL,
                    method VARCHAR(255) NOT NULL,
                    address VARCHAR(255) NOT NULL,
                    total_product INT NOT NULL,
                    total_price DECIMAL(10,2) NOT NULL,
                    place_order DATETIME,
                    payment_status VARCHAR(255) NOT NULL,
                    CONSTRAINT FK_USER FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE blogs(
                       id_blog INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       title_en VARCHAR(255) NOT NULL,
                       title_pt VARCHAR(255) NOT NULL,
                       category_en VARCHAR(255) NOT NULL,
                       category_pt VARCHAR(255) NOT NULL,
                       author VARCHAR(255) NOT NULL,
                       date DATETIME NOT NULL,
                       photo VARCHAR(255) NOT NULL,
                       alt_en VARCHAR(255) NOT NULL,
                       alt_pt VARCHAR(255) NOT NULL


);

CREATE TABLE messages(
                      id_message INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                      name_en VARCHAR(255) NOT NULL,
                      name_pt VARCHAR(255) NOT NULL,
                      mail VARCHAR(255) NOT NULL,
                      subject_en VARCHAR(255) NOT NULL,
                      subject_pt VARCHAR(255) NOT NULL,
                      message_en VARCHAR(255) NOT NULL,
                      message_pt VARCHAR(255) NOT NULL,
                      description_en TEXT NOT NULL,
                      description_PT TEXT NOT NULL

);

CREATE TABLE image(
                    id_image INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    header_img VARCHAR(255) NOT NULL,
                    header_alt_en VARCHAR(255) NOT NULL,
                    header_alt_pt VARCHAR(255) NOT NULL,
                    about_img VARCHAR(255) NOT NULL,
                    about_alt_en VARCHAR(255) NOT NULL,
                    about_alt_pt VARCHAR(255) NOT NULL,
                    product_img VARCHAR(255) NOT NULL,
                    product_alt_en VARCHAR(255) NOT NULL,
                    product_alt_pt VARCHAR(255) NOT NULL,
                    gallery_img VARCHAR(255) NOT NULL,
                    gallery_alt_en VARCHAR(255) NOT NULL,
                    gallery_alt_pt VARCHAR(255) NOT NULL,
                    blog_img VARCHAR(255) NOT NULL,
                    blog_alt_en VARCHAR(255) NOT NULL,
                    blog_alt_pt VARCHAR(255) NOT NULL

)
ENGINE = InnoDB;


-- Cryptage complexe en utilisant
UPDATE users SET password = SHA1(CONCAT(MD5(mail),MD5(pass)));