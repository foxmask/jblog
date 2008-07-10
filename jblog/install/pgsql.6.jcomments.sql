-- Comments table
CREATE TABLE sc_comments (
    com_id SERIAL NOT NULL,
    com_scope VARCHAR(50) NOT NULL,   -- 'snippet' or 'application'
    com_subject_id INTEGER NOT NULL, -- sc_snippets::sn_id or sc_apps::app_id
    user_login VARCHAR(50) NOT NULL,
    com_content TEXT NOT NULL,
    com_created_at TIMESTAMP NOT NULL,
    
    PRIMARY KEY (com_id),
    
    CONSTRAINT fk_com_login FOREIGN KEY (user_login) REFERENCES community_users(login)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE INDEX idx1_com ON sc_comments (com_scope, com_subject_id);
CREATE INDEX idx2_com ON sc_comments (user_login);