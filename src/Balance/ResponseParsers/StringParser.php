<?php

namespace Yepbro\Smsc\Balance\ResponseParsers;

use Yepbro\Smsc\Helper;

/**
 * Разбор ответа в формате STRING с данными баланса
 */
class StringParser
{
    public function __invoke(?string $content): array
    {
        $data = explode(',', $content);

        $balance = isset($data[0]) ? (float)$data[0] : null;

        $currency = Helper::convertCurrencyNameToISO4217($data[1] ?? null);

        return [
            'balance' => $balance,
            'currency' => $currency,
        ];
    }
}