<?php

declare(strict_types=1);

namespace AssoConnect\PHPPercent\Tests;

use AssoConnect\PHPPercent\Percent;
use Money\Money;
use PHPUnit\Framework\TestCase;

class PercentTest extends TestCase
{
    public function testEquals(): void
    {
        $percent = new Percent(42);
        $this->assertTrue($percent->equals(new Percent(42)));
        $this->assertFalse($percent->equals(new Percent(24)));
    }

    public function testToRatio(): void
    {
        $percent = new Percent(4200);
        $this->assertSame(0.42, $percent->toRatio());
    }

    public function testApplyTo(): void
    {
        $percent = new Percent(4200);
        $amount = Money::EUR(10000);
        $amountPercent = Money::EUR(4200);
        $this->assertEquals($amountPercent, $percent->applyTo($amount));
    }

    public function testAddTo(): void
    {
        $percent = new Percent(4200);
        $amount = Money::EUR(10000);
        $amountAdd = Money::EUR(14200);
        $this->assertEquals($amountAdd, $percent->addTo($amount));
    }

    public function testRemoveFrom(): void
    {
        $percent = new Percent(4200);
        $amount = Money::EUR(10000);
        $amountSubstract = Money::EUR(5800);
        $this->assertEquals($amountSubstract, $percent->removeFrom($amount));
    }
}
