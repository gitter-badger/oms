<?php
namespace Modules\Navigation\Models;

/**
 * Navigation type enum.
 *
 * PHP Version 7.0
 *
 * @category   Modules
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class NavigationType extends \phpOMS\Datatypes\Enum
{
    const TOP = 1;

    const SIDE = 2;

    const CONTENT = 3;

    const TAB = 4;

    const CONTENT_SIDE = 5;

    const BOTTOM = 6;
}
