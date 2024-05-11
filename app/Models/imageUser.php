<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imageUser extends Model
{
    use HasFactory;
     protected $fillable = [
        'image_name',
        'user_id',
    ];
}
