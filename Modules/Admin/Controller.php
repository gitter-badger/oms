<?php
namespace Modules\Admin;

/**
 * Admin controller class.
 *
 * PHP Version 7.0
 *
 * @category   Modules
 * @package    Modules\Admin
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Controller extends \phpOMS\Module\ModuleAbstract implements \phpOMS\Module\WebInterface
{
    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $module = 'Admin';

    /**
     * Localization files.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $localization = [
        \phpOMS\Message\RequestDestination::BACKEND => ['backend'],
    ];

    /**
     * Providing.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $providing = [
        'Content',
    ];

    /**
     * Dependencies.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $dependencies = [
    ];

    /**
     * Constructor.
     *
     * @param \phpOMS\ApplicationAbstract $app Application instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app)
    {
        $app->router->add('/admin/settings/general', '\Modules\Admin\Controller:settingsGeneralBackend');
        parent::__construct($app);
    }

    /**
     * {@inheritdoc}
     */
    public function call(\phpOMS\Message\RequestAbstract $request, \phpOMS\Message\ResponseAbstract $response, $data = null)
    {
        switch ($request->getRequestDestination()) {
            case \phpOMS\Message\RequestDestination::BACKEND:
                $this->showContentBackend($request, $response);
                break;
            case \phpOMS\Message\RequestDestination::API:
                $this->showAPI($request, $response);
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows module content.
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showContentBackend($request, $response)
    {
        switch ($request->getPath(3)) {
            case 'account':
                $this->showBackendAccount($request, $response);
                break;
            case 'group':
                $this->showBackendGroup($request, $response);
                break;
            case 'settings':
                $this->showBackendSettings($request, $response);
                break;
            case 'module':
                $this->showBackendModule($request, $response);
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows module content.
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendAccount($request, $response)
    {
        switch ($request->getPath(4)) {
            case 'list':
                $accountListView = new \phpOMS\Views\View($this->app, $request, $response);
                $accountListView->setTemplate('/Modules/Admin/Theme/Backend/accounts-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $accountListView->addData('nav', $navigation->getNav());

                $accountList = new \Modules\Admin\Models\UserList($this->app->dbPool);
                $accountListView->setData('list:elements', $accountList->getList()['list']);
                $accountListView->setData('list:count', $accountList->getList()['count']);

                echo $accountListView->render();
                break;
            case 'single':
                $this->showBackendAccountSingle($request, $response);
                break;
            case 'create':
                $accountCreateView = new \phpOMS\Views\View($this->app, $request, $response);
                $accountCreateView->setTemplate('/Modules/Admin/Theme/Backend/accounts-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $accountCreateView->addData('nav', $navigation->getNav());
                echo $accountCreateView->render();
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows module content.
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendAccountSingle($request, $response)
    {
        switch ($request->getPath(5)) {
            case 'front':
                $accountView = new \phpOMS\Views\View($this->app, $request, $response);
                $accountView->setTemplate('/Modules/Admin/Theme/Backend/accounts-single');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $accountView->addData('nav', $navigation->getNav());

                $account = \Model\Account::getInstance((int) $request->getData('id'), $this->app->dbPool->get(), $this->app->sessionManager, $this->app->cache);
                $accountView->addData('account', $account);

                echo $accountView->render();
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows module content.
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendGroup($request, $response)
    {
        switch ($request->getPath(4)) {
            case 'list':
                $groupListView = new \phpOMS\Views\View($this->app, $request, $response);
                $groupListView->setTemplate('/Modules/Admin/Theme/Backend/groups-list');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $groupListView->addData('nav', $navigation->getNav());

                $groupList = new \Modules\Admin\Models\GroupList($this->app->dbPool);
                $groupListView->setData('list:elements', $groupList->getList()['list']);
                $groupListView->setData('list:count', $groupList->getList()['count']);

                echo $groupListView->render();
                break;
            case 'single':
                $this->showBackendGroupSingle($request, $response);
                break;
            case 'create':
                $groupCreateView = new \phpOMS\Views\View($this->app, $request, $response);
                $groupCreateView->setTemplate('/Modules/Admin/Theme/Backend/groups-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $groupCreateView->addData('nav', $navigation->getNav());
                echo $groupCreateView->render();
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows module content.
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendGroupSingle($request, $response)
    {
        switch ($request->getPath(5)) {
            case 'front':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $accounts = new \Modules\Admin\Models\UserList($this->app->dbPool);

                /** @noinspection PhpUnusedLocalVariableInspection */
                $group = new \Modules\Admin\Models\Group((int) $request->getData('id'), $this->app->dbPool->get(), $this->app->cache);

                $request->setData('id', 1, false);

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/groups-single.tpl.php';
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows module content.
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendSettings($request, $response)
    {
        $this->app->appSettings->get([
            1000000006,
            1000000007,
            1000000008,
            1000000012,
            1000000013,
            1000000014,
            1000000016,
            1000000017,
            1000000018,
            1000000019,
            1000000020,
            1000000021,
            1000000022,
            1000000023,
            1000000024,
            1000000025,
            1000000026,
        ]);

        switch ($request->getPath(4)) {
            case 'general':
                $coreSettingsView = new \phpOMS\Views\View($this->app, $request, $response);
                $coreSettingsView->setTemplate('/Modules/Admin/Theme/Backend/settings-general');
                echo $coreSettingsView->render();
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows module content.
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function showBackendModule($request, $response)
    {
        switch ($request->getPath(4)) {
            case 'list':
                $moduleListView = new \phpOMS\Views\View($this->app, $request, $response);
                $moduleListView->setTemplate('/Modules/Admin/Theme/Backend/modules-list');
                echo $moduleListView->render();
                break;
            case 'front':
                //$info = $this->app->modules->moduleInfoGet((int)$request->getData('id'));

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/modules-single.tpl.php';
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 404 Not Found');
                $response->setHeader('Status', 'Status: 404 Not Found');

                include __DIR__ . '/../../Web/Backend/404.tpl.php';

                return;
        }
    }

    /**
     * Shows api content.
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function showAPI($request, $response)
    {
        switch ($request->getPath(3)) {
            case 'module':
                $this->apiModule($request, $response);
                break;
        }
    }

    /**
     * Shows api content.
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    private function apiModule($request, $response)
    {
        switch ($request->getRequestDestination()) {
            case \phpOMS\Message\RequestMethod::POST:
                $this->app->moduleManager->install($request->getData('module'));
                break;
            default:
                $response->setHeader('HTTP', 'HTTP/1.0 406 Not acceptable');
                $response->setHeader('Status', 'Status:406 Not acceptable');

                return;
        }
    }
}
