Drop database if exists projetoFinalSI;
create database projetoFinalSI;
use projetoFinalSI;

create table user(
    id int unsigned primary key AUTO_INCREMENT not null ,
    email varchar(225) not null unique ,
    password varchar(225) not null
);

