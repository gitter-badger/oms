<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$departmentListView = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$headerView         = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);
$footerView         = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);

$departmentListView->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang['Business']['Departments']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang['Business']['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang['Business']['Parent'], 'sortable' => true],
]);

/*
 * Footer
 */
$footerView->setPages($this->getData('list:count') / 25);
$footerView->setPage(1);
$footerView->setResults($this->getData('list:count'));

$departmentListView->addView('header', $headerView);
$departmentListView->addView('footer', $footerView);

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
echo $departmentListView->render();
