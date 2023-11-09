<?php

namespace Modules\Transaction\Enums;

use Exception;
use Modules\Transaction\Traits\EnumToIterable;

enum ProviderStatusCodeEnum
{
    use EnumToIterable;

    case Authorised;
    case Decline;
    case Refunded;


    /**
     * @param int|string|null $value
     * @return self|null
     */
    public static function parse(int|string|null $value): ?self
    {
        return match (ucwords($value)){
            '1', '100','Authorised' => self::Authorised,
            '2', '200','Decline' => self::Decline,
            '3', '300','Refunded' => self::Refunded,
            default => null
        };
    }

    /**
     * @param int|string|null $value
     * @return string|null
     */
    public static function get(int|string|null $value): ?string
    {
        return self::parse($value)?->name;
    }
}
