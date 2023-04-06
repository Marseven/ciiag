<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;

    protected $table = 'queries';

    public function user()
    {
    	return $this->belongsTo(User::class, 'customer_id');
    }

}
