<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery Simple Live Search </title>
<style>
#search{
	height: 30px;
	width: 300px;
	font-size: 22px;
}
.loader-image{
	/*display: none;*/
	background:url('preload.gif') no-repeat right center; 
}
</style>
</head>
<body>

<form>
	<input id="search" type="text">
</form>

<div id="results"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("input#search").keyup(function(e){
	
		//Set Search String
		var searchString = $(this).val();
		
		//set var to use for the request
		var request;
		
		// Abort any other request
		if(request){
			request.abort();
		}
			
		if(searchString.length > 0){
			//show preloader image
			$("#search").addClass("loader-image");
			
			// Fire off the ajax
			request = $.ajax({
				url: "search.php",
				type: "post",
				data: {
						queryString: searchString 
					}
			});

			//Callback handler that will be called on success
			request.done(function (response, textStatus, jqXHR){
				//remove preloader image
				$("#search").removeClass("loader-image");
				//fill div with results
				$('#results').html("<ul>"+response+"</ul>");
			});

			//Callback handler that will be called on failure
			request.fail(function (jqXHR, textStatus, errorThrown){
				// Log the error to the console
				console.error("The following error occurred: "+ textStatus, errorThrown);
			});

			//Prevent default posting of form
			event.preventDefault();
		}	
	});
});
</script>
</body>
</html>