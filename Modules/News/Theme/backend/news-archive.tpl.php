<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
* UI Logic
*/
$newsListview = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$headerView   = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);
$footerView   = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);

$newsListview->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang['News']['Archive']);
$headerView->setHeader([
    ['title' => $this->l11n->lang['News']['Type'], 'sortable' => true],
    ['title' => $this->l11n->lang['News']['Title'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang['News']['Author'], 'sortable' => true],
    ['title' => $this->l11n->lang['News']['Date'], 'sortable' => true],
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$newsListview->addView('header', $headerView);
$newsListview->addView('footer', $footerView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000701001);

/*
 * Template
 */
echo $nav->render();
echo $newsListview->render();
