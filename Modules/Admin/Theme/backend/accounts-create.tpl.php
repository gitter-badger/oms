<?php
/**
 * @var \phpOMS\Views\View $this
 */
$panelCoreSettingsView = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelCoreSettingsView->setTemplate('/Web/Templates/Panel/BoxHalf');
$panelCoreSettingsView->setTitle($this->l11n->lang['Admin']['Account']);
$this->addView('settings::core', $panelCoreSettingsView);

$settingsFormView = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$settingsFormView->setTemplate('/Web/Templates/Forms/FormInner');
$settingsFormView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 0, 'content' => $this->l11n->lang['Admin']['Active']],
        ['value' => 1, 'content' => $this->l11n->lang['Admin']['Inactive']],
    ],
    'selected' => 1,
    'label'    => $this->l11n->lang['Admin']['Status'],
    'name'     => 'status',
]);

$settingsFormView->setElement(1, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 0, 'content' => $this->l11n->lang['Admin']['Single'], 'selected' => true],
        ['value' => 1, 'content' => $this->l11n->lang['Admin']['Group']],
    ],
    'selected' => 1,
    'label'    => $this->l11n->lang['Admin']['Status'],
    'name'     => 'status',
]);

$this->getView('settings::core')->addView('form', $settingsFormView);

/*
 * Account name
 */

$panelNameSettingsView = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelNameSettingsView->setTemplate('/Web/Templates/Panel/BoxHalf');
$panelNameSettingsView->setTitle($this->l11n->lang['Admin']['Account']);
$this->addView('settings::name', $panelNameSettingsView);

$settingsFormView = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$settingsFormView->setTemplate('/Web/Templates/Forms/FormInner');
$settingsFormView->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$settingsFormView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Loginname'],
    'name'    => 'loginname',
]);

$settingsFormView->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Name1'],
    'name'    => 'name1',
]);

$settingsFormView->setElement(2, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Name2'],
    'name'    => 'name2',
]);

$settingsFormView->setElement(3, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Name3'],
    'name'    => 'name3',
]);

$settingsFormView->setElement(4, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Email'],
    'name'    => 'email',
]);

$settingsFormView->setElement(5, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Password'],
    'name'    => 'Password',
]);

$settingsFormView->setElement(5, 1, [
    'type'  => \phpOMS\Html\TagType::BUTTON,
    'label' => $this->l11n->lang[0]['Create'],
]);

$this->getView('settings::name')->addView('form', $settingsFormView);


/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000104001);
?>
<?= $nav->render(); ?>

<form action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/account.php'); ?>"
      method="POST">
    <?= $this->getView('settings::core')->render(); ?>

    <?= $this->getView('settings::name')->render(); ?>
</form>