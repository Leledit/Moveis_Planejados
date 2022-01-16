
function setaImage(){
	
	var setting ={
		
		primeiraImg: function(){ /*seta a primeira imagen que ira apaarecer no nosso slids*/
			
			elemento = document.querySelector(".first");/*captura a primeira tag da"div#slider" e coloca numa variavel elemento */
			elemento.classList.add("ativo");/*coloca a class "ativo" na tag capturada*/
			
		},
		
		slide: function(){
			elemento = document.querySelector(".ativo");
			if(elemento.nextElementSibling){
				elemento.nextElementSibling.classList.add("ativo");	  
				elemento.classList.remove("ativo")
			}
			else
			{
				elemento.classList.remove("ativo");
				setting.primeiraImg();
			}
			
		},
		
	
		proximo:function(){
			
			clearInterval(intervalo);
			elemento = document.querySelector(".ativo");
			if(elemento.nextElementSibling){
				elemento.nextElementSibling.classList.add("ativo");	
				elemento.classList.remove("ativo");
		 
			}
			else
			{
				elemento.classList.remove("ativo");
				setting.primeiraImg();
			}
			intervalo = setInterval(slide,4000);
		},//fechamento da funcao proximo
	
	
		anterior: function(){
			
			clearInterval(intervalo);
	
			elemento = document.querySelector(".ativo");
			if(elemento.previousElementSibling){
				elemento.previousElementSibling.classList.add("ativo");
				elemento.classList.remove("ativo");	
			}
			else
			{
				elemento.classList.remove("ativo");					
				elemento = document.querySelector(".end");
				elemento.classList.add("ativo");
			}
			intervalo = setInterval(slide,4000);
		},//fechamento da função
		
		parar: function(){
			
			clearInterval(intervalo);
			
		},
		
		reiniciar: function(){
			
			intervalo = setInterval(setting.slide,4000);

		}
		
		
		
	}

	//chama o slide a um determinado tempo
	var intervalo = setInterval(setting.slide,4000);

	document.querySelector(".next").addEventListener("click",setting.proximo,false);
	document.querySelector(".prev").addEventListener("click",setting.anterior,false);
	document.querySelector("#photo-viewer").addEventListener("mouseover",setting.parar,false);
	document.querySelector("#photo-viewer").addEventListener("mouseout",setting.reiniciar,false);

}

window.addEventListener("load",setaImage,false);/*execulta a funçao "setaImage* quando a janela for carregada*/

