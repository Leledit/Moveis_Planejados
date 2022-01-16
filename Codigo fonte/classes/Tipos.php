<?php

class Tipos{
	
	private $cod;
	private $nome;
	
	public function setDataFromRS($resultset){
	  $this->cod = $resultset["tip_cod"];

	  $this->nome = $resultset["tip_nome"];	
	 }
	 
	 public function setNome($nome){
		 if(strlen($nome)<5 || strlen($nome)<100)
		 return false;
		 
		 $this->nome = $nome;
		 return true;
		 }
		 
	 public function getCod(){
		return $this->cod;
	 }
	 public function getNome(){
	    return $this->nome;
	 }
	}


?>