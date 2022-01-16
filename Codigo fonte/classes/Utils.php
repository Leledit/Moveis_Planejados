<?php

class Utils{
	
	//esta classe define algumas funçoes uteis para a aplicaçao, como carregar 
	// o banco de dados e o arquivo de configuraç~
	
	public function getConfigVars(){
		
		//essa função tem a resposabilidade de ler o arquivo de configuraçao da aplicação , definido pelo usuario
		///, em busca do valor de uma variavel especifica. Este metodo pode ser otimizado, lendo todas as variaveis 
		//e disponibilizando-as em uma array armazenado em sessão
		
		//caminho do arquivo de configuraçoes , em diretorio que nao possua
		//acesso externo(internet) , mas sim , somente interno no servidor.
		$arquivo = file("config/properties.ini");
		$configVars = array();
		
		//le o arquivo linha por linha
		for($i=0;$i<count($arquivo);$i++){
			 //captura a posição do sinal '='
			 $equals =  strpos($arquivo[$i],'=');
			 
			 //captura o nome da variavel
			 $varName = substr($arquivo[$i],0,$equals);
			 
			 //captura o valor
			 $varValue = substr($arquivo[$i],
			                          $equals+1 , //soma um para nao conter o caracter '='
									  strlen($arquivo[$i])-$equals);//le o tamanho da linha menos o que ja foi lido at o sinal de '='
			//remove eventuais finais de linha capturados no arquivo
			$varValue = str_replace("\n","",$varValue);
			$varValue = str_replace("\r","",$varValue);
									  
			$configVars[$varName] = $varValue;						
			 
			}//fechameto do for
		   return $configVars;
		}
	
	public function getDatabaseConnection(){
		
		//esta funçao obtem as informaçoes de banco de dados a ser ultilizado em um arquivo de configuração
		// criadi pelo programador , para esta aplicação.
		//baseado nas informaçoes , cria o objeto de acordo com o tipo desejado
		
		//captura os dados de um arquivo de configuração , inclusive se é MYSQL, ou outros
		$configVars = $this->getConfigVars();
		
		$dbTempAddress = $configVars["DB_ADDRESS"];
		$dbTempPort  = $configVars["DB_PORT"];
		$dbTempUser  = $configVars["DB_USER"];
		$dbTempPassword = $configVars["DB_PASSWORD"];
		$dbTempName = $configVars["DB_NAME"];
		$dbTemp = null;
		$dbTempType = "MySQL";
	     
		 if($dbTempType == "MySQL")
		   $dbTemp = new MySQL();
		                 
		 else if($dbTempType == "PostgreSQL")
		   $dbTemp = new SQLServer(); //necessario iimplementar a classe PostgreSQL
		   
		  if($dbTemp != null)
			  $dbTemp->setConfig($dbTempAddress,$dbTempPort,$dbTempUser,$dbTempPassword,$dbTempName);
			  
			  return $dbTemp;
			 
			  
		}
	
	
	}


?>