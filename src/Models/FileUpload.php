<?php

namespace Jopanel\Hudsyn\Models;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $table = 'hud_files';

    // Ensure Eloquent formats timestamps as "Y-m-d H:i:s"
    protected $dateFormat = 'Y-m-d H:i:s';

    // Cast the timestamps explicitly
    protected $casts = [
        'created_at'   => 'datetime:Y-m-d H:i:s',
        'updated_at'   => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'file_name',
        'original_name',
        'file_path',
        'file_size',
        'mime_type'
    ];
}
