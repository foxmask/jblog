-- Tags
CREATE TABLE sc_tags (
    tag_id SERIAL NOT NULL,
    tag_name VARCHAR(50) NOT NULL,
    nbuse INTEGER default '0',
    
    PRIMARY KEY (tag_id),
    UNIQUE (tag_name)
);

-- Tags in use
CREATE TABLE sc_tags_tagged (
    tt_id SERIAL NOT NULL,
    tag_id INTEGER NOT NULL,
    tt_scope_id VARCHAR(50) NOT NULL,    -- 'snippet' or 'application'
    tt_subject_id INtEGER NOT NULL,  -- sc_snippets::sn_id or sc_apps::app_id

    PRIMARY KEY  (tt_id)
);

CREATE INDEX idx1_tt ON sc_tags_tagged (tt_scope_id, tt_subject_id);
CREATE INDEX idx2_tt ON sc_tags_tagged (tag_id);