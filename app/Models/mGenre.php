<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mGenre extends Model
{
    use HasFactory;
    protected $table = "genre";
    protected $fillable = [
        "genre"
    ];
}
