<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Command
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property boolean $bindable
 * @property int $weight
 */
class Command extends Model
{
    use HasFactory;

    const COLUMN_ID  = 'id';
    const COLUMN_NAME = 'name';

    protected $guarded = [self::COLUMN_ID];
}
