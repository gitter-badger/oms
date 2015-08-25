<?php
namespace Modules\Support;

/**
 * Support status enum.
 *
 * PHP Version 7.0
 *
 * @category   Support
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class SupportStatus extends \phpOMS\Datatypes\Enum
{
    const OPEN = 0;

    const REVIEW = 1;

    const LIVE = 2;

    const UNSOLVABLE = 3;

    const SOLVED = 4;

    const CLOSED = 5;
}