drop database if exists programacion;
create database programacion;
use programacion;

create table Tarea(
	id int auto_increment primary key,
	titulo varchar(60),
	contenido varchar (255),
	estado varchar(20) default "Pendiente",
	autor varchar(20),
	created_at timestamp,
	updated_at timestamp,
	deleted_at timestamp
);
