<?php

namespace phpOMS\DataStorage\Database;

abstract class Grammar
{
    protected $tablePrefix = '';

    public function getDateFormat() : string
    {
        return 'Y-m-d H:i:s';
    }

    public function getTablePrefix() : string
    {
        return $this->tablePrefix;
    }

    public function setTablePrefix(string $prefix)
    {
        $this->tablePrefix = $prefix;
    }
}
