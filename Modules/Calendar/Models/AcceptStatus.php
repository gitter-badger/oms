<?php
namespace Modules\Calendar\Models;

/**
 * Accept status enum.
 *
 * PHP Version 7.0
 *
 * @category   Calendar
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class AcceptStatus extends \phpOMS\Datatypes\Enum
{
    const ACCEPTED = 0;

    const DENIED = 1;
}
