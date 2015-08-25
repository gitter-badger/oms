<?php

require_once __DIR__ . '/../../../../../phpOMS/Autoloader.php';

class EncryptionTest extends PHPUnit_Framework_TestCase
{
    public function testEncryption()
    {
    	$expected = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+{}:"|?><,.;';
    	$key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
    	$key2 = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00aa");

    	$encryption = new \phpOMS\Security\Encryption\Encryption($key);
    	$encrypted = $encryption->encrpyt($expected);
    	$decrypted = $encryption->decrypt($encrypted);

    	$this->assertEquals($expected, $decrypted);

    	$encryption->setKey($key2);
    	$decrypted2 = $encryption->decrypt($encrypted);

    	$this->assertNotEquals($expected, $decrypted2);
    }
}
