<?php

namespace App\Enums;

enum Target: string
{
    case Blank = "_blank";
    case Self = "_self";

    public static function getTargetArray(): array
    {
        return array_column(Target::cases(), 'value');
    }
}
