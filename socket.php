<?php
//<editor-fold desc="Require/Include">
require_once __DIR__ . '/phpOMS/Autoloader.php';
require_once __DIR__ . '/config.php';
//</editor-fold>

$App = new \Socket\SocketApplication($CONFIG, $argv[1]);