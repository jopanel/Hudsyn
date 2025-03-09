<?php

namespace Jopanel\Hudsyn\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'hud_pages';

    // Ensure Eloquent formats timestamps as "Y-m-d H:i:s"
    protected $dateFormat = 'Y-m-d H:i:s';

    // Cast the timestamps explicitly
    protected $casts = [
        'created_at'   => 'datetime:Y-m-d H:i:s',
        'updated_at'   => 'datetime:Y-m-d H:i:s',
        'published_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'is_homepage',
        'layout_header',
        'layout_footer',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'static_file_path',
        'published_at'
    ];
}
