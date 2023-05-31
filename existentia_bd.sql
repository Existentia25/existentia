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

);

CREATE TABLE about(
                       id_about INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       about_title_en VARCHAR(255),
                       about_title_pt VARCHAR(255),
                       about_content_en TEXT,
                       about_content_pt TEXT,
                       about_img VARCHAR(255),
                       about_img_alt_en VARCHAR(255),
                       about_img_alt_pt VARCHAR(255),
                       about_button_en VARCHAR(255),
                       about_button_pt VARCHAR(255),
                       about_button_href_en VARCHAR(255),
                       about_button_href_pt VARCHAR(255)
                       
);

CREATE TABLE about_mozambique(
                       id_about_mozambique INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       about_mozambique_title_en VARCHAR(255),
                       about_mozambique_title_pt VARCHAR(255),
                       about_mozambique_content_en TEXT,
                       about_mozambique_content_pt TEXT,
                       about_mozambique_img VARCHAR(255),
                       about_mozambique_img_alt_en VARCHAR(255),
                       about_mozambique_img_alt_pt VARCHAR(255),
                       about_mozambique_button_en VARCHAR(255),
                       about_mozambique_button_pt VARCHAR(255),
                       about_mozambique_button_href_en VARCHAR(255),
                       about_mozambique_button_href_pt VARCHAR(255)
                       
);

CREATE TABLE steps(
                       id_steps INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       steps_title_en VARCHAR(255),
                       steps_title_pt VARCHAR(255),
                       steps_content_en TEXT,
                       steps_content_pt TEXT

);

CREATE TABLE product(
                       id_product INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       product_img VARCHAR(255),
                       product_img_alt_en VARCHAR(255),
                       product_img_alt_pt VARCHAR(255),
                       product_title_en VARCHAR(255),
                       product_title_pt VARCHAR(255),
                       product_subtitle_en VARCHAR(255),
                       product_subtitle_pt VARCHAR(255),
                       product_content_en TEXT,
                       product_content_pt TEXT,
                       product_description_en VARCHAR(255),
                       product_description_pt VARCHAR(255),
                       product_button_en VARCHAR(255),
                       product_button_pt VARCHAR(255),
                       product_button_href_en VARCHAR(255),
                       product_button_href_pt VARCHAR(255)
                       
);

CREATE TABLE gallery(
                       id_gallery INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       gallery_img VARCHAR(255),
                       gallery_img_alt_en VARCHAR(255),
                       gallery_img_alt_pt VARCHAR(255)

);

CREATE TABLE faq(
                       id_faq INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       faq_question_en VARCHAR(255),
                       faq_question_pt VARCHAR(255),
                       faq_answer_en TEXT,
                       faq_answer_pt TEXT

);

CREATE TABLE blog(
                       id_blog INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       blog_img VARCHAR(255),
                       blog_img_alt_en VARCHAR(255),
                       blog_img_alt_pt VARCHAR(255),
                       blog_title_en VARCHAR(255),
                       blog_title_pt VARCHAR(255),
                       blog_author VARCHAR(255),
                       blog_date_time DATE,
                       blog_category_en VARCHAR(255),
                       blog_category_pt VARCHAR(255),
                       blog_read_more_en VARCHAR(255),
                       blog_read_more_pt VARCHAR(255),
                       blog_content_en TEXT,
                       blog_content_pt TEXT,
                       blog_button_en VARCHAR(255),
                       blog_button_pt VARCHAR(255),
                       blog_button_href_en VARCHAR(255),
                       blog_button_href_pt VARCHAR(255)
                    
);

CREATE TABLE testimony(
                       id_testimony INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       testimony_title_en VARCHAR(255),
                       testimony_title_pt VARCHAR(255),
                       testimony_content_en TEXT,
                       testimony_content_pt TEXT,
                       testimony_name_en VARCHAR(255),
                       testimony_name_pt VARCHAR(255),
                       testimony_img VARCHAR(255),
                       testimony_img_alt_en VARCHAR(255),
                       testimony_img_alt_pt VARCHAR(255)
                       

)

ENGINE = InnoDB;


-- Cryptage complexe en utilisant
UPDATE users SET password = SHA1(CONCAT(MD5(mail),MD5(pass)));