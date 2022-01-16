<?php 

abstract class BancoDados{
	//essa classe abstrata define os metodos que as classes que a herdam dvem implementar
	//de forma concreta , padronizando os nomes dos metods independente do banco de dados a ser implementado 
	
	protected $server;             //armazen o endereço do servidor
	protected $port;               //armazena a porta de conexao
	protected $user;               //armazena o nome de usuario para conexao
	protected $password;           //armazena a senha de usuario para conexao
	protected $db;                 //armazena o nome do banco de dados
	protected $connection;         //armazena os dados de uma conexao
	protected $resultSet;          //armazena o ResultSet de uma consulta
	
	
	//define os dados de conexão com o banco de dados
	abstract public function setConfig($server, $port, $user, $password, $db);
	
	//conexat o banco de dados
	abstract public function connect();
	
	//desconexta do banco de dados
	abstract public function disconnect();
	
	//executa comandos sql
	abstract public function executeCommand($sql);
	
	//retorna o proximo result set da consulta
	abstract public function getNextResultSetPosition();
	
	//retorna o numero de registros do ultimo comando realizado
	abstract public function getAffectdRows();
	
	//retorna se ocorreu algum erro no ultimo comando realizado 
	abstract public function getError();
	
	}

?>