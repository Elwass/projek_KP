<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function peserta()
    {
        return $this->hasOne(Peserta::class, 'id_pendaftar');
    }

    public function pendamping()
    {
        return $this->hasOneThrough(User::class, Peserta::class, 'id_pendaftar', 'id', 'id', 'id_user');
    }
}
