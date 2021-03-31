<?php

namespace App\Enums;

class AdvantageTypeEnum
{
    const TYPE_GRENADES = 1;
    const TYPE_BOOSTS = 2;
    const TYPE_TIPS_AND_TRICKS = 3;
    const TYPE_WALL_BANGS = 4;

    public static function labels()
    {
        return [
            self::TYPE_GRENADES => 'Grenades',
            self::TYPE_BOOSTS => 'Boosts',
            self::TYPE_TIPS_AND_TRICKS => 'Tips and tricks',
            self::TYPE_WALL_BANGS => 'Wall-bangs'
        ];
    }

    public static function label($key)
    {
        return self::labels()[$key];
    }
}
