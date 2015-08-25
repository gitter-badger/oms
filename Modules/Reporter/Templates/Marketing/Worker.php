<?php
$start = new \phpOMS\Datatypes\SmartDateTime('2015/01/01');
$end   = new \phpOMS\Datatypes\SmartDateTime('2015/06/30');

$acDef = [];
$ccDef = [];
$coDef = [];

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
    4456, 4600, 4601, 4602, 4605, 4610, 4611, 4613, 4614, 4615,
    4616, 4617, 4618, 4619, 4620, 4623, 4625, 4626, 4630, 4643,
];

$types = [
    'A' => 'EventCourseInt',
    'B' => 'Advice',
    'D' => 'Demo',
    'E' => 'Briefing',
    'I' => 'IMPLA',
    'K' => 'Course',
    'M' => 'MarketingSupport',
    'P' => 'Promotion',
    'R' => 'CourseRosbach',
    'S' => 'Roadshow',
    'U' => 'AdditionalSupport',
    'V' => 'Event',
    ''  => 'Unknown',
];

$account    = [];
$type       = [];
$costcenter = [];
$costobject = [];

$total_now = 0.0;

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

        if (!isset($type[$t_name][$year][$month])) {
            $type[$t_name][$year][$month] = 0.0;
        }

        if (!isset($costcenter[$line[8]][$year][$month])) {
            $costcenter[$line[8]][$year][$month] = 0.0;
        }

        if (!isset($costobject[$line[9]][$year][$month])) {
            $costobject[$line[9]][$year][$month] = 0.0;
        }

        // Now
        if ($date->getTimestamp() >= $start->getTimestamp() && $date->getTimestamp() <= $end->getTimestamp()) {
            if (!isset($account[$line[10]]['now']['value'])) {
                $account[$line[10]]['now']['value'] = 0.0;
            }

            if (!isset($account[$line[10]]['now']['cc'][$line[8]])) {
                $account[$line[10]]['now']['cc'][$line[8]] = 0.0;
            }

            if (!isset($account[$line[10]]['now']['type'][$t_name])) {
                $account[$line[10]]['now']['type'][$t_name] = 0.0;
            }

            if (!isset($account[$line[10]]['now']['co'][$line[9]])) {
                $account[$line[10]]['now']['co'][$line[9]] = 0.0;
            }

            if (!isset($type[$t_name]['now']['value'])) {
                $type[$t_name]['now']['value'] = 0.0;
            }

            if (!isset($type[$t_name]['now']['cc'][$line[8]])) {
                $type[$t_name]['now']['cc'][$line[8]] = 0.0;
            }

            if (!isset($type[$t_name]['now']['ac'][$line[10]])) {
                $type[$t_name]['now']['ac'][$line[10]] = 0.0;
            }

            if (!isset($costcenter[$line[8]]['now']['value'])) {
                $costcenter[$line[8]]['now']['value'] = 0.0;
            }

            if (!isset($costcenter[$line[8]]['now']['co'][$line[9]])) {
                $costcenter[$line[8]]['now']['co'][$line[9]] = 0.0;
            }

            if (!isset($costcenter[$line[8]]['now']['ac'][$line[10]])) {
                $costcenter[$line[8]]['now']['ac'][$line[10]] = 0.0;
            }

            if (!isset($costcenter[$line[8]]['now']['type'][$t_name])) {
                $costcenter[$line[8]]['now']['type'][$t_name] = 0.0;
            }

            if (!isset($costobject[$line[9]]['now']['value'])) {
                $costobject[$line[9]]['now']['value'] = 0.0;
            }

            if (!isset($costobject[$line[9]]['now']['ac'][$line[10]])) {
                $costobject[$line[9]]['now']['ac'][$line[10]] = 0.0;
            }

            if (!isset($costobject[$line[9]]['now']['cc'][$line[8]])) {
                $costobject[$line[9]]['now']['cc'][$line[8]] = 0.0;
            }

            $account[$line[10]]['now']['value'] += $val;
            $account[$line[10]]['now']['cc'][$line[8]] += $val;
            $account[$line[10]]['now']['type'][$t_name] += $val;
            $type[$t_name]['now']['value'] += $val;
            $type[$t_name]['now']['cc'][$line[8]] += $val;
            $type[$t_name]['now']['ac'][$line[10]] += $val;
            $costcenter[$line[8]]['now']['value'] += $val;
            $costcenter[$line[8]]['now']['co'][$line[9]] += $val;
            $costcenter[$line[8]]['now']['ac'][$line[10]] += $val;
            $costcenter[$line[8]]['now']['type'][$t_name] += $val;
            $costobject[$line[9]]['now']['value'] += $val;
            $costobject[$line[9]]['now']['ac'][$line[10]] += $val;
            $costobject[$line[9]]['now']['cc'][$line[8]] += $val;

            $total_now += $val;
        }

        $account[$line[10]][$year][$month] += $val;
        $type[$t_name][$year][$month] += $val;
        $costcenter[$line[8]][$year][$month] += $val;
        $costobject[$line[9]][$year][$month] += $val;
    }
}
fclose($file);
