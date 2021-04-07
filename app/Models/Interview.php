<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Interview
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $respondent_name
 * @property string $respondent_photo
 * @property string $respondent_info
 * @property boolean $published
 * @property Question[] $questions
 */
class Interview extends Model
{
    use HasFactory;

    const COLUMN_ID  = 'id';
    const COLUMN_NAME = 'name';

    protected $guarded = [self::COLUMN_ID];

    public function questions()
    {
        return $this->hasMany(Question::class, 'interview_id', 'id');
    }
}
