<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * General
 */

$settingsFormView = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$settingsFormView->setTemplate('/Web/Templates/Forms/FormFull');
$settingsFormView->setHasSubmit(false);
$settingsFormView->setOnChange(true);
$settingsFormView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$settingsFormView->setMethod(\phpOMS\Message\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 1, 'content' => $this->l11n->lang['Calendar']['Day'],],
        ['value' => 2, 'content' => $this->l11n->lang['Calendar']['Week'],],
        ['value' => 3, 'content' => $this->l11n->lang['Calendar']['Month'], 'selected' => true],
        ['value' => 4, 'content' => $this->l11n->lang['Calendar']['Year'],],
    ],
    'selected' => 3,
    'label'    => $this->l11n->lang['Calendar']['Interval'],
    'name'     => 'interval',
]);

$settingsFormView->setElement(1, 0, [
    'type'     => \phpOMS\Html\TagType::SELECT,
    'options'  => [
        ['value' => 1, 'content' => $this->l11n->lang['Calendar']['Blocks'],],
        ['value' => 2, 'content' => $this->l11n->lang['Calendar']['List'],],
        ['value' => 2, 'content' => $this->l11n->lang['Calendar']['Timeline'],],
    ],
    'selected' => 1,
    'label'    => $this->l11n->lang['Calendar']['Layout'],
    'name'     => 'layout',
]);
?>
<div class="b-7" id="i3-2-1">
    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <div class="m-calendar-mini">

        </div>
    </div>
    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <h1>
            <?= $this->l11n->lang['Calendar']['Settings']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <?= $settingsFormView->render(); ?>
        </div>
    </div>
</div>
<div class="b-6" id="i3-2-2">
    <div class="m-calendar" data-settings='{"interval": 3, "active": []}'>

    </div>
</div>