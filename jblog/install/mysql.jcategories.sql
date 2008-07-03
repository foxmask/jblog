-- Categories
CREATE TABLE `jcategories` (
    `cat_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `cat_name` VARCHAR(50) NOT NULL,
    
    PRIMARY KEY pk_cat (`cat_id`),
    UNIQUE idx1_cat(`cat_name`)
);