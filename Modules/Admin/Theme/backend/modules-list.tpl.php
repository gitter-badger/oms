<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * UI Logic
 */
$moduleListView = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$headerView     = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);
$footerView     = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);

$moduleListView->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang['Admin']['Modules']);
$headerView->setHeader([
    ['title' => $this->l11n->lang['Admin']['Status'], 'sortable' => true],
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang['Admin']['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang['Admin']['Theme'], 'sortable' => true],
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$moduleListView->addView('header', $headerView);
$moduleListView->addView('footer', $footerView);

/*
 * Template
 */
echo $moduleListView->render();
