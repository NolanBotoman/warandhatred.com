<?php

function getAttachmentLinks($page)
{
	$links = array();
	foreach (glob('views/'. $page . '*.php*') as $link) {
		$parts = explode($page, $link);
		$parts = explode(".", $parts[1]);
		
		array_push($links, strtolower($parts[0]));
	} 

    return $links;
}