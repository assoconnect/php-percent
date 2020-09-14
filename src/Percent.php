<?php

declare(strict_types=1);

namespace AssoConnect\PHPPercent;

use Money\Money;

class Percent
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function equals(self $percent): bool
    {
        return $this->value === $percent->value;
    }

    public function toRatio(): float
    {
        return $this->value / 10000;
    }

    public function applyTo(Money $amount): Money
    {
        return $amount->multiply($this->value / 10000, Money::ROUND_HALF_DOWN);
    }

    public function addTo(Money $amount): Money
    {
        return $amount->add($this->applyTo($amount));
    }

    public function removeFrom(Money $amount): Money
    {
        return $amount->subtract($this->applyTo($amount));
    }
}
