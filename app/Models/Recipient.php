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

    public function addRecipient($data)
    {

        return $this->create([
            'user_id' => auth()->user()->id,
            'recipient' => $data['recipient'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'province' => $data['province'],
            'city' => $data['city'],
            'district' => $data['district'],
            'sub_district' => $data['sub_district'],
            'zip_code' => $data['zip_code'],
        ]);
    }

    public function getRecipient()
    {
        return $this->where('user_id', auth()->user()->id)->get();
    }
}
