<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$mediaListView = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$headerView    = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);
$footerView    = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);

$mediaListView->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang['Media']['Media']);
$headerView->setHeader([
    ['title' => $this->l11n->lang['Media']['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang['Media']['Type'], 'sortable' => true],
    ['title' => $this->l11n->lang['Media']['Size'], 'sortable' => true],
    ['title' => $this->l11n->lang['Media']['Creator'], 'sortable' => true],
    ['title' => $this->l11n->lang['Media']['Created'], 'sortable' => true],
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$mediaListView->addView('header', $headerView);
$mediaListView->addView('footer', $footerView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000401001);

/*
 * Template
 */
echo $nav->render();
echo $mediaListView->render();
