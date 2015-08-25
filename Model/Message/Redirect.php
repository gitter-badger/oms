<?php
namespace Model\Message;

/**
 * Redirect class.
 *
 * PHP Version 7.0
 *
 * @category   Modules
 * @package    Model\Message
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Redirect implements \phpOMS\Contract\RenderableInterface, \phpOMS\Contract\ArrayableInterface
{
    /**
     * Message type.
     *
     * @var string
     * @since 1.0.0
     */
    const TYPE = 'redirect';

    /**
     * Redirect uri.
     *
     * @var string
     * @since 1.0.0
     */
    private $uri = '';

    /**
     * Delay.
     *
     * @var int
     * @since 1.0.0
     */
    private $delay = 0;

    /**
     * Window.
     *
     * @var bool
     * @since 1.0.0
     */
    private $new = false;

    /**
     * Set delay.
     *
     * @param int $delay Delay in ms
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDelay(int $delay)
    {
        $this->delay = $delay;
    }

    /**
     * Set uri.
     *
     * @param string $uri Uri
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setUri(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * Render message.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function render()
    {
        return $this->__toString();
    }

    /**
     * Stringify.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __toString()
    {
        return json_encode($this->toArray());
    }

    /**
     * Generate message array.
     *
     * @return array<string, mixed>
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function toArray()
    {
        return ['type' => self::TYPE, 'time' => $this->delay, 'uri' => $this->uri, 'new' => $this->new];
    }
}