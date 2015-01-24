<?php

include_once("php/misc/header.php");
?>


<div class="row-fluid">
	<div class="col-xs-4">
		<?php include_once "php/forms/userInfos.php"; ?>
	</div>
	<div class="col-xs-3">

		<h2>clock and table layout</h2>
		<div class="whole-page vertical-middle">
			<div class="vertical-middle__child">

				<div class="clock">
					<ul class="clock__marks"></ul>
					<div class="clock__hands">
						<div class="clock__hand clock__hand--hour"></div>
						<div class="clock__hand clock__hand--minute"></div>
						<div class="clock__hand clock__hand--second"></div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="col-xs-5">
		<?php include_once "php/forms/availableTimes.php"; ?>
	</div>
</div>


<?php

include_once("php/forms/userInfos.php");
?>

<?php
include_once("php/misc/footer.php");
?>
