<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KNN extends Model
{
    use HasFactory;

    protected $table = 'knn';
    protected $fillable = ['precision', 'recall', 'f1-score', 'support', 'accuracy'];
}
