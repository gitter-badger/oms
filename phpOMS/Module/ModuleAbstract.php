<?php
namespace phpOMS\Module;

/**
 * Module abstraction class.
 *
 * PHP Version 7.0
 *
 * @category   Module
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class ModuleAbstract implements \phpOMS\Module\ModuleInterface
{
    /**
     * Receiving modules from?
     *
     * @var string[]
     * @since 1.0.0
     */
    public $receiving = [];

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $module = '';

    /**
     * Localization files.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $localization = [
    ];

    /**
     * Application instance.
     *
     * @var \phpOMS\ApplicationAbstract
     * @since 1.0.0
     */
    protected $app = null;

    /**
     * Constructor.
     *
     * @param \phpOMS\ApplicationAbstract $app Application instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Install external.
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function installExternal()
    {
        return false;
    }

    /**
     * Get language files.
     *
     * @param string $language    Language key
     * @param string $destination Application destination (e.g. Backend)
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getLocalization(string $language, string $destination) : array
    {
        $lang = [];
        if (isset(static::$localization[$destination])) {
            foreach (static::$localization[$destination] as $file) {
                /** @noinspection PhpIncludeInspection */
                include realpath(__DIR__ . '/../../Modules/' . static::$module . '/Theme/lang/' . $file . '.' . $language . '.lang.php');
                /** @var array $MODLANG */
                $lang += $MODLANG;
            }
        }

        return $lang;
    }

    /**
     * {@inheritdoc}
     */
    public function callPull()
    {
        foreach ($this->receiving as $mid) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->app->moduleManager->running[$mid]->callPush();
        }
    }

    /**
     * {@inheritdoc}
     */
    abstract public function call(\phpOMS\Message\RequestAbstract $request, \phpOMS\Message\ResponseAbstract $response, $data = null);

    /**
     * {@inheritdoc}
     */
    public function getProviding() : array
    {
        /** @noinspection PhpUndefinedFieldInspection */
        return static::$providing;
    }

    /**
     * {@inheritdoc}
     */
    public function getName() : string
    {
        /** @noinspection PhpUndefinedFieldInspection */
        return static::$module;
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies() : array
    {
        /** @noinspection PhpUndefinedFieldInspection */
        return static::$dependencies;
    }
}
