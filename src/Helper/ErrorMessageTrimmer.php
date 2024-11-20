<?php

namespace App\Helper;

final readonly class ErrorMessageTrimmer
{
    public static function trim(string $exceptionMessage): string
    {
        return preg_replace('/ returned for "http.*"/', '', $exceptionMessage);
    }
}
