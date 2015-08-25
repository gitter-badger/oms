<?php

require_once __DIR__ . '/../../../../../../phpOMS/Autoloader.php';

class QueryBuildingTest extends PHPUnit_Framework_TestCase
{
    protected $config = null;
    protected $con    = null;

    protected function setUp()
    {
        $this->config = [
            'db' => [
                'db'       => 'mysql', /* db type */
                'host'     => '127.0.0.1', /* db host address */
                'login'    => 'root', /* db login name */
                'password' => '123456', /* db login password */
                'database' => 'orange_management', /* db name */
                'prefix'   => 'oms_', /* db table prefix */
            ],
        ];

        $this->con = new \phpOMS\DataStorage\Database\Connection\MysqlConnection($this->config['db']);
    }

    public function testMysqlSelect()
    {
        $query = new \phpOMS\DataStorage\Database\Query\Builder($this->con);
        $sql   = 'SELECT `a`.`test` FROM `a` WHERE `a`.`test` = 1;';
        $this->assertEquals($sql, $query->select('a.test')->from('a')->where('a.test', '=', 1)->toSql());

        $query = new \phpOMS\DataStorage\Database\Query\Builder($this->con);
        $sql   = 'SELECT `a`.`test`, `b`.`test` FROM `a`, `b` WHERE `a`.`test` = \'abc\';';
        $this->assertEquals($sql, $query->select('a.test', 'b.test')->from('a', 'b')->where('a.test', '=', 'abc')->toSql());

        $query            = new \phpOMS\DataStorage\Database\Query\Builder($this->con);
        $sql              = 'SELECT `a`.`test`, `b`.`test` FROM `a`, `b` WHERE `a`.`test` = \'abc\' AND `b`.`test` = 2;';
        $systemIdentifier = '`';
        $this->assertEquals($sql, $query->select('a.test', function () {
            return '`b`.`test`';
        })->from('a', function () use ($systemIdentifier) {
            return $systemIdentifier . 'b' . $systemIdentifier;
        })->where(['a.test', 'b.test'], ['=', '='], ['abc', 2], ['and', 'and'])->toSql());

        $query = new \phpOMS\DataStorage\Database\Query\Builder($this->con);
        $sql   = 'SELECT `a`.`test`, `b`.`test` FROM `a`, `b` WHERE `a`.`test` = \'abc\' ORDER BY `a`.`test` ASC, `b`.`test` DESC;';
        $this->assertEquals($sql, $query->select('a.test', 'b.test')->from('a', 'b')->where('a.test', '=', 'abc')->orderBy(['a.test',
                                                                                                                            'b.test'], ['ASC',
                                                                                                                                        'DESC'])->toSql());
    }

    public function testMysqlInsert()
    {
        $query = new \phpOMS\DataStorage\Database\Query\Builder($this->con);
        $sql   = 'INSERT INTO `a` VALUES (1, \'test\');';
        $this->assertEquals($sql, $query->insert()->into('a')->values(1, 'test')->toSql());

        $query = new \phpOMS\DataStorage\Database\Query\Builder($this->con);
        $sql   = 'INSERT INTO `a` (`test`, `test2`) VALUES (1, \'test\');';
        $this->assertEquals($sql, $query->insert('test', 'test2')->into('a')->values(1, 'test')->toSql());
    }
}
