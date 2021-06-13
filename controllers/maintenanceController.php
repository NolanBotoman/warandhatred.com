<?php

require('models/Link.php');

switch ($_GET['show']) {

    case 'maintenance' :
        require('views/maintenance.php');
        break;

    case 'whitelist' :
        $links = ['whitelist'];
        require('views/loginSign_In.php');
}