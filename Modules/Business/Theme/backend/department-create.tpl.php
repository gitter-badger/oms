<?php
/**
 * @var \phpOMS\Views\View $this
 */
$panelCreate = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelCreate->setTitle($this->l11n->lang['Business']['Department']);

$this->addView('group:create', $panelCreate);
$this->getView('group:create')->setTemplate('/Web/Templates/Panel/BoxThird');

/*
 * General
 */

$formDepartmentCreate = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$formDepartmentCreate->setTemplate('/Web/Templates/Forms/FormFull');
$formDepartmentCreate->setSubmit('submit1', $this->l11n->lang[0]['Submit']);
$formDepartmentCreate->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$formDepartmentCreate->setMethod(\phpOMS\Message\RequestMethod::POST);

$formDepartmentCreate->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'name'    => 'gid',
    'label'   => $this->l11n->lang['Business']['Name'],
]);

$formDepartmentCreate->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'text',
    'label'   => $this->l11n->lang['Business']['Parent'],
    'name'    => 'gname',
]);

$formDepartmentCreate->setElement(2, 0, [
    'type'  => \phpOMS\Html\TagType::TEXTAREA,
    'label' => $this->l11n->lang['Business']['Description'],
    'name'  => 'gdesc',
]);

$panelCreate->addView('form', $formDepartmentCreate);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1004703001);

/*
 * Template
 */
echo $nav->render();
echo $panelCreate->render();
