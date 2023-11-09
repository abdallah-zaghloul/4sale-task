<?php

namespace Modules\Provider\Enums;

use Modules\Transaction\Traits\EnumToIterable;

enum ProviderEnum : string
{
    use EnumToIterable;

    case DataProviderX = 'DataProviderX';
    case DataProviderY = 'DataProviderY';


    public static function get(null|int|string $value): ?string
    {
        return @static::tryFrom($value)?->value;
    }
}
