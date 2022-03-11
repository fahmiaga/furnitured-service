<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    // ['status', 'total_cost', 'start_booking', 'end_booking']

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
