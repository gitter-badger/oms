<?php
$start = new \phpOMS\Datatypes\SmartDateTime('2015/01/01');
$end   = new \phpOMS\Datatypes\SmartDateTime('2015/06/30');

$file = fopen(__DIR__ . '/NOGITCARS.csv', 'r');

$cars = [];
while (($line = fgetcsv($file, 0, ';')) !== false) {
    $line[2]        = number_format((float) str_replace(['.', ','], ['', '.'], $line[2]), 2);
    $line[3]        = number_format((float) str_replace(['.', ','], ['', '.'], $line[3]), 2);
    $line[4]        = number_format((float) str_replace(['.', ','], ['', '.'], $line[4]), 2);
    $line[5]        = number_format((float) str_replace(['.', ','], ['', '.'], $line[5]), 2);
    $line[6]        = number_format((float) str_replace(['.', ','], ['', '.'], $line[6]), 2);
    $cars[$line[0]] = $line;
}
fclose($file);

$file = fopen(__DIR__ . '/NOGIT.csv', 'r');

//$bookentries = [];
$carData     = [];
$accountData = [];
while (($line = fgetcsv($file)) !== false) {
    //$bookentries[] = $line;

    if (array_key_exists($line[9], $cars) || $line[9] === '') {
        if ($line[9] === '') {
            $line[9] = 'EMPTY';
        }

        $soll  = (float) str_replace(['.', ','], ['', '.'], $line[3]);
        $haben = (float) str_replace(['.', ','], ['', '.'], $line[4]);
        $tYear = (int) ((new DateTime($line[0]))->format('Y'));

        if (!isset($carData[$line[9]][$tYear][(int) $line[10]])) {
            $carData[$line[9]][$tYear][(int) $line[10]] = 0;
        }

        if (!isset($accountData[$tYear][(int) $line[10]])) {
            $accountData[$tYear][(int) $line[10]] = 0;
        }

        $carData[$line[9]][$tYear][(int) $line[10]] += $soll;
        $carData[$line[9]][$tYear][(int) $line[10]] -= $haben;
        $accountData[$tYear][(int) $line[10]] += (float) $soll;
        $accountData[$tYear][(int) $line[10]] -= (float) $haben;
    }
}
fclose($file);

$year  = 2015;
$month = 3;

$accounts = [4574, 4340, 4573, 4575, 4572, 4580];

for ($y = $year; $y > $year - 3; $y--) {
    foreach ($accounts as $account) {
        if (!isset($accountData[$y][$account])) {
            $accountData[$y][$account] = 0;
        }

        foreach ($cars as $car => $more) {
            if (!isset($carData[$car][$y][$account])) {
                $carData[$car][$y][$account] = 0;
            }
        }
    }
}
