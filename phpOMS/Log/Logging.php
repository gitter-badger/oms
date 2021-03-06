<?php
/* This logging class will not be in the release or dev version!!!! Use a logging library/framework for that */
namespace phpOMS\Log;

/**
 * Logging class.
 *
 * PHP Version 7.0
 *
 * @category   Log
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Logging implements \phpOMS\Pattern\Singleton
{
    /**
     * Timing array.
     *
     * Potential values are null or an array filled with log timings.
     * This is used in order to profile code sections by ID.
     *
     * @var array[float]
     * @since 1.0.0
     */
    public $timings = [];

    /**
     * Instance.
     *
     * @var \phpOMS\DataStorage\Cache\CacheManager
     * @since 1.0.0
     */
    protected static $instance = null;

    /**
     * The file pointer for the logging.
     *
     * Potential values are null or a valid file pointer
     *
     * @var resource
     * @since 1.0.0
     */
    private $fp = null;

    /**
     * Object constructor.
     *
     * Creates the logging object and overwrites all default values.
     *
     * @param string $path Path for logging
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function __construct($path)
    {
        $this->fp = fopen($path . '/' . date('Y-m-d') . '.log', 'a');
    }

    /**
     * Returns instance.
     *
     * @param string $path Logging path
     *
     * @return \phpOMS\Log\Logging
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getInstance($path = null)
    {
        if (self::$instance === null) {
            self::$instance = new self($path);
        }

        return self::$instance;
    }

    /**
     * Object destructor.
     *
     * Closes the logging file
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function __destruct()
    {
        fclose($this->fp);
    }

    /**
     * Protect instance from getting copied from outside.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __clone()
    {
    }

    /**
     * Logs an array as csv.
     *
     * Stores an array as csv formatted string
     * The array structure has to be:
     *
     * DATETIME, LEVEL, CLASS/SOURCE, METHODE, ERROR_ID, CUSTOM_MSG, EXCEPTION_MSG, IP, EXCEPTION_STACK
     *
     * Possible LEVELs are:
     * FATAL
     * ERROR
     * WARNING
     * DEBUG
     * INFO
     *
     * @param array $fields
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function log($fields)
    {
        // TODO: make screen and socket log possible
        fputcsv($this->fp, $fields, ';');
    }

    /**
     * Starts the time measurement.
     *
     * @param string $id the ID by which this time measurement gets identified
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function startTimeLog($id = '')
    {
        $mtime = explode(' ', microtime());
        $mtime = $mtime[1] + $mtime[0];

        $this->timings[$id] = ['start' => $mtime];
    }

    /**
     * Ends the time measurement.
     *
     * @param string $id the ID by which this time measurement gets identified
     *
     * @return int the time measurement
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function endTimeLog($id = '')
    {
        $mtime = explode(' ', microtime());
        $mtime = $mtime[1] + $mtime[0];

        $this->timings[$id]['end']  = $mtime;
        $this->timings[$id]['time'] = $mtime - $this->timings[$id]['start'];

        return $this->timings[$id]['time'];
    }

    /**
     * Sorts timings descending.
     *
     * @param array [float] &$timings the timing array to sort
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function timingSort(&$timings)
    {
        uasort($timings, [$this, 'orderSort']);
    }

    /**
     * Sorts all timings descending.
     *
     * @param array $a
     * @param array $b
     *
     * @return bool the comparison
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    private function orderSort($a, $b)
    {
        if ($a['time'] == $b['time']) {
            return 0;
        }

        return ($a['time'] > $b['time']) ? -1 : 1;
    }
}
