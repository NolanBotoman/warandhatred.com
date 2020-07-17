<?php

require('models/Link.php');

$links = getAttachmentLinks($_GET['page']);
$page = $_GET['page'];

switch ($_GET['show']) {

	case 'legal_notice' :
		require('views/miscLegal_Notice.php');
		break;

	case 'cgv' :
	require('views/miscCGV.php');
		break;

	default:
		require('views/miscContact.php');
		break;

}
