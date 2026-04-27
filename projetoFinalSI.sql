Drop database if exists projetoFinalSI;
create database projetoFinalSI;
use projetoFinalSI;

create table user(
    id int unsigned AUTO_INCREMENT not null ,
    email varchar(225) not null unique ,
    password varchar(225) not null,
    name varchar(225) not null,
    PRIMARY KEY (id, email)
);