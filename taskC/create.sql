DROP TABLE IF EXISTS responsible_for;
DROP TABLE IF EXISTS request;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS locations;

CREATE TABLE locations(
    id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    building VARCHAR(20),
    room INTEGER
);

CREATE TABLE users(
    netid VARCHAR(20) NOT NULL, 
    user_name VARCHAR(30) NOT NULL, 
    phone INTEGER, 
    email VARCHAR(20) NOT NULL, 
    is_student BOOLEAN NOT NULL,
    location_id INTEGER,
    PRIMARY KEY (netid),
    FOREIGN KEY (location_id) REFERENCES locations(id)
);

CREATE TABLE items(
    id INTEGER AUTO_INCREMENT,
    item_name VARCHAR(30) NOT NULL,
    is_broken BOOLEAN DEFAULT false,
    location_id INTEGER NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (location_id) REFERENCES locations(id)
);

CREATE TABLE request(
    id INTEGER AUTO_INCREMENT,
    description VARCHAR(300) NOT NULL,
    requestDate DATE NOT NULL,
    is_completed BOOLEAN DEFAULT false,
    user_id VARCHAR(20) NOT NULL,
    item_id INTEGER NOT NULL,    
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(netid),
    FOREIGN KEY (item_id) REFERENCES items(id)
);

CREATE TABLE responsible_for(
    user_id VARCHAR(20),
    location_id INTEGER,
    PRIMARY KEY (user_id, location_id),
    FOREIGN KEY (user_id) REFERENCES users(netid),
    FOREIGN KEY (location_id) REFERENCES locations(id)
);

