<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'recipient', 'address', 'phone', 'province_id', 'city_id', 'district', 'sub_district', 'zip_code'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function addRecipient($data)
    {

        return $this->create([
            'user_id' => auth()->user()->id,
            'recipient' => $data['recipient'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'province_id' => $data['province_id'],
            'city_id' => $data['city_id'],
            'district' => $data['district'],
            'sub_district' => $data['sub_district'],
            'zip_code' => $data['zip_code'],
        ]);
    }

    public function getRecipient()
    {
        return $this->join('provinces', 'provinces.id', '=', 'recipients.province_id')
            ->join('cities', 'cities.id', '=', 'recipients.city_id')
            ->where('user_id', auth()->user()->id)
            ->get();
    }
}
