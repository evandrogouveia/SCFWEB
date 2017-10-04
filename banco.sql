create database scfweb;

use scfweb;

create table funcionario(
     idfuncionario integer auto_increment primary key,
     matricula varchar(20)not null,
     nome varchar(50)not null,
     telefone varchar(20)not null,
     sexo varchar(5)not null,
     email varchar(50)not null,
     salario double(10,2)not null
);

create table endereco(
     idendereco integer auto_increment primary key,
     endereco varchar(50)not null,
     bairro varchar(50)not null,
     cep varchar(20)not null,
     cidade varchar(50)not null,
     estado varchar(20)not null,
     idfuncionario integer
);

alter table endereco add constraint fkendfunc
   foreign key(idfuncionario)references funcionario(idfuncionario)
   on delete cascade;

use scfweb;

alter table funcionario add column idcargo integer unsigned;

alter table funcionario add constraint fkfunccargo
    foreign key(idcargo) references cargos(id)
    on delete cascade;
