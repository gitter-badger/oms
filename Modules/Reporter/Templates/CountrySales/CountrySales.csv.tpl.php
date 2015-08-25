<?php include __DIR__ . '/Worker.php';

echo $lang['Countries'] . "\n";

foreach ($countries as $d2 => $value) {
    echo array_search($d2, $cc) . ';' . $d2 . ';' . number_format($value, 2, ',', '.') . "\n";
}

echo $lang['Accounts'] . "\n";

foreach ($accounts as $key => $value) {
    echo $key . ';' . number_format($value, 2, ',', '.') . "\n";
}

echo $lang['Developed'] . "\n";

echo $lang['Total'] . ";" . $developed['total'] . "\n";

foreach ($developed['top'] as $key => $value) {
    echo $value['id'] . ';' . number_format($value['value'], 2, ',', '.') . ";" .  $value['cc']. "\n";
}

echo $lang['Undeveloped'] . "\n";

echo $lang['Total'] . ";" . $undeveloped['total'] . "\n";

foreach ($undeveloped['top'] as $key => $value) {
    echo $value['id'] . ';' . number_format($value['value'], 2, ',', '.') . ";" .  $value['cc']. "\n";
}
