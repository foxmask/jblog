-- Categories
CREATE TABLE jcategories (
    cat_id SERIAL NOT NULL,
    cat_name VARCHAR(50) NOT NULL,
    
    PRIMARY KEY (cat_id),
    UNIQUE (cat_name)
);