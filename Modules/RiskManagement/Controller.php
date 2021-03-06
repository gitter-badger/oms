<?php
namespace Modules\RiskManagement;

/**
 * Risk Management class.
 *
 * PHP Version 7.0
 *
 * @category   Modules
 * @package    Modules\RiskManagement
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
    protected static $module = 'RiskManagement';

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
        switch ($request->getPath(4)) {
            case 'cockpit':
                $riskMgmtDashboard = new \phpOMS\Views\View($this->app, $request, $response);
                $riskMgmtDashboard->setTemplate('/Modules/RiskManagement/Theme/Backend/cockpit');

                $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
                $riskMgmtDashboard->addData('nav', $navigation->getNav());
                echo $riskMgmtDashboard->render();
                break;
            case 'risk':
                $this->showContentBackendRisk($request, $response);
                break;
            case 'cause':
                $this->showContentBackendCause($request, $response);
                break;
            case 'solution':
                $this->showContentBackendSolution($request, $response);
                break;
            case 'settings':
                $this->show_backend_settings();
                break;
            case 'unit':
                $this->showContentBackendUnit($request, $response);
                break;
            case 'department':
                $this->showContentBackendDepartment($request, $response);
                break;
            case 'category':
                $this->showContentBackendCategory($request, $response);
                break;
            case 'project':
                $this->showContentBackendProject($request, $response);
                break;
            case 'process':
                $this->showContentBackendProcess($request, $response);
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
    public function showContentBackendRisk($request, $response)
    {
        $riskView = new \phpOMS\Views\View($this->app, $request, $response);
        $riskView->setTemplate('/Modules/RiskManagement/Theme/Backend/risk-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $riskView->addData('nav', $navigation->getNav());
        echo $riskView->render();
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
    public function showContentBackendCause($request, $response)
    {
        $causeView = new \phpOMS\Views\View($this->app, $request, $response);
        $causeView->setTemplate('/Modules/RiskManagement/Theme/Backend/cause-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $causeView->addData('nav', $navigation->getNav());
        echo $causeView->render();
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
    public function showContentBackendSolution($request, $response)
    {
        $solutionView = new \phpOMS\Views\View($this->app, $request, $response);
        $solutionView->setTemplate('/Modules/RiskManagement/Theme/Backend/solution-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $solutionView->addData('nav', $navigation->getNav());
        echo $solutionView->render();
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
    public function showContentBackendUnit($request, $response)
    {
        $unitView = new \phpOMS\Views\View($this->app, $request, $response);
        $unitView->setTemplate('/Modules/RiskManagement/Theme/Backend/unit-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $unitView->addData('nav', $navigation->getNav());
        echo $unitView->render();
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
    public function showContentBackendDepartment($request, $response)
    {
        $departmentView = new \phpOMS\Views\View($this->app, $request, $response);
        $departmentView->setTemplate('/Modules/RiskManagement/Theme/Backend/department-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $departmentView->addData('nav', $navigation->getNav());
        echo $departmentView->render();
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
    public function showContentBackendCategory($request, $response)
    {
        $categoryView = new \phpOMS\Views\View($this->app, $request, $response);
        $categoryView->setTemplate('/Modules/RiskManagement/Theme/Backend/category-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $categoryView->addData('nav', $navigation->getNav());
        echo $categoryView->render();
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
    public function showContentBackendProject($request, $response)
    {
        $projectView = new \phpOMS\Views\View($this->app, $request, $response);
        $projectView->setTemplate('/Modules/RiskManagement/Theme/Backend/project-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $projectView->addData('nav', $navigation->getNav());
        echo $projectView->render();
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
    public function showContentBackendProcess($request, $response)
    {
        $processView = new \phpOMS\Views\View($this->app, $request, $response);
        $processView->setTemplate('/Modules/RiskManagement/Theme/Backend/process-list');

        $navigation = \Modules\Navigation\Models\Navigation::getInstance($request->getHash(), $this->app->dbPool);
        $processView->addData('nav', $navigation->getNav());
        echo $processView->render();
    }
}
