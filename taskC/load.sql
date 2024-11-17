LOAD DATA 
LOCAL INFILE '~/database/locations.csv'
INTO TABLE locations
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(
    building,
    room
);

LOAD DATA 
LOCAL INFILE '~/database/users.csv'
INTO TABLE users
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(
    netid,
    user_name, 
    phone, 
    email, 
    is_student,
    location_id
);

LOAD DATA 
LOCAL INFILE '~/database/items.csv'
INTO TABLE items
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(
    item_name,
    location_id
);

LOAD DATA 
LOCAL INFILE '~/database/responsible_for.csv'
INTO TABLE responsible_for
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(
    user_id,
    location_id
);