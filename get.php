<?php

$user_id="";
$service_id="";

/* get information about project
variables:
error
subdomain
title
title2
title3
*/
$info=get_data($user_id."/".$service_id."/about");
echo $info['title']; // show title


/* get all services
id
title
service
price_lt
price_eur
about
p1..p10
*/
$services=get_data($user_id."/".$service_id."/services");
for ($i=0; $i<=count($services['count']); $i++) {
	$id=$services['services'][$i][$i+1][id];
	foreach ($services['services'][$i][$i+1] as $k => $v) {
		$sr[$id][$k]=$v;
	}
}
echo $sr[21139]['service']; // show service name example OP


function get_data($url) {
	$minehost="https://minehost.lt/sms/";
	$url=$minehost.$url;
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	$array = json_decode($data, true);
	return $array;
	// return $data;
}


?>
