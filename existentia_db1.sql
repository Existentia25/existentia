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



CREATE TABLE faq(
                       id_faq INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       faq_question_en1 VARCHAR(255),
                       faq_question_pt1 VARCHAR(255),
                       faq_answer_en1 TEXT,
                       faq_answer_pt1 TEXT,
                       faq_question_en2 VARCHAR(255),
                       faq_question_pt2 VARCHAR(255),
                       faq_answer_en2 TEXT,
                       faq_answer_pt2 TEXT,
                       faq_question_en3 VARCHAR(255),
                       faq_question_pt3 VARCHAR(255),
                       faq_answer_en3 TEXT,
                       faq_answer_pt3 TEXT,
                       faq_question_en4 VARCHAR(255),
                       faq_question_pt4 VARCHAR(255),
                       faq_answer_en4 TEXT,
                       faq_answer_pt4 TEXT,
                       faq_question_en5 VARCHAR(255),
                       faq_question_pt5 VARCHAR(255),
                       faq_answer_en5 TEXT,
                       faq_answer_pt5 TEXT,
                       faq_question_en6 VARCHAR(255),
                       faq_question_pt6 VARCHAR(255),
                       faq_answer_en6 TEXT,
                       faq_answer_pt6 TEXT,
                       faq_question_en7 VARCHAR(255),
                       faq_question_pt7 VARCHAR(255),
                       faq_answer_en7 TEXT,
                       faq_answer_pt7 TEXT,
                       faq_question_en8 VARCHAR(255),
                       faq_question_pt8 VARCHAR(255),
                       faq_answer_en8 TEXT,
                       faq_answer_pt8 TEXT

);

CREATE TABLE blog(
                       id_blog INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       blog_img VARCHAR(255),
                       blog_img_alt_en VARCHAR(255),
                       blog_img_alt_pt VARCHAR(255),
                       blog_title_en VARCHAR(255),
                       blog_title_pt VARCHAR(255),
                       blog_author VARCHAR(255),
                       blog_date_time DATETIME,
                       blog_category_en VARCHAR(255),
                       blog_category_pt VARCHAR(255),
                       blog_readmore_en VARCHAR(255),
                       blog_readmore_pt VARCHAR(255),
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
