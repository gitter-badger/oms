<?php
namespace Web;

/**
 * Default exception and error handler.
 *
 * PHP Version 7.0
 *
 * @category   Web
 * @package    Web
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
final class UnhandledHandler
{
    /**
     * Exception handler.
     *
     * @param mixed $e Exception
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function exceptionHandler($e)
    {
        echo '<b>My Exception</b> [' . $e->getCode() . '] ' .$e->getMessage() . "<br />\n";
        echo '  Exception on line ' . $e->getLine() . ' in file ' . $e->getFile();
        echo ', PHP ' . PHP_VERSION . ' (' . PHP_OS . ")<br />\n";
        echo "Aborting...<br />\n";
    }

    /**
     * Error handler.
     *
     * @param int    $errno   Error number
     * @param string $errstr  Error message
     * @param string $errfile Error file
     * @param int    $errline Error line
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function errorHandler(int $errno, string $errstr, string $errfile, int $errline) : bool
    {
        if (!(error_reporting() & $errno)) {
            // This error code is not included in error_reporting
            return false;
        }

        switch ($errno) {
            case E_USER_ERROR:
                echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
                break;
            case E_USER_WARNING:
                echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
                break;
            case E_USER_NOTICE:
                echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
                break;
            default:
                echo "Unknown error type: [$errno] $errstr<br />\n";
                break;
        }

        echo "  Fatal error on line $errline in file $errfile";
        echo ', PHP ' . PHP_VERSION . ' (' . PHP_OS . ")<br />\n";
        echo "Aborting...<br />\n";

        error_clear_last();

        return true;
    }

    /**
     * Shutdown handler.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function shutdownHandler()
    {
        $e = error_get_last();

        if (isset($e)) {
            echo '<b>My ERROR</b> [' . $e['type'] . '] ' . $e['message'] . "<br />\n";
            echo '  Fatal error on line ' . $e['line'] . ' in file ' . $e['file'];
            echo ', PHP ' . PHP_VERSION . ' (' . PHP_OS . ")<br />\n";
            echo "Aborting...<br />\n";
        }
    }
}
