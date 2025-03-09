<?php

namespace Jopanel\Hudsyn\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'hud_settings';

    // Ensure Eloquent formats timestamps as "Y-m-d H:i:s"
    protected $dateFormat = 'Y-m-d H:i:s';

    // Cast the timestamps explicitly
    protected $casts = [
        'created_at'   => 'datetime:Y-m-d H:i:s',
        'updated_at'   => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'key',
        'value'
    ];
}
