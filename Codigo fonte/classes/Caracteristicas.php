<?php 


class caracteristicas{
	
	
	private $cod;
	private $tipos;
	private $prod_cod;
	private $calc_valor;
	
	 
	public function setDataFromRS($resultset){
	$this->cod = $resultset["carc_cod"];
	$this->tipos = $resultset["Tipos_tip_cod"];
	$this->prod_cod = $resultset["Produtos_prod_cod"];
	$this->calc_valor = $resultset["carc_valor"];
		
		}
		public function setTip_cod($Tipo_cod){
		 if(!is_numeric($Tipo_cod))
		  return false;
		  
		  $this->tipos = $Tipo_cod;
		  return true;
		}
		public function setProd_cod($Prod_cod){
		 if (!is_numeric($Prod_cod))
		     return false;
			 
		 $this->prod_cod = $Prod_cod ;	
		 return true;	
		}
		public function setCalcValor($calc_valor){
		 if(strlen($calc_valor)<5 || strlen($calc_valor <100))  
		 return false;
		 
		 $this->calc_valor = $calc_valor;
		 return true;
			}
			
			public function getCod(){
			  return $this->cod;	
			}
			public function getTipo(){
			  return $this->tipos;
			}
			public function getProdCod(){
			  return $this->prod_cod;
			}
			public function getCalcValor(){
			 return $this->calc_valor;
			}
	
	
	}

?>