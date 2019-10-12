function snack(msg, type) {
	
	var x = document.getElementById("snackbar");

	//clean the snackbar
    x.className = "";
    
    $('#snackbar').addClass('alert alert-' + type + ' show');
    
    $('#snackbar').html(msg);

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = ""; }, 3000);
}