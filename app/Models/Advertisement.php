<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Advertisement
 * @package App\Models
 *
 * @property int $id
 * @property string $url
 * @property string $image
 * @property string $starts_at
 * @property string $ends_at
 * @property int $position
 */
class Advertisement extends Model
{
    use HasFactory;

    const COLUMN_ID = 'id';

    protected $guarded = [self::COLUMN_ID];
}
