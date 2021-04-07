<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $answer
 * @property int $weight
 * @property int $interview_id
 */
class Question extends Model
{
    use HasFactory;

    const COLUMN_ID = 'id';
    const COLUMN_NAME = 'name';

    protected $guarded = [self::COLUMN_ID];
}
