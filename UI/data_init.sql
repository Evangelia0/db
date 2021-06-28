DROP DATABASE IF EXISTS Hotel;
CREATE DATABASE IF NOT EXISTS Hotel;
create table Client(
	first_name varchar(20) NOT NULL,
	last_name varchar(20) NOT NULL,
	date_of_birth date NOT NULL,
	document_of_id varchar(20) NOT NULL,
	email varchar(30),
	phone_number varchar(15) NOT NULL,
	NFC_ID varchar(30) NOT NULL,
	PRIMARY KEY(NFC_ID)
);

create table area(
	ID_area varchar(30) NOT NULL,
	Area_name varchar(20) NOT NULL,
	description_of_area varchar(100) NOT NULL,
	Num_of_rooms int NOT NULL,
	PRIMARY KEY(ID_area)
);

create table has_access(
NFC_ID varchar(30) NOT NULL,
ID_area varchar(30) NOT NULL,
Start_time time NOT NULL,
End_time time NOT NULL,
PRIMARY KEY(NFC_ID,ID_area),
FOREIGN KEY(NFC_ID) references Client(NFC_ID),
FOREIGN KEY(ID_area) references area(ID_area)
);

create table Visits(
NFC_ID varchar(30) NOT NULL,
ID_area varchar(30) NOT NULL,
Start_time time NOT NULL,
End_time time NOT NULL,
PRIMARY KEY(NFC_ID,ID_area),
FOREIGN KEY(NFC_ID) references Client(NFC_ID),
FOREIGN KEY(ID_area) references area(ID_area)
);

create table Services(
Service_ID varchar(30) NOT NULL,
Service_Descr varchar(100),
PRIMARY KEY(Service_ID)
);

create table Service_requires_registration(
Service_ID_Regis varchar(30) NOT NULL references Services(Service_ID),
PRIMARY KEY(Service_ID_Regis)
);

create table Service_doesnt_require_registration(
Service_ID_NonRegis varchar(30) NOT NULL references Services(Service_ID),
PRIMARY KEY(Service_ID_NonRegis)
);

create table service_charge(
date_of_charge date NOT NULL,
description varchar(100) NOT NULL,
amount numeric default 0,
NFC_ID varchar(30) NOT NULL,
Service_ID varchar(30) NOT NULL,
PRIMARY KEY(date_of_charge,NFC_ID,Service_ID),
FOREIGN KEY(NFC_ID) references Client(NFC_ID) ON DELETE CASCADE,
FOREIGN KEY(Service_ID) references Services(Service_ID)

);

create table Provided_in(
ID_area varchar(30) NOT NULL,
Service_ID varchar(30) NOT NULL,
PRIMARY KEY(ID_area,Service_ID),
FOREIGN KEY(ID_area) references area(ID_area),
FOREIGN KEY(Service_ID) references Services(Service_ID)
);

create table Registers(
NFC_ID varchar(30) NOT NULL,
Service_ID_Regis varchar(30) NOT NULL,
PRIMARY KEY(NFC_ID, Service_ID_Regis),
FOREIGN KEY(NFC_ID) references Client(NFC_ID),
FOREIGN KEY(Service_ID_Regis) references Service_requires_registration(Service_ID_Regis)
);

INSERT INTO Client(first_name,last_name,date_of_birth,document_of_id,email,phone_number,NFC_ID)
 VALUES('Eleni', 'Menegaki', '1976-6-5','ID','menegaki@gmail.com', '6975674345', 12),
       ('Asi', 'Bilioy', '1963-4-9','ID','asi@hotmail.com', '6944673378', 13),
        ('Nickie', 'Papasp', '1977-3-2','ID','nickie@hotmail.com', '6944673378', 14),
        ('Aneta', 'Ntourtoureka', '2002-02-04','ID','aneta@gmail.com', '6944673378', 15);

INSERT INTO area(ID_area,Area_name,description_of_area,Num_of_rooms)
 VALUES(1,'firstfloor', 'okay', 12),
       (2,'secondfloor', 'okay', 13),
        (3,'thirdfloor', 'okay', 14),
        (4,'fourthfloor', 'okay', 15);

INSERT INTO has_access(NFC_ID,ID_area,Start_time,End_time)
 VALUES(12,1,'09:00:00', '22:00:00'),
        (12,2,'09:00:00', '22:00:00'),
        (12,3,'09:00:00', '22:00:00'),
        (13,3,'09:00:00', '22:00:00'),
        (13,2,'09:00:00', '22:00:00'),
        (14,3,'09:00:00', '22:00:00'),
        (14,1,'09:00:00', '22:00:00'),
         (15,4,'09:00:00', '22:00:00');

INSERT INTO visits(NFC_ID,ID_area,Start_time,End_time)
 VALUES(12,4,'09:00:00', '22:00:00'),
        (12,3,'09:00:00', '22:00:00'),
        (12,1,'09:00:00', '22:00:00'),
        (13,3,'09:00:00', '22:00:00'),
        (13,2,'09:00:00', '22:00:00'),
        (14,3,'09:00:00', '22:00:00'),
        (14,1,'09:00:00', '22:00:00'),
         (15,4,'09:00:00', '22:00:00');

INSERT INTO Services(service_id,service_descr)
VALUES('Bar','the bar'),
       ('Gym','the gym'),
       ('Lobby','karaoke nights' ),
       ('Music Hall', 'Kaiti Garbi performing'),
       ('Pool','partying on weekends');

INSERT INTO service_requires_registration(Service_ID_Regis)
VALUES ('Gym'),
       ('Music Hall'),
       ('Pool');

INSERT INTO service_doesnt_require_registration(Service_ID_NonRegis)
VALUES ('Bar'),
       ('Lobby');

INSERT INTO service_charge(date_of_charge,description,amount,NFC_ID,Service_ID)
VALUES ('2021-08-2', 'Music Hall!', 13,12,'Music Hall'),
       ('2021-08-2', 'Gym!', 11,13,'Gym'),
       ('2021-09-2', 'Pool!', 15,15,'Pool'),
       ('2021-07-22', 'Gym!', 11,14,'Gym'),
       ('2021-09-2', 'Music Hall!', 13,14,'Music Hall');

INSERT INTO Provided_in(ID_area, Service_ID)
VALUES (1,'Lobby'),
       (1,'Bar'),
       (2,'Gym'),
       (3,'Gym'),
       (1,'Music Hall');

INSERT INTO Registers(NFC_ID, Service_ID_Regis)
VALUES(12,'Music Hall'),
       (12,'Gym'),
       (13,'Gym'),
       (14,'Pool');