<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $hackathon_id
 * @property string $text
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Answer extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'date',
        'updated_at' => 'date',
    ];
}
