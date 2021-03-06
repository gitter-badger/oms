<?php
namespace phpOMS\Localization;

/**
 * Localization class.
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\Localization
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Localization
{
    /**
     * Country ID.
     *
     * @var string
     * @since 1.0.0
     */
    public $country = null;

    /**
     * Timezone.
     *
     * @var string
     * @since 1.0.0
     */
    public $timezone = null;

    /**
     * Language ISO code.
     *
     * @var string
     * @since 1.0.0
     */
    public $language = 'en';

    /**
     * Currency.
     *
     * @var string
     * @since 1.0.0
     */
    public $currency = null;

    /**
     * Number format.
     *
     * @var string
     * @since 1.0.0
     */
    public $numberformat = null;

    /**
     * Time format.
     *
     * @var string
     * @since 1.0.0
     */
    public $datetime = null;

    /**
     * Language array.
     *
     * @var string[]
     * @since 1.0.0
     */
    public $lang = [];

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
        // TODO: implement!!!
        setlocale(LC_TIME, '');
        setlocale(LC_NUMERIC, '');
        setlocale(LC_MONETARY, '');
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
    public function getTimezone() : string
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setTimezone(string $timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLanguage() : string
    {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;
    }

    /**
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLang() : array
    {
        return $this->lang;
    }

    /**
     * @param array $lang
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setLang(array $lang)
    {
        $this->lang = $lang;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDatetime() : string
    {
        return $this->datetime;
    }

    /**
     * @param string $datetime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setDatetime(string $datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getNumberformat() : string
    {
        return $this->numberformat;
    }

    /**
     * @param string $numberformat
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setNumberformat(string $numberformat) : string
    {
        $this->numberformat = $numberformat;
    }
}
