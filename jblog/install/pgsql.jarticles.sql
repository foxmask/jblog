-- Articles table
CREATE TABLE blog_articles (
    art_id SERIAL NOT NULL,
    user_login VARCHAR(50) NOT NULL,
    cat_name INTEGER NOT NULL,
    art_title VARCHAR(150) NOT NULL,
    art_content TEXT NOT NULL,
    art_created_at TIMESTAMP NOT NULL,
    
    PRIMARY KEY (art_id),
    
    CONSTRAINT fk_art_login FOREIGN KEY (user_login) REFERENCES community_users(login)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_art_category FOREIGN KEY (cat_name) REFERENCES blog_categories(cat_name)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE INDEX idx1_art ON blog_articles (cat_name);
CREATE INDEX idx2_art ON blog_articles (user_login);