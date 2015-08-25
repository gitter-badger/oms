<?php
namespace phpOMS\Asset;

/**
 * Asset manager class.
 *
 * Responsible for authenticating and initializing the connection
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\Asset
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class AssetManager
{
    /**
     * Assets.
     *
     * @var array
     * @since 1.0.0
     */
    private $assets = [];

    /**
     * Constructor.
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database pool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct(\phpOMS\DataStorage\Database\Pool $dbPool)
    {
    }

    /**
     * Add asset.
     *
     * @param string $id        Asset id
     * @param string $asset     Asset
     * @param bool  $overwrite Overwrite
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function set(string $id, string $asset, bool $overwrite = true) : bool
    {
        if ($overwrite || !isset($this->assets[$id])) {
            $this->assets[$id] = $asset;

            return true;
        }

        return false;
    }

    /**
     * Remove asset.
     *
     * @param string $id Asset id
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function remove(string $id) : bool
    {
        if (isset($this->assets[$id])) {
            unset($this->assets[$id]);

            return true;
        }

        return false;
    }

    /**
     * Get asset.
     *
     * @param string $id Asset id
     *
     * @return mixed Asset
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function get(string $id)
    {
        if (isset($this->assets[$id])) {
            return $this->assets[$id];
        }

        return null;
    }
}
