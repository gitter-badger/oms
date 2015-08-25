<?php
namespace Modules\News\Models;

/**
 * News type status.
 *
 * PHP Version 7.0
 *
 * @category   Module
 * @package    Modules\News
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class NewsStatus extends \phpOMS\Datatypes\Enum
{
    const VISIBLE = 0;

    const DRAFT = 1;
}
