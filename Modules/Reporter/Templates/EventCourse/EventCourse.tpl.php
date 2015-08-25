<?php
/**
 * @var \phpOMS\Views\View $this
 */
require 'Worker.php';

$tabView = new \Web\Views\Divider\TabularView($this->app, $this->request, $this->response);
$tabView->setTemplate('/Web/Templates/Divider/Tabular');
$lang = $this->getData('lang');

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

<?php
/*
 * UI Logic
 */
$overviewCompareList           = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$overviewCompareListHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$overviewCompareList->setTemplate('/Web/Templates/Lists/ListFull');
$overviewCompareListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$overviewCompareListHeaderView->setTitle($lang['Budget']);
$overviewCompareListHeaderView->setHeader([
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Budget'], 'sortable' => true],
    ['title' => $lang['Current'], 'sortable' => true],
    ['title' => $lang['Forecast'], 'sortable' => true],
    ['title' => $lang['History'], 'sortable' => true],
    ['title' => $lang['DiffBudget%'], 'sortable' => true],
]);

$overviewCompareList->setFreeze(1, 2);

$overviewCompareList->addElements([
    'EventCourseInt',
    '?',
    number_format($type['A'][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.'),
    number_format(0.00 / $month * 12, 2),
    number_format(0.00, 2),
    '100.00%',
]);

$overviewCompareList->addElements([
    'EventCourse',
    '?',
    number_format($type['K'][$fiscal_end->format('Y')]['value'] + $type['R'][$fiscal_end->format('Y')]['value'] + $type['V'][$fiscal_end->format('Y')]['value'], 2, ',', '.'),
    number_format(0.00, 2),
    number_format(0.00, 2),
    '100.00%',
]);

$overviewCompareList->addElements([
    'Demo',
    '?',
    number_format($type['D'][$fiscal_end->format('Y')]['value'] ?? : 0, 2, ',', '.'),
    number_format(0.00, 2),
    number_format(0.00, 2),
    '100.00%',
]);

$overviewCompareList->addElements([
    'Briefing',
    '?',
    number_format($type['E'][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.'),
    number_format(0.00, 2),
    number_format(0.00, 2),
    '100.00%',
]);

$overviewCompareList->addElements([
    'Advice',
    '?',
    number_format($type['B'][$fiscal_end->format('Y')]['value'] ?? 0, 2, ',', '.'),
    number_format(0.00, 2),
    number_format(0.00, 2),
    '100.00%',
]);

$overviewCompareList->addView('header', $overviewCompareListHeaderView);

/*
 * UI Logic
 */
/* TODO: Costs/Success for all */
$overviewTypeListView       = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$overviewTypeListHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$overviewTypeListView->setTemplate('/Web/Templates/Lists/ListFull');
$overviewTypeListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$overviewTypeListHeaderView->setTitle($lang['CostObject']);
$overviewTypeListHeaderView->setHeader([
    ['title' => $lang['CostObject'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['History'], 'sortable' => true],
    ['title' => $lang['Current'], 'sortable' => true],
    ['title' => $lang['Forecast'], 'sortable' => true],
    ['title' => $lang['Diff'], 'sortable' => true],
]);

$overviewTypeListView->setFreeze(1, 2);

$sum_hist     = 0.0;
$sum_current  = 0.0;
$sum_forecast = 0.0;
foreach ($types as $key => $stype) {
    $overviewTypeListView->addElements([
        $key,
        $stype,
        (number_format($history = $type[$key][$fiscal_end_prev->format('Y')]['value'] ?? 0.0, 2, ',', '.')),
        (number_format($current = $type[$key][$fiscal_end->format('Y')]['value'] ?? 0.0, 2, ',', '.')),
        (number_format($forecast = ($type[$key][$fiscal_end->format('Y')]['value'] ?? 0.0) / abs(((int) $fiscal_current->format('m') - ((int) $fiscal_end->format('m') + 1)) % 12 + 1) * 12, 2, ',', '.')),
        number_format($history == 0 ? 0 : 100 * ($forecast - $history) / $history, 2, ',', '.') . '%',
    ]);
    $sum_hist += $history;
    $sum_current += $current;
    $sum_forecast += $forecast;
}

$overviewTypeListView->addElements([
    '',
    'Total',
    number_format($sum_hist, 2, ',', '.'),
    number_format($sum_current, 2, ',', '.'),
    number_format($sum_forecast, 2, ',', '.'),
    number_format(100 * ($sum_forecast - $sum_hist) / $sum_hist, 2, ',', '.') . '%',
]);

$overviewTypeListView->addView('header', $overviewTypeListHeaderView);

/*
 * UI Logic
 */
$overviewCostCenterView       = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$overviewCostCenterHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$overviewCostCenterView->setTemplate('/Web/Templates/Lists/ListFull');
$overviewCostCenterHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$overviewCostCenterHeaderView->setTitle($lang['CostCenter']);
$overviewCostCenterHeaderView->setHeader([
    ['title' => $lang['CostCenter'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['History'], 'sortable' => true],
    ['title' => $lang['Current'], 'sortable' => true],
    ['title' => $lang['Forecast'], 'sortable' => true],
    ['title' => $lang['Diff'], 'sortable' => true],
]);

$overviewCostCenterView->setFreeze(1, 2);

$sum_hist     = 0.0;
$sum_current  = 0.0;
$sum_forecast = 0.0;
foreach ($costcenter as $key => $cc) {
    $overviewCostCenterView->addElements([
        $key,
        $ccDef[$key],
        (number_format($history = $costcenter[$key][$fiscal_end_prev->format('Y')]['value'] ?? 0.0, 2, ',', '.')),
        (number_format($current = $costcenter[$key][$fiscal_end->format('Y')]['value'] ?? 0.0, 2, ',', '.')),
        (number_format($forecast = ($costcenter[$key][$fiscal_end->format('Y')]['value'] ?? 0.0) / abs(((int) $fiscal_current->format('m') - ((int) $fiscal_end->format('m') + 1)) % 12 + 1) * 12, 2, ',', '.')),
        number_format($history == 0 ? 0 : 100 * ($forecast - $history) / $history, 2, ',', '.') . '%',
    ]);
    $sum_hist += $history;
    $sum_current += $current;
    $sum_forecast += $forecast;
}

$overviewCostCenterView->addElements([
    '',
    'Total',
    number_format($sum_hist, 2, ',', '.'),
    number_format($sum_current, 2, ',', '.'),
    number_format($sum_forecast, 2, ',', '.'),
    number_format(100 * ($sum_forecast - $sum_hist) / $sum_hist, 2, ',', '.') . '%',
]);

$overviewCostCenterView->addView('header', $overviewCostCenterHeaderView);

/*
 * UI Logic
 */
$overviewAccountView       = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$overviewAccountHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$overviewAccountView->setTemplate('/Web/Templates/Lists/ListFull');
$overviewAccountHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$overviewAccountHeaderView->setTitle($lang['Account']);
$overviewAccountHeaderView->setHeader([
    ['title' => $lang['Account'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['History'], 'sortable' => true],
    ['title' => $lang['Current'], 'sortable' => true],
    ['title' => $lang['Forecast'], 'sortable' => true],
    ['title' => $lang['Diff'], 'sortable' => true],
]);

$overviewAccountView->setFreeze(1, 2);

$sum_hist     = 0.0;
$sum_current  = 0.0;
$sum_forecast = 0.0;
foreach ($account as $key => $ac) {
    $overviewAccountView->addElements([
        $key,
        $acDef[$key],
        (number_format($history = $account[$key][$fiscal_end_prev->format('Y')]['value'] ?? 0.0, 2, ',', '.')),
        (number_format($current = $account[$key][$fiscal_end->format('Y')]['value'] ?? 0.0, 2, ',', '.')),
        (number_format($forecast = ($account[$key][$fiscal_end->format('Y')]['value'] ?? 0.0) / abs(((int) $fiscal_current->format('m') - ((int) $fiscal_end->format('m') + 1)) % 12 + 1) * 12, 2, ',', '.')),
        number_format($history == 0 ? 0 : 100 * ($forecast - $history) / $history, 2, ',', '.') . '%',
    ]);
    $sum_hist += $history;
    $sum_current += $current;
    $sum_forecast += $forecast;
}

$overviewAccountView->addElements([
    '',
    'Total',
    number_format($sum_hist, 2, ',', '.'),
    number_format($sum_current, 2, ',', '.'),
    number_format($sum_forecast, 2, ',', '.'),
    number_format(100 * ($sum_forecast - $sum_hist) / $sum_hist, 2, ',', '.') . '%',
]);

$overviewAccountView->addView('header', $overviewAccountHeaderView);

$tabView->addTab($lang['Overview'], $overviewCompareList->render() . $overviewTypeListView->render() . $overviewCostCenterView->render() . $overviewAccountView->render(), 'overview');

/*
 * UI Logic
 */
$typeList           = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$typeListHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$typeList->setTemplate('/Web/Templates/Lists/ListFull');
$typeListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$typeListHeaderView->setTitle('CostObject');
$typeListHeaderView->setHeader([
    ['title' => $lang['CostObject'], 'sortable' => true],
    ['title' => $lang['Date'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Total'], 'sortable' => true],
]);

$typeList->setFreeze(1, 0);
$typeList->addView('header', $typeListHeaderView);

foreach ($costobject as $key => $co) {
    if (strrpos($key, 'K', -strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $typeList->addElements([$key, $coDef[$key] ?? '', '',
                                number_format($co[$fiscal_end->format('Y')]['value'], 2, ',', '.'), ]);
    }
}

$typeList->addElements(['Total', '', '', number_format($type['K'][$fiscal_end->format('Y')]['value'], 2, ',', '.')]);

/*
 * UI Logic
 */
$typeCostCenterList           = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$typeCostCenterListHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$typeCostCenterList->setTemplate('/Web/Templates/Lists/ListFull');
$typeCostCenterListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$typeCostCenterListHeaderView->setTitle('CostCenter');
$typeCostCenterListHeaderView->setHeader([
    ['title' => $lang['CostCenter'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Total'], 'sortable' => true],
]);

$typeCostCenterList->setFreeze(1, 0);
$typeCostCenterList->addView('header', $typeCostCenterListHeaderView);

foreach ($type['K'][$fiscal_end->format('Y')]['cc'] as $key => $stype) {
    $typeCostCenterList->addElements([$key, $ccDef[$key] ?? '',
                                      number_format($stype, 2, ',', '.'), ]);
}

$typeCostCenterList->addElements(['Total', '',
                                  number_format($type['K'][$fiscal_end->format('Y')]['value'], 2, ',', '.'), ]);

/*
 * UI Logic
 */
$typeAccountList           = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$typeAccountListHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$typeAccountList->setTemplate('/Web/Templates/Lists/ListFull');
$typeAccountListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$typeAccountListHeaderView->setTitle('Account');
$typeAccountListHeaderView->setHeader([
    ['title' => $lang['Account'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Total'], 'sortable' => true],
]);

$typeAccountList->setFreeze(1, 0);
$typeAccountList->addView('header', $typeAccountListHeaderView);

foreach ($type['K'][$fiscal_end->format('Y')]['ac'] as $key => $stype) {
    $typeAccountList->addElements([$key, $acDef[$key] ?? '',
                                   number_format($stype, 2, ',', '.'), ]);
}

$typeAccountList->addElements(['Total', '', number_format($type['K'][$fiscal_end->format('Y')]['value'], 2, ',', '.')]);

$tabView->addTab($lang['Type'], $typeList->render() . $typeCostCenterList->render() . $typeAccountList->render(), 'type');

/*
 * UI Logic
 */
$costObjectAccount           = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$costObjectAccountHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$costObjectAccount->setTemplate('/Web/Templates/Lists/ListFull');
$costObjectAccountHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$costObjectAccountHeaderView->setTitle('Account');
$costObjectAccountHeaderView->setHeader([
    ['title' => $lang['Account'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Total'], 'sortable' => true],
]);

$costObjectAccount->setFreeze(1, 0);
$costObjectAccount->addView('header', $costObjectAccountHeaderView);

foreach ($costobject['K152333'][$fiscal_end->format('Y')]['ac'] as $key => $co) {
    $costObjectAccount->addElements([$key, $acDef[$key] ?? '',
                                     number_format($co, 2, ',', '.'), ]);
}

$costObjectAccount->addElements(['Total', '',
                                 number_format($costobject['K152333'][$fiscal_end->format('Y')]['value'], 2, ',', '.'), ]);

/*
 * UI Logic
 */
$costObjectCostCenter           = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$costObjectCostCenterHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$costObjectCostCenter->setTemplate('/Web/Templates/Lists/ListFull');
$costObjectCostCenterHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$costObjectCostCenterHeaderView->setTitle('CostCenter');
$costObjectCostCenterHeaderView->setHeader([
    ['title' => $lang['CostCenter'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Total'], 'sortable' => true],
]);

$costObjectCostCenter->setFreeze(1, 0);
$costObjectCostCenter->addView('header', $costObjectCostCenterHeaderView);

foreach ($costobject['K152333'][$fiscal_end->format('Y')]['cc'] as $key => $co) {
    $costObjectCostCenter->addElements([$key, $ccDef[$key] ?? '',
                                        number_format($co, 2, ',', '.'), ]);
}

$costObjectCostCenter->addElements(['Total', '',
                                    number_format($costobject['K152333'][$fiscal_end->format('Y')]['value'], 2, ',', '.'), ]);

$tabView->addTab($lang['CostObject'], $costObjectAccount->render() . $costObjectCostCenter->render(), 'costobject');

/*
 * UI Logic
 */
$costCenterAccount           = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$costCenterAccountHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$costCenterAccount->setTemplate('/Web/Templates/Lists/ListFull');
$costCenterAccountHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$costCenterAccountHeaderView->setTitle('Account');
$costCenterAccountHeaderView->setHeader([
    ['title' => $lang['Account'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Total'], 'sortable' => true],
]);

$costCenterAccount->setFreeze(1, 0);
$costCenterAccount->addView('header', $costCenterAccountHeaderView);

foreach ($costcenter[241][$fiscal_end->format('Y')]['ac'] as $key => $ac) {
    $costCenterAccount->addElements([$key, $acDef[$key] ?? '',
                                     number_format($ac, 2, ',', '.'), ]);
}

$costCenterAccount->addElements(['Total', '',
                                 number_format($costcenter[241][$fiscal_end->format('Y')]['value'], 2, ',', '.'), ]);

/*
 * UI Logic
 */
$costcenterType           = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$costcenterTypeHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$costcenterType->setTemplate('/Web/Templates/Lists/ListFull');
$costcenterTypeHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$costcenterTypeHeaderView->setTitle('Type');
$costcenterTypeHeaderView->setHeader([
    ['title' => $lang['Type'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Total'], 'sortable' => true],
]);

$costcenterType->setFreeze(1, 0);
$costcenterType->addView('header', $costcenterTypeHeaderView);

foreach ($costcenter[241][$fiscal_end->format('Y')]['type'] as $key => $co) {
    $costcenterType->addElements([$key, $types[$key] ?? '', number_format($co, 2, ',', '.')]);
}

$costcenterType->addElements(['Total', '',
                              number_format($costcenter[241][$fiscal_end->format('Y')]['value'], 2, ',', '.'), ]);

/*
 * UI Logic
 */
$costcenterCostObject           = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$costcenterCostObjectHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$costcenterCostObject->setTemplate('/Web/Templates/Lists/ListFull');
$costcenterCostObjectHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$costcenterCostObjectHeaderView->setTitle('CostObject');
$costcenterCostObjectHeaderView->setHeader([
    ['title' => $lang['CostObject'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Total'], 'sortable' => true],
]);

$costcenterCostObject->setFreeze(1, 0);
$costcenterCostObject->addView('header', $costcenterCostObjectHeaderView);

foreach ($costcenter[241][$fiscal_end->format('Y')]['co'] as $key => $co) {
    $costcenterCostObject->addElements([$key, (!isset($coDef[$key]) ? '' : $coDef[$key]),
                                        number_format($co, 2, ',', '.'), ]);
}

$costcenterCostObject->addElements(['Total', '',
                                    number_format($costcenter[241][$fiscal_end->format('Y')]['value'], 2, ',', '.'), ]);

$tabView->addTab($lang['CostCenter'], $costcenterType->render() . $costCenterAccount->render() . $costcenterCostObject->render(), 'costcenter');

/*
 * UI Logic
 */
$accountTypeList           = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$accountTypeListHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$accountTypeList->setTemplate('/Web/Templates/Lists/ListFull');
$accountTypeListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$accountTypeListHeaderView->setTitle('Type');
$accountTypeListHeaderView->setHeader([
    ['title' => $lang['CostCenter'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Total'], 'sortable' => true],
]);

$accountTypeList->setFreeze(1, 0);
$accountTypeList->addView('header', $accountTypeListHeaderView);

foreach ($account[4480][$fiscal_end->format('Y')]['type'] as $key => $stype) {
    $accountTypeList->addElements([$key, $types[$key] ?? '',
                                   number_format($stype, 2, ',', '.'), ]);
}

$accountTypeList->addElements(['Total', '',
                               number_format($account[4480][$fiscal_end->format('Y')]['value'], 2, ',', '.'), ]);

/*
 * UI Logic
 */
$accountCostCenterList           = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$accountCostCenterListHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$accountCostCenterList->setTemplate('/Web/Templates/Lists/ListFull');
$accountCostCenterListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$accountCostCenterListHeaderView->setTitle('CostCenter');
$accountCostCenterListHeaderView->setHeader([
    ['title' => $lang['CostCenter'], 'sortable' => true],
    ['title' => $lang['Description'], 'sortable' => true, 'full' => true],
    ['title' => $lang['Total'], 'sortable' => true],
]);

$accountCostCenterList->setFreeze(1, 0);
$accountCostCenterList->addView('header', $accountCostCenterListHeaderView);

foreach ($account[4480][$fiscal_end->format('Y')]['cc'] as $key => $cc) {
    $accountCostCenterList->addElements([$key, $ccDef[$key] ?? '',
                                         number_format($cc, 2, ',', '.'), ]);
}

$accountCostCenterList->addElements(['Total', '',
                                     number_format($account[4480][$fiscal_end->format('Y')]['value'], 2, ',', '.'), ]);

$tabView->addTab($lang['Account'], $accountTypeList->render() . $accountCostCenterList->render(), 'account');

?>
<?= $tabView->render(); ?>
