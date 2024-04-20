<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    protected $user_role = [
        'creator',
        'participant',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function creator(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->wherePivot('role', 'creator');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->wherePivot('role', 'participant');
    }

}
