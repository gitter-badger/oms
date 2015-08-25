<?php
namespace phpOMS\Uri;

/**
 * UriFactory class.
 *
 * Used in order to create a uri
 *
 * PHP Version 7.0
 *
 * @category   Uri
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class UriFactory
{
    /**
     * Dynamic query elements.
     *
     * @var string[]
     * @since 1.0.0
     */
    private static $uri = [];

    /**
     * Constructor.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function __construct()
    {
    }

    /**
     * Set global query replacements.
     *
     * @param string $key Replacement key
     *
     * @return false|string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getQuery(string $key)
    {
        if (isset(self::$uri[$key])) {
            return self::$uri[$key];
        }

        return false;
    }

    /**
     * Set global query replacements.
     *
     * @param string $key       Replacement key
     * @param string $value     Replacement value
     * @param bool   $overwrite Overwrite if already exists
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function setQuery(string $key, string $value, bool $overwrite = true)
    {
        if ($overwrite || !isset(self::$uri[$key])) {
            self::$uri[$key] = $value;
        }
    }

    /**
     * Build uri.
     *
     * @param string        $uri     Path data
     * @param array         $toMatch Optional special replacements
     * @param UriScheme|int $scheme  Scheme type
     *
     * @return null|string
     *
     * @throws \Exception
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function build(string $uri, array $toMatch = null, int $scheme = \phpOMS\Uri\UriScheme::HTTP)
    {
        $uri = preg_replace_callback('(\{[\/#\?@\.][a-zA-Z0-9]*\})', function ($match) {
            $match = substr($match[0], 1, strlen($match[0]) - 2);

            return isset(self::$uri[$match]) ? self::$uri[$match] : '???';
        }, $uri);

        return $uri;
    }
}