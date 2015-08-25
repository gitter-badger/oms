<?php
namespace phpOMS\Config;

/**
 * Settings class.
 *
 * Responsible for providing a database/cache bound settings manger
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\Config
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class SettingsAbstract implements \phpOMS\Config\OptionsInterface
{
    use \phpOMS\Config\OptionsTrait;

    /**
     * Cache manager (pool).
     *
     * @var \phpOMS\DataStorage\Cache\CacheManager
     * @since 1.0.0
     */
    protected $cache = null;

    /**
     * Database connection instance.
     *
     * @var \phpOMS\DataStorage\Database\Connection\ConnectionAbstract
     * @since 1.0.0
     */
    protected $connection = null;

    /**
     * Settings table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = null;

    /**
     * Columns to identify the value.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static $columns = [
        'id',
    ];

    /**
     * Field where the actual value is stored.
     *
     * @var string
     * @since 1.0.0
     */
    protected $valueField = 'option';

    /**
     * Get option by key.
     *
     * @param string[] $columns Column values for filtering
     *
     * @return mixed Option value
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function get(array $columns)
    {
        //$key = md5(json_encode($columns));

        $options = false;

        switch ($this->connection->getType()) {
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $query = new \phpOMS\DataStorage\Database\Query\Builder($this->connection);
                $sql   = $query->select(static::$columns[0], 'settings_content')
                    ->from($this->connection->prefix . static::$table)
                    ->where(static::$columns[0], 'in', $columns)
                    ->toSql();

                $sth = $this->connection->con->prepare(
                    $sql
                );
                $sth->execute();

                $options = $sth->fetchAll(\PDO::FETCH_KEY_PAIR);
                $this->setOptions($options);
                break;
        }

        return $options;
    }

    /**
     * Set option by key.
     *
     * @param string[] $columns   Column values for filtering
     * @param string[] $value     Value to insert
     * @param bool     $overwrite Overwrite existing settings
     * @param bool     $cachable  Cache this setting
     * @param bool     $store     Save this Setting immediately to database
     *
     * @return mixed Option value
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function set(array $columns, array $value, bool $overwrite = true, bool $cachable = true, bool $store = false)
    {
        $key = md5(json_encode($columns));
    }
}
