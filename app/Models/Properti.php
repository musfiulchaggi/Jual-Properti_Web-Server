<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properti extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'harga',
        'nama_properti',
        'deskripsi',
        'lattitude',
        'longitude',
        'phone',
        'email',
        'provinsi',
        'kabupaten',
        'kecamatan'
    ];

    public function get_gambar()
    {
        return $this->hasMany(Gambar::class,'properti_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
