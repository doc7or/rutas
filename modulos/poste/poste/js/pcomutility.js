/*
Funzione per la valorizzazione in js di campi input e la pulizia automatica sull onFocus:
prende una hash map come parametro in entrata: selettore : testo da visualizzare
se il value del campo è vuoto, viene riassegnato il valore della map
EX:
			var map = { 
				'#username': 'Nome utente', 
				'#password': 'password',
			};
*/			
			function pulisciInput(map){
				$.each(map, function(key, value) {

					$(key).val(value);

					$(key).focus(function(){
						if($(this).val()==value){
							$(this).val("");
						}
					});

					$(key).focusout(function(){
						if($(this).val()==""){
							$(this).val(value);
						}
					});

				});

			};