<?php
namespace Modules\Tasks;

/**
 * Task class.
 *
 * PHP Version 7.0
 *
 * @category   Modules
 * @package    Modules\Tasks
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
    protected static $module = 'Tasks';

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
            case \phpOMS\Message\RequestDestination::API:
                $this->showContentApi($request, $response);
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
            case 'dashboard':
                $taskDashboardView = new \phpOMS\Views\View($this->app, $request, $response);
                $taskDashboardView->setTemplate('/Modules/Tasks/Theme/Backend/task-dashboard');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskDashboardView->addData('nav', $navigation->getNav());
                echo $taskDashboardView->render();
                break;
            case 'single':
                $taskSingleView = new \phpOMS\Views\View($this->app, $request, $response);
                $taskSingleView->setTemplate('/Modules/Tasks/Theme/Backend/task-single');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskSingleView->addData('nav', $navigation->getNav());
                echo $taskSingleView->render();
                break;
            case 'create':
                $taskCreateView = new \phpOMS\Views\View($this->app, $request, $response);
                $taskCreateView->setTemplate('/Modules/Tasks/Theme/Backend/task-create');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskCreateView->addData('nav', $navigation->getNav());
                echo $taskCreateView->render();
                break;
            case 'analysis':
                $taskAnalysisView = new \phpOMS\Views\View($this->app, $request, $response);
                $taskAnalysisView->setTemplate('/Modules/Tasks/Theme/Backend/task-analysis');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskAnalysisView->addData('nav', $navigation->getNav());
                echo $taskAnalysisView->render();
                break;
            case 'settings':
                $taskSettingsView = new \phpOMS\Views\View($this->app, $request, $response);
                $taskSettingsView->setTemplate('/Modules/Tasks/Theme/Backend/task-settings');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $taskSettingsView->addData('nav', $navigation->getNav());
                echo $taskSettingsView->render();
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
    public function showApi(\phpOMS\Message\RequestAbstract $request, \phpOMS\Message\ResponseAbstract $response)
    {
        switch ($request->getMethod()) {
            case \phpOMS\Message\RequestMethod::POST:

                break;
        }
    }

    public function createTask(...$taskElements) 
    {
        $task = new \Modules\News\Models\Task();
        
    }
}
