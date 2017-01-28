<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>


	</div><!-- .site-inner -->
</div><!-- .site -->

<script>
	$( "#send_email_button" ).html( ""
	+"<p>Oppure lascia la tua email qui</p>"
	+"<div class='search-form'>"
	+"<input type='search' class='search-field' placeholder='latua@email.me' value='' name='s' title='Cerca:' id='youremail'>"
	+"<button id='send_email_button' onclick='scriviemail($(\"#youremail\").val())' class='search-submit mail-submit'><span class='screen-reader-text'>Cerca</span></button></div>"
	+"");

	//$("#send_email_button").click(scriviemail($("#youremail").val));

	function scriviemail(email){
		console.log(email);
		var dimenticatiAPI = "http://gistonic-milano.1hi.it/tools/scrivi_email_home.php?email="+email;
		$.getJSON(dimenticatiAPI, function(data){});
	}
</script>

</body>
</html>
