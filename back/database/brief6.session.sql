-- @block
DROP DATABASE ELECTROTHMAN ; 
-- @block
CREATE DATABASE ELECTROTHMAN ; 
USE ELECTROTHMAN ; 
CREATE TABLE users (
   id int PRIMARY KEY AUTO_INCREMENT, 
   username varchar(25),
   email varchar(25),
   phone varchar(25),
   adresse varchar(40)not null,
   ville varchar(40),
   password varchar(25),
   type ENUM('unverified', 'user', 'admin') DEFAULT 'unverified'
);
-- @block
CREATE TABLE category(
   id int PRIMARY KEY AUTO_INCREMENT,
   name varchar(25),
   description varchar(225),
   image varchar(255)
);
-- @block
CREATE TABLE product (
   id int PRIMARY KEY AUTO_INCREMENT, 
   name varchar(255),
   old_price float,
   new_price float,
   image varchar (255),
   stock int,
   country varchar(255),
   city varchar(255),
   nbachat int not null,
   category int,
   FOREIGN KEY (category) REFERENCES category(id) on delete cascade
);


CREATE TABLE commande (
    idcom INT PRIMARY KEY AUTO_INCREMENT,
    date_creation DATE,
    date_envoi DATE,
    date_livraison DATE,
    prix_total FLOAT,
    idclient INT,
    etat varchar(40),
    CONSTRAINT fk_client FOREIGN KEY (idclient) REFERENCES users(id),
    CONSTRAINT ck_etat CHECK (etat IN("en attente","en cours","livré"))
);

CREATE TABLE commande_produit (
    idcom INT,
    idproduit INT,
    quantite INT,
    prix_unitaire FLOAT,
    prix_total FLOAT,
    PRIMARY KEY(idcom,idproduit),
    CONSTRAINT fk_com FOREIGN KEY (idcom) REFERENCES commande(idcom),
    CONSTRAINT fk_prod FOREIGN KEY (idproduit) REFERENCES product(id)
);


-- @block
INSERT INTO category (name, description, image) VALUES
("arduino","adadadadadada", "New York"),
("electrique","adadadadadada", "New York"),
("switch","adadadadadada", "New York");
-- @block
INSERT INTO product (name, old_price, new_price, category, image, stock, country, city,nbachat) VALUES
("LED", 0.5, 0.25, 1, "LED.jpg", 12, "USA", "New York",10),
("Resistor", 0.1, 0.05, 3, "Resistor.jpg", 5, "Canada", "Toronto",20),
("Arduino", 10.0, 5.0, 2, "arduino.jpg", 4, "Germany", "Berlin",60),
("Raspberry Pi", 35.0, 17.5, 2, "Raspberry_Pi.jpg", 1, "France", "Paris",30),
("Capacitor", 0.2, 0.1, 1, "Capacitor.jpg", 0, "Australia", "Sydney",40),
("Transistor", 0.3, 0.15, 1, "Transistor.jpg", 3, "Japan", "Tokyo",41),
("Diode", 0.2, 0.1, 1, "Diode.jpg", 7, "Brazil", "Rio de Janeiro",35),
("Potentiometer", 1.0, 0.5, 3, "Potentiometer.jpg", 19, "India", "Mumbai",46),
("Relay", 2.0, 1.0, 2, "Relay.jpg", 102, "China", "Shanghai",87),
("IC", 1.5, 0.75, 1, "IC.jpg", 45, "Spain", "Madrid",34),
("Breadboard", 5.0, 2.5, 2, "Breadboard.jpg", 5, "United Kingdom", "London",45),
("Motor", 8.0, 4.0, 2, "Motor.jpg", 60, "South Korea", "Seoul",67),
("Sensor", 3.0, 1.5, 1, "Sensor.jpg", 12, "Mexico", "Mexico City",21),
("Switch", 0.5, 0.25, 1, "Switch.jpg", 45, "Italy", "Rome",34),
("Battery", 2.0, 1.0, 2, "Battery.jpg", 300, "Russia", "Moscow",54),
("Power Supply", 10.0, 5.0, 2, "Power_Supply.jpg", 4, "Sweden", "Stockholm",56),
("Wire", 0.1, 0.05, 1, "Wire.jpg", 1000, "Netherlands", "Amsterdam",56),
("Connector", 0.3, 0.15, 3, "Connector.jpg", 30, "Switzerland", "Zurich",54),
("PCB", 5.0, 2.5, 2, "PCB.jpg", 4, "Belgium", "Brussels",6),
("Oscillator", 1.5, 0.75, 1, "Oscillator.jpg", 20, "Argentina", "Buenos Aires",88);



SELECT *
FROM product p1
WHERE nbachat = (
    SELECT MAX(nbachat)
    FROM product p2
    WHERE p1.category = p2.category
);
-- @block
update users set type = 'admin' where username = "fadi";
-- @block
SELECT id , category FROM product where category = 1;
