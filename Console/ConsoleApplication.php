<?php
namespace Console;

/**
 * Controller class.
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
class ConsoleApplication extends \phpOMS\ApplicationAbstract
{
    /**
     * Constructor.
     *
     * @param array $config Core config
     * @param array $arg    Call argument
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct(array $config, array $arg)
    {
        $this->dbPool = new \phpOMS\DataStorage\Database\Pool();
        $this->dbPool->create('core', $config['db']);

        $this->cacheManager   = new \phpOMS\DataStorage\Cache\CacheManager($this->dbPool);
        $this->appSettings    = new \Model\CoreSettings($this->dbPool->get());
        $this->eventManager   = new \phpOMS\Event\EventManager();
        $this->router         = new \phpOMS\Router\Router();
        $this->sessionManager = new \phpOMS\DataStorage\Session\HttpSession(36000);
        $this->moduleManager  = new \phpOMS\Module\ModuleManager($this);
        $this->l11nManager    = new \phpOMS\Localization\L11nManager();
        $this->dispatcher     = new \phpOMS\Dispatcher\Dispatcher($this);
        $commandManager       = new \phpOMS\Console\CommandManager();

        $modules = $this->moduleManager->getActiveModules();
        $this->moduleManager->initModule($modules);

        $commandManager->attach('', function($para) {
            echo 'Use -h for help.';
        }, null);

        $commandManager->trigger($arg[1] ?? '', $arg);
    }
}
