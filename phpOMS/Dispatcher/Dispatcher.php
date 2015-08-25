<?php
namespace phpOMS\Dispatcher;

/**
 * Dispatcher class.
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Dispatcher
{
    /**
     * Application.
     *
     * @var \phpOMS\ApplicationAbstract
     * @since 1.0.0
     */
    //private $app = null;

    /**
     * Controller.
     *
     * @var array
     * @since 1.0.0
     */
    private $controllers = [];

    /**
     * Constructor.
     *
     * @param \phpOMS\ApplicationAbstract $app Appliaction
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct(\phpOMS\ApplicationAbstract $app)
    {
        $this->app = $app;
    }

    /**
     * Dispatch controller.
     *
     * @param string|array|\Closure            $controller Controller string
     * @param \phpOMS\Message\RequestAbstract  $request    Request
     * @param \phpOMS\Message\ResponseAbstract $response   Response
     * @param mixed                            $data       Data
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function dispatch($controller, \phpOMS\Message\RequestAbstract $request, \phpOMS\Message\ResponseAbstract $response, $data)
    {
        if (is_string($controller)) {
            $dispatch = explode(':', $controller);
            $this->set($dispatch[0]);

            $this->controllers[$dispatch[0]]->{$dispatch[1]}($this->app, $request, $response, $data);
        } elseif (is_array($controller)) {
            foreach ($controller as $c) {
                $this->dispatch($c, $request, $response, $data);
            }
        } elseif ($controller instanceof \Closure) {
            $controller($this->app, $request, $response, $data);
        } else {
            throw new \UnexpectedValueException('Unexpected controller type.');
        }
    }

    /**
     * Set controller.
     *
     * @param string $controller Controller string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function set(string $controller) : bool
    {
        if (!isset($this->controllers[$controller])) {
            $this->controllers[$controller] = new $controller($this->app);

            return true;
        }

        return false;
    }
}
