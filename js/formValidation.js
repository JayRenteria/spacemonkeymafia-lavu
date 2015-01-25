var name = $("#guestName");
var email = $("#guestEmail");
var phone = $("#guestPhone");

$("#guestForm").on("submit", function() {
	signup_submit();
});

function signup_submit() {
	var url = "../php/forms/signup.php";
	var data = {

	}

	// TODO: validation if some time available

	data.submit = true;

	$.post( url, data, function( response ) {
		if( response.valid === false ) {
			output_message( response, container.get_name() );
			output_message( response, container.get_mail() );
			output_message( response, container.get_password() );
			output_message( response, container.get_confirm() );
		}
	}, "json" ).fail( function(  xhr, status, error ) {
		console.error( xhr.responseText );
	});
}