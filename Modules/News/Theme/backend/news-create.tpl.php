<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
 * Settings
 */
$createPanel = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$createPanel->setTitle($this->l11n->lang['News']['Settings']);
$this->addView('settingsPanel', $createPanel);
$this->getView('settingsPanel')->setTemplate('/Web/Templates/Panel/BoxFull');

$formSettingsView = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$formSettingsView->setTemplate('/Web/Templates/Forms/FormFull');
$formSettingsView->setSubmit('submit1', $this->l11n->lang[0]['Save']);
$formSettingsView->setSubmit('delete', $this->l11n->lang[0]['Delete']);
$formSettingsView->setSubmit('publish', $this->l11n->lang['News']['Publish'], [
    'visible' => true, 
    'float' => 1,
    'formfields' => [
        'title' => '#news-title',
        'plain' => '#md-news',
        'featured' => '#news-featured',
    ]
    ]);
$formSettingsView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost() . '/' . $this->l11n->getLanguage() . '/api/news.php');
$formSettingsView->setMethod(\phpOMS\Message\RequestMethod::POST);

$formSettingsView->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        [
            'value'   => 0,
            'content' => $this->l11n->lang['News']['News'],
        ],
        [
            'value'    => 1,
            'content'  => $this->l11n->lang['News']['Headline'],
            'selected' => true,
        ],
    ],
    'name'    => 'type',
    'label'   => $this->l11n->lang['News']['Type'],
]);

$formSettingsView->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        [
            'value'   => 0,
            'content' => $this->l11n->lang['News']['Draft'],
        ],
        [
            'value'    => 1,
            'content'  => $this->l11n->lang['News']['Visible'],
            'selected' => true,
        ],
    ],
    'name'    => 'status',
    'label'   => $this->l11n->lang['News']['Status'],
]);

$formSettingsView->setElement(2, 0, [
    'type'    => \phpOMS\Html\TagType::INPUT,
    'subtype' => 'datetime-local',
    'name'    => 'publish-date',
    'label'   => $this->l11n->lang['News']['Publish'],
]);

$this->getView('settingsPanel')->addView('form', $formSettingsView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1000701001);
?>
<?= $nav->render(); ?>

<div class="b-7" id="i3-2-1">
    <?= $this->getView('settingsPanel')->render(); ?>

    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <h1>
            <?= $this->l11n->lang['News']['Permissions']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <ul>
                <li><input type="text" placeholder="<?= $this->l11n->lang['News']['Groups']; ?>">
            </ul>
        </div>
    </div>

    <div class="b b-5 c30-1 c30" id="i30-1-4">
        <h1>
            <?= $this->l11n->lang['News']['Additional']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <ul>
                <li><input type="checkbox" id="news-featured"> <?= $this->l11n->lang['News']['Featured']; ?>
            </ul>
        </div>
    </div>
</div>

<div class="b-6">
    <div class="b full">
        <input type="text" class="full" placeholder="<?= $this->l11n->lang['News']['Title']; ?>" id="news-title">
    </div>
    <div class="tabview">
        <ul class="tab-links">
            <li class="active">
                <a href=".tab-1"><?= $this->l11n->lang['News']['Plain'] ?></a>
            <li>
                <a href=".tab-2"><?= $this->l11n->lang['News']['Preview'] ?></a>
        </ul>

        <div class="tab-content">
            <div class="tab tab-1 active">
                <div class="b full">
                    <textarea class="full" style="min-height: 200px" id="md-news"></textarea>
                </div>
            </div>
            <div class="tab tab-2">
                <div class="b full md-preview-news"></div>
            </div>
        </div>
    </div>
</div>
