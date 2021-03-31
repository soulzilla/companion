<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Map
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $canonical
 * @property string $logo
 * @property string $background_image
 * @property string $positions_image
 * @property int $weight
 * @property string $practice_map
 * @property string $practice_preview
 * @property string $created_at
 * @property string $updated_at
 */
class Map extends Model
{
    use HasFactory;

    const COLUMN_ID = 'id';
    const COLUMN_NAME = 'name';

    protected $guarded = [self::COLUMN_ID];
}
