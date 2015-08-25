<?php

/**
 * @var \phpOMS\Views\View $this
 */
include_once __DIR__ . '/../../Templates/' . $this->getData('name') . '/' . $this->getData('name') . '.lang.php';

$this->getView('DataView')->addData('lang', $reportLanguage[($this->request->getData('lang') !== null && isset($reportLanguage[$this->request->getData('lang')]) ? $this->request->getData('lang') : $this->l11n->getLanguage())]);

$formExport = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$formExport->setTemplate('/Web/Templates/Forms/FormFull');
$formExport->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$formExport->setMethod(\phpOMS\Message\RequestMethod::POST);

$formExport->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        ['value' => 'en', 'content' => 'English', 'selected'],
        ['value' => 'de', 'content' => 'Deutsch'],
    ],
    'label'   => $this->l11n->lang['Reporter']['Language'],
    'name'    => 'lang',
]);

$formExport->setElement(1, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 'pdf', 'content' => 'PDF'],
        ['value' => 'csv', 'content' => 'CSV'],
        ['value' => 'json', 'content' => 'JSON'],
        ['value' => 'xlsx', 'content' => 'Excel'],
    ],
    'selected' => '',
    'label'    => $this->l11n->lang['Reporter']['Type'],
    'name'     => 'type',
]);

$formExport->setElement(2, 0, [
    'type'  => \phpOMS\Html\TagType::BUTTON,
    'label' => $this->l11n->lang['Reporter']['Export'],
    'name'  => 'export',
    'data'  => [
        'ropen' => '/{#lang}/api/reporter/export.php?id={?id}&type={#n-type}&lang={#n-lang}',
    ],
]);

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

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <ul class="l-1">
                <li>
                    <a href="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/Backend/reporter/edit.php?id=' . $this->getData('name')); ?>"
                       class="button"><?= $this->l11n->lang['Reporter']['Edit']; ?></a>
            </ul>
        </div>
    </div>

    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <ul class="l-1">
                <li><?= $this->l11n->lang['Reporter']['Dataset']; ?>
                <li><select>
                        <option value="0" selected>
                    </select>
            </ul>
        </div>
    </div>

    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <?= $formExport->render(); ?>
        </div>
    </div>

    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <h1><?= $this->l11n->lang['Reporter']['Info']; ?></h1>

        <div class="bc-1">
            <!-- @formatter:off -->
            <table class="tc-1">
                <tr>
                    <th><label><?= $this->l11n->lang['Reporter']['Creator']; ?></label>
                    <td>asldkf
                <tr>
                    <th><label><?= $this->l11n->lang['Reporter']['Created']; ?></label>
                    <td>asldkf
                <tr>
                    <th><label><?= $this->l11n->lang['Reporter']['Datasets']; ?></label>
                    <td>asldkf
            </table>
            <!-- @formatter:on -->
        </div>
    </div>
</div>
<div class="b-6">
    <?= $this->getView('DataView')->render(); ?>
</div>
