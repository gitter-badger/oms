<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$timeMgmtView = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$headerView   = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$timeMgmtView->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang['PersonnelTimeManagement']['TimeManagement']);
$headerView->setHeader([
    ['title' => '', 'sortable' => false],
    ['title' => $this->l11n->lang['PersonnelTimeManagement']['Date'], 'sortable' => true],
    ['title' => $this->l11n->lang['PersonnelTimeManagement']['Status'], 'sortable' => true],
    ['title' => $this->l11n->lang['PersonnelTimeManagement']['Type'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang['PersonnelTimeManagement']['Start'], 'sortable' => true],
    ['title' => $this->l11n->lang['PersonnelTimeManagement']['End'], 'sortable' => true],
    ['title' => $this->l11n->lang['PersonnelTimeManagement']['Duration'], 'sortable' => true],
]);
$timeMgmtView->addView('header', $headerView);

/*
 * Settings
 */
/**
 * @var \phpOMS\Views\View $this
 */
$panelSettingsView = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelSettingsView->setTemplate('/Web/Templates/Panel/BoxFull');
$panelSettingsView->setTitle($this->l11n->lang['PersonnelTimeManagement']['Settings']);
$this->addView('settings', $panelSettingsView);

$settingsFormView = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$settingsFormView->setTemplate('/Web/Templates/Forms/FormFull');
$settingsFormView->setHasSubmit(false);
$settingsFormView->setOnChange(true);
$settingsFormView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        ['value' => 0, 'content' => $this->l11n->lang['PersonnelTimeManagement']['All']],
        ['value' => 1, 'content' => $this->l11n->lang['PersonnelTimeManagement']['Day']],
        ['value' => 2, 'content' => $this->l11n->lang['PersonnelTimeManagement']['Week']],
        ['value' => 3, 'content' => $this->l11n->lang['PersonnelTimeManagement']['Month'], 'selected' => true],
        ['value' => 4, 'content' => $this->l11n->lang['PersonnelTimeManagement']['Year']],
    ],
    'label'   => $this->l11n->lang['PersonnelTimeManagement']['Interval'],
    'name'    => 'interval',
]);

$this->getView('settings')->addView('form', $settingsFormView);

/*
 * Statistics
 */
$panelStatView = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelStatView->setTemplate('/Web/Templates/Panel/BoxFull');
$panelStatView->setTitle($this->l11n->lang['PersonnelTimeManagement']['General']);
$this->addView('stats', $panelStatView);

$statTableView = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$statTableView->setTemplate('/Web/Templates/Lists/AssocList');
$statTableView->setElements([
    [$this->l11n->lang['PersonnelTimeManagement']['Surplus'],
     '+2 ' . $this->l11n->lang['PersonnelTimeManagement']['hours'], ],
    [$this->l11n->lang['PersonnelTimeManagement']['Work'],
     '12.5 / 160 ' . $this->l11n->lang['PersonnelTimeManagement']['hours'], ],
    [$this->l11n->lang['PersonnelTimeManagement']['Vacation'],
     '20 / 28 ' . $this->l11n->lang['PersonnelTimeManagement']['days'], ],
    [$this->l11n->lang['PersonnelTimeManagement']['Sick'], '2 ' . $this->l11n->lang['PersonnelTimeManagement']['days']],
]);

$this->getView('stats')->addView('stat::table', $statTableView);
?>

<div class="b-7" id="i3-2-1">
    <?php if (($clocking = $this->app->moduleManager->get('Clocking')) !== null) {
    $clocking->getBackendUserClocking($this->l11n, $this->response, $this->request);
} ?>
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <h1><?= $this->l11n->lang['PersonnelTimeManagement']['Planning']; ?></h1>

        <div class="bc-1">
            <button><?= $this->l11n->lang['PersonnelTimeManagement']['New']; ?></button>
        </div>
    </div>
    <?= $this->getView('settings')->render(); ?>

    <?= $this->getView('stats')->render(); ?>
</div>
<div class="b-6">
    <?= $timeMgmtView->render(); ?>
</div>