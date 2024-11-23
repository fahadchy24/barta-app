<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id', 'message', 'picture',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function reactions(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_reactions')->withTimestamps();
    }

    public function reactionCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->reactions()->count()
        );
    }

    public function pictureUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => asset(Storage::url($this->picture)),
        );
    }
}
