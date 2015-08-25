<?php/** @var \Modules\EventManagement\Controller $this */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                           1004201001, ]);
\phpOMS\Model\Model::generate_table_filter_view(); ?>

<div class="tabview">
    <!-- @formatter:off -->
    <ul class="tab-links">
        <li class="active"><a href=".tab-1"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['CoreData'] ?></a>
        <li><a href=".tab-2"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['People'] ?></a>
    </ul>
    <!-- @formatter:on -->

    <div class="tab-content">
        <div class="tab tab-1 active">
            <div class="b b-2 c42-2 c42" id="i42-2-1">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['EventManagement']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['Title']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['Description']; ?></label>
                        <li><textarea></textarea>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['Start']; ?></label>
                        <li><input type="date">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['End']; ?></label>
                        <li><input type="date">
                        <li>
                    </ul>
                    <!-- @formatter:on -->
                </div>
            </div>

            <div class="b b-2 c42-2 c42" id="i42-2-2">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['Permissions']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['Manager']; ?></label>
                        <li><input type="text">
                            <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                    </ul>
                    <!-- @formatter:on -->
                </div>
            </div>
        </div>
        <div class="tab tab-2">
            <div class="b b-2 c42-2 c42" id="i42-2-2">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['Account']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['ID']; ?></label>
                        <li><input type="text" disabled>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['User']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['Amount']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['Info']; ?></label>
                        <li><textarea></textarea>
                        <li>
                    </ul>
                    <!-- @formatter:on -->
                    <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="b b-5 c42-2 c42" id="i42-2-2">
    <h1>
        <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['EventManagement']['Event']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
    </div>
</div>

<div class="c-bar rT">
    <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Create']; ?></button>
    <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Cancel']; ?></button>
</div>
