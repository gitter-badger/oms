<?php
namespace phpOMS\DataStorage\Database;

/**
 * Datamapper for databases.
 *
 * DB, Cache, Session
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
class DataMapperAbstract implements \phpOMS\DataStorage\DataMapperInterface
{
    /**
     * Database connection
     *
     * @var \phpOMS\DataStorage\Database\Connection\ConnectionAbstract
     * @since 1.0.0
     */
    protected $db = null;

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected $primaryField = 'id';

    /**
     * Columns
     *
     * @var array<string, array>
     * @since 1.0.0
     */
    protected $columns = [];

    /**
     * Relations.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected $hasMany = [];

    /**
     * Relations.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected $hasOne = [];

    /**
     * Table.
     *
     * @var string
     * @since 1.0.0
     */
    protected $table = null;

    /**
     * Update data.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function update()
    {
    }

    /**
     * Save data.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function save()
    {
    }

    /**
     * Delete data.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function delete()
    {
    }

    /**
     * Find data.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function find()
    {
        $query = new \phpOMS\DataStorage\Database\Query\Builder($this->db);
        $query->prefix($this->db->getPrefix());

        foreach($columns as &$column) {
            if(!isset($this->columns[$column])) {
                throw new \Exception();
            }

            $column = $this->columns[$column];
        }

        return $query->select(...$columns)->from($table);
    }

    /**
     * Find data.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function list(\phpOMS\DataStorage\Database\Query\Builder $query)
    {

    }

    /**
     * Populate data.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function populate($result)
    {
    }

    /**
     * Load.
     *
     * @param array $objects Objects to load
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function with(...$objects)
    {
    }

    /**
     * Get object.
     *
     * @param mixed $primaryKey Key
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function get($primaryKey)
    {
    }

    /**
     * Find all.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function findAll()
    {
    }

    public function getPrimaryField()
    {
        return $this->primaryField;
    }

    public function getTable()
    {
        return $this->table;
    }
}
