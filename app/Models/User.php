<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Permission;

#[ObservedBy(UserObserver::class)]
class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'login',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $withCount = ['userNotifications'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

//    protected static function booted(): void
//    {
//        static::created(function (User $user) {
//            $user->profile()->create([
//                'name' => 'Vasy',
//                'phone' => '7777777777777',
//                'address' => 'asdasdasdasdasd',
//                'gender' => 'male',
//            ]);
//        });
//    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function roles(): belongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function comments(): HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, Profile::class);
    }

    //another approach
//    public function comments(): HasManyThrough
//    {
//        return $this->through('profile')->has('comments');
//        return $this->throughProfile()->hasComments();
//    }

    public function posts(): HasManyThrough
    {
        return $this->hasManyThrough(Post::class, Profile::class);
    }

    public function articles(): HasManyThrough
    {
        return $this->hasManyThrough(Article::class, Profile::class);
    }

    public function getIsAdminAttribute(): bool
    {
        return auth()->user()->roles->contains('title', 'admin');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }

    public function hasPermission(string $permissionName): bool
    {
        return $this->permissions()->where('name', $permissionName)->exists();
    }

    public function userNotifications(): HasMany
    {
        return $this->hasMany(UserNotification::class);
    }

}
