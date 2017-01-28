<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<script>

	getLocation();

	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		}
		else {
			//add_point();
		}
	}

	function showPosition(position) {
			console.log(position);
	}

	/*
	navigator.geolocation.getCurrentPosition(inCasoDiSuccesso, opzInCasoDiErrore);
	//inCasoDiSuccesso, opzInCasoDiErrore, opzioni
	var inCasoDiSuccesso = function(position){
	  alert( "Posizione delle: " + position.timestamp.getHours() + ":" +
	  position.timestamp.getMinutes() + "n" +
	  "Accuratezza delle coordinate: " + position.coords.accuracy + " mt; n" +
	  "Latitudine: " + position.coords.latitude + " gradi; n" +
	  "Longitudine: " + position.coords.longitude + "gradi; n" +
	  "Accuratezza dell'altezza: " + position.coords.altitudeAccuracy + " mt; n" +
	  "Altezza: " + position.coords.altitude + " mt; n" +
	  "Direzione: " + position.coords.heading + " gradin " +
	  "(0 = Nord, 90 = Ovest, 180 = Sud, 270 = Est);n" +
	  "Velocita: " + position.coords.speed + " m/s;"
	  );
	}
	var opzInCasoDiErrore = function(position){}
	*/
</script>
<div class=row>
	<div class=col-sm-12 style="margin-bottom:15px;">
		<div class="well bs-component">
	    <form class="form-horizontal" action="http://gistonic-milano.1hi.it/send-gpx/send-gpx-upload/" method="POST" enctype="multipart/form-data">
	      <fieldset>
	        <legend>Seleziona il file GPX dal computer/smartphone</legend>
	        <!--<div class="form-group is-empty">
	          <label for="inputEmail" class="col-md-2 control-label">Email</label>
					</div>-->
					<div class="form-group is-fileinput">
	            <label for="inputFile" class="col-md-2 control-label">File</label>

	            <div class="col-md-10">
	              <input type="text" id="textfile" readonly="" class="form-control" placeholder="Clicca qui e scegli il tuo tracciato">
	              <input type='file' name='file' id='file' multiple="">
	            </div>
	          <span class="material-input"></span>
					</div>
					<div class='col-md-12' style='text-align:center;'>
						<input type="submit" name="submit" value="Continua" class="btn btn-lg btn-success" style="margin-bottom:25px;">
					</div>
				</fieldset>
			</div>
		</form>
	</div>
	</div>
</div>

<script>
$( "#file" ).change(function() {
	$( "#textfile" ).val($( "#file" ).val());
});
</script>
