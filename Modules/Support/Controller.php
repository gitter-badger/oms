<?php
namespace Modules\Support;

/**
 * Support controller class.
 *
 * PHP Version 7.0
 *
 * @category   Modules
 * @package    Modules\Support
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
    protected static $module = 'Support';

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
     * @param \phpOMS\ApplicationAbstract $app Application reference
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($app)
    {
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
        // TODO: pull abstract view creation and output out. let error be a view as well -> less code writing
        switch ($request->getPath(3)) {
            case 'list':
                $supportDashboardView = new \phpOMS\Views\View($this->app, $request, $response);
                $supportDashboardView->setTemplate('/Modules/Support/Theme/Backend/support-dashboard');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportDashboardView->addData('nav', $navigation->getNav());
                echo $supportDashboardView->render();
                break;
            case 'single':
                /** @noinspection PhpUnusedLocalVariableInspection */
                $support = new \Modules\Tasks\Models\Task($this->app->dbPool);
                $support->init($request->getData('id'));

                /** @noinspection PhpIncludeInspection */
                include __DIR__ . '/Theme/Backend/support-single.tpl.php';
                break;
            case 'create':
                $supportCreateView = new \phpOMS\Views\View($this->app, $request, $response);
                $supportCreateView->setTemplate('/Modules/Support/Theme/Backend/support-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportCreateView->addData('nav', $navigation->getNav());
                echo $supportCreateView->render();
                break;
            case 'analysis':
                $supportAnalysisView = new \phpOMS\Views\View($this->app, $request, $response);
                $supportAnalysisView->setTemplate('/Modules/Support/Theme/Backend/support-analysis');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportAnalysisView->addData('nav', $navigation->getNav());
                echo $supportAnalysisView->render();
                break;
            case 'settings':
                $supportSettingsView = new \phpOMS\Views\View($this->app, $request, $response);
                $supportSettingsView->setTemplate('/Modules/Support/Theme/Backend/support-settings');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportSettingsView->addData('nav', $navigation->getNav());
                echo $supportSettingsView->render();
                break;
            case 'support':
                $this->showContentBackendPrivate($request, $response);
                break;
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
    public function showContentBackendPrivate($request, $response)
    {
        switch ($request->getPath(4)) {
            case 'dashboard':
                $supportDashboardView = new \phpOMS\Views\View($this->app, $request, $response);
                $supportDashboardView->setTemplate('/Modules/Support/Theme/Backend/user-support-dashboard');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $supportDashboardView->addData('nav', $navigation->getNav());
                echo $supportDashboardView->render();
                break;
        }
    }
}
