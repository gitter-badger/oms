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
class L11nManager
{
    /**
     * Language.
     *
     * @var string[][]
     * @since 1.0.0
     */
    private $language = [];

    /**
     * Verify if language is loaded.
     *
     * @param string $language Language iso code
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function isLanguageLoaded(string $language) : bool
    {
        return isset($this->language[$language]);
    }

    /**
     * Load language.
     *
     * One module can only be loaded once. Once the module got loaded it's not
     * possible to load more language files later on.
     *
     * @param string     $language Language iso code
     * @param string     $from     Module name
     * @param string[][] $files    Language files content
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function loadLanguage(string $language, string $from, array $files)
    {
        if (!isset($this->language[$language][$from])) {
            $this->language[$language][$from] = $files[$from];
        } else {
            $this->language[$language][$from] = $files[$from] + $this->language[$language][$from];
        }
    }

    /**
     * Get application language.
     *
     * @param string $language Language iso code
     * @param string $module   Module name
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLanguage(string $language, string $module = null) : array
    {
        if (!isset($module) && isset($this->language[$language])) {
            return $this->language[$language];
        } elseif (isset($this->language[$language])) {
            return $this->language[$language][$module];
        } else {
            return [];
        }
    }
}
