<?php
namespace phpOMS\Pattern;

/**
 * Subject.
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
interface Subject
{
    /**
     * Attach observer to subject.
     *
     * @param \phpOMS\Pattern\Observer $observer Observer
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function attach(\phpOMS\Pattern\Observer $observer);

    /**
     * Detach observer.
     *
     * @param \phpOMS\Pattern\Observer $observer Observer
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function detach(\phpOMS\Pattern\Observer $observer);

    /**
     * Notify observer of change.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function notify();
}
