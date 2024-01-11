<?php

namespace Yepbro\Smsc\Balance\ResponseParsers;

use Yepbro\Smsc\Helper;

/**
 * Разбор ответа в формате JSON с данными баланса
 */
class JsonParser
{
    public function __invoke(?string $content): array
    {
        $data = json_decode($content, true);

        $balance = isset($data['balance']) ? (float)$data['balance'] : null;

        $currency = Helper::convertCurrencyNameToISO4217($data['currency'] ?? null);

        return [
            'balance' => $balance,
            'currency' => $currency,
        ];
    }
}