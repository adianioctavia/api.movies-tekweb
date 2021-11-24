<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mSutradara extends Model
{
    use HasFactory;
    protected $table = "sutradara";
    protected $fillable = [
        "nama",
        "ttl",
        "pendidikan"
    ];
}
