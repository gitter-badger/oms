<?php
namespace phpOMS\Datatypes;

/**
 * Location class.
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
class Location implements \phpOMS\Contract\JsonableInterface
{
    /**
     * Zip or postal.
     *
     * @var string
     * @since 1.0.0
     */
    private $postal = null;

    /**
     * Name of city.
     *
     * @var string
     * @since 1.0.0
     */
    private $city = null;

    /**
     * Name of the country.
     *
     * @var string
     * @since 1.0.0
     */
    private $country = null;

    /**
     * Street & district.
     *
     * @var string
     * @since 1.0.0
     */
    private $address = null;

    /**
     * State.
     *
     * @var string
     * @since 1.0.0
     */
    private $state = null;

    /**
     * Geo coordinates.
     *
     * @var float[]
     * @since 1.0.0
     */
    private $geo = null;

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
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getPostal() : string
    {
        return $this->postal;
    }

    /**
     * @param string $postal
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setPostal(string $postal)
    {
        $this->postal = $postal;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCity() : string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getAddress() : string
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getState() : string
    {
        return $this->state;
    }

    /**
     * @param string $state
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setState(string $state)
    {
        $this->state = $state;
    }

    /**
     * @return \float[]
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getGeo() : array
    {
        return $this->geo;
    }

    /**
     * @param \float[] $geo
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setGeo(array $geo)
    {
        $this->geo = $geo;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'postal' => $this->postal,
            'city' => $this->city,
            'country' => $this->country,
            'address' => $this->address,
            'state' => $this->state,
            'geo' => $this->geo,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function toJson(int $option = 0) : string
    {
        return json_encode($this->toArray());
    }
}
