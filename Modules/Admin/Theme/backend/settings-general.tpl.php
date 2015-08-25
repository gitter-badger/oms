<?php
/*
 * UI Logic
 */

/**
 * @var \phpOMS\Views\View $this
 */
$panelPageView         = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelLocalizationView = clone $panelPageView;
$panelAccountsView     = clone $panelPageView;

$panelPageView->setTitle($this->l11n->lang['Admin']['Page']);
$panelLocalizationView->setTitle($this->l11n->lang['Admin']['Localization']);

$this->addView('settings::page', $panelPageView);
$this->addView('settings::l11n', $panelLocalizationView);
$this->addView('settings::accounts', $panelAccountsView);

//$this->getView('nav::top')->setTemplate('/Web/Templates/Panel/BoxThird');
$this->getView('settings::page')->setTemplate('/Web/Templates/Panel/BoxThird');
$this->getView('settings::l11n')->setTemplate('/Web/Templates/Panel/BoxThird');

/*
 * General
 */

$formPageView = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$formPageView->setTemplate('/Web/Templates/Forms/FormFull');
$formPageView->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$formPageView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$formPageView->setMethod(\phpOMS\Message\RequestMethod::POST);

$formPageView->setElement(0, 0, [
    'type'        => \phpOMS\Html\TagType::INPUT,
    'subtype'     => 'text',
    'name'        => 'oname',
    'label'       => $this->l11n->lang['Admin']['OName'],
    'placeholder' => 'Orange Management',
]);

$formPageView->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['LAddress'],
    'name'    => 'laddr',
]);

$formPageView->setElement(2, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['RAddress'],
    'name'    => 'raddr',
]);

$formPageView->setElement(3, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'checkbox',
    'label'   => $this->l11n->lang['Admin']['Cache'],
    'name'    => 'cache',
]);

$this->getView('settings::page')->addView('form', $formPageView);

/*
 * Localization
 */

$formLocalizationView = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$formLocalizationView->setTemplate('/Web/Templates/Forms/FormFull');
$formLocalizationView->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$formLocalizationView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$formLocalizationView->setMethod(\phpOMS\Message\RequestMethod::POST);

$formLocalizationView->setElement(0, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [],
    'selected' => '',
    'label'    => $this->l11n->lang['Admin']['Language'],
    'name'     => 'lang',
]);

$formLocalizationView->setElement(1, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [],
    'selected' => '',
    'label'    => $this->l11n->lang['Admin']['Country'],
    'name'     => 'country',
]);

$formLocalizationView->setElement(2, 0, [
    'type'        => \phpOMS\Html\TagType::INPUT,
    'subtype'     => 'text',
    'label'       => $this->l11n->lang['Admin']['Timezone'],
    'name'        => 'timezone',
    'placeholder' => 'Europe/London',
]);

$formLocalizationView->setElement(3, 0, [
    'type'        => \phpOMS\Html\TagType::INPUT,
    'subtype'     => 'text',
    'name'        => 'datetime',
    'label'       => $this->l11n->lang['Admin']['Timeformat'],
    'placeholder' => 'YYYY-MM-DD hh:mm:ss',
]);

$formLocalizationView->setElement(4, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [],
    'selected' => '',
    'label'    => $this->l11n->lang['Admin']['Currency'],
    'name'     => 'currency',
]);

$formLocalizationView->setElement(5, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [],
    'selected' => '',
    'label'    => $this->l11n->lang['Admin']['Numberformat'],
    'name'     => 'nformat',
]);

$this->getView('settings::l11n')->addView('form', $formLocalizationView);

/*
 * Template
 */

echo $this->getView('settings::page')->render();
echo $this->getView('settings::l11n')->render();
