LOAD DATA 
LOCAL INFILE 'C:\\Users\\liusy\\Desktop\\Rochester\\spring 2022\\CSC 261\\project\\milestone3\\code\\database\\locations.csv'
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
LOCAL INFILE 'C:\\Users\\liusy\\Desktop\\Rochester\\spring 2022\\CSC 261\\project\\milestone3\\code\\database\\users.csv'
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
LOCAL INFILE 'C:\\Users\\liusy\\Desktop\\Rochester\\spring 2022\\CSC 261\\project\\milestone3\\code\\database\\items.csv'
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
LOCAL INFILE 'C:\\Users\\liusy\\Desktop\\Rochester\\spring 2022\\CSC 261\\project\\milestone3\\code\\database\\responsible_for.csv'
INTO TABLE responsible_for
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(
    user_id,
    location_id
);
