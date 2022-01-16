create database Macomp;
use macomp;


CREATE TABLE Imagens (
  img_cod INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  img_titulo VARCHAR(100) NULL,
  img_src VARCHAR(100) NULL,
  PRIMARY KEY(img_cod)
);
CREATE TABLE Produtos (
  prod_cod INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Imagens_img_cod INTEGER UNSIGNED NOT NULL,
  prod_titulo VARCHAR(100) NULL,
  prod_ativo ENUM('S','N') NULL,
  PRIMARY KEY(prod_cod),
  INDEX Produtos_FKIndex1(Imagens_img_cod)
);



CREATE TABLE Usuarios (
  usu_cod INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  usu_nome VARCHAR(100) NULL,
  usu_usuario VARCHAR(100) NULL,
  usu_senha VARCHAR(60) NULL,
  PRIMARY KEY(usu_cod)
);

CREATE TABLE Orçamento (
  orc_cod INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Produtos_prod_cod INTEGER UNSIGNED NOT NULL,
  orc_nome_clien VARCHAR(100) NULL,
  orc_celular_clien INTEGER UNSIGNED NULL,
  orc_email_clien VARCHAR(100) NULL,
  orc_qtd_prod INTEGER UNSIGNED NULL,
  orc_valor_total INTEGER UNSIGNED NULL,
  orc_status ENUM('Encerrado','Aberto') NULL,
  PRIMARY KEY(orc_cod, Produtos_prod_cod),
  INDEX Orçamento_FKIndex1(Produtos_prod_cod)
);
SELECT * FROM usuarios u;

insert into usuarios(usu_nome, usu_usuario, usu_senha) value('leandro ricardo caixeta junior','leandro','e10adc3949ba59abbe56e057f20f883e');



