var $numberOfGuests = $("#numberOfGuests");
console.log("hello222");
$numberOfGuests.on("change", function() {
	console.log("hello");
	//$("#guestForm").submit();
	document.getElementById('guestForm').submit();
});
