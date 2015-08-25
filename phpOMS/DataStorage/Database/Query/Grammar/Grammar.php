<?php

namespace phpOMS\DataStorage\Database\Query\Grammar;

/**
 * Database query grammar.
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
class Grammar extends \phpOMS\DataStorage\Database\Grammar
{
    /**
     * Comment style.
     *
     * @var string
     * @since 1.0.0
     */
    protected $comment = '--';

    /**
     * String quotes style.
     *
     * @var string
     * @since 1.0.0
     */
    protected $valueQuotes = '\'';

    /**
     * System identifier.
     *
     * @var string
     * @since 1.0.0
     */
    public $systemIdentifier = '"';

    /**
     * And operator.
     *
     * @var string
     * @since 1.0.0
     */
    protected $and = 'AND';

    /**
     * Or operator.
     *
     * @var string
     * @since 1.0.0
     */
    protected $or = 'OR';

    /**
     * Select components.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected $selectComponents = [
        'aggregate',
        'selects',
        'from',
        'joins',
        'wheres',
        'groups',
        'havings',
        'orders',
        'limit',
        'offset',
        'unions',
        'lock',
    ];

    /**
     * Insert components.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected $insertComponents = [
        'into',
        'inserts',
        'values',
    ];

    /**
     * Update components.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected $updateComponents = [
        'updates',
        'sets',
        'wheres',
    ];

    /**
     * Compile to query.
     *
     * @param \phpOMS\DataStorage\Database\Query\Builder $query Builder
     *
     * @return string
     *
     * @throws
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function compileQuery($query) : string
    {
        return trim(
                   implode(' ',
                       array_filter(
                           $this->compileComponents($query),
                           function ($value) {
                               return (string) $value !== '';
                           }
                       )
                   )
               ) . ';';
    }

    /**
     * Compile components.
     *
     * @param \phpOMS\DataStorage\Database\Query\Builder $query Builder
     *
     * @return string[]
     *
     * @throws
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function compileComponents(\phpOMS\DataStorage\Database\Query\Builder $query) : array
    {
        $sql = [];

        switch ($query->getType()) {
            case \phpOMS\DataStorage\Database\Query\QueryType::SELECT:
                $components = $this->selectComponents;
                break;
            case \phpOMS\DataStorage\Database\Query\QueryType::INSERT:
                $components = $this->insertComponents;
                break;
            case \phpOMS\DataStorage\Database\Query\QueryType::UPDATE:
                $components = null;
                break;
            case \phpOMS\DataStorage\Database\Query\QueryType::DELETE:
                $components = null;
                break;
            default:
                throw new \InvalidArgumentException('Unknown query type.');
        }

        /* Loop all possible query components and if they exist compile them. */
        foreach ($components as $component) {
            if (isset($query->{$component})) {
                $sql[$component] = $this->{'compile' . ucfirst($component)}($query, $query->{$component});
            }
        }

        return $sql;
    }

    /**
     * Compile select.
     *
     * @param \phpOMS\DataStorage\Database\Query\Builder $query   Builder
     * @param array                                      $columns Columns
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function compileSelects(\phpOMS\DataStorage\Database\Query\Builder $query, array $columns) : string
    {
        $expression = $this->expressionizeSelect($columns);

        if ($expression == '') {
            return '';
        }

        return ($query->distinct ? 'SELECT DISTINCT ' : 'SELECT ') . $expression;
    }

    /**
     * Expressionize elements.
     *
     * @param array $elements Elements
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function expressionizeSelect(array $elements, string $prefix = '') : string
    {
        $expression = '';

        foreach ($elements as $key => $element) {
            if (is_string($element)) {
                $expression .= $this->compileSystem($element, $prefix) . ', ';
            } elseif ($element instanceof \Closure) {
                $expression .= $prefix . $element() . ', ';
            } elseif ($element instanceof \phpOMS\DataStorage\Database\Query\Builder) {
                $expression .= $element->toSql() . ', ';
            } else {
                throw new \InvalidArgumentException();
            }
        }

        return rtrim($expression, ', ');
    }

    /**
     * Compile from.
     *
     * @param \phpOMS\DataStorage\Database\Query\Builder $query Builder
     * @param array                                      $table Tables
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function compileFrom(\phpOMS\DataStorage\Database\Query\Builder $query, array $table) : string
    {
        $expression = $this->expressionizeSelect($table, $query->getPrefix());

        if ($expression == '') {
            return '';
        }

        return 'FROM ' . $expression;
    }

    /**
     * Compile where.
     *
     * @param \phpOMS\DataStorage\Database\Query\Builder $query  Builder
     * @param array                                      $wheres Where elmenets
     * @param bool                                       $first  Is first element (usefull for nesting)
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function compileWheres(\phpOMS\DataStorage\Database\Query\Builder $query, array $wheres, bool $first = true) : string
    {
        $expression = '';

        foreach ($wheres as $key => $where) {
            foreach ($where as $key2 => $element) {
                if (!$first) {
                    $expression .= ' ' . strtoupper($element['boolean']) . ' ';
                }

                if (is_string($element['column'])) {
                    $expression .= $this->compileSystem($element['column'], $query->getPrefix()) . ' ' . strtoupper($element['operator']) . ' ' . $this->compileValue($element['value']);
                } elseif ($element['column'] instanceof \Closure) {
                } elseif ($element['column'] instanceof \phpOMS\DataStorage\Database\Query\Builder) {
                }

                if (is_string($element['value'])) {
                } elseif ($element['value'] instanceof \Closure) {
                } elseif ($element['value'] instanceof \phpOMS\DataStorage\Database\Query\Builder) {
                } elseif ($element['value'] instanceof \DateTime) {
                } elseif (is_int($element['value'])) {
                } elseif (is_bool($element['value'])) {
                } elseif (is_null($element['value'])) {
                } elseif (is_float($element['value'])) {
                } elseif (is_array($element['value'])) {
                    // is bind
                }

                $first = false;
            }
        }

        if ($expression == '') {
            return '';
        }

        return 'WHERE ' . $expression;
    }

    /**
     * Compile value.
     *
     * @param array|string|\Closure $value Value
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function compileValue($value) : string
    {
        if (is_string($value)) {
            return $this->valueQuotes . $value . $this->valueQuotes;
        } elseif (is_int($value)) {
            return $value;
        } elseif (is_array($value)) {
            $values = '';

            foreach ($value as $val) {
                $values .= $this->compileValue($val) . ', ';
            }

            return '(' . rtrim($values, ', ') . ')';
        } elseif ($value instanceof \DateTime) {
            return $this->valueQuotes . $value->format('Y-m-d h:m:s') . $this->valueQuotes;
        } elseif (is_null($value)) {
            return 'NULL';
        } elseif(is_bool($value)) {
            return (string) ((int) $value);
        }
    }

    /**
     * Compile system.
     *
     * @param array|string $system System
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function compileSystem($system, string $prefix = '') : string
    {
        if (count($split = explode('.', $system)) == 2) {
            return $this->compileSystem($prefix . $split[0]) . '.' . $this->compileSystem($split[1]);
        } else {
            return $this->systemIdentifier . $prefix . $system . $this->systemIdentifier;
        }
    }

    /**
     * Compile limit.
     *
     * @param \phpOMS\DataStorage\Database\Query\Builder $query Builder
     * @param int                                        $limit Limit
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function compileLimit(\phpOMS\DataStorage\Database\Query\Builder$query, $limit) : string
    {
        return 'LIMIT ' . $limit;
    }

    /**
     * Compile offset.
     *
     * @param \phpOMS\DataStorage\Database\Query\Builder $query  Builder
     * @param int                                        $offset Offset
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function compileOffset(\phpOMS\DataStorage\Database\Query\Builder $query, $offset) : string
    {
        return 'OFFSET ' . $offset;
    }

    private function compileJoins()
    {
        return '';
    }

    private function compileGroups()
    {
        return '';
    }

    /**
     * Compile offset.
     *
     * @param \phpOMS\DataStorage\Database\Query\Builder $query  Builder
     * @param array                                      $orders Order
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function compileOrders(\phpOMS\DataStorage\Database\Query\Builder $query, array $orders) : string
    {
        $expression = '';

        foreach ($orders as $order) {
            $expression .= $this->compileSystem($order['column']) . ' ' . $order['order'] . ', ';
        }

        if ($expression == '') {
            return '';
        }

        $expression = rtrim($expression, ', ');

        return 'ORDER BY ' . $expression;
    }

    private function compileUnions()
    {
        return '';
    }

    private function compileLock()
    {
        return '';
    }

    /**
     * Compile insert into table.
     *
     * @param \phpOMS\DataStorage\Database\Query\Builder $query Builder
     * @param string                                     $table Table
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function compileInto(\phpOMS\DataStorage\Database\Query\Builder $query, $table) : string
    {
        return 'INSERT INTO ' . $this->compileSystem($table, $query->getPrefix());
    }

    /**
     * Compile insert into columns.
     *
     * @param \phpOMS\DataStorage\Database\Query\Builder $query   Builder
     * @param array                                      $columns Columns
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function compileInserts(\phpOMS\DataStorage\Database\Query\Builder $query, array $columns) : string
    {
        $cols = '';

        foreach ($columns as $column) {
            $cols .= $this->compileSystem($column) . ', ';
        }

        if ($cols == '') {
            return '';
        }

        return '(' . rtrim($cols, ', ') . ')';
    }

    /**
     * Compile insert values.
     *
     * @param \phpOMS\DataStorage\Database\Query\Builder $query  Builder
     * @param array                                      $values Values
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    protected function compileValues(\phpOMS\DataStorage\Database\Query\Builder $query, array $values) : string
    {
        $vals = '';

        foreach ($values as $value) {
            $vals .= $this->compileValue($value) . ', ';
        }

        if ($vals == '') {
            return '';
        }

        return 'VALUES ' . rtrim($vals, ', ');
    }
}
