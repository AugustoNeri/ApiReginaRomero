$(document).ready(function () {
	
      //Despliega el menu del filtro de las sucursales
      mostrarMenu("dropdown-btn");
		
	  $(buscarModelo());

}); 


function filterSearch() {
	$('.searchResult').html('<div id="loading">Cargando .....</div>');
	var actions = 'fetch_data';

	var brand = getFilterData('brand');
	var ram = getFilterData('ram');
	var storage = getFilterData('storage');
	$.ajax({
		url:"action.php",
		method:"POST",
		dataType: "json",		
		data:{actions:actions, ram:ram, storage:storage},
		success:function(data){
			$('.searcInventario').html(data);
		}
	});
}
function getFilterData(className) {
	var filter = [];
	$('.'+className+':checked').each(function(){
		filter.push($(this).val());
	});
	return filter;
}

function mostrarMenu(texto){
	var dropdown = document.getElementsByClassName(texto);
	 var i;

	 for (i = 0; i < dropdown.length; i++) {
	   dropdown[i].addEventListener("click", function() {
	   this.classList.toggle("active");
	   var sucursales = this.nextElementSibling;
	   if (sucursales.style.display === "block") {
	    	sucursales.style.display = "block";
	   } else {
	   		sucursales.style.display = "block";
	   }
	   });
	 }
}

function buscarModelo(consulta){
   $.ajax({
	   url:'buscador.php',
	   type:'POST',
	   dataType:'html',
	   data:{consulta,consulta},
   })
   .done(function(respuesta){
	   $("#containerModelo").html(respuesta);
   })
   .fail(function(){
	   console.log("error");
   })
}

$(document).on('keyup','#btxtModelo',function(){
   var valor = $(this).val();
   if(valor!=""){
	   buscarModelo(valor);
   }else{
	   buscarModelo();
   }
})





