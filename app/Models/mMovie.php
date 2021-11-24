<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mMovie extends Model
{
    use HasFactory;
    protected $table = "movies";
    protected $guarded = [];
    public function getGenre()
    {
        return $this->belongsTo(mGenre::class, 'id_genre', 'id');
    }
    public function getSutradara()
    {
        return $this->belongsTo(mSutradara::class, 'id_sutradara', 'id');
    }
}
