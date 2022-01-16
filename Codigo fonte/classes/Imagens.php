<?php

class imagens{
	
	
	private $cod;
	private $titulo;
	private $src;

	public function setDataFromRS($resultSet){
	  $this->cod = $resultSet["img_cod"];	
	  $this->titulo = $resultSet["img_titulo"];
	  $this->src = $resultSet["img_src"];
	 
	}
	
	public function setTitulo($titulo){
		if(strlen($titulo)<5 || strlen($titulo)<100)
		return false;
		
		$this->titulo = $titulo;
		return true;
		
		}
		
	public function setSrc($src){
	   if(strlen($src)<5 || strlen($src)>100)
	   return false;
	   
	   $this->src = $src;
	   return true;	
	 
	 }
	 
	 public function getCod(){
		return $this->cod; 
		 }
		 
	public function gettTitulo(){
	  return $this->titulo;
	 }
	 
	 public function getSrc(){
	  return $this->src;	 
	}
	
	
	
	}




?>