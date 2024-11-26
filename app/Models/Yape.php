<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yape extends Model
{
    use HasFactory;

    protected $fillable = ['titular', 'telefono'];

    //Relación polimorfica 1 * 1
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
