<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $registration_date_begin
 * @property Carbon $registration_date_end
 * @property Carbon $start_date_begin
 * @property Carbon $start_date_end
 * @property int $max_members_count
 * @property string $description
 * @property string $task
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Hackathon extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'registration_date_begin' => 'date',
        'registration_date_end' => 'date',
        'start_date_begin' => 'date',
        'start_date_end' => 'date',
    ];
}
