<?php

namespace Yepbro\Smsc\Balance\Enums;

enum Format: int
{
    case STRING = 1; // в виде строки (250.80)
    case XML = 2; // в xml формате
    case JSON = 3; // в json формате

    public static function tryFromName(string $name): ?Format
    {
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }

        return null;
    }
}
