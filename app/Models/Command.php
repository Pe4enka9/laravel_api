<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $hackathon_id
 * @property int $owner_id
 * @property array $teammates
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method static owner()
 * @method static teammates()
 */
class Command extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function teammates(): HasMany
    {
        return $this->hasMany(User::class, 'command_id');
    }
}
