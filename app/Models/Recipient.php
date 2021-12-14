<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'recipient', 'address', 'phone', 'province', 'city', 'district', 'sub_district', 'zip_code'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
