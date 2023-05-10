CREATE TABLE about(
                      id  INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                      about_title VARCHAR(255) NOT NULL,
                      about_content TEXT NOT NULL,
                      about_img VARCHAR(255) NOT NULL,
                      about_img_alt_en VARCHAR(255) NOT NULL,
                      about_img_alt_pt VARCHAR(255) NOT NULL,
                      about_button VARCHAR(255) NOT NULL,
                      about_button_href VARCHAR(255) NOT NULL

);

CREATE TABLE steps(
                    id_steps INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    steps_title_en VARCHAR(255) NOT NULL,
                    steps_title_pt VARCHAR(255) NOT NULL,
                    steps_card_title_en VARCHAR(255) NOT NULL,
                    steps_card_title_pt VARCHAR(255) NOT NULL,
                    steps_card_description_en TEXT,
                    steps_card_description_pt TEXT
);

CREATE TABLE gallery (
                       id_gallery INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       gallery_title_en VARCHAR(255) NOT NULL,
                       gallery_title_pt VARCHAR(255) NOT NULL,
                       gallery_description_en TEXT,
                       gallery_description_pt TEXT,
                       gallery_img_alt_en VARCHAR(255) NOT NULL,
                       gallery_img_alt_pt VARCHAR(255) NOT NULL,
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
                       blog_button VARCHAR(255),
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
