<?php
namespace Modules\Reporter\Models;

/**
 * Reporter status.
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\Auth
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class ReporterStatus extends \phpOMS\Datatypes\Enum
{
    const INACTIVE = 0;

    const ACTIVE = 1;
}
