<?php

$url = "https://www.realmofthemadgod.com/account/verify";

$data = array('clientToken' => 0, 'guid' => $_GET['guid'], 'password' => $_GET['password']);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url . "?muledump=true", false, $context);
if ($result === FALSE) {
    echo "Verify error";
}

$xml = new SimpleXMLElement($result);

$listUrl = "https://www.realmofthemadgod.com/char/list?muleDump=true&accessToken=" . urlencode($xml->AccessToken);

$result = file_get_contents($listUrl, false);
if ($result === FALSE) {
    echo "list error";
}
print($result);