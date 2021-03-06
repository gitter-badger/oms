<?php
namespace phpOMS\Utils\IO;

/**
 * Exchange interface.
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\Utils\IO
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface ExchangeInterface extends \phpOMS\Utils\IO\Cvs\CvsInterface, \phpOMS\Utils\IO\Json\JsonInterface, \phpOMS\Utils\IO\Excel\ExcelInterface, \phpOMS\Utils\IO\Pdf\PdfInterface
{
}
