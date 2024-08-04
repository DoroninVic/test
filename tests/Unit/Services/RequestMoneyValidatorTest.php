<?php

namespace Tests\Unit\Services;

use App\DTO\{Request, Transaction};
use App\Services\RequestMoneyValidator;
use PHPUnit\Framework\TestCase;

class RequestMoneyValidatorTest extends TestCase
{
    public function test_success_validation_deviation_10()
    {
        $validator = new RequestMoneyValidator(10);
        $request = new Request(100, 'Usd'); // дополнительно проверяем формат валюты
        $transaction = new Transaction(90, Transaction::CURRENCY_USD);

        $this->assertTrue($validator->validate($request, $transaction));
    }

    public function test_failed_validation_out_of_range()
    {
        $validator = new RequestMoneyValidator(1);
        $request = new Request(100, 'uSD');
        $transaction = new Transaction(97.54, Transaction::CURRENCY_USD);

        $this->assertFalse($validator->validate($request, $transaction));
    }

    public function test_success_validation_bad_currency()
    {
        $validator = new RequestMoneyValidator(10);
        $request = new Request(100, 'USD');
        $transaction = new Transaction(90, Transaction::CURRENCY_EURO);

        $this->assertFalse($validator->validate($request, $transaction));
    }

    // Дополнительные тесты функционала

    public function test_success_validation_default_deviation()
    {
        $validator = new RequestMoneyValidator();
        $request = new Request(100, 'USD');
        $transaction = new Transaction(90, Transaction::CURRENCY_USD);

        $this->assertTrue($validator->validate($request, $transaction));
    }
}
