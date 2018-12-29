function listaActividades() {
	$.getJSON( "forms/lista_actividades.php", { "parametro1" : "valor1"} )
    .done(function( data, textStatus, errorThrown ) {
    	$('#listado_actividades').empty()
		$('#listado_actividades').append("<table>");
		$('#listado_actividades').append("<tr>");
		$('#listado_actividades').append("<th> Evento </th>");
		$('#listado_actividades').append("<th> Descripción </th>");
		$('#listado_actividades').append("<th> Precio (€)</th>");
		$('#listado_actividades').append("<th> Límite de personas </th>");
		$('#listado_actividades').append("<th> Fecha </th>");
		$('#listado_actividades').append("<th> Hora inicio </th>");
		$('#listado_actividades').append("<th> Duración </th>");
		$('#listado_actividades').append("</tr>");
    	for (var i in data) {
    		$('#listado_actividades').append("<tr>");
    		$('#listado_actividades').append("<td>" + data[i].summary + "</td>");
    		$('#listado_actividades').append("<td>" + data[i].descripcion + "</td>");
    		$('#listado_actividades').append("<td>" + data[i].precio + "</td>");
    		$('#listado_actividades').append("<td>" + data[i].limite + "</td>");
    		$('#listado_actividades').append("<td>" + data[i].fecha + "</td>");
    		$('#listado_actividades').append("<td>" + data[i].hora + "</td>");
    		$('#listado_actividades').append("<td>" + data[i].duracion + "</td>");
    		$('#listado_actividades').append("</tr>");
    	}
		$('#listado_actividades').append("</table>");
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        if ( console && console.log ) {
            console.log( "Algo ha fallado: " +  textStatus + errorThrown);
        }
    });
}

function initMap() {
        var myLatLng = {lat: 38.361222, lng: -0.487733};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: myLatLng
        });

        var locations = [
      ['Bondi Beach', 38.363222, -0.483733, 4],
      ['Coogee Beach', 38.365222, -0.484733, 5],
      ['Cronulla Beach', 38.368222, -0.489733, 3],
      ['Manly Beach', 38.361122, -0.487133, 2],
      ['<h3>Prueba 1</h3><p>Texto descriptivo y tal y tal</p><p></p><p>Precio: 10€</p>', 38.362222, -0.480733, 1]
      ];

      var infowindow = new google.maps.InfoWindow();

  var marker, i;

  for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));
}
}
