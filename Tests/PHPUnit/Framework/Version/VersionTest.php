<?php

require_once __DIR__ . '/../../../../phpOMS/Autoloader.php';

class VersionTest extends PHPUnit_Framework_TestCase
{
    public function testVersionCompare()
    {
        $version1 = '1.23.456';
        $version2 = '1.23.567';

        $this->assertEquals(\phpOMS\Version\Version::compare($version1, $version1), 0);
        $this->assertEquals(\phpOMS\Version\Version::compare($version1, $version2), -1);
        $this->assertEquals(\phpOMS\Version\Version::compare($version2, $version1), 1);
    }
}
