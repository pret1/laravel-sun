<?php

namespace App\Models;

use App\Http\Filter\PostFilter;
use App\Models\Traits\HasFilter;
use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

#[ObservedBy(PostObserver::class)]
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFilter;

    protected $withCount = ['likedProfiles'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

//    public function likedProfiles(): BelongsToMany
//    {
//        return $this->belongsToMany(Profile::class, 'post_profile_likes');
//    }
    public function likedProfiles(): MorphToMany
    {
        return $this->morphToMany(Profile::class, 'likeable')->withTimestamps();
    }

//    public function comments(): HasMany
//    {
//        return $this->hasMany(Comment::class);
//    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function user(): ?BelongsTo
    {
        return $this->profile?->user();
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

//    public function views(): MorphMany
//    {
//        return $this->morphMany(View::class, 'viewable');
//    }

    public function viewedProfiles(): MorphToMany
    {
        return $this->morphToMany(Profile::class, 'viewable');
    }

    public function getImageUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->image?->image_path);
    }

    public function getIsLikedAttribute(): bool
    {
        return $this->likedProfiles->contains('id', auth()->user()->profile->id);
    }

}
