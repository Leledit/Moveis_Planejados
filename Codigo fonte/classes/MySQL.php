<?php 

include_once("BancoDados.php");


class MySQL extends BancoDados{
	              
	
	//essa clase foi implementada para interagir com o banco de dados
	//herdando os metodos abstratos definidos na classe BancoDados 
	
	//define os dados de conexão com o banco de dados
	public function setConfig($server, $port , $user,$password , $db){
		$this->server = $server ;
		$this->port = $port;
		$this->user = $user;
		$this->password = $password;
		$this->db = $db;
		}
		

/*daqui para baixo ok*/
		
	public function limparSqlInject($strinsql){
		
		return mysqli_escape_string($this->connection, $strinsql);
		
		}	
	//Conexta ao banco de dados
	public function connect(){
		//formata o endereço e a porta do servidor
		$address = $this->server;
		if($this->port != "")
		$address .= ":".$this->port;
		
		$this->connection = mysqli_connect($address,$this->user , $this->password , $this->db) or die('Nao foi possivel conectar :'.mysqli_error($this->connection));
		}
		
     //desconecta do banco de dados
	 public function disconnect(){
		if($this->connection)
		  mysqli_close($this->connection);
		}
		
		//execulta comandos sql
	public function executeCommand($sql){
			
		if($this->connection)
		{
			$this->resultSet = mysqli_query($this->connection, $sql);
			return TRUE;
		}
		else
			return FALSE;
	}
	
			
			
		//retorna o proximo result set da consulta
		public function getNextResultSetPosition(){
			 return mysqli_fetch_array($this->resultSet);
			}
			
	    //retorna o numero de registros alterados no ultimo comando realizado
		public function getAffectdRows(){

		 return mysqli_affected_rows($this->connection);
		}
		
		public function getFetchArray(){
		  
		  return mysqli_fetch_array($this->resultSet);	
		
		}
		public function getfetchassoc(){
		  return mysqli_fetch_assoc($this->resultSet);
		}
		
		public function resultset(){
		  return $this->resultSet;
		}
		//retorna se ocoreu algum erro no ultimo comando realizado 
		public function getError(){
		 return  mysqli_error($this->connection);	
		}
		
	}

?>