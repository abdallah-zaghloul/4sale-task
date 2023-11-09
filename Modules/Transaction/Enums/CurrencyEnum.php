<?php

namespace Modules\Transaction\Enums;

use Modules\Transaction\Traits\EnumToIterable;

enum CurrencyEnum : string
{
    use EnumToIterable;

    case AED = 'AED';
    case USD = 'USD';


    public static function get(null|int|string $value): ?string
    {
        return @static::tryFrom($value)?->value;
    }
}
