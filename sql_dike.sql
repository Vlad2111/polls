CREATE SEQUENCE id INCREMENT BY 1;

create table alluser(
id_user integer DEFAULT NEXTVAL('id'),
last_name character(50),
first_name character(50),
patronymic character(50),
type character(50),
email character(50),
login character(50) NOT NULL,
password integer NOT NULL,

constraint user_pkeys primary key (id_user));

create table role (
id_role integer DEFAULT NEXTVAL('id'),
description character (50),
constraint role_pkey primary key (id_role));

create table role_user (
id_user integer not null,
id_role integer not null,
    constraint user_role_fkey foreign key (id_user) references alluser(id_user),
    constraint role_user_fkey foreign key (id_role) references role(id_role));

insert into alluser values 
('1', 'Иван', 'Иванов','Михалович', 'admin', 'admin@mail.ru', 'Иван', '1'),
('2', 'Михаил', 'Тюбиков','Иваныч', 'compiler', 'compiler@mail.ru', 'Михаил', '2'),
('3', 'Сергей', 'Иванов', 'Николаевич','test', 'test@mail.ru', '3', 'Сергей' );

insert into role values
	('1', 'Полный доступ', 'admin'),
	('2', 'Создание', 'compiler'),
	('3', 'Выполнение теста', 'test');

insert into role_user values
	('1', '1'),
	('2', '2'),
	('3', '3');

