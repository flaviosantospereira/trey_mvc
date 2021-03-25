O padrão dos paths se encontram como:

http://localhost/trey_mvc/

----------------------------------------------------------------------------

Email:

Habilitar acesso de apps menos seguros a conta que será utilizada para teste.
Configurar usuário de email e senha que será utilizado em trey_mvc/mail/mail.php
Configurar crontable para manipular a data e hora.

----------------------------------------------------------------------------

Dados do DB:

database: trey_db
port: 3306
username: root
password: root

----------------------------------------------------------------------------

Criação do trey_db:

create database trey_db

----------------------------------------------------------------------------

Comandos de criação de tabelas:

CREATE TABLE trey_db.salesman (
salesman_id INT AUTO_INCREMENT PRIMARY KEY,
salesman_name VARCHAR(30) NULL,
salesman_email VARCHAR(60) null,
created_by int not null,
created_at datetime null,
updated_by int null,
updated_at datetime null,
active varchar(5) null)

CREATE TABLE trey_db.sales (
sale_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
salesman_id INT NULL,
sale_value DECIMAL(10,2) NULL,
sale_date DATETIME  NULL,
created_at DATETIME NULL,
updated_at DATETIME NULL,
created_by VARCHAR(30) NULL,
updated_by VARCHAR(30) NULL,
active varchar(5) null,
FOREIGN KEY (salesman_id) REFERENCES salesman(salesman_id))

CREATE TABLE users (
user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_name VARCHAR(30) NOT NULL,
user_email VARCHAR(60) NOT NULL UNIQUE,
user_password VARCHAR(255) NOT NULL,
user_role TINYINT NULL,
created_at DATETIME not null)

----------------------------------------------------------------------------