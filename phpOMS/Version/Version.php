<?php
namespace phpOMS\Version;

/**
 * Version class.
 *
 * Responsible for handling versions
 *
 * PHP Version 7.0
 *
 * @category   Version
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Version
{
    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function __construct()
    {
    }

    /**
     * Save version file.
     *
     * @param string $type    Lib or tool name
     * @param string $version Version
     * @param string $path    Path to version file
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function setVersion(string $type, string $version, string $path)
    {
        $versions        = self::getVersion($path);
        $versions[$type] = $version;
        file_put_contents($path, json_encode($versions));
    }

    /**
     * Loading version file.
     *
     * @param string $path Path to version file
     *
     * @return string[]
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getVersion(string $path) : array
    {
        return json_decode(file_get_contents($path), true);
    }

    /**
     * Comparing two versions.
     *
     * @param string $ver1 Version
     * @param string $ver2 Version
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function compare(string $ver1, string $ver2) : int
    {
        return version_compare($ver1, $ver2);
    }
}
