<?php
namespace phpOMS\DataStorage\Cache;

/**
 * MemCache class.
 *
 * PHP Version 5.6
 *
 * @category   Framework
 * @package    phpOMS\DataStorage\Cache
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class FileCache implements \phpOMS\DataStorage\Cache\CacheInterface
{
    /**
     * Cache path.
     *
     * @var string
     * @since 1.0.0
     */
    const CACHE_PATH = __DIR__ . '/../../../Cache';

    /**
     * Only cache if data is larger than threshold (0-100).
     *
     * @var int
     * @since 1.0.0
     */
    private $threshold = 50;

    /**
     * {@inheritdoc}
     */
    public function set($key, $value, \phpOMS\DataStorage\Cache\CacheStatus $type = null, int $expire = 2592000)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function add($key, $value, \phpOMS\DataStorage\Cache\CacheStatus $type = null, int $expire = 2592000)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, \phpOMS\DataStorage\Cache\CacheStatus $type = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key, \phpOMS\DataStorage\Cache\CacheStatus $type = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function flush(\phpOMS\DataStorage\Cache\CacheStatus $type = null)
    {
        array_map('unlink', glob(self::CACHE_PATH . '/*'));
    }

    /**
     * {@inheritdoc}
     */
    public function replace($key, $value, \phpOMS\DataStorage\Cache\CacheType $type = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function stats() : array
    {
        $stats          = [];
        $stats['count'] = \phpOMS\System\FileSystem::getFileCount(self::CACHE_PATH);

        // size, avg. last change compared to now

        return $stats;
    }

    /**
     * {@inheritdoc}
     */
    public function getThreshold() : array
    {
        return $this->threshold;
    }
}
