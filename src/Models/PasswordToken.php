<?php

namespace Jopanel\Hudsyn\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordToken extends Model
{
    protected $table = 'hud_password_tokens';

    // Ensure Eloquent formats timestamps as "Y-m-d H:i:s"
    protected $dateFormat = 'Y-m-d H:i:s';

    // Cast the timestamps explicitly
    protected $casts = [
        'expires_at'   => 'datetime:Y-m-d H:i:s',
        'created_at'   => 'datetime:Y-m-d H:i:s',
        'updated_at'   => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'user_id', 'token', 'expires_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
