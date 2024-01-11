<?php

namespace Yepbro\Smsc\Balance\Enums;

enum CurrencyFlag: int
{
    case YES = 1;
    case NO = 0;

    public static function tryFromName(string $name): ?CurrencyFlag
    {
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }

        return null;
    }
}