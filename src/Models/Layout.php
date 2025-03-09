<?php

namespace Jopanel\Hudsyn\Models;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    protected $table = 'hud_layouts';

    // Ensure Eloquent formats timestamps as "Y-m-d H:i:s"
    protected $dateFormat = 'Y-m-d H:i:s';

    // Cast the timestamps explicitly
    protected $casts = [
        'created_at'   => 'datetime:Y-m-d H:i:s',
        'updated_at'   => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'name',
        'header_file',
        'footer_file'
    ];
}
