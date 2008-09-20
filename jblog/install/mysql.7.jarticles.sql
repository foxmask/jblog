-- Articles table
CREATE TABLE blog_articles (
    `art_id` INT NOT NULL AUTO_INCREMENT,
    `user_login` VARCHAR(50) NOT NULL,
    `cat_id` INTEGER NOT NULL,
    `art_title` VARCHAR(150) NOT NULL,
    `art_content` TEXT NOT NULL,
    `art_created_at` TIMESTAMP NOT NULL,
	`art_published` boolean default false,
    
    PRIMARY KEY (`art_id`),
	INDEX idx1_art (`cat_id`),
	INDEX idx2_art (`user_login`),
	INDEX idx3_art (`art_published`)
);