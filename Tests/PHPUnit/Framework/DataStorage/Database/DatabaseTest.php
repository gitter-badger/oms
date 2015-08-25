<?php

require_once __DIR__ . '/../../../../../phpOMS/Autoloader.php';

class DatabasePoolTest extends PHPUnit_Framework_TestCase
{
    public function testBasicConnection()
    {
        require_once __DIR__ . '/../../../../../config.php';

        $dbPool = new \phpOMS\DataStorage\Database\Pool();
        $dbPool->create('core', $CONFIG['db']);

        $this->assertEquals($dbPool->get()->getStatus(), \phpOMS\DataStorage\Database\DatabaseStatus::OK);
    }
}
