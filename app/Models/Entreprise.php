<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    public function payment()
    {
        return $this->hasMany(Payment::class, 'entreprise_id');
    }

    public function membres()
    {
        return $this->hasMany(Membre::class, 'entreprise_id');
    }

    public function atelierj1()
    {
        return $this->belongsTo(Atelier::class, 'atelier_j1_a1');
    }

    public function atelierj2()
    {
        return $this->belongsTo(Atelier::class, 'atelier_j1_a2');
    }

    public function atelierj3()
    {
        return $this->belongsTo(Atelier::class, 'atelier_j2_a1');
    }

    public function atelierj4()
    {
        return $this->belongsTo(Atelier::class, 'atelier_j2_a2');
    }


}
