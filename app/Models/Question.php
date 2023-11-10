<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Question extends Model
{
    use HasFactory;

    // cast é conversor, para realmente vir conforme a gente expecificou, no caso o boolean
    protected $casts = [
        'draft' => 'bool',
    ];

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function likes(): Attribute
    {
        return new Attribute(get: fn () => $this->votes->sum('like')); //indo para o banco de dados fazer uma consulta e somando todos likes que tem do votes
    }

    public function unlikes(): Attribute
    {
        return new Attribute(get: fn () => $this->votes->sum('unlike'));
    }
}
