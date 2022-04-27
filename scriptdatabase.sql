create table usuarios(
    id INT not null AUTO_INCREMENT,
    nome varchar(100) not null,
    login varchar(15) not null,
    email varchar(100) not null,
    senha varchar(100) not null,
    datacadastro datetime not null,
    dataultimoacesso datetime not null,
    PRIMARY KEY ( id )
);

INSERT INTO usuarios(nome, login, email, senha, datacadastro, dataultimoacesso) 
values ('Matheus Santos','admin', 'matheustss0279@gmail.com', '123', '2017-03-14 15:45:00.000', '2017-03-14 15:45:00.000')