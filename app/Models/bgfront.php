<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bgfront extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_bg',
        'image_bgres',
    ];
}
