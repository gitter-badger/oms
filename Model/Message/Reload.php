<?php
namespace Model\Message;

/**
 * Reload class.
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
class Reload implements \phpOMS\Contract\RenderableInterface, \phpOMS\Contract\ArrayableInterface, \phpOMS\Contract\JsonableInterface
{
    /**
     * Message type.
     *
     * @var string
     * @since 1.0.0
     */
    const TYPE = 'reload';

    /**
     * Delay in ms.
     *
     * @var int
     * @since 1.0.0
     */
    private $delay = 0;

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
     * Render message.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function render() : string
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
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function toArray() : array
    {
        return ['type' => self::TYPE, 'time' => $this->delay];
    }

    /**
     * Generate message json.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function toJson(int $optino = 0) : string
    {
        return json_encode($this->toArray());
    }
}
