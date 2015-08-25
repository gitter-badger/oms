<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
* UI Logic
*/
$profileList = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$headerView  = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);
$footerView  = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);

$profileList->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang['Profile']['Profiles']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang['Profile']['Activity'], 'sortable' => true],
    ['title' => $this->l11n->lang['Profile']['Name'], 'sortable' => true, 'full' => true],
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$profileList->addView('header', $headerView);
$profileList->addView('footer', $footerView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000301001);
?>

<?= $nav->render(); ?>
<?= $profileList->render();
