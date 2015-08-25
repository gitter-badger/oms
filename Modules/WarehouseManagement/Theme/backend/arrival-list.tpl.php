<?php/** @var \Modules\Warehousing\Controller $this */
\phpOMS\Model\Model::generate_table_filter_view(); ?>

<div class="b-7" id="i3-2-1">
</div>
<div class="b-6">
    <table class="t t-1 c27-1 c27" id="i27-1-1">
        <thead>
        <tr>
            <th colspan="9" class="lT">
                <i class="fa fa-filter p f dim"></i>

                <h1><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Reporter']['Arrivals']; ?></h1>
            <th class="rT">
                <i class="fa fa-minus min"></i>
                <i class="fa fa-plus max vh"></i>
                <tr>
                    <?php
                    \phpOMS\Model\Model::generate_table_header_view(
                        [
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['ID'],
                             'sort' => 1, ],
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Reporter']['Reference'],
                             'sort' => 0, ],
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Reporter']['Consignor'],
                             'sort' => 0, ],
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Reporter']['Name'],
                             'sort' => 0, 'full' => true, ],
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Reporter']['Street'],
                             'sort' => 0, ],
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Reporter']['City'],
                             'sort' => 0, ],
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Reporter']['Zip'],
                             'sort' => 0, ],
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Reporter']['Country'],
                             'sort' => 0, ],
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Reporter']['Order'],
                             'sort' => 0, ],
                            ['name' => $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Reporter']['Date'],
                             'sort' => 0, ],
                        ]
                    );
                    ?>
        <tbody>
        <?php
        /** @var \phpOMS\Module\Modules $modules */ /*
        $modules_installed = $this->app->modules->module_list_installed_get();
        $url['level'] = array_slice($request->getData(), 0, 4);
        $url['level'][] = 'front';
        $url['id'] = 'class';

        \phpOMS\Model\Model::generate_table_content_view(
            $modules_installed['list'],
            ['id', 'name', 'theme', 'version'],
            $url
        );*/
        ?>
    </table>
</div>