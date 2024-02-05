CREATE DATABASE IF NOT EXISTS steven_garage_vincent_parrot

USE steven_garage_vincent_parrot

CREATE TABLE Admin
(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    lastname VARCHAR(50) not null,
    firstname VARCHAR(50) not null,
    email VARCHAR(250) not null,
    password VARCHAR(250) not null
)

CREATE TABLE employee
(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    email VARCHAR(250) NOT NULL,
    password VARCHAR(250) NOT NULL
)

CREATE TABLE post
(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    price INT(250) NOT NULL,
    kilometers INT(250) NOT NULL,
    year INT(11) NOT NULL
)

CREATE TABLE brand
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) not null,
    post_id INT(10) NOT NULL,
    FOREIGN KEY (post_id) REFERENCES post(id)    
)

CREATE TABLE imageCar
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    URL VARCHAR(250) not null,
    post_id INT(10) NOT NULL,
    FOREIGN KEY (post_id) REFERENCES post(id) 
)

CREATE TABLE contact
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    lastname VARCHAR(50) not null,
    firstname VARCHAR(50) not null,
    email VARCHAR(250) not null,
    message TEXT not null,
    post_id INT(10) NOT NULL,
    FOREIGN KEY (post_id) REFERENCES post(id) 

)

CREATE TABLE review
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    lastname VARCHAR(50) not null,
    firstname VARCHAR(50) not null,
    email VARCHAR(250) not null,
    message TEXT not null,
    rate INT NOT NULL,
    post_id INT(11) NOT NULL,
    FOREIGN KEY (post_id) REFERENCES post(id) 

)

CREATE TABLE Equipment
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) not null,
)

CREATE TABLE PostEquipment
(
    PRIMARY KEY (PostID, EquipmentID),
    FOREIGN KEY (PostID) REFERENCES Post(id),
    FOREIGN KEY (EquipmentID) REFERENCES Equipment(id)
)

CREATE TABLE Characteristic
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) not null,
)


CREATE TABLE PostCharacteristic
(
    PRIMARY KEY (PostID, CharacteristicID),
    FOREIGN KEY (PostID) REFERENCES Post(id),
    FOREIGN KEY (CharacteristicID) REFERENCES Characteristic(id)
)

CREATE TABLE Option
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) not null,
)

CREATE TABLE PostOptionc
(
    PRIMARY KEY (PostID, OptionID),
    FOREIGN KEY (PostID) REFERENCES Post(id),
    FOREIGN KEY (OptionID) REFERENCES Option(id)
)
