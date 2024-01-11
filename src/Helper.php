<?php

namespace Yepbro\Smsc;

class Helper
{
    /**
     * Приведение имени валюты к стандарту ISO 4217
     */
    public static function convertCurrencyNameToISO4217(?string $currency): ?string
    {
        if (empty($currency)) {
            return null;
        }

        return str_replace(['RUR'], ['RUB'], $currency);
    }

    /**
     * Получить данные внутри указанного тега
     */
    public static function cutBetweenTag(string $data, string $tag): ?string
    {
        $regex = '|<' . $tag . '>(.*?)</' . $tag . '>|s';

        preg_match($regex, $data, $matches);

        return $matches[1] ?? null;
    }
}