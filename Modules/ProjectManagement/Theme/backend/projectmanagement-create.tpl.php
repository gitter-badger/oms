<?php/** @var \Modules\ProjectManagement\Controller $this */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                           1001701001, ]);
\phpOMS\Model\Model::generate_table_filter_view(); ?>

<div class="tabview">
    <!-- @formatter:off -->
    <ul class="tab-links">
        <li class="active"><a href=".tab-1"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['CoreData'] ?></a>
        <li><a href=".tab-2"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Milestone'] ?></a>
        <li><a href=".tab-3"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Elements'] ?></a>
    </ul>
    <!-- @formatter:on -->

    <div class="tab-content">
        <div class="tab tab-1 active">
            <div class="b b-2 c17-2 c17" id="i17-2-1">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['ProjectManagement']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Title']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Description']; ?></label>
                        <li><textarea></textarea>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Start']; ?></label>
                        <li><input type="date">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['End']; ?></label>
                        <li><input type="date">
                        <li>
                    </ul>
                    <!-- @formatter:on -->
                </div>
            </div>

            <div class="b b-2 c17-2 c17" id="i17-2-2">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Permissions']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Group']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['User']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Manager']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                    </ul>
                    <!-- @formatter:on -->
                </div>
            </div>
        </div>
        <div class="tab tab-2">
            <div class="b b-2 c17-2 c17" id="i17-2-2">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Milestone']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['ID']; ?></label>
                        <li><input type="text" disabled>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Name']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Description']; ?></label>
                        <li><textarea></textarea>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Start']; ?></label>
                        <li><input type="date">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['End']; ?></label>
                        <li><input type="date">
                        <li>
                    </ul>
                    <!-- @formatter:on -->
                    <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                </div>
            </div>
        </div>
        <div class="tab tab-3">
            <div class="b b-2 c17-2 c17" id="i17-2-2">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Elements']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['ID']; ?></label>
                        <li><input type="text" disabled>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Milestone']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Depending']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Type']; ?></label>
                        <li>
                            <select>
                                <option><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Task']; ?>
                                <option><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Calendar']; ?>
                            </select>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Title']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Description']; ?></label>
                        <li><textarea></textarea>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Start']; ?></label>
                        <li><input type="date">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['End']; ?></label>
                        <li><input type="date">
                        <li>
                    </ul>
                    <!-- @formatter:on -->
                    <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                </div>
            </div>

            <div class="b b-2 c17-2 c17" id="i17-2-2">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Permissions']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Group']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['User']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                    </ul>
                    <!-- @formatter:on -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="b b-5 c17-2 c17" id="i17-2-2">
    <h1>
        <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['ProjectManagement']['Project']; ?>
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
