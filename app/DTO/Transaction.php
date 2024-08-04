<?php

namespace App\DTO;

class Transaction
{
    const CURRENCY_USD = 'usd';
    const CURRENCY_EURO = 'eur';

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
     * @return array
     */
    public static function currenciesList(): array
    {
        return [
            self::CURRENCY_USD,
            self::CURRENCY_EURO
        ];
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
