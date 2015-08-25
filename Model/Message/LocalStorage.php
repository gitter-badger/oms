<?php
namespace Model\Message;

/**
 * LocalStorage class.
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
class LocalStorage implements \phpOMS\Contract\RenderableInterface, \phpOMS\Contract\ArrayableInterface
{
    /**
     * Message type.
     *
     * @var string
     * @since 1.0.0
     */
    const TYPE = 'localstorage';

    /**
     * Local storage key|value array.
     *
     * @var string
     * @since 1.0.0
     */
    private $values = [];

    /**
     * Local storage value to set.
     *
     * @param mixed $key       Value key
     * @param mixed $value     Value to store
     * @param bool  $overwrite Overwrite if exists
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setValue($key, $value, bool $overwrite = true) : bool
    {
        if ($overwrite || !isset($this->values[$key])) {
            $this->values[$key] = $value;

            return true;
        }

        return false;
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
     * @return array<string, mixed>
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function toArray() : array
    {
        return ['type' => self::TYPE, 'values' => $this->values];
    }
}
