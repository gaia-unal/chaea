window.addEventListener('DOMContentLoaded',	strategyCrud)

var co=0;


	function ajaxSettingStrategy(strategy,action) {
				var strategys = strategy;
				var strategy = JSON.stringify(strategy);
				$.ajax({
					method:"POST",
					url: "/chaea/backendPhp/strategySQL/a-StrategyActivity.php",
					data: {"action":action,"strategy":strategy}
				}).done( function( info ){
					if(Number(info)==1){
						 mensajeSend("Se registro correctamente la estrategia: "+ strategys[0]);
						 $('#formStrategy')[0].reset();
						 document.getElementById('id13').style.display='none';
					}else if (Number(info)==2) {
						 mensajeWarning("La estrategia: \""+strategys[0]+"\" ya existe para este estilo de aprendizaje.\nDebe tener otro nombre");
					}else if(Number(info)==3){
						 mensajeSend("Se actuaizo correctamente el la estrategia: "+ strategys[0]);
						 document.getElementById('id13').style.display='none';
					}else {
						mensajeSend(info);
					}
				});
			}






			function mensajeSend(info){
				$('#InfoUser').html(`<h4>`+info+`</h4>`);
				var modalInfo = document.getElementById('id04');
				modalInfo.style.display='block';
				 $("#id04").fadeOut(9000);
				 $("#acep").click(function(){
						$("#id04").stop(true, true);
					});
			}
			function mensajeWarning(info){
				$('#warningInfo').html(`<h4>`+info+`</h4>`);
				var modalWarning = document.getElementById('id09');
				modalWarning.style.display='block';
				$("#acep").click(function(){
					 $("#id04").stop(true, true);
				 });
			}
			function mensajePanelS(info, option){
				switch (option) {
					case 1:
						$('#infoPanel1').html("<div id='infoPanelClose' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick=\"$('#infoPanelClose').hide();\" data-dismiss='alert'>&times;</button><strong>"+info+"</strong></a> </div>");
						return false;
						break;
					case 2:
						$('#infoPanel2').html("<div id='infoPanelClose' class='alert alert-dismissible alert-warning'><button type='button' class='close' onclick=\"$('#infoPanelClose').hide();\" data-dismiss='alert'>&times;</button><strong>"+info+"</strong></a> </div>");
						return false;
						break;
				}
				return false;

			}
			function newStrategy(){

				 //esta función me permite crear un vector que son los atributos de la persona y luego llama la función ajaxpost
				   var name_strategy = document.getElementById('name_strategy').value; /*0*/
				   var id_type_learning = document.getElementById('id_type_learning').value; /*1*/
				   var strategy = new Array(name_strategy,id_type_learning);
				   var bas = 0;
				   for (let i in strategy){if((strategy[i]=="") ) {bas++;}}
							if (bas==0){
								 $('#infoPanelClose').hide();
								 ajaxSettingStrategy(strategy,2);
								 loading();

							 }else{
								 let info='Debe ingresar todos los datos que se solicitan.';
								 mensajePanelS(info,1);
								 bas=0;
						 }
 				 }



 //Funcion editar strategy.
     var get_edit_strategy = function(tbody, table){
       $(tbody).on('click','#editStrategy', function(){
         try {
					 		let data = table.row( $(this).parents("tr") ).data();
					 		let id_learning;
            //  $('#name_edit_strategy').html('Esta editando el curso '+data.name_course);
						 $('#id_edit_strategy').val(data.id_str);
             $('#name_edit_strategy').val(data.str_des);
						 if(data.ty_lear_des=='activo'){
							 id_learning = 1;
						 }else if (data.ty_lear_des=='reflexivo') {
							 id_learning = 2;
						 }else if (data.ty_lear_des=='teórico') {
							 id_learning = 3;
						 }else if (data.ty_lear_des=='pragmático') {
							 id_learning = 4;
						 }
						 $('#id_type_learning_edit').val(id_learning);

					 	document.getElementById('id14').style.display='block';
         } catch (e) {
             console.error(e);
         }

      });
     }

	 //Funcion eliminar strategy.
	 var get_data_delete =function(tbody, table){
		 $(tbody).on('click','button.delete', function(){
			 try {
				 var data = table.row($(this).parents("tr")).data();
				 $('#elements').html('¿Seguro que desea eliminar la estrategia: '+data.str_des+'?');
				 $('#id_element').val(data.id_str);
				 document.getElementById('id01').style.display='block';
			 } catch (e) {  }

		 });
	 }
		 //Funcion que toma los datos del formulario de edición de la actividad
	 	function editThisStrategy(){
			let bas = 0;
	 		let name_edit_strategy = $('#name_edit_strategy').val();/*0*/
	 		let id_type_learning_edit = $('#id_type_learning_edit').val();/*1*/
	 		let id_edit_strategy = $('#id_edit_strategy').val();/*2*/
	 		let strategy = [name_edit_strategy, id_type_learning_edit, id_edit_strategy];
	 				for (let	 i in strategy){if((strategy[i]=="") ) {bas++;}}
	 				if (bas==0){
	 						$('#infoPanelClose').hide();
							ajaxSettingStrategy(strategy,3);
	 						loading();
							document.getElementById('id14').style.display='none';

	 				}else{
	 					let info='Debe ingresar todos los datos que se solicitan.';
	 					mensajePanelS(info,2);
	 					bas=0;
	 				}


	 	}
	 	//fin editar.


function strategyCrud(){
	//Agregar una Estrategia
	var 	btn_profile = document.getElementById('addStrategy');
		btn_profile.addEventListener('click', function (){
			document.getElementById('id13').style.display='block';
	});
	var 	btn_profile = document.getElementById('add_strategy');
		btn_profile.addEventListener('click', function (){
			newStrategy();
	});

	//Editar una Estrategia

	$( "#edit_strategy" ).click(function() {
		editThisStrategy();
	});
	$("#deleteElement").click(function(){
    var id_element = document.getElementById('id_element').value;
    ajaxSettingStrategy(id_element,4);
	  loading();
		document.getElementById('id01').style.display='none';
	});



}
