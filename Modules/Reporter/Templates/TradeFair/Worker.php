<?php
$fiscal_end        = new \phpOMS\Datatypes\SmartDateTime('2016/06/30');
$fiscal_current    = new \phpOMS\Datatypes\SmartDateTime('2015/07/31');
$fiscal_start      = new \phpOMS\Datatypes\SmartDateTime('2015/07/01');
$fiscal_start_prev = $fiscal_start->createModify(-1);
$fiscal_end_prev   = $fiscal_end->createModify(-1);

$acDef      = [];
$ccDef      = [];
$coDef      = [];
$courseList = [];

if (($path = realpath(__DIR__ . '/accountsNOGIT.csv')) !== false) {
    $file = fopen($path, 'r');
    while (($line = fgetcsv($file, 0, ';', '"')) !== false) {
        $acDef[$line[0]] = $line[1];
    }
    fclose($file);
}

if (($path = realpath(__DIR__ . '/costcentersNOGIT.csv')) !== false) {
    $file = fopen($path, 'r');
    while (($line = fgetcsv($file, 0, ';', '"')) !== false) {
        $ccDef[$line[0]] = $line[1];
    }
    fclose($file);
}

if (($path = realpath(__DIR__ . '/costobjectsNOGIT.csv')) !== false) {
    $file = fopen($path, 'r');
    while (($line = fgetcsv($file, 0, ';', '"')) !== false) {
        $coDef[$line[0]] = $line[1];
    }
    fclose($file);
}

$accounts = [
    4410, 4411, 4412, 4413, 4414, 4415, 4416, 4418, 4419, 4420, 4421, 4424, 4425, 4426, 4400, 4423, 4404, 4427, 4422, 4416, 4417, 4428, 4430, 4405, 4401, 4402,
];

$accounts_domestic = [
    4405, 4401, 4402,
];

$account    = [];
$costcenter = [];
$costobject = [];

$total = [];

$file = fopen(__DIR__ . '/Entries2YNOGIT.csv', 'r');
while (($line = fgetcsv($file, 0, ',', '"')) !== false) {
    if (in_array($line[10], $accounts)) {
        $date  = new \phpOMS\Datatypes\SmartDateTime($line[0]);
        $year  = (int) $date->format('Y');
        $month = (int) $date->format('m');

        $val_1 = (float) str_replace(['.', ','], ['', '.'], $line[3]);
        $val_2 = (float) str_replace(['.', ','], ['', '.'], $line[4]);
        $val   = $val_1 - $val_2;

        $t_name = empty($line[9]) ? '' : substr($line[9], 0, 1);

        if (!isset($account[$line[10]][$year][$month])) {
            $account[$line[10]][$year][$month] = 0.0;
        }

        if (!isset($costcenter[$line[8]][$year][$month])) {
            $costcenter[$line[8]][$year][$month] = 0.0;
        }

        if (!isset($costobject[$line[9]][$year][$month])) {
            $costobject[$line[9]][$year][$month] = 0.0;
        }

        $account[$line[10]][$year][$month] += $val;
        $type[$t_name][$year][$month] += $val;
        $costcenter[$line[8]][$year][$month] += $val;
        $costobject[$line[9]][$year][$month] += $val;

        // Now
        if ($date->getTimestamp() >= $fiscal_start->getTimestamp() && $date->getTimestamp() <= $fiscal_current->getTimestamp()) {
            $fiscal_year = $fiscal_end->format('Y');
        } elseif ($date->getTimestamp() >= $fiscal_start_prev->getTimestamp() && $date->getTimestamp() <= $fiscal_end_prev->getTimestamp()) {
            $fiscal_year = $fiscal_end_prev->format('Y');
        } else {
            continue;
        }

        if (!isset($account[$line[10]][$fiscal_year]['value'])) {
            $account[$line[10]][$fiscal_year]['value'] = 0.0;
        }

        if (!isset($account[$line[10]][$fiscal_year]['cc'][$line[8]])) {
            $account[$line[10]][$fiscal_year]['cc'][$line[8]] = 0.0;
        }

        if (!isset($account[$line[10]][$fiscal_year]['type'][$t_name])) {
            $account[$line[10]][$fiscal_year]['type'][$t_name] = 0.0;
        }

        if (!isset($account[$line[10]][$fiscal_year]['co'][$line[9]])) {
            $account[$line[10]][$fiscal_year]['co'][$line[9]] = 0.0;
        }

        if (!isset($costcenter[$line[8]][$fiscal_year]['value'])) {
            $costcenter[$line[8]][$fiscal_year]['value'] = 0.0;
        }

        if (!isset($costcenter[$line[8]][$fiscal_year]['co'][$line[9]])) {
            $costcenter[$line[8]][$fiscal_year]['co'][$line[9]] = 0.0;
        }

        if (!isset($costcenter[$line[8]][$fiscal_year]['ac'][$line[10]])) {
            $costcenter[$line[8]][$fiscal_year]['ac'][$line[10]] = 0.0;
        }

        if (!isset($costcenter[$line[8]][$fiscal_year]['type'][$t_name])) {
            $costcenter[$line[8]][$fiscal_year]['type'][$t_name] = 0.0;
        }

        if (!isset($costobject[$line[9]][$fiscal_year]['value'])) {
            $costobject[$line[9]][$fiscal_year]['value'] = 0.0;
        }

        if (!isset($costobject[$line[9]][$fiscal_year]['ac'][$line[10]])) {
            $costobject[$line[9]][$fiscal_year]['ac'][$line[10]] = 0.0;
        }

        if (!isset($costobject[$line[9]][$fiscal_year]['cc'][$line[8]])) {
            $costobject[$line[9]][$fiscal_year]['cc'][$line[8]] = 0.0;
        }

        $account[$line[10]][$fiscal_year]['value'] += $val;
        $account[$line[10]][$fiscal_year]['cc'][$line[8]] += $val;
        $account[$line[10]][$fiscal_year]['type'][$t_name] += $val;
        $costcenter[$line[8]][$fiscal_year]['value'] += $val;
        $costcenter[$line[8]][$fiscal_year]['co'][$line[9]] += $val;
        $costcenter[$line[8]][$fiscal_year]['ac'][$line[10]] += $val;
        $costcenter[$line[8]][$fiscal_year]['type'][$t_name] += $val;
        $costobject[$line[9]][$fiscal_year]['value'] += $val;
        $costobject[$line[9]][$fiscal_year]['ac'][$line[10]] += $val;
        $costobject[$line[9]][$fiscal_year]['cc'][$line[8]] += $val;

        if (!isset($total[$fiscal_year])) {
            $total[$fiscal_year] = 0.0;
        }

        $total[$fiscal_year] += $val;
    }
}
fclose($file);
