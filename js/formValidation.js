var name = $("#guestName");
var email = $("#guestEmail");
var phone = $("#guestPhone");
var date = $("#guestDate");
var time = $("#guestTime");

$("#guestForm").on("submit", function() {
	signup_submit();
});

function signup_submit() {
	var url = "../php/forms/signup.php";
	var data = {
		name: name,
		email: email,
		phone: phone,
		date: date,
		time: time
	}

	// TODO: validation if some time available

	data.submit = true;

	$.post( url, data, function( response ) {
		if( response.valid === false ) {
		} else {
			$("#guestForm").hide();
			$("#reservationConfirmationCard").show();
			$("#ajaxResponse p:nth-child(1)").html(response["name"]);
			$("#ajaxResponse p:nth-child(2)").html(response["email"]);
			$("#ajaxResponse p:nth-child(3)").html(response["phone"]);
			$("#ajaxResponse p:nth-child(4)").html(response["date"]);
			$("#ajaxResponse p:nth-child(5)").html(response["name"]);
		}
	}, "json" ).fail( function(  xhr, status, error ) {
		console.error( xhr.responseText );
	});
}