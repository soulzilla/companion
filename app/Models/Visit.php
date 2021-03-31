<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Visit
 * @package App\Models
 *
 * @property int $id
 * @property string $ip_address
 * @property string $fingerprint
 * @property string $created_at
 * @property string $updated_at
 */
class Visit extends Model
{
    const COLUMN_ID = 'id';

    protected $guarded = [self::COLUMN_ID];
}
