#!/usr/bin/php
<?php
include_once('../simplepie.class.php');

// Parse it
$feed = new SimplePie();
if (isset($argv[1]) && $argv[1] !== '')
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $argv[1]);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 45);
	curl_setopt($ch, CURLOPT_TIMEOUT, 45);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_USERAGENT, SIMPLEPIE_USERAGENT);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	
	$feed->set_raw_data(curl_exec($ch));
	curl_close($ch);
	
	$feed->init();
}

$items = $feed->get_items();

foreach ($items as $item)
{
	echo $item->get_title() . "\n";
}

var_dump($feed->get_item_quantity());

?>