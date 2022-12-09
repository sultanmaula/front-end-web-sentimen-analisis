<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preprocessing extends Model
{
    use HasFactory;

    protected $table = 'preprocessing';
    protected $fillable = ['username', 'content', 'review_tokens', 'review_tokens_fdist', 'review_tokens_WSW', 'review_normalized', 'review_tokens_stemmed'];
}
