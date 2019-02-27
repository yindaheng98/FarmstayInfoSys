create user Farmstay identified by 'Farmstay';
GRANT SELECT ,UPDATE ,INSERT ON Farmstay.* TO 'Farmstay'@'localhost' IDENTIFIED BY 'Farmstay';
flush privileges;

create user City identified by 'City';
GRANT SELECT ,UPDATE ,INSERT ON City.* TO 'City'@'localhost' IDENTIFIED BY 'City';
flush privileges;
