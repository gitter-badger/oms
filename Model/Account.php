<?php
namespace Model;

/**
 * Account class.
 *
 * PHP Version 7.0
 *
 * @category   Modules
 * @package    Model
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Account extends \phpOMS\Account\Account
{
    /**
     * Database connection.
     *
     * @var \phpOMs\DataStorage\Database\Connection\ConnectionAbstract
     * @since 1.0.0
     */
    private $connection = null;

    /**
     * Session manager.
     *
     * @var \phpOMS\DataStorage\Session\SessionInterface
     * @since 1.0.0
     */
    private $sessionManager = null;

    /**
     * Cache manager.
     *
     * @var \phpOMS\DataStorage\Cache\CacheManager
     * @since 1.0.0
     */
    private $cacheManager = null;

    /**
     * Account address (primary).
     *
     * @var \phpOMS\Datatypes\Address
     * @since 1.0.0
     */
    private $address = null;

    /**
     * Multition cache.
     *
     * @var \Model\Account[]
     * @since 1.0.0
     */
    private static $instances = [];

    /**
     * Constructor.
     *
     * @param int                                                        $id             Account id
     * @param \phpOMS\DataStorage\Database\Connection\ConnectionAbstract $connection     Database connection
     * @param \phpOMS\DataStorage\Session\SessionInterface               $sessionManager Session manager
     * @param \phpOMS\DataStorage\Cache\CacheManager                     $cacheManager   Cache manager
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct(int $id, \phpOMS\DataStorage\Database\Connection\ConnectionAbstract $connection, \phpOMS\DataStorage\Session\SessionInterface $sessionManager, \phpOMS\DataStorage\Cache\CacheManager $cacheManager)
    {
        $this->id             = $id;
        $this->connection     = $connection;
        $this->sessionManager = $sessionManager;
        $this->cacheManager   = $cacheManager;

        $this->l11n = new \phpOMS\Localization\Localization();
    }

    /**
     * Multition constructor.
     *
     * @param int                                                        $id             Account id
     * @param \phpOMS\DataStorage\Database\Connection\ConnectionAbstract $connection     Database connection
     * @param \phpOMS\DataStorage\Session\SessionInterface               $sessionManager Session manager
     * @param \phpOMS\DataStorage\Cache\CacheManager                     $cacheManager   Cache manager
     *
     * @return \Model\Account
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getInstance(int $id, \phpOMS\DataStorage\Database\Connection\ConnectionAbstract $connection, \phpOMS\DataStorage\Session\SessionInterface $sessionManager, \phpOMS\DataStorage\Cache\CacheManager $cacheManager) : \Model\Account
    {
        if (!isset(self::$instances[$id])) {
            self::$instances[$id] = new self($id, $connection, $sessionManager, $cacheManager);
        }

        return self::$instances[$id];
    }

    /**
     * Authenticate account.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function authenticate()
    {
        $this->id = (new \phpOMS\Auth\Auth($this->connection, $this->sessionManager))->authenticate();
    }

    /**
     * Get localization.
     *
     * @return \phpOMS\Localization\Localization
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getL11n() : \phpOMS\Localization\Localization
    {
        return $this->l11n;
    }

    /**
     * Get account id.
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get account name.
     *
     * @return string[]
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getName() : array
    {
        return $this->name;
    }

    /**
     * Get account address.
     *
     * @return \phpOMS\Datatypes\Address
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getAddress() : \phpOMS\Datatypes\Address
    {
        return $this->address;
    }

    /**
     * Login account.
     *
     * @param string $user     Login
     * @param string $password Password
     *
     * @return int Login code
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function login($user, $password) : int
    {
        return (new \phpOMS\Auth\Auth($this->connection, $this->sessionManager))->login($user, $password);
    }
}
