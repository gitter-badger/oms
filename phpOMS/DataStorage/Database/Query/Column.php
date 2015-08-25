<?php

namespace phpOMS\DataStorage\Database\Query;

/**
 * Database query builder.
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\DataStorage\Database
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Column
{
	private $column = '';

	public function __construct(string $column) 
	{
		$this->column = $column;
	}

	public function getColumn() : string
	{
		return $this->column;
	}

	public function setColumn(string $column) 
	{
		$this->column = $column;
	}
}