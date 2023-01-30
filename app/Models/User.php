<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        //+
        'img_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function from_users()
    {
        return $this->belongsToMany(self::class, "swipes", "from_user_id", "to_user_id")->withTimestamps();
    }

    public function to_users()
    {
        return $this->belongsToMany(self::class, "swipes", "to_user_id", "from_user_id")->withTimestamps();
    }

    public function is_like($filter)
    {
        return $this->belongsToMany(self::class, "swipes", "from_user_id", "to_user_id")->wherePivot('is_like', $filter)->wherePivot('to_user_id', Auth::id())->withTimestamps();
    }


    public function matches()
    {
        $ids = $this->to_users()->where('is_like', true)->pluck('from_user_id');
        return $this->from_users()->wherePivot('is_like', true)->wherePivotIn('to_user_id', $ids);
    }

}
