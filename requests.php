<?php
function post($url, $data=[], $headers=[]) {
	$c = curl_init($url);
	curl_setopt($c, CURLOPT_POSTFIELDS, $data);
	curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	
	$res = curl_exec($c);
	curl_close($c);
	return json_decode($res,true);
}

function get($url, $headers=[]) {
	$c = curl_init($url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($c, CURLOPT_HTTPGET , 1);

	$res = curl_exec($c); 
	curl_close($c);

	return json_decode($res,true);
}

?>