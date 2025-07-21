<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Scopes\OpenedScope;
use App\Models\Scopes\PublicScope;

#[ScopedBy([OpenedScope::class])]
#[ScopedBy([PublicScope::class])]
class Capsule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'open_date',
        'privacy',
        'surprise'
    ];
}
