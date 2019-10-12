$(document).ready(function() {
	if($(document).has("#tabAtend").length) {
		loadTable();
	}
	
});

/** load index table **/
function loadTable() {
	$.get('table', function(data) {
		$('#tabAtend').html(data);
	});
}