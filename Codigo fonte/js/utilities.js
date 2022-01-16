// Helper function to add an event listener
function addEvent (el, event, callback) {
  if ('addEventListener' in el) {                  // If addEventListener works
    el.addEventListener(event, callback, false);   // Use it
  } else {                                         // Otherwise
    el['e' + event + callback] = callback;         // CreateIE fallback
    el[event + callback] = function () {
      el['e' + event + callback](window.event);
    };
    el.attachEvent('on' + event, el[event + callback]);
  }
}

// Helper function to remove an event listener
function removeEvent(el, event, callback) {
  if ('removeEventListener' in el) {                      // If removeEventListener works
    el.removeEventListener(event, callback, false);       // Use it 
  } else {                                                // Otherwise
    el.detachEvent('on' + event, el[event + callback]);   // Create IE fallback
    el[event + callback] = null;
    el['e' + event + callback] = null;
  }
}

//função responsavel por fazer com que a mensagem de erro desapareça ao clicar no campo de texto

function MsgDesaparecer(){
	
	elemento = document.querySelector(".adm_log_Msg");
	elemento.classList.add("adm_log_Msg_fal");
	
	}

/// funçao resposnavel por mostrar ou ocultar a senh digitada pelo usuario do sistema	



function MostrarSenha(){
	
	
	
	var inputsenha = document.querySelector('#log_senha');
	var tiposenha = inputsenha.getAttribute('type');
	var inputexsenha = document.querySelector('#log_ex_senha');
  
    if(!document.querySelector('#log_senha').value.length  == 0){
		if(tiposenha == 'password'){
		
		inputsenha.setAttribute('type','text');
	    inputexsenha.setAttribute('value','Ocultar Senha');
	    
		
	}else{
		inputsenha.setAttribute('type','password');
		inputexsenha.setAttribute('value','Exibir Senha');
	}
		
		}
	
	
	
  
	
	}



document.querySelector("input").addEventListener("click",MsgDesaparecer,false);
document.querySelector("#log_ex_senha").addEventListener("click",MostrarSenha,false);
//document.querySelector("input").addEventListener("0",MsgDesaparecer,false);