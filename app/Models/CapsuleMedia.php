<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CapsuleMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'capsule_id',
        'file_path',
    ];
}
