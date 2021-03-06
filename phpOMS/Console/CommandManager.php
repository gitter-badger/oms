<?php
namespace phpOMS\Console;

/**
 * CommandManager class.
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\Socket
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 *
 * @todo       : Hey, this looks like a copy of an event manager!
 */
class CommandManager implements \Countable
{
    /**
     * Commands.
     *
     * @var mixed[]
     * @since 1.0.0
     */
    private $commands = [];

    /**
     * Commands.
     *
     * @var int
     * @since 1.0.0
     */
    private $count = 0;

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
    }

    /**
     * Attach new command.
     *
     * @param string $cmd      Command ID
     * @param mixed  $callback Function callback
     * @param mixed  $source   Provider
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function attach(string $cmd, $callback, $source, $overwrite = true) : bool
    {
        if($overwrite || !isset($this->commands[$cmd])) {
            $this->commands[$cmd] = [$callback, $source];
            $this->count++;

            return true;
        }

        return false;
    }

    /**
     * Detach existing command.
     *
     * @param string $cmd    Command ID
     * @param mixed  $source Provider
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function detach(string $cmd, $source) : bool
    {
        if (array_key_exists($cmd, $this->commands)) {
            unset($this->commands[$cmd]);
            $this->count--;

            return true;
        }

        return false;
    }

    /**
     * Trigger command.
     *
     * @param string $cmd  Command ID
     * @param mixed  $conn Client ID
     * @param mixed  $para Parameters to pass
     *
     * @return mixed|bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function trigger(string $cmd, $para)
    {
        if (array_key_exists($cmd, $this->commands)) {
            return $this->commands[$cmd][0]($para);
        }

        return false;
    }

    /**
     * Count commands.
     *
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function count() : int
    {
        return $this->count;
    }
}
