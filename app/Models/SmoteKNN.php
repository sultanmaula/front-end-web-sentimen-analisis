<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmoteKNN extends Model
{
    use HasFactory;

    protected $table = 'smote_knn';
    protected $fillable = ['precision', 'recall', 'f1-score', 'support', 'accuracy'];
}
