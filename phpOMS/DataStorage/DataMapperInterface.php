<?php
namespace phpOMS\DataStorage;

/**
 * Datamapper interface.
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
interface DataMapperInterface
{
    /**
     * Update data.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function update();

    /**
     * Save data.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function save();

    /**
     * Delete data.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function delete();

    /**
     * Find data.
     *
     * @param array $columns Columns
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function find(...$columns);

    /**
     * List data.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function list(\phpOMS\DataStorage\Database\Query\Builder $query, $account);

    /**
     * Populate data.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function populate(array $result);

    /**
     * Load.
     *
     * @param array $objects Objects to load
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function with(...$objects);

    /**
     * Get object.
     *
     * @param mixed $primaryKey Key
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function get($primaryKey);

    /**
     * Find all.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function findAll();
}
