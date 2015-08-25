<?php
namespace phpOMS\Socket\Packets;

/**
 * Server class.
 *
 * Parsing/serializing arrays to and from php file
 *
 * PHP Version 7.0
 *
 * @category   System
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class PacketManager
{
    /**
     * Command Manager.
     *
     * @var \phpOMS\Socket\CommandManager
     * @since 1.0.0
     */
    private $commandManager = null;

    /**
     * Client Manager.
     *
     * @var \phpOMS\Socket\Server\ClientManager
     * @since 1.0.0
     */
    private $clientManager = null;

    /**
     * Constructor.
     *
     * @param \phpOMS\Socket\CommandManager       $cmd  Command Manager
     * @param \phpOMS\Socket\Server\ClientManager $user Client Manager
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct(\phpOMS\Socket\CommandManager $cmd, \phpOMS\Socket\Server\ClientManager $user)
    {
        $this->commandManager = $cmd;
        $this->clientManager  = $user;
    }

    /**
     * Handle package.
     *
     * @param string $data Package data
     * @param mixed  $key  Client Id
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function handle(string $data, $key)
    {/*
        if (!empty($data)) {
            $data = explode(' ', $data);
            $this->commandManager->trigger($data[0], $key, $data);
        } else {
            $this->commandManager->trigger('empty', $key, $data);
        }*/
    }
}
