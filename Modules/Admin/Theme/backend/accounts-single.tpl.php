<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * Account
 */

$panelAccountView = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelAccountView->setTemplate('/Web/Templates/Panel/BoxThird');
$panelAccountView->setTitle($this->l11n->lang['Admin']['Account']);
$this->addView('account::account', $panelAccountView);

$accountFormView = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$accountFormView->setTemplate('/Web/Templates/Forms/FormFull');
$accountFormView->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$accountFormView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$accountFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$accountFormView->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang[0]['ID'],
    'name'    => 'accid',
    'active'  => false,
]);

$accountFormView->setElement(1, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 0, 'content' => $this->l11n->lang['Admin']['Active']],
        ['value' => 1, 'content' => $this->l11n->lang['Admin']['Inactive']],
    ],
    'selected' => 0,
    'label'    => $this->l11n->lang['Admin']['Status'],
    'name'     => 'status',
]);

$accountFormView->setElement(2, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 0, 'content' => $this->l11n->lang['Admin']['Single']],
        ['value' => 1, 'content' => $this->l11n->lang['Admin']['Group']],
    ],
    'selected' => 0,
    'label'    => $this->l11n->lang['Admin']['Type'],
    'name'     => 'status',
]);

$accountFormView->setElement(3, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Activity'],
    'name'    => 'activity',
    'active'  => false,
]);

$accountFormView->setElement(4, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Created'],
    'name'    => 'created',
    'active'  => false,
]);

$this->getView('account::account')->addView('form', $accountFormView);

/*
 * Profile
 */

$panelProfileView = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelProfileView->setTemplate('/Web/Templates/Panel/BoxThird');
$panelProfileView->setTitle($this->l11n->lang['Admin']['Account']);
$this->addView('account::profile', $panelProfileView);

$profileFormView = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$profileFormView->setTemplate('/Web/Templates/Forms/FormFull');
$profileFormView->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$profileFormView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$profileFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$profileFormView->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Loginname'],
    'name'    => 'loginname',
]);

$profileFormView->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Name1'],
    'name'    => 'name1',
]);

$profileFormView->setElement(2, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Name2'],
    'name'    => 'name2',
]);

$profileFormView->setElement(3, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Name3'],
    'name'    => 'name3',
]);

$profileFormView->setElement(4, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Admin']['Email'],
    'name'    => 'email',
]);

$profileFormView->setElement(5, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'password',
    'label'   => $this->l11n->lang['Admin']['Password'],
    'name'    => 'password',
    'active'  => false,
]);

$profileFormView->setElement(5, 1, [
    'type'  => \phpOMS\Html\TagType::BUTTON,
    'label' => $this->l11n->lang[0]['Reset'],
]);

$this->getView('account::profile')->addView('form', $profileFormView);

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
<?= $this->getView('account::account')->render(); ?>
<?= $this->getView('account::profile')->render(); ?>