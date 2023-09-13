<?php

declare(strict_types=1);

namespace AssoConnect\PHPPercent;

use Money\Money;

class Percent
{
    private int $value;

    /**
     * Percent constructor.
     * @param int $value Use 2000 to represent 20.00%
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @param Percent $percent Percent object to compare
     * @return bool True if both objects represent the same value
     */
    public function equals(self $percent): bool
    {
        return $this->value === $percent->value;
    }

    /**
     * @return int Internal representation of the percentage
     */
    public function toInteger(): int
    {
        return $this->value;
    }

    /**
     * @return float Float representation of the percentage (0.2 for 20%)
     */
    public function toRatio(): float
    {
        return $this->value / 10000;
    }

    /**
     * Use the current percent on a given Money object
     * @param Money $amount
     * @return Money 20EUR for 20% of 100EUR
     */
    public function applyTo(Money $amount): Money
    {
        return $amount->multiply(sprintf('%.14F', $this->value / 10000), Money::ROUND_HALF_DOWN);
    }

    /**
     * Increase a given Money object by the current percent
     * @param Money $amount
     * @return Money 120EUR for 100EUR + 20%
     */
    public function addTo(Money $amount): Money
    {
        return $amount->add($this->applyTo($amount));
    }

    /**
     * Decrease a given Money object by the current percent
     * @param Money $amount
     * @return Money 80EUR for 100EUR - 20%
     */
    public function removeFrom(Money $amount): Money
    {
        return $amount->subtract($this->applyTo($amount));
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
