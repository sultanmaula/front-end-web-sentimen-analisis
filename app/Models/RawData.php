<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawData extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'score',
        'at',
        'content',
        'flag'
    ];

    protected $table = 'raw_data';
}
