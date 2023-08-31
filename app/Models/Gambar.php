<?php

namespace App\Models;

use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;

    protected $fillable = [
        'properti_id',
        'gambar',
    ];

    public function properti()
    {
        return $this->belongsTo(Properti::class, 'properti_id', 'id');
    }
}
