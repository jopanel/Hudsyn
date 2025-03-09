<?php

namespace Jopanel\Hudsyn\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'hud_blog';

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
        'published_at',
        'author_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
