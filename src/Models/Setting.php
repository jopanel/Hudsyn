<?php

namespace Jopanel\Hudsyn\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'hud_settings';

    protected $fillable = [
        'key',
        'value'
    ];
}
