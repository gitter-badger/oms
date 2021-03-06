<?php
namespace phpOMS\Validation;

/**
 * Validator abstract.
 *
 * PHP Version 7.0
 *
 * @category   Validation
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class ValidatorAbstract
{
    /**
     * Error code.
     *
     * @var int
     * @since 1.0.0
     */
    protected static $error = 0;

    /**
     * Message string.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $msg = '';

    /**
     * {@inheritdoc}
     */
    public static function getMessage()
    {
        return self::$msg;
    }
}
