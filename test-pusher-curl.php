<?php
$ch = curl_init("https://api-ap1.pusher.com/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
if ($result === false) {
    echo "cURL error: " . curl_error($ch);
} else {
    echo "Success!";
}
curl_close($ch);