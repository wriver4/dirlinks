<?php
opcache_reset();
require 'src/Dirlinks.php';
$show = new Dirlinks;
$show->header("/var/www/Local", "dirlinks");
$show->show("/var/www/Local");
$show->footer("/var/www/Local","dirlinks");
