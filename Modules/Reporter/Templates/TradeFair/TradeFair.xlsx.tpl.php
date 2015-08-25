<?php

require 'Worker.php';
$lang = $this->getData('lang');

date_default_timezone_set('Europe/London');

// Create new PHPExcel object
$excel = new \phpOMS\Utils\Excel\Excel();

include ROOT_PATH . '/Web/Styles/Excel.php';

// Set document properties
$excel->getProperties()->setCreator('Orange Management Solutions')
    ->setLastModifiedBy('Dennis Eichhorn')
    ->setTitle('Trade Fairs')
    ->setSubject('International & Domestic Trade Fairs')
    ->setDescription('Document used in order to evaluate the domestic and international trade fair expenses.')
    ->setKeywords('OMS Budget Trade Fair')
    ->setCategory('Controlling');

$budget = [
];

$excel->getActiveSheet()
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['Overview'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

// Cost Object
$i = 5;
$excel->getActiveSheet()
    ->setCellValue('A' . $i, $lang['ID'])
    ->setCellValue('B' . $i, $fiscal_start->format('Y/m/d'))
    ->setCellValue('C' . $i, $fiscal_start->createModify(0, 1)->format('Y/m/d'))
    ->setCellValue('D' . $i, $fiscal_start->createModify(0, 2)->format('Y/m/d'))
    ->setCellValue('E' . $i, $fiscal_start->createModify(0, 3)->format('Y/m/d'))
    ->setCellValue('F' . $i, $fiscal_start->createModify(0, 4)->format('Y/m/d'))
    ->setCellValue('G' . $i, $fiscal_start->createModify(0, 5)->format('Y/m/d'))
    ->setCellValue('H' . $i, $fiscal_start->createModify(0, 6)->format('Y/m/d'))
    ->setCellValue('I' . $i, $fiscal_start->createModify(0, 7)->format('Y/m/d'))
    ->setCellValue('J' . $i, $fiscal_start->createModify(0, 8)->format('Y/m/d'))
    ->setCellValue('K' . $i, $fiscal_start->createModify(0, 9)->format('Y/m/d'))
    ->setCellValue('L' . $i, $fiscal_start->createModify(0, 10)->format('Y/m/d'))
    ->setCellValue('M' . $i, $fiscal_start->createModify(0, 11)->format('Y/m/d'))
    ->setCellValue('N' . $i, $lang['Actual'])
    ->setCellValue('O' . $i, $lang['Forecast'])
    ->setCellValue('P' . $i, $lang['Total'])
    ->setCellValue('Q' . $i, $lang['Budget'])
    ->setCellValue('R' . $i, $lang['DiffBudget%']);

$i += 1;
$start = $i;
foreach ($types as $key => $stype) {
    $excel->getActiveSheet()
        ->setCellValue('A' . $i, $key)
        ->setCellValue('B' . $i, $stype)
        ->setCellValue('C' . $i, $type[$key][$fiscal_end_prev->format('Y')]['value'] ?? 0.0)
        ->setCellValue('D' . $i, $type[$key][$fiscal_end->format('Y')]['value'] ?? 0.0)
        ->setCellValue('E' . $i, '=D' . $i . '/' . abs(((int) $fiscal_current->format('m') - ((int) $fiscal_end->format('m') + 1)) % 12 + 1) . '*12')
        ->setCellValue('F' . $i, $budget[$key])
        ->setCellValue('G' . $i, '=(E' . $i . '-F' . $i . ')/F' . $i);

    $i++;
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':B' . $i);

$excel->getActiveSheet()
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('C' . $i, '=SUM(C' . $start . ':C' . ($i - 1) . ')')
    ->setCellValue('D' . $i, '=SUM(D' . $start . ':D' . ($i - 1) . ')')
    ->setCellValue('E' . $i, '=SUM(E' . $start . ':E' . ($i - 1) . ')')
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=(E' . $i . '-F' . $i . ')/F' . $i);

// Cost Center
$i += 2;
$excel->getActiveSheet()
    ->setCellValue('A' . $i, $lang['CostCenter'])
    ->setCellValue('B' . $i, $lang['Description'])
    ->setCellValue('C' . $i, $lang['History'])
    ->setCellValue('D' . $i, $lang['Actual'])
    ->setCellValue('E' . $i, $lang['Forecast'])
    ->setCellValue('F' . $i, $lang['DiffHistory%']);

$i += 1;
$start = $i;
foreach ($costcenter as $key => $cc) {
    $excel->getActiveSheet()
        ->setCellValue('A' . $i, $key)
        ->setCellValue('B' . $i, $ccDef[$key])
        ->setCellValue('C' . $i, $costcenter[$key][$fiscal_end_prev->format('Y')]['value'] ?? 0.0)
        ->setCellValue('D' . $i, $costcenter[$key][$fiscal_end->format('Y')]['value'] ?? 0.0)
        ->setCellValue('E' . $i, '=D' . $i . '/' . abs(((int) $fiscal_current->format('m') - ((int) $fiscal_end->format('m') + 1)) % 12 + 1) . '*12')
        ->setCellValue('F' . $i, '=(E' . $i . '-C' . $i . ')/C' . $i);

    $i++;
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':B' . $i);

$excel->getActiveSheet()
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('C' . $i, '=SUM(C' . $start . ':C' . ($i - 1) . ')')
    ->setCellValue('D' . $i, '=SUM(D' . $start . ':D' . ($i - 1) . ')')
    ->setCellValue('E' . $i, '=SUM(E' . $start . ':E' . ($i - 1) . ')')
    ->setCellValue('F' . $i, '=(E' . $i . '-C' . $i . ')/C' . $i);

// Account
$i += 2;
$excel->getActiveSheet()
    ->setCellValue('A' . $i, $lang['Account'])
    ->setCellValue('B' . $i, $lang['Description'])
    ->setCellValue('C' . $i, $lang['History'])
    ->setCellValue('D' . $i, $lang['Actual'])
    ->setCellValue('E' . $i, $lang['Forecast'])
    ->setCellValue('F' . $i, $lang['DiffHistory%']);

$i += 1;
$start = $i;
foreach ($account as $key => $ac) {
    $excel->getActiveSheet()
        ->setCellValue('A' . $i, $key)
        ->setCellValue('B' . $i, $acDef[$key])
        ->setCellValue('C' . $i, $account[$key][$fiscal_end_prev->format('Y')]['value'] ?? 0.0)
        ->setCellValue('D' . $i, $account[$key][$fiscal_end->format('Y')]['value'] ?? 0.0)
        ->setCellValue('E' . $i, '=D' . $i . '/' . abs(((int) $fiscal_current->format('m') - ((int) $fiscal_end->format('m') + 1)) % 12 + 1) . '*12')
        ->setCellValue('F' . $i, '=(E' . $i . '-C' . $i . ')/C' . $i);

    $i++;
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':B' . $i);

$excel->getActiveSheet()
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('C' . $i, '=SUM(C' . $start . ':C' . ($i - 1) . ')')
    ->setCellValue('D' . $i, '=SUM(D' . $start . ':D' . ($i - 1) . ')')
    ->setCellValue('E' . $i, '=SUM(E' . $start . ':E' . ($i - 1) . ')')
    ->setCellValue('F' . $i, '=(E' . $i . '-C' . $i . ')/C' . $i);

// Formatting
$excel->getActiveSheet()
    ->getStyle('F6:F19')
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$excel->getActiveSheet()
    ->getStyle('F22:F' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$excel->getActiveSheet()
    ->getStyle('G6:G19')
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$excel->getActiveSheet()
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3');

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

// Rename worksheet
$excel->getActiveSheet()->setTitle('Overview');

$excel->createSheet(1);

$excel->setActiveSheetIndex(1)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['AdviceBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (strrpos($key, 'B', -strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, $courseList[$key][2] ?? '')
            ->setCellValue('D' . $i, $courseList[$key][4] ?? '')
            ->setCellValue('E' . $i, $courseList[$key][5] ?? : '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        $i++;
    }
}

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['B']);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 2));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 3) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Advice');

$excel->createSheet(2);

$excel->setActiveSheetIndex(2)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['DemoBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (strrpos($key, 'D', -strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, $courseList[$key][2] ?? '')
            ->setCellValue('D' . $i, $courseList[$key][4] ?? '')
            ->setCellValue('E' . $i, $courseList[$key][5] ?? '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        $i++;
    }
}

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['D']);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 2));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 3) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Demo');

// Sheet
$excel->createSheet(3);

$excel->setActiveSheetIndex(3)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['BriefingBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (strrpos($key, 'E', -strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, $courseList[$key][2] ?? '')
            ->setCellValue('D' . $i, $courseList[$key][4] ?? '')
            ->setCellValue('E' . $i, $courseList[$key][5] ?? '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        $i++;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['E']);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 2));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 3) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Briefing');

// Sheet
$excel->createSheet(4);

$excel->setActiveSheetIndex(4)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['IMPLABudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (strrpos($key, 'I', -strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, $courseList[$key][2] ?? '')
            ->setCellValue('D' . $i, $courseList[$key][4] ?? '')
            ->setCellValue('E' . $i, $courseList[$key][5] ?? '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        $i++;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['I']);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 2));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 3) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('IMPLA');

// Sheet
$excel->createSheet(5);

$excel->setActiveSheetIndex(5)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['MarketingSupportBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (strrpos($key, 'M', -strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, $courseList[$key][2] ?? '')
            ->setCellValue('D' . $i, $courseList[$key][4] ?? '')
            ->setCellValue('E' . $i, $courseList[$key][5] ?? '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        $i++;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['M']);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 2));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 3) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Marketing Support');

// Sheet
$excel->createSheet(6);

$excel->setActiveSheetIndex(6)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['PromotionBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (strrpos($key, 'P', -strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, $courseList[$key][2] ?? '')
            ->setCellValue('D' . $i, $courseList[$key][4] ?? '')
            ->setCellValue('E' . $i, $courseList[$key][5] ?? '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        $i++;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['P']);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 2));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 3) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Promotion');

// Sheet
$excel->createSheet(7);

$excel->setActiveSheetIndex(7)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['RoadshowBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (strrpos($key, 'S', -strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, $courseList[$key][2] ?? '')
            ->setCellValue('D' . $i, $courseList[$key][4] ?? '')
            ->setCellValue('E' . $i, $courseList[$key][5] ?? '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        $i++;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['S']);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 2));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 3) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Roadshow');

// Sheet
$excel->createSheet(8);

$excel->setActiveSheetIndex(8)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['AdditionalSupportBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (strrpos($key, 'U', -strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, $courseList[$key][2] ?? '')
            ->setCellValue('D' . $i, $courseList[$key][4] ?? '')
            ->setCellValue('E' . $i, $courseList[$key][5] ?? '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        $i++;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['U']);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 2));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 3) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Additional Support');

// Sheet
$excel->createSheet(9);

$excel->setActiveSheetIndex(9)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['ExportCourseBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if ((strrpos($key, 'A', -strlen($key)) !== false || $key === '') && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, $courseList[$key][2] ?? '')
            ->setCellValue('D' . $i, $courseList[$key][4] ?? '')
            ->setCellValue('E' . $i, $courseList[$key][5] ?? '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        $i++;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['A']);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 2));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 3) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Export Courses');

// Sheet
$excel->createSheet(10);

$excel->setActiveSheetIndex(10)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['CourseBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if ((strrpos($key, 'K', -strlen($key)) !== false || strrpos($key, 'V', -strlen($key)) !== false || strrpos($key, 'R', -strlen($key)) !== false) && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, $courseList[$key][2] ?? '')
            ->setCellValue('D' . $i, $courseList[$key][4] ?? '')
            ->setCellValue('E' . $i, $courseList[$key][5] ?? '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        $i++;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . ($budget['K'] + $budget['R'] + $budget['V']));

$i++;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 2));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 3) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Events & Courses');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$excel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
