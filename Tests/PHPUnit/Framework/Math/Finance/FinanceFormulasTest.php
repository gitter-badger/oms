<?php

require_once __DIR__ . '/../../../../../phpOMS/Autoloader.php';

class FinanceFormulasTest extends PHPUnit_Framework_TestCase
{
    public function testAnnualPercentageYield()
    {
        $expected = 0.06168;

        $r = 0.06;
        $n = 12;
        $apy = \phpOMS\Math\Finance\FinanceFormulas::getAnnualPercentageYield($r, $n);

        $this->assertEquals(round($expected, 5), round($apy, 5));
        $this->assertEquals(round($r, 2), \phpOMS\Math\Finance\FinanceFormulas::getStateAnnualInterestRateOfAPY($apy, $n));
    }

    public function testFutureValueOfAnnuity()
    {
        $expected = 5204.04;

        $P = 1000.00;
        $r = 0.02;
        $n = 5;
        $fva = \phpOMS\Math\Finance\FinanceFormulas::getFutureValueOfAnnuity($P, $r, $n);

        $this->assertEquals(round($expected, 2), round($fva, 2));
        $this->assertEquals($n, \phpOMS\Math\Finance\FinanceFormulas::getNumberOfPeriodsOfFVA($fva, $P, $r));
        $this->assertEquals(round($P, 2), round(\phpOMS\Math\Finance\FinanceFormulas::getPeriodicPaymentOfFVA($fva, $r, $n), 2));
    }

    public function testFutureValueOfAnnuityContinuousCompounding()
    {
        $expected = 12336.42;

        $cf = 1000.00;
        $r = 0.005;
        $t = 12;
        $fvacc = \phpOMS\Math\Finance\FinanceFormulas::getFutureValueOfAnnuityConinuousCompounding($cf, $r, $t);

        $this->assertEquals(round($expected, 2), round($fvacc, 2));
        $this->assertEquals(round($cf, 2), round(\phpOMS\Math\Finance\FinanceFormulas::getCashFlowOfFVACC($fvacc, $r, $t), 2));
        $this->assertEquals($t, \phpOMS\Math\Finance\FinanceFormulas::getTimeOfFVACC($fvacc, $cf, $r));
    }

    public function testAnnuityPaymentPV()
    {
        $expected = 212.16;

        $pv = 1000.00;
        $r = 0.02;
        $n = 5;
        $p = \phpOMS\Math\Finance\FinanceFormulas::getAnnuityPaymentPV($pv, $r, $n);

        $this->assertEquals(round($expected, 2), round($p, 2));
        $this->assertEquals($n, \phpOMS\Math\Finance\FinanceFormulas::getNumberOfAPPV($p, $pv, $r));
        $this->assertEquals(round($pv, 2), round(\phpOMS\Math\Finance\FinanceFormulas::getPresentValueOfAPPV($p, $r, $n), 2));
    }

    public function testAnnuityPaymentFV()
    {
        $expected = 192.16;

        $fv = 1000.00;
        $r = 0.02;
        $n = 5;
        $p = \phpOMS\Math\Finance\FinanceFormulas::getAnnuityPaymentFV($fv, $r, $n);

        $this->assertEquals(round($expected, 2), round($p, 2));
        $this->assertEquals($n, \phpOMS\Math\Finance\FinanceFormulas::getNumberOfAPFV($p, $fv, $r));
        $this->assertEquals(round($fv, 2), round(\phpOMS\Math\Finance\FinanceFormulas::getFutureValueOfAPFV($p, $r, $n), 2));
    }

    public function testAnnutiyPaymentFactorPV()
    {
        $expected = 0.21216;

        $r = 0.02;
        $n = 5;
        $p = \phpOMS\Math\Finance\FinanceFormulas::getAnnutiyPaymentFactorPV($r, $n);

        $this->assertEquals(round($expected, 5), round($p, 5));
        $this->assertEquals($n, \phpOMS\Math\Finance\FinanceFormulas::getNumberOfAPFPV($p, $r));
    }

    public function testPresentValueOfAnnuity()
    {
        $expected = 4713.46;

        $P = 1000.00;
        $r = 0.02;
        $n = 5;
        $pva = \phpOMS\Math\Finance\FinanceFormulas::getPresentValueOfAnnuity($P, $r, $n);

        $this->assertEquals(round($expected, 2), round($pva, 2));
        $this->assertEquals($n, \phpOMS\Math\Finance\FinanceFormulas::getNumberOfPeriodsOfPVA($pva, $P, $r));
        $this->assertEquals(round($P, 2), round(\phpOMS\Math\Finance\FinanceFormulas::getPeriodicPaymentOfPVA($pva, $r, $n), 2));
    }

    public function testPresentValueAnnuityFactor()
    {
        $expected = 4.7135;

        $r = 0.02;
        $n = 5;
        $p = \phpOMS\Math\Finance\FinanceFormulas::getPresentValueAnnuityFactor($r, $n);

        $this->assertEquals(round($expected, 4), round($p, 4));
        $this->assertEquals($n, \phpOMS\Math\Finance\FinanceFormulas::getPeriodsOfPVAF($p, $r));
    }
}
