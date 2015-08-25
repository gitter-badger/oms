<?php/** @var \Modules\RiskManagement\Controller $this */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                           1003001001, ]);
?>

<div class="b b-2 c30-1 c30" id="i30-1-1">
    <h1>
        <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Solution']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <ul class="l-1">
            <li><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Title']; ?>
            <li><input type="text">
            <li><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Description']; ?>
            <li><input type="text">
            <li><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Unit']; ?>
            <li><input type="text">
            <li><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Protection']; ?>
            <li><input type="text">
            <li><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Probability']; ?>
            <li><input type="text">
            <li><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Damage']; ?>
            <li><input type="text">
            <li><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Cause']; ?>
            <li><input type="text">
            <li><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Parent']; ?>
            <li><input type="text">
            <li><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Department']; ?>
            <li><input type="text">
            <li><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Category']; ?>
            <li><input type="text">
            <li><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['RiskManagement']['Active']; ?>
            <li><input type="text">
        </ul>
    </div>
</div>
