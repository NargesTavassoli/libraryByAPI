<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Uuids;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'user_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id', 'id');
    }

    protected $with = ['books'];

    public function generateToken()
    {
        $api_token = \Str::random(50);
        $this->api_token = $api_token;
        $this->save();
        return $api_token;
    }

    public function logout()
    {
        $this->api_token = null;
        $this->save();
    }
}
