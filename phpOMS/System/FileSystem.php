<?php
namespace phpOMS\System;

/**
 * Filesystem class.
 *
 * Performing operations on the file system
 *
 * PHP Version 7.0
 *
 * @category   System
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class FileSystem
{
    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    private function __construct()
    {
    }

    /**
     * Get file count inside path.
     *
     * @param string $path      Path to folder
     * @param bool   $recursive Should sub folders be counted as well?
     * @param array  $ignore    Ignore these sub-paths
     *
     * @return null|string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getFileCount(string $path, bool $recursive = true, array $ignore = ['.', '..', 'cgi-bin', '.DS_Store'])
    {
        $size  = 0;
        $files = scandir($path);

        foreach ($files as $t) {
            if (in_array($t, $ignore)) {
                continue;
            }
            if (is_dir(rtrim($path, '/') . '/' . $t)) {
                if ($recursive) {
                    $size += self::getFileCount(rtrim($path, '/') . '/' . $t, true, $ignore);
                }
            } else {
                $size++;
            }
        }

        return $size;
    }

    public function copy()
    {
    }

    public function rename()
    {
    }

    public function move()
    {
    }

    public function delete()
    {
    }

    public function touch()
    {
    }

    public function mkdir()
    {
    }

    public function exists()
    {
    }

    public function chmod()
    {
    }

    public function chown()
    {
    }

    public function chgrp()
    {
    }

    public function symlink()
    {
    }

    public function toRelative()
    {
    }

    public function toAbsolute()
    {
    }

    public function isRelative()
    {
    }

    public function isAbsolute()
    {
    }

    public function dump()
    {
    }
}
