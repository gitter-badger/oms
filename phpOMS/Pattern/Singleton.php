<?php
namespace phpOMS\Pattern;

/**
 * Singleton interface (pattern).
 *
 * PHP Version 7.0
 *
 * @category   Pattern
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface Singleton
{
    /**
     * Get instance.
     *
     * @return Singleton
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getInstance() : Singleton;

    /**
     * Overwriting clone in order to maintain singleton pattern.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __clone();
}
