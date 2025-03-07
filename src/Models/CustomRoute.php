<?php

namespace Jopanel\Hudsyn\Models;

use Illuminate\Database\Eloquent\Model;

class CustomRoute extends Model
{
    protected $table = 'hud_custom_routes';

    protected $fillable = [
        'route',
        'content_type',
        'content_id'
    ];
}
