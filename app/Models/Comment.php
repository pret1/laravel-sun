<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function childrenComments(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parentComment(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function likedProfiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class, 'comment_profile_likes');
    }

    public function category(): BelongsTo
    {
        return $this->post->category();
    }

    public function user(): BelongsTo
    {
        return $this->profile->user();
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function views(): MorphMany
    {
        return $this->morphMany(View::class, 'viewable');
    }
}
