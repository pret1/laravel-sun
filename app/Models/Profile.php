<?php

namespace App\Models;

use App\Models\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasLog;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

//    public function likedPosts(): BelongsToMany
//    {
//        return $this->belongsToMany(Post::class, 'post_profile_likes');
//    }

    public function likedPosts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'likeable');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

//    public function likedComments(): BelongsToMany
//    {
//        return $this->belongsToMany(Comment::class, 'comment_profile_likes');
//    }
    public function likedComments(): BelongsToMany
    {
        return $this->morphedByMany(Comment::class, 'likeable', 'likeables')->withTimestamps();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function viewedComments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'viewable');
    }

    public function viewedPosts(): MorphToMany
    {
        return $this->morphToMany(Post::class, 'viewable');
    }
}
