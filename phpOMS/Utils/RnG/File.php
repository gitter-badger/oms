<?php
namespace phpOMS\Utils\RnG;

/**
 * File generator.
 *
 * PHP Version 7.0
 *
 * @category   DataStorage
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class File
{
    /**
     * Extensions.
     *
     * @var array[]
     * @since 1.0.0
     */
    private static $extensions = [['exe', null],
                                  ['dat', null],
                                  ['txt', null],
                                  ['csv', 'txt'],
                                  ['doc', null],
                                  ['docx', 'doc'],
                                  ['mp3', null],
                                  ['mp4', null],
                                  ['avi', null],
                                  ['mpeg', null],
                                  ['wmv', null],
                                  ['ppt', null],
                                  ['xls', null],
                                  ['xlsx', 'xls'],
                                  ['xlsxm', 'xls'],
                                  ['php', null],
                                  ['html', null],
                                  ['tex', null],
                                  ['js', null],
                                  ['c', null],
                                  ['cpp', null],
                                  ['h', null],
                                  ['res', null],
                                  ['ico', null],
                                  ['jpg', null],
                                  ['png', null],
                                  ['gif', null],
                                  ['bmp', null],
                                  ['ttf', null],
                                  ['zip', null],
                                  ['rar', null],
                                  ['7z', null],
                                  ['tar', 'gz'],
                                  ['gz', null],
                                  ['gz', null],
                                  ['sh', null],
                                  ['bat', null],
                                  ['iso', null],
                                  ['css', null],
                                  ['json', null],
                                  ['ini', null],
                                  ['psd', null],
                                  ['pptx', 'ppt'],
                                  ['xml', null],
                                  ['dll', null],
                                  ['wav', null],
                                  ['wma', null],
                                  ['vb', null],
                                  ['tmp', null],
                                  ['tif', null],
                                  ['sql', null],
                                  ['swf', null],
                                  ['svg', null],
                                  ['rpm', null],
                                  ['rss', null],
                                  ['pkg', null],
                                  ['pdf', null],
                                  ['mpg', null],
                                  ['mov', null],
                                  ['jar', null],
                                  ['flv', null],
                                  ['fla', null],
                                  ['deb', null],
                                  ['py', null],
                                  ['pl', null], ];

    /**
     * Get a random file extension.
     *
     * @param array                                  $source       Source array for possible extensions
     * @param \phpOMS\Utils\RnG\DistributionType|int $distribution Distribution type for the extensions
     *
     * @return false|array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function generateExtension($source = null, $distribution = \phpOMS\Utils\RnG\DistributionType::UNIFORM)
    {
        if ($source === null) {
            $source = self::$extensions;
        }

        switch ($distribution) {
            case \phpOMS\Utils\RnG\DistributionType::UNIFORM:
                $key = rand(0, count($source) - 1);
                break;
            default:
                return false;
        }

        return $source[$key][0];
    }

    public static function generateFileName()
    {
    }

    public static function generateFileVirtual($path, $name = null, $size = [0, 1000000], $extension = null)
    {
    }

    public static function generateFile($path, $name = null, $size = [0, 1000000], $extension = null)
    {
    }
}
