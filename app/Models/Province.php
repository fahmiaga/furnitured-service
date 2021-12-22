<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function recipients()
    {
        return $this->hasMany(Recipient::class, 'province_id');
    }
}
