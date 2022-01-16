<?php 

class Usuario{
	
	//usario responsavel por acessar a parte administrativa do site aonde se altera os produtos do site
	
	private $id_usu;
	private $nome;
	private $usuario;
	private $senha;
	
	/*
	 Recebe um ResultSet com os campos da tabela USUARIO do banco de daods e popula as informaçoes de uma pessoa
	*/

	public function setDataFromRS($resultSet){
		$this->id_usu = $resultSet["usu_cod"];
		$this->nome = $resultSet["usu_nome"];
		$this->usuario = $resultSet["usu_usuario"];
		$this->senha = $resultSet["usu_senha"];
		
		}
		
		//conjunto de funçoes setters
		public function setNome($nome){
			if(strlen($nome) < 5 || strlen($nome) > 100)
			  return false;
			  
		   $this->nome = $nome;
		   return true;
			}
	   public function setUsuario($usuario){
		  if(strlen($usuario) < 5 || strlen($usuario) > 100)
			  return false;
			  
		   $this->usuario = $usuario;
		   return true;
		   }
		   
	    public function setSenha($senha){
		  if(strlen($senha)<5 || strlen($senha) > 60)
			  return false;
			  
		   $this->senha = md5($senha);
		   return true;
		   }
		   
		   //conjunto de funçoes getters
		   
		   public function getId_usu()
		   {return $this->id_usu;}
		   
		   public function getNome()
		   {return $this->nome;}
		   
		   public function getUsuario()
		   {return $this->usuario;}
		   
		   public function getSenha()
		   {return $this->senha;}
	}

?>