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
     * @param array $columns Columns
     *
     * @return \phpOMS\DataStorage\Database\Query\Builder
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function find(...$columns) : \phpOMS\DataStorage\Database\Query\Builder
    {
        $query = new \phpOMS\DataStorage\Database\Query\Builder($this->db);
        $query->prefix($this->db->getPrefix());

        return $query->select(...$columns)->from($this->table);
    }

    /**
     * Find data.
     *
     * @param \phpOMS\DataStorage\Database\Query\Builder $query Query
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
 */
    public function list(\phpOMS\DataStorage\Database\Query\Builder $query)
    {
        $sth = $this->db->con->prepare($query->toSql());
        $sth->execute();
        $results = $sth->fetchAll(\PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Populate data.
     *
     * @param array $result Result set
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function populate(array $result) {}

    /**
     * Populate data.
     *
     * @param array $result Result set
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function populateIterable(array $result) : array {}

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
        $query = (new \phpOMS\DataStorage\Database\Query\Builder($this->db))
            ->setPrefix($this->db->getPrefix())
            ->select('*')
            ->from($this->table)
            ->where($this->primaryField, '=', $primaryKey);

        $sth = $this->db->prepare($query->toSql())->execute();

        return $this->populate($sth->fetchAll());
    }

    /**
     * Get primary field.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPrimaryField() : string
    {
        return $this->primaryField;
    }

    /**
     * Get main table.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getTable() : string
    {
        return $this->table;
    }
}
