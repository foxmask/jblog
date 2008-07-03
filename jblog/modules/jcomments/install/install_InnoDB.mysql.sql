
-- Comments table
CREATE TABLE `sc_comments` (
    `com_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `com_scope` VARCHAR(50) NOT NULL,   -- 'snippet' or 'application'
    `com_subject_id` INT UNSIGNED NOT NULL, -- sc_snippets::sn_id or sc_apps::app_id
    `user_login` VARCHAR(50) NOT NULL,
    `com_content` TEXT NOT NULL,
    `com_created_at` DATETIME NOT NULL,
    
    PRIMARY KEY pk_com (`com_id`),
    INDEX idx1_com (`com_scope`, `com_subject_id`),
    INDEX idx2_com (`user_login`),
    
    CONSTRAINT fk_com_login FOREIGN KEY (`user_login`) REFERENCES `community_users`(`login`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
