<?php

namespace Yepbro\Smsc\Balance\ResponseParsers;

use Yepbro\Smsc\Helper;

/**
 * Разбор ответа в формате XML с данными баланса
 */
class XmlParser
{
    public function __invoke(?string $content): array
    {
        $balance = Helper::cutBetweenTag($content, 'balance');

        $currency = Helper::cutBetweenTag($content, 'currency');

        $currency = Helper::convertCurrencyNameToISO4217($currency);

        return [
            'balance' => $balance,
            'currency' => $currency,
        ];
    }
}