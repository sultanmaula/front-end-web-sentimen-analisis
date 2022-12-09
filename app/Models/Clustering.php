<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clustering extends Model
{
    use HasFactory;

    protected $table = 'clustering';
    protected $fillable = ['username', 'content', 'cluster'];
}