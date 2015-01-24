<?php

function post_to_api($postvars)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://admin.poslavu.com/cp/reqserv/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
$response = curl_exec($ch);
curl_close($ch);

return $response;
}

post_to_api("dataname=demo_lh15_1_03&key=PnbL6By6ATVEiFAE5sPa&token=3EkwWqhBV6JM5TfZvbMQ&table=tables")

?>
	