<?php/** @var \Modules\Surveys\Controller $this */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                           1000801001, ]);
\phpOMS\Model\Model::generate_table_filter_view(); ?>

<div class="tabview">
    <!-- @formatter:off -->
    <ul class="tab-links">
        <li class="active"><a href=".tab-1"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['CoreData'] ?></a>
        <li><a href=".tab-2"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Section'] ?></a>
        <li><a href=".tab-3"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Question'] ?></a>
        <li><a href=".tab-4"><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Answer'] ?></a>
    </ul>
    <!-- @formatter:on -->

    <div class="tab-content">
        <div class="tab tab-1 active">
            <div class="b b-2 c8-2 c8" id="i8-2-1">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Survey']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Title']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Description']; ?></label>
                        <li><textarea></textarea>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Start']; ?></label>
                        <li><input type="date">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['End']; ?></label>
                        <li><input type="date">
                        <li>
                    </ul>
                    <!-- @formatter:on -->
                </div>
            </div>

            <div class="b b-2 c8-2 c8" id="i8-2-2">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Permissions']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Group']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['User']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Result']; ?></label>
                        <li>
                            <input type="text">
                            <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                    </ul>
                    <!-- @formatter:on -->
                </div>
            </div>
        </div>
        <div class="tab tab-2">
            <div class="b b-2 c8-2 c8" id="i8-2-1">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Section']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['ID']; ?></label>
                        <li><input type="text" disabled>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Title']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Description']; ?></label>
                        <li><textarea></textarea>
                        <li>
                    </ul>
                    <!-- @formatter:on -->
                    <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                </div>
            </div>
        </div>
        <div class="tab tab-3">
            <div class="b b-2 c8-2 c8" id="i8-2-1">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Question']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['ID']; ?></label>
                        <li><input type="text" disabled>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Question']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Description']; ?></label>
                        <li><textarea></textarea>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Section']; ?></label>
                        <li><input type="text">
                        <li>
                    </ul>
                    <!-- @formatter:on -->
                    <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                </div>
            </div>
        </div>
        <div class="tab tab-4">
            <div class="b b-2 c8-2 c8" id="i8-2-1">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Answer']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <!-- @formatter:off -->
                    <ul class="l-1">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['ID']; ?></label>
                        <li><input type="text" disabled>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Type']; ?></label>
                        <li>
                            <select>
                                <option selected><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Radio']; ?>
                                <option><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Checkbox']; ?>
                                <option><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Dropdown']; ?>
                                <option><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Text']; ?>
                                <option><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Number']; ?>
                                <option><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Date']; ?>
                            </select>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Answer']; ?></label>
                        <li><input type="text">
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Reference']; ?></label>
                        <li>
                            <select>
                                <option selected><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Question']; ?>
                                <option><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Section']; ?>
                            </select>
                        <li><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['ID']; ?></label>
                        <li><input type="text">
                        <li>
                    </ul>
                    <!-- @formatter:on -->
                    <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
                </div>
            </div>

            <div class="b b-2 c8-2 c8" id="i8-2-1">
                <h1>
                    <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Additional']; ?>
                    <i class="fa fa-minus min"></i>
                    <i class="fa fa-plus max vh"></i>
                </h1>

                <div class="bc-1">
                    <ul class="l-1">
                        <li>

                        <li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="b b-5 c8-2 c8" id="i8-2-2">
    <h1>
        <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Surveys']['Survey']; ?>
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
