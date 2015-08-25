<?php
namespace phpOMS\Router;

/**
 * Router class.
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\Socket
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Router
{
    /**
     * Routes.
     *
     * @var string[]
     * @since 1.0.0
     */
    private $routes = [];

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
     * Add route.
     *
     * @param string $route       Route regex
     * @param string $destination Destination e.g. Module:function
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function add(string $route, string $destination)
    {
        $this->routes[$route][] = $destination;
    }

    /**
     * Is route regex.
     *
     * @param string $route Route regex
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function isValid(string $route) : bool
    {
        /* Is valid regex? */
        /** @noinspection PhpUsageOfSilenceOperatorInspection */
        if (@preg_match($route, null) === false) {
            return false;
        }

        return true;
    }

    /**
     * Route uri.
     *
     * @param string $uri Uri to route
     *
     * @return string[]
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function route(string $uri) : array
    {
        $bound = [];
        foreach ($this->routes as $route => $dest) {
            if ($this->match($route, $uri)) {
                $bound[] = $dest;
            }
        }

        return $bound;
    }

    /**
     * Match route and uri.
     *
     * @param string $route Route
     * @param string $uri   Uri
     *
     * @return bool
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function match(string $route, string $uri) : bool
    {
        return (bool) preg_match('~^' . $route . '$~', $uri);
    }

    /**
     * Route uri for module.
     *
     * @param string $uri    Uri to route
     * @param string $module Module name
     *
     * @return string[]
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function routeModule(string $uri, string $module) : string
    {
        $bound = [];
        foreach ($this->routes as $route => $dest) {
            if (strrpos($dest, $module, -strlen($dest)) !== false && $this->match($route, $uri)) {
                $bound[] = $dest;
            }
        }

        return $bound;
    }
}
