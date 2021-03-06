<?php
namespace phpOMS\Socket;

/**
 * Socket class.
 *
 * PHP Version 7.0
 *
 * @category   Socket
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface SocketInterface
{
    /**
     * Create the socket.
     *
     * @param string $ip   IP address
     * @param int    $port Port
     *
     * @since    1.0.0
     * @author   Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function create(string $ip, int $port);

    /**
     * Close socket.
     *
     * @since    1.0.0
     * @author   Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function close();

    /**
     * Run socket.
     *
     * @since    1.0.0
     * @author   Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function run();
}
