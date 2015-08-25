<?php
/**
 * @var \phpOMS\Views\View $this
 */
$createPanel     = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$permissionPanel = clone $createPanel;

$createPanel->setTitle($this->l11n->lang[0]['Create']);
$permissionPanel->setTitle($this->l11n->lang['Reporter']['Permission']);

$this->addView('createFormPanel', $createPanel);
$this->getView('createFormPanel')->setTemplate('/Web/Templates/Panel/BoxHalf');

$this->addView('permissionFormPanel', $permissionPanel);
$this->getView('permissionFormPanel')->setTemplate('/Web/Templates/Panel/BoxHalf');

/*
 * Create
 */

$formCreateForm = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$formCreateForm->setTemplate('/Web/Templates/Forms/FormFull');
$formCreateForm->setSubmit('submit1', $this->l11n->lang[0]['Create']);
$formCreateForm->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$formCreateForm->setMethod(\phpOMS\Message\RequestMethod::POST);

$formCreateForm->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'name'    => 'title',
    'label'   => $this->l11n->lang['Reporter']['Title'],
]);

$formCreateForm->setElement(1, 0, [
    'type'  => \phpOMS\Html\TagType::SYMMETRIC,
    'tag'   => 'span',
    'name'  => 'fdragndrop',
    'label' => $this->l11n->lang['Reporter']['Files'],
    'class' => 'dragndrop',
]);

$formCreateForm->setElement(2, 0, [
    'type'     => \phpOMS\Html\TagType::INPUT,
    'subtype'  => 'file',
    'name'     => 'mdirectory',
    'label'    => null,
    'active'   => true,
    'multiple' => true,
]);

$formCreateForm->setElement(3, 0, [
    'type'     => \phpOMS\Html\TagType::INPUT,
    'subtype'  => 'text',
    'name'     => 'requirednames',
    'label'    => $this->l11n->lang['Reporter']['FileNames'],
    'validate' => '[a-bA-Z0-9\.]*',
]);

$formCreateForm->setElement(3, 1, [
    'type'  => \phpOMS\Html\TagType::BUTTON,
    'label' => $this->l11n->lang['Reporter']['Add'],
    'name'  => 'requirednames',
    'class' => 'form-list',
]);

$formCreateForm->setElement(4, 0, [
    'type' => \phpOMS\Html\TagType::ULIST,
    'name' => 'requirednames',
    'list' => [],
]);

$this->getView('createFormPanel')->addView('form', $formCreateForm);

/*
 * Permission Add
 */

$formPermissionAdd = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$formPermissionAdd->setTemplate('/Web/Templates/Forms/FormFull');
$formPermissionAdd->setSubmit('submit1', $this->l11n->lang[0]['Add']);
$formPermissionAdd->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$formPermissionAdd->setMethod(\phpOMS\Message\RequestMethod::POST);

$formPermissionAdd->setElement(0, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        [
            'value'   => 0,
            'content' => 'Group',
        ],
        [
            'value'   => 1,
            'content' => 'Account',
        ],
    ],
    'selected' => '',
    'label'    => $this->l11n->lang['Reporter']['Type'],
    'name'     => 'type',
]);

$formPermissionAdd->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'name'    => 'id',
    'label'   => $this->l11n->lang[0]['ID'],
]);

$formPermissionAdd->setElement(2, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'name'    => 'perm',
    'label'   => $this->l11n->lang['Reporter']['Permission'],
]);

$this->getView('permissionFormPanel')->addView('form', $formPermissionAdd);

/*
 * Permission List
 */
$permissionListView = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$headerView         = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$permissionListView->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang['Reporter']['Permission']);
$headerView->setHeader([
    ['title' => $this->l11n->lang['Reporter']['Type'], 'sortable' => true],
    ['title' => $this->l11n->lang['Reporter']['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang['Reporter']['Permission'], 'sortable' => true],
]);

$permissionListView->addView('header', $headerView);
$this->addView('permissionList', $permissionListView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1002701001);
?>

<?= $nav->render(); ?>
<?= $this->getView('createFormPanel')->render(); ?>
<?= $this->getView('permissionFormPanel')->render(); ?>
<?= $this->getView('permissionList')->render(); ?>