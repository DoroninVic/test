<?php

namespace App\DTO;

class Request
{
    /**
     * @var float
     */
    public float $amount;

    /**
     * @var string
     */
    public string $currency;

    /**
     * @param float $amount
     * @param string $currency
     */
    public function __construct(float $amount, string $currency)
    {
        $this->amount = number_format($amount, 2);
        $this->currency = strtolower($currency);
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}
