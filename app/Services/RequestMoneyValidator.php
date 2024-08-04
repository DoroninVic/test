<?php

namespace App\Services;

use App\DTO\{
    Request as RequestDTO,
    Transaction as TransactionDTO
};

class RequestMoneyValidator
{
    /**
     * @var float|mixed
     */
    private float $deviation;

    /**
     * @param float|null $deviationPercent
     */
    public function __construct(float $deviationPercent = null)
    {
        $this->deviation = !$deviationPercent ?
            env('DEFAULT_DEVIATION_PERCENT', 10) : // предпочтительней конечно через config
            $deviationPercent;
    }

    /**
     * @param RequestDTO $request
     * @param TransactionDTO $transaction
     * @return bool
     */
    public function validate(RequestDTO $request, TransactionDTO $transaction): bool
    {
        // Проверка по перечню доступных валют
        if (!in_array($request->getCurrency(), $transaction::currenciesList())) {
            return false;
        }

        // Проверка соответствия валюты операции и запрошенной валюты
        if ($transaction->getCurrency() !== $request->getCurrency()) {
            return false;
        }

        // Максимально допустимпое отклонение (допуск)
        $maxAmountDeviation = round($request->getAmount() * $this->deviation / 100,2);

        // Сравнение фактического отклонения и максимально допустимого
        if (abs($transaction->getAmount() - $request->getAmount()) > $maxAmountDeviation)
            return false;

        return true;
    }
}
