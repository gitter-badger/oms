<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$tasksList  = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$headerView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);
$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);

$tasksList->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang['Tasks']['Tasks']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang['Tasks']['Status'], 'sortable' => true],
    ['title' => $this->l11n->lang['Tasks']['Priority'], 'sortable' => true],
    ['title' => $this->l11n->lang['Tasks']['Title'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang['Tasks']['Creator'], 'sortable' => true],
    ['title' => $this->l11n->lang['Tasks']['Created'], 'sortable' => true],
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$tasksList->addView('header', $headerView);
$tasksList->addView('footer', $footerView);

/*
 * Settings
 */
/**
 * @var \phpOMS\Views\View $this
 */
$panelSettingsView = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelSettingsView->setTemplate('/Web/Templates/Panel/BoxFull');
$panelSettingsView->setTitle($this->l11n->lang['Tasks']['Settings']);
$this->addView('settings', $panelSettingsView);

$settingsFormView = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$settingsFormView->setTemplate('/Web/Templates/Forms/FormFull');
$settingsFormView->setHasSubmit(false);
$settingsFormView->setOnChange(true);
$settingsFormView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 0, 'content' => $this->l11n->lang['Tasks']['All']],
        ['value' => 1, 'content' => $this->l11n->lang['Tasks']['Day']],
        ['value' => 2, 'content' => $this->l11n->lang['Tasks']['Week']],
        ['value' => 3, 'content' => $this->l11n->lang['Tasks']['Month']],
        ['value' => 4, 'content' => $this->l11n->lang['Tasks']['Year']],
    ],
    'selected' => 3,
    'label'    => $this->l11n->lang['Tasks']['Interval'],
    'name'     => 'interval',
]);

$this->getView('settings')->addView('form', $settingsFormView);

/*
 * Statistics
 */
$panelStatView = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelStatView->setTemplate('/Web/Templates/Panel/BoxFull');
$panelStatView->setTitle($this->l11n->lang['Tasks']['Statistics']);
$this->addView('stats', $panelStatView);

$statTableView = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$statTableView->setTemplate('/Web/Templates/Lists/AssocList');
$statTableView->setElements([
    [$this->l11n->lang['Tasks']['Received'], 0],
    [$this->l11n->lang['Tasks']['Created'], 0],
    [$this->l11n->lang['Tasks']['Forwarded'], 0],
    [$this->l11n->lang['Tasks']['AverageAmount'], 0],
    [$this->l11n->lang['Tasks']['AverageProcessTime'], 0],
    [$this->l11n->lang['Tasks']['InTime'], 0],
]);

$this->getView('stats')->addView('stat::table', $statTableView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1001101001);
?>
<?= $nav->render(); ?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <a href="create.php" class="button"><?= $this->l11n->lang['Tasks']['New']; ?></a>
        </div>
    </div>
    <?= $this->getView('settings')->render(); ?>

    <?= $this->getView('stats')->render(); ?>
</div>
<div class="b-6">
    <?= $tasksList->render(); ?>
</div>