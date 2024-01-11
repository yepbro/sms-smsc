<?php

namespace Yepbro\Smsc\Send\Enums;

enum Format: int
{
    case STRING = 0; // в виде строки (250.80)
    case DIGITS = 1; // в виде чисел через запятую
    case XML = 2; // в xml формате
    case JSON = 3; // в json формате
}
