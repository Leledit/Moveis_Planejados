<?php



class Orcamento{
	
	private $cod_produto;
	private $nome_clien;
	private $celular_clien;
	private $email_clien;
	private $status;
	
	// , , , , , 
	public function setDataFromRS($resultSet){
	   $this->cod_produto = $resultSet["Produtos_prod_cod"];
	   $this->nome_clien = $resultSet["orc_nome_clien"];
	   $this->celular_clien = $resultSet["orc_celular_clien"];
	   $this->email_clien = $resultSet["orc_email_clien"];
	   $this->status = $resultSet["orc_status"];
	  
	   }
	public function SetCodProd($cod_produto){
	  if(!is_numeric($cod_produto))
	   return false;
	   
	  $this->cod_produto = $cod_produto;
	  return true;
	}
	
	public function SetNomeCliente($nome_client){
		if(strlen($nome_client)<5 || strlen($nome_client >100))
			return false;
			
		  $this->nome_clien = $nome_client;
		  return true;
	}
	public function SetCelular($celular){   
	  $this->celular_clien = $celular;
	  return true;
	}
	public function SetEmail($email){	
	  $this->email_clien = $email;
	  return true;
	   	
	 
	} 
	 public function SetStatus($status){
	  $this->status = $status;
	  return true;	
	}
	//funçoes gets
	public function getCod()
		    {return $this->cod_produto;}
	public function getNomeCliente()
		    {return $this->nome_clien;}
	public function getValor()
		    {return $this->valor;}
	public function getCelular()
		    {return $this->celular_clien;}
	public function getEmail()
		    {return $this->email_clien;}
	public function getQtd()
		    {return $this->qtd;}
	public function getStatus()
		    {return $this->status;}
}



?>