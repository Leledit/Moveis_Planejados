<?php 

include_once("MySQL.php");


class produtos{
	
	 
	
	private $cod ;
	private $imagen;
	private $titulo;
	private $ativo;
     
	 

	 /*
	 Recebe um ResultSet com os campos da tabela USUARIO do banco de daods e popula as informaçoes de uma pessoa
	*/
	
	 public function setDataFromRS($resultSet){
	   $this->cod = $resultSet["prod_cod"];
	   $this->imagen = $resultSet["Imagens_img_cod"];
	   $this->titulo = $resultSet["prod_titulo"];
	   $this->ativo = $resultSet["prod_ativo"];
	   }
	   
	   
	  
	   
	  
	   
	   //conjunto de funçoes sets
	   
	
	   public function setcod($imagen){
		$this->imagen = $imagen;
	   }
	   
	    public function setativo($ativo){
		$this->ativo = $ativo;
	   }
	   
	   public function settitulo($titulo){
		 if(strlen($titulo)<5 || strlen($titulo) > 100)
			  return false;
			  
		   $this->titulo = $titulo;
		   return true;   
	   }
	   
	  
	  //inicio das funçoes gets
	
	       public function getCod()
		    {return $this->cod;}
		   
		   public function getImagen()
		    {return $this->imagen;}
		   
		   public function getTitulo()
		    {return $this->titulo;}

		    public function getativo()
		    {return $this->ativo;}
		   
	}//fechamento da class produtos
	
	
  

?>