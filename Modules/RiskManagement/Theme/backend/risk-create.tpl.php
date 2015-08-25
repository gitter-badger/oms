<?php/** @var \Modules\RiskManagement\Controller $this */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                           1003001001, ]);
?>
<div class="b b-2 c30-1 c30" id="i30-1-1">
    <h1>
        <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Risk']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <ul class="l-1">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Title']; ?></label>
            <li><input type="text">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Description']; ?></label>
            <li><textarea></textarea>
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Responsible']; ?></label>
            <li><input type="text">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Unit']; ?></label>
            <li><input type="text">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Department']; ?></label>
            <li><input type="text">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Category']; ?></label>
            <li><input type="text">
        </ul>
    </div>
</div>

<div class="b b-2 c30-1 c30" id="i30-1-1">
    <h1>
        <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Risk']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <ul class="l-1">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Probability']; ?></label>
            <li><input type="text">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Damage']; ?></label>
            <li><input type="text">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Parent']; ?></label>
            <li><input type="text">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Process']; ?></label>
            <li><input type="text">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Project']; ?></label>
            <li><input type="text">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Limit']; ?></label>
            <li><input type="text">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Interval']; ?></label>
            <li><input type="text">
        </ul>
    </div>
</div>

<div class="c-bar rT">
    <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Create']; ?></button>
    <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Cancel']; ?></div>