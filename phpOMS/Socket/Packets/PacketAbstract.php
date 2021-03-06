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
abstract class PacketAbstract implements \Serializable
{
    /**
     * Packet header.
     *
     * @var \phpOMS\Socket\Packets\Header
     * @since 1.0.0
     */
    private $header = null;

    /**
     * Stringify packet.
     *
     * This is using a json format
     *
     * @var \phpOMS\Socket\Packets\Header
     * @since 1.0.0
     */
    abstract public function __toString();

    /**
     * Stringify packet.
     *
     * This is using a json format
     *
     * @return string Json string
     *
     * @var \phpOMS\Socket\Packets\Header
     * @since 1.0.0
     */
    abstract public function serialize();

    /**
     * Unserialize packet.
     *
     * This is using a json format
     *
     * @param string $string Json string
     *
     * @var \phpOMS\Socket\Packets\Header
     * @since 1.0.0
     */
    abstract public function unserialize(string $string);

    /**
     * Get packet header.
     *
     * @return \phpOMS\Socket\Packets\Header
     *
     * @var \phpOMS\Socket\Packets\Header
     * @since 1.0.0
     */
    public function getHeader() : \phpOMS\Socket\Packets\Header
    {
        return $this->header;
    }

    /**
     * Set packet header.
     *
     * @param \phpOMS\Socket\Packets\Header $header Header
     *
     * @var \phpOMS\Socket\Packets\Header
     * @since 1.0.0
     */
    public function setHeader(\phpOMS\Socket\Packets\Header $header)
    {
        $this->header = $header;
    }
}
