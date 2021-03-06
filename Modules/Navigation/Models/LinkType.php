<?php
namespace Modules\Navigation\Models;

/**
 * Link type enum.
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
abstract class LinkType extends \phpOMS\Datatypes\Enum
{
    const CATEGORY = 0;

    const LINK = 1;
}
