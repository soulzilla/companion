<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Advantage
 * @package App\Models
 *
 * @property int $id
 * @property int $map_id
 * @property int $type
 * @property int|null $group_type
 * @property string $name
 * @property string $description
 * @property string $video_url
 */
class Advantage extends Model
{
    use HasFactory;

    const COLUMN_ID = 'id';
    const COLUMN_NAME = 'name';

    protected $guarded = [self::COLUMN_ID];
}
