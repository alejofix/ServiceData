
	var controller = new Object();
	jQuery.extend(controller, {
		
		init : function() {
			controller.aprobado();
			controller.noAprobado();
		},
		
		aprobado: function() {
			jQuery(".aprobado").click(function() {
				var id = jQuery(this).attr('data');
				var mejora = jQuery(this).attr('data-mejora');
				swal({
					title : "Esta usted Seguro",
					text : "Esta seguro de aprobar este Objetivo",
					type : "info",
					showCancelButton: true,
					confirmButtonColor: "#2c7ea1",
					confirmButtonText: "Si, Aprobar Objetivo",
					closeOnConfirm: false
				},
				function() {
					controller.ajaxAprobado({ id : id, mejora : mejora, token : "da39a3ee5e6b4b0d3255bfef95601890afd80709" });
				});
			});	
		},
		
		ajaxAprobado: function(array) {
			jQuery.ajax({
				url : "{{ RUTA_APP|e }}/Mejoras/Gestion/ajaxAprobado",
				data: array,
				dataType : "json",
				type: "POST",
				success: function(respuesta) {
					controller.ajaxAprobadoSuccess(respuesta, array.id);
				}
			});
		},
		
		ajaxAprobadoSuccess: function(respuesta, id) {
			var clase = (respuesta.status == true) ? "alert alert-info" : "alert alert-danger";
			jQuery("#action_" + id).empty().html('<strong>' + respuesta.estado + '</strong>');
			jQuery("#list_" + id).attr("class", clase);
			swal("Aprobado!", "Se ha aprobado el objetivo seleccionado.", "success");
		},
		
		noAprobado: function(){
			jQuery(".no_aprobado").click(function() {
				var id = jQuery(this).attr('data');
				var mejora = jQuery(this).attr('data-mejora');
				swal({
					title: "Objetivo No Aprobado",
					text: "Escriba la razon para no ser aprobado:",
					type: "input",
					showCancelButton: true,
					closeOnConfirm: false,
					animation: "slide-from-top",
					inputPlaceholder: "Razón"
				},
				function(inputValue) {
					if (inputValue === false) 
						return false;
						
					if (inputValue === "") {
						swal.showInputError("Debe ingresar la razón Correspondiente");
						return false
					}
					
					controller.ajaxNoAprobado({ id : id, descripcion : inputValue, mejora : mejora, token : "da39a3ee5e6b4b0d3255bfef95601890afd80709"});
				});
			});
		},
		
		ajaxNoAprobado: function(array) {
			jQuery.ajax({
				url : "{{ RUTA_APP|e }}/Mejoras/Gestion/ajaxNoAprobado",
				data: array,
				dataType : "json",
				type: "POST",
				success: function(respuesta) {
					controller.ajaxNoAprobadoSuccess(respuesta, array.id);
				}
			});
		},
		
		ajaxNoAprobadoSuccess: function(respuesta, id) {
			jQuery("#action_" + id).empty().html('<strong>' + respuesta.estado + '</strong>');
			jQuery("#list_" + id).attr("class", "alert alert-danger");
			
			var tipo = (respuesta.status == true) ? "success" : "error";
			swal("Razon Guardada", "Se ha generado la no aprobacion del objetivo", tipo);
		}
	});