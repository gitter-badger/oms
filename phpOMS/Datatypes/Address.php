<?php
namespace phpOMS\Datatypes;

/**
 * Address class.
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\Datatypes
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Address implements \phpOMS\Contract\JsonableInterface
{
    /**
     * Name of the receiver.
     *
     * @var string
     * @since 1.0.0
     */
    private $recipient = null;

    /**
     * Sub of the address.
     *
     * @var string
     * @since 1.0.0
     */
    private $fao = null;

    /**
     * Location.
     *
     * @var \phpOMS\Datatypes\Location
     * @since 1.0.0
     */
    private $location = null;

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        $this->$location = new \phpOMS\Datatypes\Location();
    }

    /**
     * Get recipient.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getRecipient() : string
    {
        return $this->recipient;
    }

    /**
     * Set recipient.
     *
     * @param string $recipient Recipient
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setRecipient(string $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * Get FAO.
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getFAO() : string
    {
        return $this->fao;
    }

    /**
     * Set FAO.
     *
     * @param string $fao FAO
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFAO(string $fao)
    {
        $this->fao = $fao;
    }

    /**
     * Get location.
     *
     * @return \phpOMS\Datatypes\Location
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLocation() : phpOMS\Datatypes\Location
    {
        return $this->location;
    }

    /**
     * Set location.
     *
     * @param \phpOMS\Datatypes\Location $location Location
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLocation(\phpOMS\Datatypes\Location $location)
    {
        $this->location = $location;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return ['recipient' => $this->recipient, 'fao' => $this->fao, 'location' => $this->location->toArray()];
    }

    /**
     * {@inheritdoc}
     */
    public function toJson(int $option = 0) : string
    {
        return json_encode($this->toArray());
    }
}
