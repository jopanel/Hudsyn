<?php

namespace Jopanel\Hudsyn\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'hud_users';

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password'
    ];

    // Ensure Eloquent formats timestamps as "Y-m-d H:i:s"
    protected $dateFormat = 'Y-m-d H:i:s';

    // Cast the timestamps explicitly
    protected $casts = [
        'created_at'   => 'datetime:Y-m-d H:i:s',
        'updated_at'   => 'datetime:Y-m-d H:i:s',
    ];

    // Relationships

    public function passwordTokens()
    {
        return $this->hasMany(PasswordToken::class, 'user_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'author_id');
    }

    public function pressReleases()
    {
        return $this->hasMany(PressRelease::class, 'author_id');
    }
}
